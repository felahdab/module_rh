<?php

use function Pest\Livewire\livewire;

use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\{actingAs};
use Livewire\Livewire;

use Filament\Facades\Filament;
use Filament\Pages\Dashboard;

use App\Models\User;
use Modules\RH\Filament\RH\Resources\MarinResource;
use Modules\RH\Models\Marin;
 
uses(RefreshDatabase::class);
uses(Tests\TestCase::class);

beforeEach(function () {
    Filament::setCurrentPanel(
        Filament::getPanel('RH'),
    );

    $this->admin=User::factory()->create();
    $this->admin->admin=1;
    $this->admin->save();
});

it('displays the RH panel', function() {
    livewire(Dashboard::class)
        ->assertSee('Tableau de bord');
});

it('displays the marins table for admins', function() {
    actingAs($this->admin)->get(MarinResource::getUrl('index'))->assertSuccessful();
});

it('doesn\'t display the activite table for non admins', function() {
    $user=User::factory()->create();

    actingAs($user)->get(MarinResource::getUrl('index'))->assertForbidden();
});

it('doesn\'t display the marin table for guests', function() {
    $this->get(MarinResource::getUrl('index'))->assertRedirect();
});

it('displays the marins from the database', function() {
    $marins = Marin::factory()->count(10)->create();

    Livewire::actingAs($this->admin)
        ->test(MarinResource\Pages\ListMarins::class)
        ->assertCanSeeTableRecords($marins);
});

it('can render marin creation page', function () {
    actingAs($this->admin)->get(MarinResource::getUrl('create'))->assertSuccessful();
});

it('creates a marin in database', function () {
    $newData = Marin::factory()->make();
 
    Livewire::actingAs($this->admin)
        ->test(MarinResource\Pages\CreateMarin::class)
        ->fillForm([
            'nom' => $newData->nom,
            'prenom' => $newData->prenom,
        ])
        ->call('create')
        ->assertHasNoFormErrors();
 
    $this->assertDatabaseHas(Marin::class, [
        'nom' => $newData->nom,
        'prenom' => $newData->prenom,
    ]);
});

it('can render marin edition page', function () {
    $marin = Marin::factory()->create();

    actingAs($this->admin)->get(MarinResource::getUrl('edit', [
        'record' => $marin,
    ]))
    ->assertSuccessful()
    ->assertSee($marin->nom);

});

it('does save the new data into database when editing activite', function () {
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