<?php

namespace Modules\RH\Tests\Feature;

use Modules\RH\Jobs\ConfirmMarinUuidJob;
use Modules\RH\Models\Marin;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Log;

// 2eme fonction
use Mockery;
use Modules\RH\Http\Integrations\Connectors\CentralRHServerConnector;
use Modules\RH\Http\Integrations\Requests\RetreiveMarinByNID;


use Tests\TestCase;

class ConfirmMarinUuidJobTest extends TestCase
{


    
    
    // NOTE 
    // J'ai du modifier Fichier Database dans ma version pour les tests
    // Modification aussi de .env.testing (ajout )

    /**
     * Function Test pour job Confirmation est declenche lors de la creation
     */

     public function testConfirmMarinUuidJobIsDispatched()
     {
        
        // Simuler file attente
        // Isolation test (ne sont pas relllement executes mais garde en memoire)
        Queue::fake();

        // Creer nouveau marin
        $marin = Marin::factory()->create();

        // Dispatch le job manuellement pour simuler comportement attendu
        // ConfirmMarinUuidJob::dispatch($marin->uuid);

        // Verification que le job ConfirmMarinUuidJob se declenche
        Queue::assertPushed(ConfirmMarinUuidJob::class, function ($job) use ($marin){
            return $job->uuid === $marin->uuid ;
        });

        // Supprimer marin Test
         $marin->delete();
        
        
        
        
        

     }
    
    
    /**
     * Autre Idee pour confirmation
     */
    

     /*
    public function test_the_application_returns_a_successful_response(): void
    {
        
        // Creation Marin
        $marin = Marin::factory()->create();

        // Simulation du Job
        $job = new ConfirmMarinUuidJob($marin->uuid);

        // Capturer log retour pour verifier si job a été exécuté
        // Premier message Alert d'apres le Job
        Log::shouldReceive('warning')
            ->once()
            ->with('Handling marin uuid retreival :'.$marin->uuid . ' ' . tenant()?->id );

        // Si job confirme
        Log::shouldReceive('info')
            ->once()
            ->with("UUID is already confirmed. End of job.");    
        
        // Executer le job
        $job->handle();
        
        // Check si job a bien été exécuté
        $this->assertTrue(true);

        // Supprimer marin Test
        $marin->delete();
        
        

    }

    */


    



}
