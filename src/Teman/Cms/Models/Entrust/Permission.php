<?php namespace Teman\Cms\Models\Entrust;

use Zizaco\Entrust\EntrustPermission;

use Illuminate\Support\Facades\Config;

class Permission extends EntrustPermission{

    protected $fillable = ['name', 'display_name'];

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
        $this->table = Config::get('cms::table_prefix').'permissions';
    }
}