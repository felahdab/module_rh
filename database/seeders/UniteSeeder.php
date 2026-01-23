<?php

namespace Modules\RH\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\RH\Models\Unite;
use Modules\RH\Models\TypeUnite;
use Modules\RH\Models\LieuUnite;
use Illuminate\Support\Facades\Log;

class UniteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Log::info('🏢 Début du seed des unités');

        $typeUnite = TypeUnite::where('libelle_court', 'ALFAN 1')->first()?->id ?? 1;
        $lieuUnite = LieuUnite::where('libelle_court', 'TLN')->first()?->id ?? 1;

        $records = [
            ['uuid' => '5fba908c-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'FPS/B', 'libelle_long' => 'FPS BREST', 'libannudef' => 'MARINE/ALFAN BREST/FPS BREST', 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fbb7f3e-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'FPS/T', 'libelle_long' => 'FPS TOULON', 'libannudef' => 'MARINE/ALFAN/FPS TOULON', 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fbc1a2a-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'ACHERON', 'libelle_long' => 'ACHERON', 'libannudef' => 'MARINE/BATIMENTS TOULON/ACHERON', 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fbc84b6-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'ACONIT', 'libelle_long' => 'ACONIT', 'libannudef' => 'MARINE/BATIMENTS TOULON/ACONIT', 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fbce74c-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'AIGLE', 'libelle_long' => 'AIGLE', 'libannudef' => 'MARINE/BATIMENTS BREST/AIGLE', 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fbd4548-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'ALDEBARAN', 'libelle_long' => 'ALDEBARAN', 'libannudef' => 'MARINE/BATIMENTS BREST/ALDEBARAN', 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fbda0d8-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'ALIZE', 'libelle_long' => 'ALIZE', 'libannudef' => 'MARINE/BATIMENTS TOULON/ALIZE', 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fbdfd96-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'ALSACE', 'libelle_long' => 'ALSACE', 'libannudef' => 'MARINE/BATIMENTS TOULON/ALSACE', 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fbe091a-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'ALTAIR', 'libelle_long' => 'ALTAIR', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fbe62cc-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'ANDROMEDE', 'libelle_long' => 'ANDROMEDE', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fbebfbc-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'ANTARES', 'libelle_long' => 'ANTARES', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fbf1af0-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'AQUITAINE A', 'libelle_long' => 'AQUITAINE A', 'libannudef' => 'MARINE/BATIMENTS BREST/AQUITAINE/AQUITAINE A', 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fbf7680-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'AQUITAINE B', 'libelle_long' => 'AQUITAINE B', 'libannudef' => 'MARINE/BATIMENTS BREST/AQUITAINE/AQUITAINE B', 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fbfd158-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'ARAGO', 'libelle_long' => 'ARAGO', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fc02aca-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'AUGUSTE BENEBIG', 'libelle_long' => 'AUGUSTE BENEBIG', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fc082c6-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'AUVERGNE', 'libelle_long' => 'AUVERGNE', 'libannudef' => 'MARINE/BATIMENTS BREST/AUVERGNE', 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fc0bde1-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'BEAUTEMPS-BEAUPRE A', 'libelle_long' => 'BEAUTEMPS-BEAUPRE A', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fc11a32-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'BEAUTEMPS-BEAUPRE B', 'libelle_long' => 'BEAUTEMPS-BEAUPRE B', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fc1734c-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'BORDA', 'libelle_long' => 'BORDA', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fc1ccf2-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'BOUGAINVILLE Equip A', 'libelle_long' => 'BOUGAINVILLE Equip A', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fc223ac-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'BOUGAINVILLE Equip B', 'libelle_long' => 'BOUGAINVILLE Equip B', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fc27fb8-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'BRETAGNE A', 'libelle_long' => 'BRETAGNE A', 'libannudef' => 'MARINE/BATIMENTS BREST/BRETAGNE/BRETAGNE A', 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fc2db5e-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'BRETAGNE B', 'libelle_long' => 'BRETAGNE B', 'libannudef' => 'MARINE/BATIMENTS BREST/BRETAGNE/BRETAGNE B', 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fc336ae-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'CAPRICORNE', 'libelle_long' => 'CAPRICORNE', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fc36c69-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'CDT BIROT', 'libelle_long' => 'CDT BIROT', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fc3c8e2-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'CDT BLAISON', 'libelle_long' => 'CDT BLAISON', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fc4225a-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'CDT BOUAN', 'libelle_long' => 'CDT BOUAN', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fc47c94-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'CDT DUCUING', 'libelle_long' => 'CDT DUCUING', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fc4d73c-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'CEPHEE', 'libelle_long' => 'CEPHEE', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fc52fd8-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'CHACAL', 'libelle_long' => 'CHACAL', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fc58950-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'CHAMPLAIN (EQ A)', 'libelle_long' => 'CHAMPLAIN (EQ A)', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fc5e6a0-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'CHAMPLAIN (EQ B)', 'libelle_long' => 'CHAMPLAIN (EQ B)', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fc63de2-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'CHARLES DE GAULLE', 'libelle_long' => 'CHARLES DE GAULLE', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fc69730-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'CHEVALIER PAUL', 'libelle_long' => 'CHEVALIER PAUL', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fc6f2bc-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'COMFLOPHIB', 'libelle_long' => 'COMFLOPHIB', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fc74c0c-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'CORMORAN A', 'libelle_long' => 'CORMORAN A', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fc7a4d4-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'CORMORAN B', 'libelle_long' => 'CORMORAN B', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fc7d756-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'COURBET', 'libelle_long' => 'COURBET', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fc834ae-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'CROIX DU SUD', 'libelle_long' => 'CROIX DU SUD', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fc88e44-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'D\'ENTRECASTEAU A', 'libelle_long' => 'D\'ENTRECASTEAU A', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fc8d986-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'D\'ENTRECASTEAU B', 'libelle_long' => 'D\'ENTRECASTEAU B', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fc9334e-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'DIXMUDE', 'libelle_long' => 'DIXMUDE', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fc98b5c-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'DUMONT D\'URVILLE A', 'libelle_long' => 'DUMONT D\'URVILLE A', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fc9de72-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'DUMONT D\'URVILLE B', 'libelle_long' => 'DUMONT D\'URVILLE B', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fca372e-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'DUPUY DE LOME A', 'libelle_long' => 'DUPUY DE LOME A', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fca90f2-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'DUPUY DE LOME B', 'libelle_long' => 'DUPUY DE LOME B', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fcad25d-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'EGLANTINE', 'libelle_long' => 'EGLANTINE', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fcb2c48-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'ETOILE', 'libelle_long' => 'ETOILE', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fcb83b6-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'EV JACOUBET', 'libelle_long' => 'EV JACOUBET', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fcbdc7e-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'FLAMANT A', 'libelle_long' => 'FLAMANT A', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fcc3620-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'FLAMANT B', 'libelle_long' => 'FLAMANT B', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fcc8f0c-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'FLOREAL', 'libelle_long' => 'FLOREAL', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fcce830-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'FORBIN', 'libelle_long' => 'FORBIN', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fccf62a-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'FULMAR', 'libelle_long' => 'FULMAR', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fcd4f2a-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'GARONNE A', 'libelle_long' => 'GARONNE A', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fcda77e-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'GARONNE B', 'libelle_long' => 'GARONNE B', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fce0984-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'GERMINAL', 'libelle_long' => 'GERMINAL', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fce60f4-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'GLYCINE', 'libelle_long' => 'GLYCINE', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fceba62-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'GPD ATLANT (STYX)', 'libelle_long' => 'GPD ATLANT (STYX)', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fcf24d8-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'GPD MANCHE (VULCAIN)', 'libelle_long' => 'GPD MANCHE (VULCAIN)', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fcf7db8-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'GRANDE HERMINE', 'libelle_long' => 'GRANDE HERMINE', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fcfd684-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'GUEPARD', 'libelle_long' => 'GUEPARD', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fd0301e-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'GUEPRATTE', 'libelle_long' => 'GUEPRATTE', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fd04505-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'JACQUES CHEVALLIER', 'libelle_long' => 'JACQUES CHEVALLIER', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fd09db8-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'JAGUAR', 'libelle_long' => 'JAGUAR', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fd0f716-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'LA BELLE POULE', 'libelle_long' => 'LA BELLE POULE', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fd15843-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'LA COMBATTANTE', 'libelle_long' => 'LA COMBATTANTE', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fd1b134-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'LA CONFIANCE', 'libelle_long' => 'LA CONFIANCE', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fd20b76-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'LA FAYETTE', 'libelle_long' => 'LA FAYETTE', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fd263f2-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'LA GLORIEUSE', 'libelle_long' => 'LA GLORIEUSE', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fd2bcde-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'LA RESOLUE', 'libelle_long' => 'LA RESOLUE', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fd315d4-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'LANGUEDOC A', 'libelle_long' => 'LANGUEDOC A', 'libannudef' => 'MARINE/BATIMENTS TOULON/LANGUEDOC/LANGUEDOC A', 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fd36e6a-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'LANGUEDOC B', 'libelle_long' => 'LANGUEDOC B', 'libannudef' => 'MARINE/BATIMENTS TOULON/LANGUEDOC/LANGUEDOC B', 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fd3c78a-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'LAPEROUSE', 'libelle_long' => 'LAPEROUSE', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fd41fc2-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'LAPLACE', 'libelle_long' => 'LAPLACE', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fd47826-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'L\'ASTROLABE A', 'libelle_long' => 'L\'ASTROLABE A', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fd4d0e8-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'L\'ASTROLABE B', 'libelle_long' => 'L\'ASTROLABE B', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fd52b0e-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'LE MALIN', 'libelle_long' => 'LE MALIN', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fd582ca-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'LEOPARD', 'libelle_long' => 'LEOPARD', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fd5db5c-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'LION', 'libelle_long' => 'LION', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fd634a2-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'LOIRE A', 'libelle_long' => 'LOIRE A', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fd68c32-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'LOIRE B', 'libelle_long' => 'LOIRE B', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fd6e500-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'LORRAINE', 'libelle_long' => 'LORRAINE', 'libannudef' => 'MARINE/BATIMENTS TOULON/LORRAINE', 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fd73db2-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'LYNX', 'libelle_long' => 'LYNX', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fd796f0-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'LYRE', 'libelle_long' => 'LYRE', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fd7ef44-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'MAITO', 'libelle_long' => 'MAITO', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fd8477e-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'MANINI', 'libelle_long' => 'MANINI', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fd8a00a-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'MARNE', 'libelle_long' => 'MARNE', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fd8f7ee-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'MAROA', 'libelle_long' => 'MAROA', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fd9504e-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'MISTRAL', 'libelle_long' => 'MISTRAL', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fd9a8d4-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'MONGE', 'libelle_long' => 'MONGE', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fda0260-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'MUTIN', 'libelle_long' => 'MUTIN', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fda5b3e-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'NIVOSE', 'libelle_long' => 'NIVOSE', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fdab50a-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'NORMANDIE', 'libelle_long' => 'NORMANDIE', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fdb0e32-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'ORION', 'libelle_long' => 'ORION', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fdb66d6-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'PANTHERE', 'libelle_long' => 'PANTHERE', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fdbbfca-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'PEGASE', 'libelle_long' => 'PEGASE', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fdc19a4-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'PLUTON / GPD MED', 'libelle_long' => 'PLUTON / GPD MED', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fdc7296-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'PLUVIER A', 'libelle_long' => 'PLUVIER A', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fdccc98-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'PLUVIER B', 'libelle_long' => 'PLUVIER B', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fdd25b2-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'PM L HER', 'libelle_long' => 'PM L HER', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fdd7e80-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'PRAIRIAL', 'libelle_long' => 'PRAIRIAL', 'libannudef' => 'MARINE/BATIMENTS DOM-TOM-ETRANGER/PRAIRIAL', 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fddd7bc-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'PROVENCE A', 'libelle_long' => 'PROVENCE A', 'libannudef' => 'MARINE/BATIMENTS TOULON/PROVENCE/PROVENCE A', 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fde3130-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'PROVENCE B', 'libelle_long' => 'PROVENCE B', 'libannudef' => 'MARINE/BATIMENTS TOULON/PROVENCE/PROVENCE B', 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fde8a5a-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'RHONE A', 'libelle_long' => 'RHONE A', 'libannudef' => 'MARINE/BATIMENTS BREST/RHONE/EQUIPAGE A', 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fdee356-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'RHONE B', 'libelle_long' => 'RHONE B', 'libannudef' => 'MARINE/BATIMENTS BREST/RHONE/EQUIPAGE B', 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fdf3d58-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'SAGITTAIRE', 'libelle_long' => 'SAGITTAIRE', 'libannudef' => 'MARINE/BATIMENTS BREST/SAGITTAIRE', 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fdf96cc-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'SEINE A', 'libelle_long' => 'SEINE A', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fdfee96-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'SEINE B', 'libelle_long' => 'SEINE B', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fe04838-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'SOMME', 'libelle_long' => 'SOMME', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fe0a112-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'SURCOUF', 'libelle_long' => 'SURCOUF', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fe0fa7e-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'TIO', 'libelle_long' => 'TERIIEROOTERIIEROO A TERIIEROOITERAI', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fe1533a-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'THETIS', 'libelle_long' => 'THETIS', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fe1aca6-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'TIGRE', 'libelle_long' => 'TIGRE', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fe20576-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'TONNERRE', 'libelle_long' => 'TONNERRE', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fe25f08-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'VENDEMIAIRE', 'libelle_long' => 'VENDEMIAIRE', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fe2b7c0-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'VENTOSE', 'libelle_long' => 'VENTOSE', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fe31132-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'PEM', 'libelle_long' => 'PEM', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fe36aaa-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'PEM/ESCO', 'libelle_long' => 'PEM/ESCO', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fe3c40c-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'ALFAN/ENT', 'libelle_long' => 'ALFAN/ENT', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fe41d84-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'ALFAN/AG', 'libelle_long' => 'ALFAN/AG', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fe47692-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'DPM/FORM', 'libelle_long' => 'DPM/FORMATION', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fe4cfee-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'DPM/BLM', 'libelle_long' => 'DPM/BLM', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fe5297c-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'FLOTTILLE LCM/MLCM 01', 'libelle_long' => 'FLOTTILLE LCM/MLCM 01', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fe582d4-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'CIE MED', 'libelle_long' => 'CIE MED', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fe5dc3c-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'AMIRAL RONARC\'H', 'libelle_long' => 'AMIRAL RONARC\'H', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fe6359c-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'CIE ATLANT', 'libelle_long' => 'CIE ATLANT', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fe68f3a-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'FLOTTILLE LCM-MLCM 2', 'libelle_long' => 'FLOTTILLE LCM-MLCM 2', 'libannudef' => null, 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fe6e8ce-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'CISMF', 'libelle_long' => 'CISMF', 'libannudef' => 'EMA/OIA/CISMF', 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fe7419a-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'CENTOPSFSM', 'libelle_long' => 'CENTOPSFSM', 'libannudef' => 'MARINE/ALFOST/DIV OPS-CENTOPS FSM', 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fe79b1e-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'CIN BREST', 'libelle_long' => 'CIN BREST', 'libannudef' => 'MARINE/CIN BREST', 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fe7f4b2-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'BN TOULON', 'libelle_long' => 'BN TOULON', 'libannudef' => 'MARINE/BASE NAVALE TOULON', 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fe84df4-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'ORG RATTACHES CEPHISMER', 'libelle_long' => 'ORG RATTACHES CEPHISMER', 'libannudef' => 'MARINE/ALFAN/CEPHISMER', 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fe8a788-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'ALERTE FAN TOULON', 'libelle_long' => 'ALERTE FAN TOULON', 'libannudef' => 'MARINE/ALFAN/DIV RH/ALT FAN TLN', 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fe90094-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'ALERTE FAN BREST', 'libelle_long' => 'ALERTE FAN BREST', 'libannudef' => 'MARINE/ALFAN BREST/DIV RH/POLE GESTION ET ORGANISATION/ALERTE FAN BREST', 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fe95a48-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'CROSS CORSE', 'libelle_long' => 'CROSS CORSE', 'libannudef' => 'MARINE/CROSS/CROSSMED/CROSS-CORSE', 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fe9b3f4-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'CROSS ETEL', 'libelle_long' => 'CROSS ETEL', 'libannudef' => 'MARINE/CROSS/CROSSATLANT/CROSSA ETEL', 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fea0d66-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'CROSS GRISNEZ', 'libelle_long' => 'CROSS GRISNEZ', 'libannudef' => 'MARINE/CROSS/CROSSMANCHE/CROSS GRIS NEZ', 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fea669a-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'CROSS TOULON', 'libelle_long' => 'CROSS TOULON', 'libannudef' => 'MARINE/CROSS/CROSSMED/CROSS LA GARDE', 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5feac06a-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'SEMAPHORE 1 BEG MELEN', 'libelle_long' => 'SEMAPHORE 1 BEG MELEN', 'libannudef' => 'MARINE/FOSIT ATLANTIQUE/SEMAPHORES ATLANT/BEG MELEN', 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5feb1a1e-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'SEMAPHORE 1 LA HEVE', 'libelle_long' => 'SEMAPHORE 1 LA HEVE', 'libannudef' => 'MARINE/FOSIT MANCHE - MER DU NORD/SEMAPHORES MMDN/SEM HEVE', 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5feb73b0-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'SEMAPHORE 1 PORTZIC', 'libelle_long' => 'SEMAPHORE 1 PORTZIC', 'libannudef' => 'MARINE/FOSIT ATLANTIQUE/SEMAPHORES ATLANT/PORTZIC', 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5febce00-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'SEMAPHORE 1 ST VAAST', 'libelle_long' => 'SEMAPHORE 1 ST VAAST', 'libannudef' => 'MARINE/FOSIT MANCHE - MER DU NORD/SEMAPHORES MMDN/SEM ST VAAST', 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fec278c-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'SEMAPHORE BEAR', 'libelle_long' => 'SEMAPHORE BEAR', 'libannudef' => 'MARINE/FOSIT MEDITERRANEE/SEMAPHORES/SEMAPHORES ARMES/BEAR', 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fec8152-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'SEMAPHORE CAP CORSE', 'libelle_long' => 'SEMAPHORE CAP CORSE', 'libannudef' => 'MARINE/FOSIT MEDITERRANEE/SEMAPHORES/SEMAPHORES ARMES/CAP CORSE', 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fecdb04-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'CROSS JOBOURG', 'libelle_long' => 'CROSS JOBOURG', 'libannudef' => 'MARINE/CROSS/CROSSMANCHE/CROSS JOBOURG', 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fed349e-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'CROSS CORSEN', 'libelle_long' => 'CROSS CORSEN', 'libannudef' => 'MARINE/CROSS/CROSSATLANT/CROSS CORSEN', 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fed8e5a-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'ALFAN/RH', 'libelle_long' => 'ALFAN/RH', 'libannudef' => 'MARINE/ALFAN/DIV RH', 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fede870-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'CECMED', 'libelle_long' => 'CECMED', 'libannudef' => 'MARINE/CECMED', 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fee41dc-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'BELLE POULE', 'libelle_long' => 'BELLE POULE', 'libannudef' => 'MARINE/BATIMENTS BREST/BELLE POULE', 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fee9bc6-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'JACQUES STOSSKOPF', 'libelle_long' => 'JACQUES STOSSKOPF', 'libannudef' => 'MARINE/BATIMENTS BREST/JACQUES STOSSKOPF', 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5feef568-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'LUBERON', 'libelle_long' => 'LUBERON', 'libannudef' => 'MARINE/BATIMENTS TOULON/LUBERON', 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fef4f06-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'DPMM/PM2', 'libelle_long' => 'DPMM/PM2', 'libannudef' => 'MARINE/DPMM/DPMM - ANTENNE TOURS/PM2', 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5fefa91c-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'SLM BREST', 'libelle_long' => 'SLM BREST', 'libannudef' => 'MARINE/SLM/SLMB', 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
            ['uuid' => '5ff00328-e330-11ef-be6c-0242c0a8600a', 'libelle_court' => 'PEM/ESTLN', 'libelle_long' => 'PEM/ESTLN', 'libannudef' => 'MARINE/ST MANDRIER/PEM/ESTLN', 'type_unite_id' => $typeUnite,  'lieu_unite_id' => $lieuUnite],
        ];

        $createdCount = 0;
        $existingCount = 0;

        foreach ($records as $record) {
            $unite = Unite::firstOrCreate(
                [
                    'uuid' => $record['uuid'],
                
                    'libelle_court' => $record['libelle_court'],
                    'libelle_long' => $record['libelle_long'],
                    'libannudef' => $record['libannudef'],
                    'type_unite_id' => $record['type_unite_id'],
                    'lieu_unite_id' => $record['lieu_unite_id'],
                ]
            );

            if ($unite->wasRecentlyCreated) {
                $createdCount++;
                Log::info("✅ Unité créée: {$record['libelle_court']} (UUID: {$record['uuid']})");
            } else {
                $existingCount++;
            }
        }

        Log::info("📊 Seed des unités terminé", [
            'créées' => $createdCount,
            'existantes' => $existingCount,
            'total' => count($records),
        ]);
    }
}
