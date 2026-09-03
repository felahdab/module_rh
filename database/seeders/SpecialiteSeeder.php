<?php

namespace Modules\RH\Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

use Modules\RH\Models\Specialite;

class SpecialiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records_to_seed = [
            [
              "uuid" => "1ac65f7a-9561-46d9-b12b-1b3e50dcbe42",
              "libelle_court" => "GECOLL",
              "libelle_long" => "Gérant de collectivité",
              "ordre" => 0,
              "data" => null,
            ],
            [
              "uuid" => "908de7e7-eb59-4c86-a7b2-2b61e1a4074f",
              "libelle_court" => "COMLOG",
              "libelle_long" => "Comptable-logisticien",
              "ordre" => 0,
              "data" => null,
            ],
            [
              "uuid" => "40f2d894-c5c9-4b98-a974-916ac36cf643",
              "libelle_court" => "GESTRH",
              "libelle_long" => "Gestionnaire de personnel RH",
              "ordre" => 0,
              "data" => null,
            ],
            [
              "uuid" => "22348e43-06db-4634-a318-d1af36ff76f6",
              "libelle_court" => "ASCOM",
              "libelle_long" => "Assistant du commandement",
              "ordre" => 0,
              "data" => null,
            ],       
            [
                "uuid" => "7d8bc60c-011a-424c-ac2e-88284ac5d8c6",
                "libelle_court" => "DETEC",
                "libelle_long" => "Détecteur",
                "ordre" => 0,
                "data" => null,
              ],
              [
                "uuid" => "cbd06850-b8ad-449c-af85-cc6a92e762df",
                "libelle_court" => "DEASM",
                "libelle_long" => "Détecteur anti-sous-marin",
                "ordre" => 0,
                "data" => null,
              ],
              [
                "uuid" => "ccc46465-2a4d-4c2d-9045-ed0fdc6e4503",
                "libelle_court" => "ELARM",
                "libelle_long" => "Electronicien d armes",
                "ordre" => 0,
                "data" => null,
              ],
              [
                "uuid" => "970b4597-fc9c-4153-b6a2-71183dc2a762",
                "libelle_court" => "ELECT",
                "libelle_long" => "Electrotechnicien",
                "ordre" => 0,
                "data" => null,
              ],
              [
                "uuid" => "62c47a9d-ba48-4c63-b26d-c5c1a978e44f",
                "libelle_court" => "Equipage",
                "libelle_long" => "Equipage",
                "ordre" => 0,
                "data" => null,
              ],
              [
                "uuid" => "75bfbaee-f4eb-4e0f-a16f-8ba3f2a56852",
                "libelle_court" => "MEARM",
                "libelle_long" => "Mécanicien d armes",
                "ordre" => 0,
                "data" => null,
              ],
              [
                "uuid" => "3d1125f3-c28b-48a8-a797-641ace6d169e",
                "libelle_court" => "MECAN",
                "libelle_long" => "Mécanicien naval",
                "ordre" => 0,
                "data" => null,
              ],
              [
                "uuid" => "c4fbc889-e01f-4947-a79e-a27662b899f7",
                "libelle_court" => "ATNAV",
                "libelle_long" => "Spécialiste d atelier naval",
                "ordre" => 0,
                "data" => null,
              ],
              [
                "uuid" => "2729fabe-094a-45f7-a238-29a515c7841c",
                "libelle_court" => "CONTA",
                "libelle_long" => "Contrôleur d aéronautique",
                "ordre" => 0,
                "data" => null,
              ],
              [
                "uuid" => "dc9e89c6-f657-45a6-8178-76e0c4d8417f",
                "libelle_court" => "DENAE",
                "libelle_long" => "Détecteur navigateur aérien",
                "ordre" => 0,
                "data" => null,
              ],
              [
                "uuid" => "ae1f8146-ec88-43fb-a54d-3f6f2c670faf",
                "libelle_court" => "ELBOR",
                "libelle_long" => "Electronicien de bord",
                "ordre" => 0,
                "data" => null,
              ],
              [
                "uuid" => "01fa62da-f8fd-4994-acef-3ad2150b5c3e",
                "libelle_court" => "MANAE",
                "libelle_long" => "Manutention aéronautique",
                "ordre" => 0,
                "data" => null,
              ],
              [
                
                "uuid" => "06f031a7-03a8-4cbf-8925-19f5bcfdf9dd",
                
                
                "libelle_court" => "ARMAE",
                "libelle_long" => "Spécialiste maintenance armement aéronautique",
                "ordre" => 0,
                "data" => null,
              ],
              [
                
                "uuid" => "f1eaa773-4bef-44fe-8fc3-81bf063f330b",
                
                
                "libelle_court" => "AVION",
                "libelle_long" => "Spécialiste maintenance avionique aéronautique",
                "ordre" => 0,
                "data" => null,
              ],
              [
                
                "uuid" => "27095b64-bb59-4abe-a329-b0a2f1f0841d",
                
                
                "libelle_court" => "PORTEUR",
                "libelle_long" => "Spécialiste maintenance porteur aéronautique",
                "ordre" => 0,
                "data" => null,
              ],
              [
                
                "uuid" => "3edcfaec-4bb7-47cd-9003-e67edf7937fb",
                
                
                "libelle_court" => "MUSIF",
                "libelle_long" => "Musicien de la flotte",
                "ordre" => 0,
                "data" => null,
              ],
              [
                
                "uuid" => "0b062b0f-d7bc-46f7-a57a-56d00ccf5550",
                
                
                "libelle_court" => "PHOTAV",
                "libelle_long" => "Photographe audiovisuel",
                "ordre" => 0,
                "data" => null,
              ],
              [
                
                "uuid" => "6adb7918-9a9e-4abe-91c5-cdec641898fe",
                
                
                "libelle_court" => "SITEL",
                "libelle_long" => "Spécialiste des systèmes d information et des télécommunications",
                "ordre" => 0,
                "data" => null,
              ],
              [
                
                "uuid" => "206145d0-ce91-4dee-81ad-994ee9ea4609",
                
                
                "libelle_court" => "COMMI",
                "libelle_long" => "Commis aux vivres",
                "ordre" => 0,
                "data" => null,
              ],
              [
                
                "uuid" => "9d619fd3-f64d-4061-b406-ada8ea31d3de",
                
                
                "libelle_court" => "CUISI",
                "libelle_long" => "Cuisinier",
                "ordre" => 0,
                "data" => null,
              ],
              [
                
                "uuid" => "c275ba8f-71f8-41e1-9b08-a54919ba926e",
                
                
                "libelle_court" => "MOTEL",
                "libelle_long" => "Maître d hôtel",
                "ordre" => 0,
                "data" => null,
              ],
              [
                
                "uuid" => "b9b470f5-2b41-4344-ba89-fbae345fb3fc",
                
                
                "libelle_court" => "Vivres",
                "libelle_long" => "Vivres",
                "ordre" => 0,
                "data" => null,
              ],
              [
                
                "uuid" => "b4b1c5f5-03c0-4080-b631-46473b9afa91",
                
                
                "libelle_court" => "INFIR",
                "libelle_long" => "Infirmier",
                "ordre" => 0,
                "data" => null,
              ],
              [
                
                "uuid" => "12f7de6f-51da-4ae0-969e-dace775007f1",
                
                
                "libelle_court" => "FUSIL",
                "libelle_long" => "Fusilier marin",
                "ordre" => 0,
                "data" => null,
              ],
              [
                
                "uuid" => "acec5a51-ff48-45f2-a248-6cd06763b90d",
                
                
                "libelle_court" => "MARPO",
                "libelle_long" => "Marin pompier",
                "ordre" => 0,
                "data" => null,
              ],
              [
                
                "uuid" => "229c1969-d0d4-495e-a259-2d05c1c297c1",
                
                
                "libelle_court" => "MAPOM",
                "libelle_long" => "Marin pompier de Marseille",
                "ordre" => 0,
                "data" => null,
              ],
              [
                
                "uuid" => "bac5ed1c-c6dd-4f6f-86cf-736e61093edb",
                
                
                "libelle_court" => "PLONG",
                "libelle_long" => "Plongeur démineur",
                "ordre" => 0,
                "data" => null,
              ],
              [
                
                "uuid" => "c3ca9ae9-c283-4adf-a40f-86d36dfa0d3d",
                
                
                "libelle_court" => "SEGER",
                "libelle_long" => "Service général",
                "ordre" => 0,
                "data" => null,
              ],
              [
                
                "uuid" => "30b94fdb-ebd3-4192-b5c5-29aa78dcae00",
                
                
                "libelle_court" => "Moniteur de sport",
                "libelle_long" => "Moniteur de sport",
                "ordre" => 0,
                "data" => null,
              ],
              [
                
                "uuid" => "87a3a509-ed7f-47e2-ac03-10953d3aad14",
                
                
                "libelle_court" => "GUETF",
                "libelle_long" => "Guetteur de la flotte",
                "ordre" => 0,
                "data" => null,
              ],
              [
                
                "uuid" => "88e8884c-6283-4f14-9253-5cdc792d822b",
                
                
                "libelle_court" => "METEOC",
                "libelle_long" => "Météorologiste-océanographe",
                "ordre" => 0,
                "data" => null,
              ],
              [
                
                "uuid" => "33a8ad5e-4d0a-454e-bbb6-01637ac2cd19",
                
                
                "libelle_court" => "MANEU",
                "libelle_long" => "Manoeuvrier",
                "ordre" => 0,
                "data" => null,
              ],
              [
                
                "uuid" => "9cb910a7-9576-4981-b45c-ad2b80f01034",
                
                
                "libelle_court" => "NAVIT",
                "libelle_long" => "Navigateur timonier",
                "ordre" => 0,
                "data" => null,
              ],
              [
                
                "uuid" => "6f56a090-41a3-42cf-9bcc-031e239ebcf6",
                
                
                "libelle_court" => "HYDRO",
                "libelle_long" => "Hydrographe",
                "ordre" => 0,
                "data" => null,
              ],
              [
                
                "uuid" => "fb37d980-c918-4075-8844-82c02f7413cf",
                
                
                "libelle_court" => "COPS",
                "libelle_long" => "Conduite des opérations",
                "ordre" => 0,
                "data" => null,
              ],
              [
                
                "uuid" => "1c44550c-ee15-41e4-9953-4ab61edc295a",
                
                
                "libelle_court" => "MISART",
                "libelle_long" => "Missile-Artillerie",
                "ordre" => 0,
                "data" => null,
              ],
              [
                
                "uuid" => "6d6d7a53-b2f6-47e4-8e96-b87e641f6413",
                
                
                "libelle_court" => "LSM",
                "libelle_long" => "Lutte Sous la Mer",
                "ordre" => 0,
                "data" => null,
              ],
              [
                
                "uuid" => "800e5dac-2ceb-4458-91ee-1c006f336b7e",
                
                
                "libelle_court" => "DET",
                "libelle_long" => "Détecteur [Officier]",
                "ordre" => 0,
                "data" => null,
              ],
              [
                
                "uuid" => "a30f4cf0-afee-4dc8-811e-fef50a4d5dff",
                
                
                "libelle_court" => "SIC",
                "libelle_long" => "Systèmes d Information et de Commandement",
                "ordre" => 0,
                "data" => null,
              ],
              [
                
                "uuid" => "2b7b39f6-049e-4c40-8287-600e6c2c417d",
                
                
                "libelle_court" => "ENERG",
                "libelle_long" => "Energie propulsion",
                "ordre" => 0,
                "data" => null,
              ],
              [
                
                "uuid" => "6ba5e3b0-eb04-4cf4-bc8c-5c88c6da3a2c",
                
                
                "libelle_court" => "INFOG",
                "libelle_long" => "Informatique générale",
                "ordre" => 0,
                "data" => null,
              ],
              [
                
                "uuid" => "83490b50-6cc6-4305-8d78-9b694092b20a",
                
                
                "libelle_court" => "Sécurité",
                "libelle_long" => "Sécurité",
                "ordre" => 0,
                "data" => null,
              ],
              [
                
                "uuid" => "5bc4a4dc-07d6-4577-917c-af7c7a34756a",
                
                
                "libelle_court" => "CCA",
                "libelle_long" => "Contrôleur de la circulation aérienne",
                "ordre" => 0,
                "data" => null,
              ],
              [
                
                "uuid" => "940bd3bf-9532-4f5b-a8ef-12709b3f0354",
                
                
                "libelle_court" => "COA",
                "libelle_long" => "Contrôleur des opérations aériennes",
                "ordre" => 0,
                "data" => null,
              ],
              [
                
                "uuid" => "fbe82dfd-1c65-4f82-a488-2c91f741b94a",
                
                
                "libelle_court" => "PILAE",
                "libelle_long" => "Pilote d Aviation navale [sous contrat]",
                "ordre" => 0,
                "data" => null,
              ],
              [
                
                "uuid" => "8ee49739-56be-49e3-be98-8bbf46d927c1",
                
                
                "libelle_court" => "AVIAT",
                "libelle_long" => "Pilote d Aviation navale [de carrière]",
                "ordre" => 0,
                "data" => null,
              ],
              [
                
                "uuid" => "6e03aeb1-daab-489f-b794-8c46a683a570",
                
                
                "libelle_court" => "EOPAN",
                "libelle_long" => "Elève officier pilote de l Aviation navale",
                "ordre" => 0,
                "data" => null,
              ],
              [
                
                "uuid" => "cbf1d063-66b9-4dc3-b4f3-fdc198d6422b",
                
                
                "libelle_court" => "AUTOPELEC",
                "libelle_long" => "",
                "ordre" => 0,
                "data" => null,
              ],
              [
                
                "uuid" => "e49bb85f-f261-42f6-9618-fcebed71c39b",
                
                
                "libelle_court" => "CDT",
                "libelle_long" => "",
                "ordre" => 0,
                "data" => null,
              ],
              [
                
                "uuid" => "efd5006e-1419-4f5f-9e7b-c7bf872eb015",
                
                
                "libelle_court" => "CYBER",
                "libelle_long" => "",
                "ordre" => 0,
                "data" => null,
              ],
              [
                
                "uuid" => "e7b81e54-186a-437b-b062-54669acaba66",
                
                
                "libelle_court" => "ENV/PREV",
                "libelle_long" => "",
                "ordre" => 0,
                "data" => null,
              ],
              [
                
                "uuid" => "524f8ce7-6a98-40ae-ba7d-c46e9c84afe2",
                
                
                "libelle_court" => "MACHTHERM",
                "libelle_long" => "",
                "ordre" => 0,
                "data" => null,
              ],
              [
                
                "uuid" => "3bf65fdf-6d38-4439-a298-03f3d9881ad5",
                
                
                "libelle_court" => "MOBUREAU",
                "libelle_long" => "",
                "ordre" => 0,
                "data" => null,
              ],
              [
                
                "uuid" => "67eacdad-ded2-4d33-9ec4-4b90b4fb8bc4",
                
                
                "libelle_court" => "MOMACH",
                "libelle_long" => "",
                "ordre" => 0,
                "data" => null,
              ],
              [
                
                "uuid" => "99626654-8bf8-483e-9273-69075f4ba267",
                
                
                "libelle_court" => "MOPOMPI",
                "libelle_long" => "",
                "ordre" => 0,
                "data" => null,
              ],
              [
                
                "uuid" => "05cdfc38-baa3-4d1e-af7c-0fa0517f7255",
                
                
                "libelle_court" => "MOPONT",
                "libelle_long" => "",
                "ordre" => 0,
                "data" => null,
              ],
              [
                
                "uuid" => "9e68f4de-da74-4541-89a9-021a7a9b9b12",
                
                
                "libelle_court" => "MOPONTVOL",
                "libelle_long" => "",
                "ordre" => 0,
                "data" => null,
              ],
              [
                
                "uuid" => "3e735b51-c301-432f-81cd-8bd1926cfdad",
                
                
                "libelle_court" => "MORESTO",
                "libelle_long" => "",
                "ordre" => 0,
                "data" => null,
              ],
              [
                
                "uuid" => "c5e33310-8fcf-4e44-9596-0c71c66b5145",
                
                
                "libelle_court" => "MOSDC",
                "libelle_long" => "",
                "ordre" => 0,
                "data" => null,
              ],
              [
                
                "uuid" => "29f5d3b6-b0e6-4bcc-b94b-e8a70c44a5d8",
                
                
                "libelle_court" => "MOSIC",
                "libelle_long" => "",
                "ordre" => 0,
                "data" => null,
              ],
              [
                
                "uuid" => "b8e51a77-db5b-40d7-b680-3b7d68cdf2bf",
                
                
                "libelle_court" => "OPLSM",
                "libelle_long" => "",
                "ordre" => 0,
                "data" => null,
              ],
              [
                
                "uuid" => "455b965d-29c0-441c-bf6f-3c7fd368faa8",
                
                
                "libelle_court" => "OPS",
                "libelle_long" => "",
                "ordre" => 0,
                "data" => null,
              ],
              [
                
                "uuid" => "e07e8f10-3c20-4cae-875c-e5b71de87cb6",
                
                
                "libelle_court" => "OPS AM",
                "libelle_long" => "",
                "ordre" => 0,
                "data" => null,
              ],
              [
                
                "uuid" => "ab095204-f23f-44ba-b119-1d373ff78332",
                
                
                "libelle_court" => "OPS ARM",
                "libelle_long" => "",
                "ordre" => 0,
                "data" => null,
              ],
              [
                
                "uuid" => "0d30b5f2-34c2-41fc-9f9e-91bc18536420",
                
                
                "libelle_court" => "OPS DEM",
                "libelle_long" => "",
                "ordre" => 0,
                "data" => null,
              ],
              [
                
                "uuid" => "18736faf-f2be-4627-84b2-4cc547eef660",
                
                
                "libelle_court" => "OPS DSM",
                "libelle_long" => "",
                "ordre" => 0,
                "data" => null,
              ],
              [
                
                "uuid" => "1ffccebd-04e0-4602-83a5-039425aee045",
                
                
                "libelle_court" => "OPS GE",
                "libelle_long" => "",
                "ordre" => 0,
                "data" => null,
              ],
              [
                
                "uuid" => "eeab79ec-34fc-4c2b-8463-4aa2135fc6d4",
                
                
                "libelle_court" => "OPS SAM",
                "libelle_long" => "",
                "ordre" => 0,
                "data" => null,
              ],
              [
                
                "uuid" => "f1fa4905-bdbc-4d69-ae8a-1aa5dc0570ce",
                
                
                "libelle_court" => "OPS SDC",
                "libelle_long" => "",
                "ordre" => 0,
                "data" => null,
              ],
              [
                
                "uuid" => "c5fa56a3-ec82-4a13-ae19-254676c338be",
                
                
                "libelle_court" => "RESTAU",
                "libelle_long" => "",
                "ordre" => 0,
                "data" => null,
              ],
              [
                
                "uuid" => "ffa78762-6f73-4a53-81f2-717f9d515023",
                
                
                "libelle_court" => "SAM",
                "libelle_long" => "",
                "ordre" => 0,
                "data" => null,
              ],
              [
                
                "uuid" => "2e01a2b6-66d5-4f4f-8692-0dda4aad8c72",
                
                
                "libelle_court" => "SDC",
                "libelle_long" => "",
                "ordre" => 0,
                "data" => null,
              ],
              [
                
                "uuid" => "6231f5a9-d960-4aac-8d6d-75d0409c455a",
                
                
                "libelle_court" => "SECIM",
                "libelle_long" => "",
                "ordre" => 0,
                "data" => null,
              ],
              [
                
                "uuid" => "76d6c361-0f5d-451f-94ea-a024d5b286cf",
                
                
                "libelle_court" => "SECIT",
                "libelle_long" => "",
                "ordre" => 0,
                "data" => null,
              ],
              [
                "uuid" => "69adae97-94fe-47b9-b377-d606206ce6ad",
                "libelle_court" => "TECHNOCOM",
                "libelle_long" => "",
                "ordre" => 0,
                "data" => null,
              ],
              [
                "uuid" => "42c43c4c-9b6b-4724-9890-e17c7593004b",
                "libelle_court" => "TECHOPS LSM",
                "libelle_long" => "",
                "ordre" => 0,
                "data" => null,
              ],
              [
                "uuid" => "5278960b-492e-4b7a-92ab-39f31291f8cc",
                "libelle_court" => "TECHSYR",
                "libelle_long" => "",
                "ordre" => 0,
                "data" => null,
              ],
              [
                "uuid" => "ce428248-b5c5-4529-b551-e6830fcc0662",
                "libelle_court" => "AMOSIC",
                "libelle_long" => "",
                "ordre" => 0,
                "data" => null,
              ],
              [
                "uuid" => "a186d6a8-e386-4f06-8795-fac5a469c3a2",
                "libelle_court" => "CLSM",
                "libelle_long" => "",
                "ordre" => 0,
                "data" => null,
              ],
              [
                "uuid" => "1770e9b9-b3e5-4a95-9b70-5828d7803c5b",
                "libelle_court" => "CSD",
                "libelle_long" => "",
                "ordre" => 0,
                "data" => null,
              ],
              [
                "uuid" => "8a2cfb33-eb98-40d0-842f-fcba569fe427",
                "libelle_court" => "ELECTRO",
                "libelle_long" => "",
                "ordre" => 0,
                "data" => null,
              ],
              [
                "uuid" => "9431fa26-a321-4e54-a0b4-50324affc79b",
                "libelle_court" => "EPMS",
                "libelle_long" => "",
                "ordre" => 0,
                "data" => null,
              ],
              [
                "uuid" => "e566ceca-4bee-4b90-9333-9171dd28d057",
                "libelle_court" => "HYDRAU",
                "libelle_long" => "",
                "ordre" => 0,
                "data" => null,
              ],
              [
                "uuid" => "42d81abd-db6c-4de5-979a-2c622fe957a1",
                "libelle_court" => "LOG",
                "libelle_long" => "",
                "ordre" => 0,
                "data" => null,
              ],
              [
                "uuid" => "337ada06-8c5e-44f3-a7e3-30e245f852f1",
                "libelle_court" => "MECATRONIQUE",
                "libelle_long" => "",
                "ordre" => 0,
                "data" => null,
              ],
              [
                "uuid" => "9f4b8970-040b-4794-a131-511bc1fcd738",
                "libelle_court" => "METOC",
                "libelle_long" => "",
                "ordre" => 0,
                "data" => null,
              ],
              [
                "uuid" => "5a9dba63-ab71-4be9-9f88-ea735ac0de61",
                "libelle_court" => "MORESTAU",
                "libelle_long" => "",
                "ordre" => 0,
                "data" => null,
              ],
              [
                "uuid" => "98fdb2c3-a08f-4306-bea1-85baddd08f27",
                "libelle_court" => "OPERATIONS",
                "libelle_long" => "",
                "ordre" => 0,
                "data" => null,
              ],
              [
                "uuid" => "a8c39100-0475-4660-9098-ab316dbd4b55",
                "libelle_court" => "SANSP",
                "libelle_long" => "",
                "ordre" => 0,
                "data" => null,
              ],
              [
                "uuid" => "2a4c72d9-765a-49b7-a3a6-826e3b8cfac0",
                "libelle_court" => "SCLAS",
                "libelle_long" => "",
                "ordre" => 0,
                "data" => null,
              ],
              [
                "uuid" => "8c2f2c74-db41-42e9-8c22-0b0673edcba3",
                "libelle_court" => "SCLSM",
                "libelle_long" => "",
                "ordre" => 0,
                "data" => null,
              ],
              [
                "uuid" => "e656f0e2-b1f6-4685-8bf0-6594f8526cec",
                "libelle_court" => "SCSIC",
                "libelle_long" => "",
                "ordre" => 0,
                "data" => null,
              ],
              [
                "uuid" => "6add7255-994e-42ac-bd42-22c53c6df59f",
                "libelle_court" => "IETA",
                "libelle_long" => "",
                "ordre" => 0,
                "data" => null,
              ],
              [
                "uuid" => "246701dd-7ef4-4190-ac78-fc357ad29e13",
                "libelle_court" => "ARMES-EQUIPEMENT",
                "libelle_long" => "",
                "ordre" => 0,
                "data" => null,
              ],
              [
                "uuid" => "77088aed-11b7-4ff8-8a9b-fbd5cc5d5774",
                "libelle_court" => "MOMACHINE",
                "libelle_long" => "",
                "ordre" => 0,
                "data" => null,
              ],
              [
                "uuid" => "a206dcfd-781a-4bb7-a5c5-a9729c7e9c2c",
                "libelle_court" => "SYNUM",
                "libelle_long" => "",
                "ordre" => 0,
                "data" => null,
              ],
              [
                "uuid" => "da13bf3d-8fbf-472e-a890-b3c5fdf80d8c",
                "libelle_court" => "RECOM",
                "libelle_long" => "",
                "ordre" => 0,
                "data" => null,
              ],
              [
                "uuid" => "31c78ae8-4428-4001-bf72-19152fc522b8",
                "libelle_court" => "OPS/3D",
                "libelle_long" => "",
                "ordre" => 0,
                "data" => null,
              ],
              [
                "uuid" => "eae2ccb6-48ca-4b07-8e3a-d81ea60928a8",
                "libelle_court" => "OPS/DEM",
                "libelle_long" => "",
                "ordre" => 0,
                "data" => null,
              ],          
            ];

        foreach ($records_to_seed as $record)
        {
            Specialite::firstOrCreate(
              ["uuid" => $record["uuid"]],
              $record
            );
        }
    }
}
