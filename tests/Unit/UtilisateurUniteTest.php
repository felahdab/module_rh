<?php

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Permission;

use Modules\RH\Models\User;
use Modules\RH\Models\Unite;
use Modules\RH\Models\Marin;
 
uses(RefreshDatabase::class);
uses(TestCase::class);

pest()->group("RH");

beforeEach(function () {
    $this->user=User::factory()->create();
    $this->unite=Unite::factory()->create();
    $this->marin=Marin::factory()->create();
});

it('un utilisateur de base n a pas d unite associee', function() {
    $this->assertTrue($this->user->getUnite() == null);
});

it('un utilisateur peut se voir attribuer une unite', function() {
    $this->user->setUnite($this->unite);
    
    $this->assertTrue($this->user->getUnite()->id == $this->unite->id);
});

it('un utilisateur peut se voir retirer une unite attribuee', function() {
    $this->user->setUnite($this->unite);
    $this->assertTrue($this->user->getUnite()->id == $this->unite->id);

    $this->user->setUnite(null);
    $this->assertTrue($this->user->getUnite() == null);
});

it('les utilisateurs peuvent être scopés par unité attribuée', function() {
    $this->assertFalse(User::deUnite($this->unite)->get()->contains($this->user));
    
    $this->user->setUnite($this->unite);
    $this->unite->refresh();
    $this->assertTrue(User::deUnite($this->unite)->get()->contains($this->user));
    
    $this->user->setUnite(null);
    $this->unite->refresh();
    $this->assertFalse(User::deUnite($this->unite)->get()->contains($this->user));
});

it('un marin de base n a pas d unite associee', function() {
    $this->assertTrue($this->marin->getUnite() == null);
});

it('un marin peut etre affecte a une unite', function() {
    $this->marin->setUnite($this->unite);

    $this->marin->refresh();
    
    $this->assertTrue($this->marin->getUnite()?->id == $this->unite->id);
});

it('un marin peut se voir retirer son unite', function() {
    $this->marin->setUnite($this->unite);
    $this->marin->refresh();
    $this->assertTrue($this->marin->getUnite()?->id == $this->unite->id);

    $this->marin->setUnite(null);
    $this->marin->refresh();
    $this->assertTrue($this->marin->getUnite() == null);
});

it('un marin peut se voir associer et dissocier d un utilisateur', function() {
    $this->marin->setUser($this->user);
    $this->marin->refresh();
    $this->assertTrue($this->marin->getUser()?->id == $this->user->id);

    $this->marin->setUser(null);
    $this->marin->refresh();
    $this->assertTrue($this->marin->getUser() == null);
});

it('un marin associe a un utilisateur peut se voir attribuer une unite qui est repliquee pour l utilisateur', function() {
    $this->marin->setUser($this->user);
    $this->marin->setUnite($this->unite);

    $this->marin->refresh();
    $this->user->refresh();

    $this->assertTrue($this->user->getUnite()?->id == $this->unite->id);
});

it('un utilisateur associe a un marin peut se voir attribuer une unite qui est repliquee pour le marin', function() {
    $this->marin->setUser($this->user);
    $this->user->setUnite($this->unite);

    $this->marin->refresh();
    $this->user->refresh();

    $this->assertTrue($this->marin->getUnite()?->id == $this->unite->id);
});

it('un utilisateur associe a un marin et affecte a une unite ne peut voir que les marins de son unite', function() {
    $this->marin->setUser($this->user);
    $this->user->setUnite($this->unite);
    $this->marin->refresh();

    $this->unite2 = Unite::factory()->create();
    $this->marin2 = Marin::factory()->create();

    $this->marin2->setUnite($this->unite2);
    $this->marin2->refresh();


    $this->actingAs($this->user);

    $this->assertTrue(Marin::all()->contains($this->marin));
    $this->assertFalse(Marin::all()->contains($this->marin2));
});

it('un utilisateur associe a un marin et affecte a une unite ne peut voir que les marins de son unite sauf s il a la permissions rh::voir_tous_les_marins', function() {
    $this->marin->setUser($this->user);
    $this->user->setUnite($this->unite);
    $this->marin->refresh();

    $this->unite2 = Unite::factory()->create();
    $this->marin2 = Marin::factory()->create();

    $this->marin2->setUnite($this->unite2);
    $this->marin2->refresh();


    $this->actingAs($this->user);
    $perm = Permission::firstOrCreate([
        "name" => "rh::voir_tous_les_marins",
        "guard_name" => "web"
    ]);

    $this->user->permissions()->attach($perm);

    $this->assertTrue(Marin::all()->contains($this->marin));
    $this->assertTrue(Marin::all()->contains($this->marin2));
});