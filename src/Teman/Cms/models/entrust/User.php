<?php namespace Teman\Cms\Models\Entrust;


use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\UserTrait;
use Illuminate\Support\Facades\Hash;
use LaravelBook\Ardent\Ardent;
use Zizaco\Entrust\HasRole;
use Zizaco\Confide\ConfideUser;
use Zizaco\Confide\ConfideUserInterface;

class User extends Ardent implements UserInterface, RemindableInterface, ConfideUserInterface{

    use UserTrait, RemindableTrait;
    use HasRole;
    use ConfideUser;

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


    public function setPasswordAttribute($password){
        $this->attributes['password'] = Hash::make($password);
    }

}