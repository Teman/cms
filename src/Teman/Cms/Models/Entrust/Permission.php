<?php namespace Teman\Cms\Models\Entrust;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission{

    protected $fillable = ['name', 'display_name'];

}