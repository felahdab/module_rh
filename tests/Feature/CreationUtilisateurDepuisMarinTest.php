<?php

namespace Modules\RH\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\RH\Models\Marin;
use Modules\RH\Models\User;

uses(RefreshDatabase::class);
uses(TestCase::class);

pest()->group("RH");

beforeEach(function () {
    $this->adminUser = User::factory()->create(["admin" => 1]); 
});

it('cree un utilisateur a partir d un marin', function(){
    // Connecter l'utilisateur admin
    $this->actingAs($this->adminUser);

    // Créer un marin
    $marin = Marin::create([
        'uuid' => 'test-uuid',
        'nid' => 'NID12345',
        'nom' => 'Test Nom',
        'prenom' => 'Test Prenom',
        'email' => 'NID12345@example.com',
        'data' => ['status' => 'pending'],
    ]);

    // Vérifier que le marin n'a pas encore d'utilisateur associé
    $this->assertNull($marin->user);

    // Créer un utilisateur pour le marin
    $user = $marin->createUser();

    // Vérifier que l'utilisateur a été créé et associé au marin
    $this->assertNotNull($user);
    $this->assertEquals($user->id, $marin->user_id);
    $this->assertEquals($marin->nom, $user->nom);
    $this->assertEquals($marin->nid . '@example.com', $user->email);

    // Vérifier que le marin a maintenant un utilisateur associé
    $this->assertNotNull($marin->fresh()->user);
});

it('cree un utilisateur a partir d un marin quand un utilisateur avec le meme mail existe deja BugFix 713160', function(){
    // Bugfix 713160: ecrire un test permettant de verifier la non-regression apres le bugfix:
    // Creer un marin
    // Creer un user avec la même adresse phemail
    // Provoquer le marin->createUser()
    // 
    // Résultat
    // - ne doit pas provoquer d'exception
    // - doit associer le marin et le user qui existent tous les deux
    
    
    $this->actingAs($this->adminUser);

    // ✅ 1. Créer un marin
    $marin = Marin::create([
        'uuid'   => 'test-uuid-bugfix',
        'nid'    => 'NID99999',
        'nom' => 'Test Nom2',
        'prenom' => 'Test Prenom2',
        'email'  => 'NID99999@example.com',
        'data' => ['status' => 'pending'],
    ]);

    // ✅ 2. Créer un user avec la même adresse email, non rattaché au marin
    $existingUser = \App\Models\User::create([
        'nom' => 'Test Nom2',
        'prenom' => 'Test Prenom2',
        'email'    => 'NID99999@example.com',
        'password' => bcrypt('password'),
    ]);

    // Vérifier l'état initial — marin et user existent mais ne sont pas rattachés
    $this->assertNull($marin->user);
    $this->assertNotNull($existingUser);

    // ✅ 3. Provoquer createUser() — ne doit PAS lever d'exception
    $user = null;
    $exception = null;

    try {
        $user = $marin->createUser();
    } catch (\Exception $e) {
        $exception = $e;
    }

    // ✅ 4. Pas d'exception
    $this->assertNull($exception, 'createUser() a levé une exception : ' . $exception?->getMessage());

    // ✅ 5. Le marin est maintenant rattaché à un user
    $this->assertNotNull($marin->fresh()->user);

    // ✅ 6. Le user rattaché est bien l'existant (pas un nouveau créé)
    $this->assertEquals($existingUser->id, $marin->fresh()->user_id);

    // ✅ 7. Pas de doublon — un seul user avec cet email
    $this->assertEquals(
        1,
        \App\Models\User::where('email', 'NID99999@example.com')->count(),
        'Un doublon de user a été créé alors qu\'un user avec cet email existait déjà'
    );
    

});

