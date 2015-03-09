<?php namespace Teman\Cms\Models\Entrust;

use Illuminate\Support\Facades\Config;

class PasswordHistory extends \Eloquent{

    protected $fillable = ['password', 'user_id'];

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
        $this->table = Config::get('cms::table_prefix').'password_history';
    }
}
