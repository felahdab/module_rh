<?php

use function Pest\Livewire\livewire;

use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\{actingAs};
use Livewire\Livewire;

use Filament\Facades\Filament;
use Filament\Pages\Dashboard;
use Filament\Tables;

use Modules\RH\Models\User;
use Modules\RH\Models\Marin;
use Modules\RH\Models\Unite;
use Modules\RH\Filament\RH\Resources\MarinResource;
use Modules\RH\Filament\RH\Resources\UniteResource;
 
uses(RefreshDatabase::class);
uses(Tests\TestCase::class);

pest()->group("RH");

beforeEach(function () {
    Filament::setCurrentPanel(
        Filament::getPanel('RH'),
    );

    $this->admin=User::factory()->create();
    $this->admin->admin=1;
    $this->admin->save();
});

it('affiche le panneau RH', function() {
    livewire(Dashboard::class)
        ->assertSee('Tableau de bord');
});

it('affiche la table des marins pour les administrateurs', function() {
    actingAs($this->admin)->get(MarinResource::getUrl('index'))->assertSuccessful();
});

it('n affiche pas la table des marins pour les utilisateurs sans permission', function() {
    $user=User::factory()->create();

    actingAs($user)->get(MarinResource::getUrl('index'))->assertForbidden();
});

it('n affiche pas la table des marins pour les utilisateurs non connectes', function() {
    $this->get(MarinResource::getUrl('index'))->assertRedirect();
});

it('affiche bien les marins presents en base', function() {
    $marins = Marin::factory()->count(10)->create();

    Livewire::actingAs($this->admin)
        ->test(MarinResource\Pages\ListMarins::class)
        ->assertCanSeeTableRecords($marins);
});

it('affiche la page de creation d un marin', function () {
    actingAs($this->admin)->get(MarinResource::getUrl('create'))->assertSuccessful();
});

it('cree un marin en base de donnee', function () {
    $newData = Marin::factory()->make();
 
    Livewire::actingAs($this->admin)
        ->test(MarinResource\Pages\CreateMarin::class)
        ->fillForm([
            'nom' => $newData->nom,
            'prenom' => $newData->prenom,
            'email' => $newData->email,
        ])
        ->call('create')
        ->assertHasNoFormErrors();
 
    $this->assertDatabaseHas(Marin::class, [
        'nom' => $newData->nom,
        'prenom' => $newData->prenom,
    ]);
});

it('affiche la page d edition d un marin', function () {
    $marin = Marin::factory()->create();

    actingAs($this->admin)->get(MarinResource::getUrl('edit', [
        'record' => $marin,
    ]))
    ->assertSuccessful()
    ->assertSee($marin->nom);

});

it('sauvegarde les modifications des informations d un marin', function () {
    $marin = Marin::factory()->create();

    Livewire::actingAs($this->admin)
        ->test(MarinResource\Pages\EditMarin::class, ["record" => $marin->getRouteKey()])
        ->assertFormSet([
            "nom"        => $marin->nom,
        ])
        ->fillForm([
            "nom" => "toto"
        ])
        ->call("save");

    $marin->refresh();
    $this->assertTrue($marin->nom == "toto");
});

it('affiche les utilisateurs attaches a une unite', function(){
    $user = User::factory()->create();
    $unite = Unite::factory()->create();

    $user->setUnite($unite);

    Livewire::actingAs($this->admin)
        ->test(UniteResource\RelationManagers\UsersRelationManager::class, [
            'ownerRecord' => $unite,
            'pageClass' =>UniteResource\Pages\EditUnite::class,
        ])
        ->assertSuccessful()
        ->assertCanSeeTableRecords([$user]);

    $this->assertTrue(true);

});

it('affiche pas les utilisateurs attaches a une autre unite', function(){
    $user = User::factory()->create();
    $unite1 = Unite::factory()->create();
    $unite2 = Unite::factory()->create();

    $user->setUnite($unite1);

    Livewire::actingAs($this->admin)
        ->test(UniteResource\RelationManagers\UsersRelationManager::class, [
            'ownerRecord' => $unite1,
            'pageClass' =>UniteResource\Pages\EditUnite::class,
        ])
        ->assertSuccessful()
        ->assertCanSeeTableRecords([$user]);

        Livewire::actingAs($this->admin)
        ->test(UniteResource\RelationManagers\UsersRelationManager::class, [
            'ownerRecord' => $unite2,
            'pageClass' =>UniteResource\Pages\EditUnite::class,
        ])
        ->assertSuccessful()
        ->assertCanNotSeeTableRecords([$user]);

    $this->assertTrue(true);

});

it('permet d attacher un utilisateur a une unite', function(){
    $user = User::factory()->create();
    $unite = Unite::factory()->create();

    Livewire::actingAs($this->admin)
        ->test(UniteResource\RelationManagers\UsersRelationManager::class, [
            'ownerRecord' => $unite,
            'pageClass' =>UniteResource\Pages\EditUnite::class,
        ])
        ->assertSuccessful()
        ->assertCanNotSeeTableRecords([$user])
        ->mountTableAction(Tables\Actions\AttachAction::class)
        ->setTableActionData([
            'recordId' => $user->id, //category_id
        ])
        ->callMountedTableAction()
        ->assertHasNoTableActionErrors();
    
    Livewire::actingAs($this->admin)
        ->test(UniteResource\RelationManagers\UsersRelationManager::class, [
            'ownerRecord' => $unite,
            'pageClass' =>UniteResource\Pages\EditUnite::class,
        ])
        ->assertSuccessful()
        ->assertCanSeeTableRecords([$user]);

    $user->refresh();
    $this->assertTrue($user->getUnite()?->id == $unite->id);

});

it('permet de detacher un utilisateur a une unite', function(){
    $user = User::factory()->create();
    $unite = Unite::factory()->create();
    $user->setUnite($unite);
    $user->refresh();
    
    Livewire::actingAs($this->admin)
        ->test(UniteResource\RelationManagers\UsersRelationManager::class, [
            'ownerRecord' => $unite,
            'pageClass' =>UniteResource\Pages\EditUnite::class,
        ])
        ->assertSuccessful()
        ->assertCanSeeTableRecords([$user])
        ->callTableAction(Tables\Actions\DetachAction::class, $user)
        ->assertCanNotSeeTableRecords([$user]);

    $user->refresh();
    $this->assertTrue($user->getUnite() == null);

});
