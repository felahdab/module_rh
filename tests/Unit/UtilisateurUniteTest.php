<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

use Modules\RH\Models\User;
use Modules\RH\Models\Unite;
 
uses(RefreshDatabase::class);
uses(Tests\TestCase::class);

beforeEach(function () {
    $this->user=User::factory()->create();

    $this->unite=Unite::factory()->create();
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
