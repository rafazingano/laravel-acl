<?php

namespace ConfrariaWeb\Acl\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Role extends Model
{
    protected $table = 'acl_roles';

    protected $fillable = [
        'name',
        'display_name',
        'description',
        'settings',
    ];

    protected $casts = [
        'settings' => 'collection'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = Config::get('cw_acl.roles_table');
    }

    public function permissions()
    {
        return $this->belongsToMany('ConfrariaWeb\Acl\Models\Permission', Config::get('cw_acl.permission_role_table'));
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User', Config::get('cw_acl.role_user_table'));
    }

}
