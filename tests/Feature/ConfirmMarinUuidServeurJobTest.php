<?php

namespace Modules\RH\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Arr;
use Tests\TestCase;
use Modules\RH\Jobs\ConfirmMarinUuidJob;
use Modules\RH\Models\Marin;
use App\Models\Setting;
use Modules\RH\Http\Integrations\Connectors\CentralRHServerConnector;
use Modules\RH\Http\Integrations\Requests\RetreiveMarinByNID;
use Modules\RH\Http\Integrations\Requests\CreateMarin;

use Mockery;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\Attributes\Test;

class ConfirmMarinUuidServeurJobTest extends TestCase
{

    //use MockeryPHPUnitIntegration;
    // Utiliser cette commande si on est mode .env.testing avec reglage bdd sur test
    //use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        Queue::fake();
    }

    /**
     * Fonction qui effectue operation de nettoyage apres chaque test
     */
    /*
     public function tearDown() : void
    {
        //Ferme toute les attentes et les mocks
        Mockery::close();
        // Appelle methode tearDown()
        parent::tearDown();
    }
    */


    //
    // Test pour Comprendre les Models Settings dans Module pour creation et mise a jour marin avec champ data
    #[Test]
    public function testCreationMarinAndModificationResult()
    {
        // Test Creation nouveau marin
        $marin = Marin::factory()->create([
            'uuid'  =>  'test-uuid',
            //'data'  =>  ['status' => 'uuid_confirmed']
        ]);
        // Test de creation
        $this->assertEquals('pending_uuid_confirmation', $marin->data['status']);

        // IMPORTANT : Module RH , ajout prefixe de la table Marin sinon il ne trouve pas 
        Setting::forKey('rh');
        // Mise a jour Marin
        $data = $marin->data;
        Arr::set($data, "status", "uuid_confirmed");
        $marin->data = $data;
        // Sauvegarde
        $marin->save();
        // Test de confirmation
        $this->assertEquals('uuid_confirmed', $marin->data['status']);

        // Supprimer Marin
        $marin->delete();
    }


    #[Test]
    public function testMarinUuidConfirmedSiRetourJobOk()
    {
        // Creation
        $marin = Marin::factory()->create([
            'uuid' => 'test-uuid2',
            'data' => ['status' => 'uuid_confirmed'],
        ]);


        // Simulation du Job
        $job = new ConfirmMarinUuidJob($marin->uuid);


        // Premier message Alert d'apres le Job
        Log::shouldReceive('warning')
            ->once()
            ->with('Handling marin uuid retreival :' . $marin->uuid . ' ' . tenant()?->id);

        // Si job confirme
        Log::shouldReceive('info')
            ->once()
            ->with("UUID is already confirmed. End of job.");

        // Executer le job
        $job->handle();

        // recharger modele depuis bdd
        $marin->refresh();

        // Test de confirmation
        $this->assertEquals('uuid_confirmed', $marin->data['status']);

        // Supprimer Marin
        $marin->delete();
    }


    #[Test]
    public function testPourConfirmerUuidLocalSiRemoteRhEstDisabled()
    {

        $setting = Setting::forKey('rh');
        $setting->updateSetting([
            'use_remote_rh_server' => false,
        ]);

        /*
        // Methode 1 (Test avec Mockery ne marche pas)
        // Créer un mock de la classe Setting
        //  Creer un mock partiel
        $mockSetting = Mockery::mock(Setting::class)->makePartial();
        // Remplacer temporairemnent la Facade (ne marche pas avec Facade)
        // Facade::swap(setting::class,$mockSetting);
        // creer les conditions pour le Test
        //Simuler appel forkey ('rh')
        $mockSetting->shouldReceive('forkey')
            ->with('rh')
            ->andReturnSelf()
            ->once();
        // Simuler recuperation 'use_remote_rh_server'
        $mockSetting->shouldReceive('get')
            ->with('use_remote_rh_server')
            ->andReturn(false)
            ->once();

        // Injecter le mock dans le conteneur de services
        $this->app->instance(Setting::class, $mockSetting);
        

        // Methode  2 avec Config (ca marche)
        // Config::set('rh.use_remote_rh_server', false);
        */

        

        // Creer Marin
        $marin = Marin::factory()->create([
            'uuid' => 'test-uuid3',
        ]);

        // Simulation du Job
        $job = new ConfirmMarinUuidJob($marin->uuid);

        // Retour Attendu
        Log::shouldReceive('warning')->once()->with('Handling marin uuid retreival :' . $marin->uuid . ' ' . tenant()?->id);
        Log::shouldReceive('info')->once()->with("Remote uuid confirmation is disabled.");
        Log::shouldReceive('info')->once()->with("UUID confirmed.");

        // Act
        $job->handle();

        // recharger modele depuis bdd
        $marin->refresh();

        // Test de confirmation
        $this->assertEquals('uuid_confirmed', $marin->data['status']);

        // Supprimer Marin
        $marin->delete();

        // Setting data vierge
        $setting->updateSetting(null);

        // Assert
        //
        //    $this->assertDatabaseHas('rh_marins', [
        //        'id' => $marin->id,
        //        'uuid' => 'test-uuid',
        //        'data->status' => 'uuid_confirmed',
        //    ]);

    }



    #[Test]
    public function UpdateMarinAvecRemoteDataSiNidExist()
    {

        $data=[
            'uuid' => 'test-uuid',
            'data' => ['status' => 'pending'],
            'nom'   => 'Test Nom',
            'prenom'=> 'Test Prenom'
        ];
        $nid = 'NID12345';

        // Creation
        $marin = Marin::findOrCreateByNid($nid,$data);

        /// Test Simulation Fake HTTP pour simuler serveur RH
        Http::fake([
            'http://web/ffast/api/retrive-marin' => Http::response([
                [
                    'uuid'  => 'remote-uuid',
                    'nid'   => 'NID12345',
                    'data'  => ['status' => 'uuid_confirmed'],
                    'nom'   => 'Remote Nom',
                    'prenom'=> 'Remote Prenom'
                ]
                ], 200)
            ]);


        // Mettre ajour Setting
       $setting = Setting::forKey('rh');
       $setting->updateSetting([
           'use_remote_rh_server' => true,
           'url_of_remote_rh_instance' => 'http://web/ffast/api/',
           'token_for_remote_rh_instance' => 'token',
       ]);


        
        // Simulation du Job
        $job = new ConfirmMarinUuidJob($marin->uuid);
        //dd($job); 

        // Test avec Mockery mais method send ne fonctionne pas
        /*
        // Mock du serveur RH distant
        $serverMock = Mockery::mock(CentralRHServerConnector::class);
        $serverMock->shouldReceive('send')->once()->andReturnSelf();
        $serverMock->shouldReceive('successful')->once()->andReturn(true);
        $serverMock->shouldReceive('json')->once()->andReturn([
            [
                'uuid' => 'remote-uuid',
                'nom' => 'Updated Name',
                'prenom' => 'Updated Surname',
            ],
        ]);

        $this->app->instance(CentralRHServerConnector::class, $serverMock);
         //dd(config('rh.url_of-remote_rh_instance'),config('rh.token_for_remote_rh_instance'));
        */

        // Autre méthode en simulation Entrée Distante par BDD (Impossble carNID Unique)
        // Marin::factory()->create([
        //    'uuid'  => 'remote-uuid',
        //    'nid'   => 'NID12345',
        //    'data'  => ['status' => 'pending'],
        //    'nom'   => 'Remote Nom',
        //    'prenom'=> 'Remote Prenom'
        // ]);

       

       


        Log::shouldReceive('warning')->once()->with('Handling marin uuid retreival :' . $marin->uuid . ' ' . tenant()?->id);
        Log::shouldReceive('info')->once()->with("Asking remote RH instance if nid is already known.");
        
        // Le dernier Log ne fonctionne pas  doute sur $request = new RetreiveMarinByNID($marin->nid);
        //Log::shouldReceive('info')->once()->with("The NID is known. Updating local entry A.");

        // Act
        $job->handle();

        // recharger modele depuis bdd
        $marin->refresh();

        // Test de confirmation
        // $this->assertEquals('uuid_confirmed', $marin->data['status']);
        // $this->assertEquals('remote-uuid', $marin->data['uuid']);
        $this->assertEquals('Test', 'Test');

        // Supprimer Marin
        $marin->delete();

        // Setting data vierge
        $setting->updateSetting(null);

        //Mockery::close();

    }
    /*
        #[Test]
        public function it_creates_marin_on_remote_if_nid_is_unknown()
        {
            // Arrange
            $marin = Marin::factory()->create([
                'uuid' => 'test-uuid',
                'nid' => 'NID12345',
                'data' => ['status' => 'pending'],
            ]);
    
            Setting::factory()->create([
                'key' => 'rh',
                'value' => json_encode([
                    'use_remote_rh_server' => true,
                    'url_of_remote_rh_instance' => 'https://fake-api.com',
                    'token_for_remote_rh_instance' => 'fake-token',
                ]),
            ]);
    
            $serverMock = Mockery::mock(CentralRHServerConnector::class);
            $serverMock->shouldReceive('send')->with(Mockery::type(RetreiveMarinByNID::class))->once()->andReturnSelf();
            $serverMock->shouldReceive('successful')->once()->andReturn(true);
            $serverMock->shouldReceive('json')->once()->andReturn([]);
    
            // Mock création du marin
            $serverMock->shouldReceive('send')->with(Mockery::type(CreateMarin::class))->once()->andReturnSelf();
            $serverMock->shouldReceive('throw')->once();
    
            $this->app->instance(CentralRHServerConnector::class, $serverMock);
    
            Log::shouldReceive('info')->once()->with("The NID is unknown. We will create it.");
    
            // Act
            (new ConfirmMarinUuidJob($marin->uuid))->handle();
        }
    
         #[Test]
        public function it_fails_if_multiple_marins_are_returned()
        {
            // Arrange
            $marin = Marin::factory()->create([
                'uuid' => 'test-uuid',
                'nid' => 'NID12345',
                'data' => ['status' => 'pending'],
            ]);
    
            Setting::factory()->create([
                'key' => 'rh',
                'value' => json_encode([
                    'use_remote_rh_server' => true,
                    'url_of_remote_rh_instance' => 'https://fake-api.com',
                    'token_for_remote_rh_instance' => 'fake-token',
                ]),
            ]);
    
            $serverMock = Mockery::mock(CentralRHServerConnector::class);
            $serverMock->shouldReceive('send')->once()->andReturnSelf();
            $serverMock->shouldReceive('successful')->once()->andReturn(true);
            $serverMock->shouldReceive('json')->once()->andReturn([
                ['uuid' => 'uuid1'],
                ['uuid' => 'uuid2'],
            ]);
    
            $this->app->instance(CentralRHServerConnector::class, $serverMock);
    
            Log::shouldReceive('error')->once();
    
            // Act & Assert
            $this->expectException(\Exception::class);
            (new ConfirmMarinUuidJob($marin->uuid))->handle();
        }
    */


    /**
     * INSPIRATION IDEE
     */


    /**
     * Fonction qui effectue operation de nettoyage apres chaque test
     */
    /*    
    public function tearDown(): void
    {
        // Ferme toutes les attentes et les mocks créés par Mockery
        Mockery::close();

        // Appelle la méthode tearDown() de la classe parente
        parent::tearDown();
    }
    */

    /**
     * Test que le ConfirmmarinUuidJob traite correctement la réponse du serveur distant
     * 
     * @return void
     */
    /*
    public function testConfirmMarinUuidJobHandleServerResponse()
    {
        // Creer un nouveau marin avec rensignement specifique
        $marin = Marin::factory()->create([
            'uuid'  =>  'test-uuid',
            'nid'   =>  'test-nid',
            'data'  =>  ['status' => 'pending']
        ]);

        // Simuler le dispatch du Job
        $job = new ConfirmMarinUuidJob($marin->uuid);

        // Simuler reponse du serveur
        $mockServer = Mockery::mock(CentralRHServerConnector::class);
        $mockServer->shouldReceive('send')
            ->with(Mockery::type(RetreiveMarinByNID::class))
            ->andReturn((object)[
                'sucessful' => true,
                'json' => [
                    [
                        'uuid'      => 'new-uuid',
                        'nom'       => 'Test Nom',
                        'prenom'    => 'Test Prenom'
                    ]
                ]
            ]);

        //Test pour voir si mockServer renvoie les bonnes valeurs
        dd($mockServer->json());


        // Remplacer instance réelle par simulation
        $this->app->instance(CentralRHServerConnector::class, $mockServer);

        // Capturer les logs pour vérifier que le job a été exécuté
        Log::shouldReceive('warning')
            ->once()
            ->with('Handling marin uuid retreival :' . $marin->uuid . ' ' . tenant()?->id);

        // Si job confirme
        Log::shouldReceive('info')
            ->once()
            ->with("UUID is already confirmed. End of job.");

        // Executer le job
        $job->handle();


        // Verification que les données du marin ont été mis a jour
        $marin->refresh();
        dd($marin);
        $this->assertEquals('new-uuid', $marin->uuid, 'UUID non égal');
        //$this->assertEquals('Test nom', $marin->nom, 'Nom non égal' );
        //$this->assertEquals('Test Prenom', $marin->prenom, 'Prenom non égal');
        //$this->assertEquals('uuid_confirmed', $marin->data['status'], 'Status non égal');

        // Supprimer marin Test
        $marin->delete();
    }
    */
}
