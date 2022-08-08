<?php

namespace ConfrariaWeb\Acl\Traits;

use ConfrariaWeb\Acl\Models\Permission;
use ConfrariaWeb\Acl\Models\Role;
use Illuminate\Support\Facades\Config;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

trait AclUserTrait
{

    use HasRelationships;

    public function permissions()
    {
        return $this->hasManyDeep(Permission::class, ['acl_role_user', Role::class, 'acl_permission_role']);
    }

    public function isAdmin()
    {
        return in_array($this->email, Config::get('cw_acl.administrator.emails'));
    }

    public function roles()
    {
        return $this->belongsToMany(Config::get('cw_acl.role'), Config::get('cw_acl.role_user_table'), Config::get('cw_acl.user_foreign_key'));
    }

    public function hasRole($role)
    {
        return $this->isAdmin() || $this->roles->contains('name', $role);
    }

    public function hasPermission($permission)
    {
        return ($this->isAdmin() || $this->permissions->contains('name', $permission));
    }
}
