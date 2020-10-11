<?PHP

namespace ConfrariaWeb\Acl\Services;

use ConfrariaWeb\Acl\Contracts\RoleContract;
use ConfrariaWeb\Vendor\Traits\ServiceTrait;

class RoleService
{
    use ServiceTrait;

    public function __construct(RoleContract $role)
    {
        $this->obj = $role;
    }

    function pluck()
    {
        return $this->obj->pluck('display_name', 'id');
    }

}
