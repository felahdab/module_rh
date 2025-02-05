<?php

namespace Modules\RH\Filament\RH\Pages;

use Filament\Pages\Page;

use App\Models\Setting;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Fieldset;

use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Form;
use Filament\Actions\Action;
use Filament\Forms\Get;

use Modules\RH\Models\Unite;

class Configuration extends Page implements HasForms, HasActions
{
    use InteractsWithForms;
    use InteractsWithActions;

    protected static ?string $title = 'Configuration du module RH';
    protected static ?string $navigationLabel = 'Configuration';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'rh::filament.rh.pages.configuration';

    public ?array $data = [];
    
    public function mount(): void
    {
        $this->data = Setting::forKey('rh')->data;
        $this->form->fill($this->data);
    }

    public static function canAccess(): bool
    {
        if (! auth()->check())
        {
            return false;
        }
        // TODO fcmcentral::change_module_configuration permission must be seeded into the permissions when intalling this module.
        return auth()->user()->can('rh::change_module_configurartion');
    }
    
    public function validateConfigurationAction()
    {
        return Action::make('validateConfigurationAction')
            ->label('Valider')
            ->action(fn() => $this->save());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('unite')
                    ->label("Unité locale")
                    ->helperText("Cette unité sera celle utilisée par défaut pour les données RH locales.")
                    ->options([Unite::pluck('libelle_long', 'id')]),
                Toggle::make('use_remote_rh_server')
                    ->label("Utiliser un serveur RH distant ?")
                    ->live(),
                Fieldset::make('remote_rh_settings')
                    ->label('Paramètres du serveur RH distant')
                    ->visible(fn (Get $get) => $get('use_remote_rh_server'))
                    ->schema([
                        TextInput::make('url_of_remote_rh_instance')
                            ->label('URL de l\'instance distante')
                            ->required(),
                        TextInput::make('token_for_remote_rh_instance')
                            ->label('Token à utiliser')
                            ->required(),
                    ]),
            ])
            ->statePath('data');
    }
    
    public function save(): void
    {
        Setting::forKey('rh')->updateSetting($this->form->getState());
    }
}
