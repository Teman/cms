<?php namespace Teman\Cms\Models\Entrust;


use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\UserTrait;
use Illuminate\Support\Facades\Hash;
use Zizaco\Entrust\HasRole;

class User extends \Eloquent implements UserInterface, RemindableInterface{

    use UserTrait, RemindableTrait;
    use HasRole;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

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