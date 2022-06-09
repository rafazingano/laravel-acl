<?PHP

namespace ConfrariaWeb\Acl\Services;

use ConfrariaWeb\Acl\Models\Role;

class RoleService
{

    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    function pluck()
    {
        return $this->role->pluck('display_name', 'id');
    }

}
