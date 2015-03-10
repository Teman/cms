<?php namespace Teman\Cms\Models\Entrust;

use Carbon\Carbon;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\UserTrait;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;

use Laracasts\Flash\Flash;
use LaravelBook\Ardent\Ardent;
use Zizaco\Entrust\HasRole;
use Teman\Cms\Models\Entrust\PasswordHistory;

class User extends Ardent  implements UserInterface, RemindableInterface{

    use HasRole, UserTrait, RemindableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');

    protected $fillable = ['email', 'password'];

    /**
     * Creates a new instance of the model.
     *
     * @return void
     */
    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
        $this->table = Config::get('cms::table_prefix').'users';
    }

    /**
     * Passwords must always be hashed
     * @param $password
     */
    public function setPasswordAttribute($password){
        $this->attributes['password'] = Hash::make($password);
        //trigger password expiry date increase
        $this->setPasswordExpiry();
    }


    public function setPasswordExpiry(){
        if($days = Config::get('cms::auth.password_valid')) {
            $this->expires = Carbon::now()->addDays($days);
        }

        if(Config::get('cms::auth.password_different') and $this->id>0){
            //old password
            PasswordHistory::create(['user_id'=>$this->id, 'password'=>$this->attributes['password']]);
        }

        return $this;
    }

    //is the user's password expired?
    public function isExpired(){
        if($days = Config::get('cms::auth.password_valid')) {
            $diff = strtotime($this->expires) - time();
            if($diff<=0){
                return true;
            }
        }
        return false;
    }

    /**
     * Username =  email
     * @param $password
     */
    public function getUsernameAttribute(){
        return $this->email;
    }

    /**
     * Set username to email before save & force lowercase+trim
     */
    public function setEmailAttribute($email){
        $email = trim(strtolower($email));
        $this->attributes['email'] = $email;
        if(Config::get('cms::auth.has_username')) {
            $this->attributes['username'] = $email;
        }
    }

    public function getDates(){
        return ['created_at', 'updated_at', 'expires', 'last_login_attempt'];
    }

    //returns array of last X passwords
    public function oldPasswords(){
        if(Config::get('cms::auth.password_different')>0) {
            return $this->hasMany('Teman\Cms\Models\Entrust\PasswordHistory')->latest()->take(Config::get('cms::auth.password_different'))->lists('password');
        }else{
            return [];
        }
    }
}