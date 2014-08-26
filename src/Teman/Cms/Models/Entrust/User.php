<?php namespace Teman\Cms\Models\Entrust;


use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\UserTrait;
use Illuminate\Support\Facades\Hash;
use LaravelBook\Ardent\Ardent;
use Zizaco\Entrust\HasRole;

class User extends Ardent  implements UserInterface, RemindableInterface{

    use HasRole;
    use UserTrait, RemindableTrait;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';


    public static $rules = [
        "email" => 'required|email|unique:users',
        "password" => 'required|min:6'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');


    protected $fillable = ['email', 'password'];


    /**
     * Passwords must always be hashed
     * @param $password
     */
    public function setPasswordAttribute($password){
        $this->attributes['password'] = Hash::make($password);
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
        $this->attributes['username'] = $email;
    }
}