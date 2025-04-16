<?php

namespace Modules\RH\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\RH\Models\Marin;
use Modules\RH\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use PHPUnit\Framework\Attributes\Test;
use Illuminate\Support\Facades\Artisan;

/**
 * Pour inteliphisense qui me souligne en rouge user
 * @property \App\Models\User @adminUser
 * 
 */
class CreationUtilisateurDepuisMarinTest extends TestCase
{

    use RefreshDatabase;

    /**
     *  Pour inteliphisense qui me souligne en rouge adminUser
     * @var \Modules\RH\Models\User
     */
    protected $adminUser;

    protected function setUp(): void
    {
        parent::setUp();
        // Artisan::call("skeletor:generate-permissions");

        // // Verifie et Créer les permissions et les rôles si necessaire
        // if(!Permission::where('name','users.store')->exists()) {
        //    Permission::create(['name' => 'users.store', 'guard_name' => 'web']); 
        // }
        
        // if(!Role::where('name','admin')->exists()) {
        // $adminRole = Role::create(['name' => 'admin', 'guard_name' => 'web']);
        // $adminRole->givePermissionTo('users.store');
        // }else{
        //     $adminRole= Role::where('name','admin')->first();
        // }
       
        // Créer un utilisateur avec le rôle admin
        $this->adminUser = User::factory()->create(["admin" => 1]); 
        //$this->adminUser->assignRole($adminRole);  
    }

    #[Test]
    public function testCreationUtilisateurDepuisMarin()
    {
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
    }

    
}
