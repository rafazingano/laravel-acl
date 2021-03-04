<?php

namespace ConfrariaWeb\Acl\Scopes;

use Auth;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class AccountRoleScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $account = account();
        $account_id = $account->id;
        if (!app()->runningInConsole() && existsAccount()) {
            $builder->where(function ($query) use($account_id){
                $query->where(Config::get('cw_acl.roles_table') . '.account_id', $account_id)
                    ->orWhereNull(Config::get('cw_acl.roles_table') . '.account_id');
            });
        }
    }
}
