<?php

namespace Modules\RH\Providers\Filament;

use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Config;
use Illuminate\View\Middleware\ShareErrorsFromSession;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Filament\FontProviders\SpatieGoogleFontProvider;
use Filament\Navigation\NavigationItem;
use Filament\Pages\Dashboard;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationBuilder;
use Filament\Navigation\MenuItem;
use Filament\Facades\Filament;

use App\Filament\AvatarProviders\AnnudefAvatarProvider;
use App\Providers\Filament\Traits\UsesSkeletorPrefixAndMultitenancyTrait;
use App\Http\Middleware\InitializeTenancyByPath;
use App\Http\Middleware\SetTenantCookieMiddleware;
use App\Http\Middleware\SetTenantDefaultForRoutesMiddleware;
use App\Filament\Pages\UserPreferences;

use Modules\RH\Filament\RH\Resources\MarinResource;
use Nwidart\Modules\Facades\Module;

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
                'primary' => Color::Cyan,
            ])
            ->defaultAvatarProvider(AnnudefAvatarProvider::class)
            ->brandName("Ressources humaines")
            ->profile(UserPreferences::class)
            ->discoverResources(in: module_path($this->module, 'app/Filament/RH/Resources'), for: "$moduleNamespace\\Filament\\RH\\Resources")
            ->discoverPages(in: module_path($this->module, 'app/Filament/RH/Pages'), for: "$moduleNamespace\\Filament\\RH\\Pages")
            ->pages([
                Dashboard::class,
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
            ->userMenuItems($this->getConditionalUserMenuItems());
    }

    /**
     * Menu utilisateur conditionnel (MEnu Avatar)
     */
    private function getConditionalUserMenuItems(): array
    {
        $menuItems = [
            'help' => MenuItem::make()
                ->label('Aide')
                ->icon('heroicon-m-question-mark-circle')
                ->url(fn () => url(config('skeletor.prefixe_instance') . '/docs/' . Filament::getCurrentPanel()->getId()) . '/', shouldOpenInNewTab: true),
            
            'apidoc' => MenuItem::make()
                ->label('API')
                ->icon('heroicon-m-cloud')
                ->url(fn () => url(route('l5-swagger.default.api')), shouldOpenInNewTab: true),
            'version' => MenuItem::make()
                ->label($this->module . ' v' . Module::find($this->module)->get('version'))
        ];

        return $menuItems;
    }

    protected function getModuleNamespace(): string
    {
        return config('modules.namespace').'\\'.$this->module;
    }
}
