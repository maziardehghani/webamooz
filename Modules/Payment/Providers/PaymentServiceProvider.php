<?php

namespace Modules\Payment\Providers;

use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Modules\Payment\GateWays\ZarinPal\GateWay;
use Modules\Payment\GateWays\ZarinPal\ZarinpalAdaptor;
use Modules\Payment\Models\Payment;
use Modules\Payment\Models\Sattlement;
use Modules\Payment\Policies\PaymentsPolicy;
use Modules\Payment\Policies\SattlementPolicy;
use Modules\RolePermissions\Models\Permission;

class PaymentServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'Payment';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'payment';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {

        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->loadJsonTranslationsFrom(__DIR__ .'/../Resources/lang');
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));
        $this->app->singleton(GateWay::class , function ($app)
        {
            return new ZarinpalAdaptor();
        });
        Gate::before(function ($user)
        {
            return $user->hasPermissionTo(Permission::PERMISSION_SUPER_ADMIN) ? true : null;
        });
        Gate::policy(Payment::class , PaymentsPolicy::class);
        Gate::policy(Sattlement::class , SattlementPolicy::class);
        $this->app->booted(function ()
        {
            config()->set('sidebar.item.myShop',
                [
                    'icon' => 'i-my__purchases ',
                    'title' =>'my payments',
                    'url' => route('dashboard.myShop.index'),

                ]
            );
            config()->set('sidebar.item.payments',
                [
                    'icon' => 'i-transactions',
                    'title' =>'transactions',
                    'url' => route('dashboard.payments'),
                    'permission' => [
                        Permission::PERMISSION_MANAGEMENT,
                    ],
                ]
            );
            config()->set('sidebar.item.sattlementRequest',
                [
                    'icon' => 'i-checkout__request',
                    'title' =>'settlement request',
                    'url' => route('dashboard.sattlement.create'),
                    'permission' => [
                        Permission::PERMISSION_MANAGEMENT,
                        Permission::PERMISSION_TEACHER,
                    ],
                ]
            );
            config()->set('sidebar.item.sattlement',
                [
                    'icon' => 'i-checkouts',
                    'title' =>'settlement',
                    'url' => route('dashboard.sattlement.index'),
                    'permission' => [
                        Permission::PERMISSION_MANAGEMENT,
                        Permission::PERMISSION_TEACHER,
                    ],
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
        $this->app->register(EventServiceProvider::class);

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
