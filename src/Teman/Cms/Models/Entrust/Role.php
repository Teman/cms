<?php namespace Teman\Cms\Models\Entrust;

use Zizaco\Entrust\EntrustRole;

use Illuminate\Support\Facades\Config;

class Role extends EntrustRole{

    protected $fillable = ['name'];

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
        $this->table = Config::get('cms::table_prefix').'roles';
    }
}
