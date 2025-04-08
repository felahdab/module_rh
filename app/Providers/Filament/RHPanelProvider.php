<?php

namespace Modules\RH\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;


use Filament\FontProviders\SpatieGoogleFontProvider;
use App\Filament\AvatarProviders\AnnudefAvatarProvider;
use App\Providers\Filament\Traits\UsesSkeletorPrefixAndMultitenancyTrait;

use App\Http\Middleware\InitializeTenancyByPath;
use App\Http\Middleware\SetTenantCookieMiddleware;
use App\Http\Middleware\SetTenantDefaultForRoutesMiddleware;

// Test Julien
use Modules\FcmCommun\Helpers\NavigationFilamentHelper;
use Filament\Navigation\NavigationItem;
use Filament\Pages\Dashboard;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationBuilder;
use Modules\RH\Filament\RH\Resources\MarinResource;
use Modules\FCmCentral\Filament\Fcmcentral\Resources\MarinResource as FcmCentralMarinResource;
use Modules\FCmCommun\Filament\Fcmcommun\Resources\MarinResource as FcmCommunMarinResource;

class RHPanelProvider extends PanelProvider
{
    use UsesSkeletorPrefixAndMultitenancyTrait;

    private string $module = "RH";

    public function panel(Panel $panel): Panel
    {
        $moduleNamespace = $this->getModuleNamespace();
        return $panel
            ->id('RH')
            ->path($this->prefix . '/rh')
            ->colors([
                'primary' => Color::Teal,
            ])
            ->font('Inter', provider: SpatieGoogleFontProvider::class)
            ->defaultAvatarProvider(AnnudefAvatarProvider::class)
            ->brandName("Ressources humaines")
            ->discoverResources(in: module_path($this->module, 'app/Filament/RH/Resources'), for: "$moduleNamespace\\Filament\\RH\\Resources")
            ->discoverPages(in: module_path($this->module, 'app/Filament/RH/Pages'), for: "$moduleNamespace\\Filament\\RH\\Pages")
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: module_path($this->module, 'app/Filament/RH/Widgets'), for: "$moduleNamespace\\Filament\\RH\\Widgets")
            ->widgets([
                // Widgets\AccountWidget::class,
                // Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                InitializeTenancyByPath::class,
                SetTenantDefaultForRoutesMiddleware::class,
                SetTenantCookieMiddleware::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            // Menu Side Bar Haut
            ->topNavigation()
            ->navigationItems([   
                // Decompacte le tableau
                ...NavigationFilamentHelper::registerNavigationsItems()
            ])  
 /*
            // Ajout Menu Supp TEST
            ->navigationItems([
                NavigationItem::make('Google')
                    ->url('https://google.fr', shouldOpenInNewTab:true)
                    ->icon('heroicon-o-presentation-chart-line')
                    ->group('Test')
                    ->sort(2)
                    ->visible(fn():bool => auth()->user()->can('users.store')),
                NavigationItem::make('dashboard')
                    ->label(fn():string => __('filament-panels::pages/dashboard.title'))
                    ->url(fn (): string => Dashboard::getUrl())
                    ->icon('heroicon-o-presentation-chart-line')
                    ->isActiveWhen(fn () => request()->routeIs('filament.RH.pages.dashboard'))
                    ->group('Test')
                    ->sort(3)
                    ->hidden(fn():bool => ! auth()->user()->can('users.store')),
            ])
            ->navigationGroups([
                'Test',
                'Categories',
            ])
               
            ->navigation(function (NavigationBuilder $builder): NavigationBuilder {
                // return $builder->items([
                 //    NavigationItem::make('TataYoYo')
                 //        ->icon('heroicon-o-home')
                 //        ->isActiveWhen(fn (): bool => request()->routeIs('filament.admin.pages.dashboard'))
                 //        ->url(fn (): string => Dashboard::getUrl()),
                 //    ...MarinResource::getNavigationItems(),
                     //...Settings::getNavigationItems(),
                 // ]);
                 return $builder->groups([
                     NavigationGroup::make('Website')
                         ->items([
                             ...MarinResource::getNavigationItems(),
                             ...FcmCentralMarinResource::getNavigationItems(),
                             ...FcmCommunMarinResource::getNavigationItems(),
                         ]),
                 ]);
             });
*/
            
    
    
            /*
            ->navigationGroups([
                NavigationGroup::make()
                    ->label('Test'),
                    
                NavigationGroup::make()
                    ->label('Categories')
                    ->icon('heroicon-o-presentation-chart-line') ,
            ])
            */
            ;
    }

    protected function getModuleNamespace(): string
    {
        return config('modules.namespace').'\\'.$this->module;
    }
}
