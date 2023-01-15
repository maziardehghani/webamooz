<?php

namespace Modules\User\Providers;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Modules\RolePermissions\Models\Permission;
use Modules\User\Database\Seeders\UserTableSeeders;
use Modules\User\Http\Middleware\StoreUser;
use Modules\User\Models\User;
use Modules\User\policies\UserPolicy;

class UserServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'User';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'user';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->loadJsonTranslationsFrom( __DIR__ .'/../Resources/lang');


        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));

        Gate::before(function ($user)
        {
            return $user->hasPermissionTo(Permission::PERMISSION_SUPER_ADMIN) ? true :null;
        });
        Gate::policy(User::class , UserPolicy::class);

        $this->app->booted(function ()
        {
            config()->set('sidebar.item.user',
                [
                    'icon' => 'i-users',
                    'title' => 'کاربران',
                    'url' => route('dashboard.users'),
                    'permission' => Permission::PERMISSION_MANAGEMENT,

                ]
            );
            config()->set('sidebar.item.profile',
                [
                    'icon' => 'i-users__information',
                    'title' => 'اطلاعات کاربری',
                    'url' => route('dashboard.users.profile'),
                ]
            );

        });

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);

        $this->app['router']->pushMiddlewareToGroup('web' , StoreUser::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path($this->moduleName, 'Config/config.php') => config_path($this->moduleNameLower . '.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path($this->moduleName, 'Config/config.php'), $this->moduleNameLower
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/' . $this->moduleNameLower);

        $sourcePath = module_path($this->moduleName, 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], ['views', $this->moduleNameLower . '-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/' . $this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'Resources/lang'), $this->moduleNameLower);
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (\Config::get('view.paths') as $path) {
            if (is_dir($path . '/modules/' . $this->moduleNameLower)) {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }
        }
        return $paths;
    }
}
