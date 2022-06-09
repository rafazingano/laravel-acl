<?php

namespace ConfrariaWeb\Acl\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AclServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../databases/Migrations');
        $this->publishes([__DIR__ . '/../../config/cw_acl.php' => config_path('cw_acl.php')], 'config');

        Blade::directive('role', function($expression) {
            return "<?php if(auth()->user()->hasRole({$expression})) : ?>";
        });

        Blade::directive('endrole', function() {
            return "<?php endif; ?>";
        });

        Blade::directive('permission', function($expression) {
            return "<?php if(auth()->user()->hasPermission({$expression})) : ?>";
        });

        Blade::directive('endpermission', function() {
            return "<?php endif; ?>";
        });

    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

}
