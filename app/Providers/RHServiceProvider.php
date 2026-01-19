<?php

namespace Modules\RH\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

use App\Filament\PanelRegistry\DirectMenuItem;
use App\Filament\PanelRegistry\PreferedPageItem;
use App\Filament\PanelRegistry\ModuleDefinedMenusRegistry;
use App\Filament\PanelRegistry\ModuleDefinedPreferedPagesRegistry;

use Modules\RH\Console\ResetTestDatabase;
use Modules\RH\Models\Brevet;
use Modules\RH\Policies\BrevetPolicy;

use Modules\RH\Models\Grade;
use Modules\RH\Policies\GradePolicy;

use Modules\RH\Models\Marin;
use Modules\RH\Policies\MarinPolicy;

use Modules\RH\Models\Specialite;
use Modules\RH\Policies\SpecialitePolicy;

use Modules\RH\Models\Unite;
use Modules\RH\Policies\UnitePolicy;

use Modules\RH\Models\TypeUnite;
use Modules\RH\Policies\TypeUnitePolicy;

use Modules\RH\Filament\RH\Resources\MarinResource\Pages\ListMarins;


class RHServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'RH';

    protected string $moduleNameLower = 'rh';

    /**
     * Boot the application events.
     */
    public function boot(): void
    {
        $this->registerCommands();
        $this->registerCommandSchedules();
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'database/migrations'));
    }

    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);
        $this->registerPolicies();

        $this->registerDirectMenuItems();
        $this->registerPreferedPagesItems();
    }

    public function registerPolicies()
    {
        $policies = [
            Brevet::class => BrevetPolicy::class,
            Grade::class => GradePolicy::class,
            Marin::class => MarinPolicy::class,
            Specialite::class => SpecialitePolicy::class,
            Unite::class => UnitePolicy::class,
            TypeUnite::class => TypeUnitePolicy::class

        ];
        foreach ($policies as $model => $policy){
            Gate::policy($model, $policy);
        }
    }

    public function registerDirectMenuItems()
    {
        app(ModuleDefinedMenusRegistry::class)->registerDirectMenuItems([
            DirectMenuItem::make()
                ->name('RH')
                ->visible(fn() => auth()->check() && auth()->user()->can('rh::marins.index'))
                ->children([
                    DirectMenuItem::make()
                        ->name('Gestion des marins')
                        ->url(fn() => ListMarins::getUrl(panel: "RH"))
                        ->visible(function() {return auth()->check() && auth()->user()->can('rh::marins.index'); }),
                ])
        ]);
   
    }

    public function registerPreferedPagesItems()
    {
        app(ModuleDefinedPreferedPagesRegistry::class)->registerPreferedPagesItems(
            [
            PreferedPageItem::make()
                ->name('RH: Gestion des marins')
                ->visible(fn() => auth()->check() && auth()->user()->can('rh::marins.index'))
                ->routeName(fn() => ListMarins::getRouteName(panel: 'RH')),
            ]
        );
    }

    /**
     * Register commands in the format of Command::class
     */
    protected function registerCommands(): void
    {
        $this->commands([
            ResetTestDatabase::class,
        ]);
    }

    /**
     * Register command Schedules.
     */
    protected function registerCommandSchedules(): void
    {
        // $this->app->booted(function () {
        //     $schedule = $this->app->make(Schedule::class);
        //     $schedule->command('inspire')->hourly();
        // });
    }

    /**
     * Register translations.
     */
    public function registerTranslations(): void
    {
        $langPath = resource_path('lang/modules/'.$this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
            $this->loadJsonTranslationsFrom($langPath);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'lang'), $this->moduleNameLower);
            $this->loadJsonTranslationsFrom(module_path($this->moduleName, 'lang'));
        }
    }

    /**
     * Register config.
     */
    protected function registerConfig(): void
    {
        $this->publishes([module_path($this->moduleName, 'config/config.php') => config_path($this->moduleNameLower.'.php')], 'config');
        $this->mergeConfigFrom(module_path($this->moduleName, 'config/config.php'), $this->moduleNameLower);
    }

    /**
     * Register views.
     */
    public function registerViews(): void
    {
        $viewPath = resource_path('views/modules/'.$this->moduleNameLower);
        $sourcePath = module_path($this->moduleName, 'resources/views');

        $this->publishes([$sourcePath => $viewPath], ['views', $this->moduleNameLower.'-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);

        $componentNamespace = str_replace('/', '\\', config('modules.namespace').'\\'.$this->moduleName.'\\'.ltrim(config('modules.paths.generator.component-class.path'), config('modules.paths.app_folder','')));
        Blade::componentNamespace($componentNamespace, $this->moduleNameLower);
    }

    /**
     * Get the services provided by the provider.
     */
    public function provides(): array
    {
        return [];
    }

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (config('view.paths') as $path) {
            if (is_dir($path.'/modules/'.$this->moduleNameLower)) {
                $paths[] = $path.'/modules/'.$this->moduleNameLower;
            }
        }

        return $paths;
    }
}
