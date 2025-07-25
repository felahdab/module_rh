## 0.0.6 (April 18, 2025)
- Updated VERSION, Updated CHANGELOG.md, Bumped 0.0.5 –> 0.0.6
- Remplacement TextInput par Placeholder dans le formulaire de rechercher dans l'annuaire.
- Ajustements sur page de recherche dans l'annuaire et le formulaire associé pour tenir compte de l'existence en base de l'utilisateur et/ou du marin. Ajustement de l'attribute fullNameAndGrade du modèle Marin.
- Retrait action de etst de la liste des marins.
- Renvoie du formulaire de la page de recherche dans l'annuaire dans une classe séparée pour clarifier le code.

## 0.0.5 (April 16, 2025)
- Updated VERSION, Updated CHANGELOG.md, Bumped 0.0.4 –> 0.0.5
- Ajustement de la factory des Marin et des tests pour tout mettre en cohérence.
- Ajustements PSR-4
- Retrait des références au module de FCM du modèle Marin.
- Définition des 2 paramètres obligatoires de la création d'un Marin (nom et prenom) dans la NewMarinDescriptionData
- Introduction du seeder de permissions pour créér la permission de gestion de la configuration du module. Nettoyage des seeders déjà présents.
- Nettoyage RHPanelServiceProvider

## 0.0.4 (April 08, 2025)
- Updated VERSION, Updated CHANGELOG.md, Bumped 0.0.3 –> 0.0.4
- Ajout service provider pour gérer les évènements du module. Implémentation du listener de création du Marin.
- Implementation action de création User et/ou Marin dans le module RH.
- Refonte des Tables Migration + Seeders ligne commande : php artisan julien:refresh-db Gestion  des Parcours, page Parcours View Travaux sur plusieurs modules FcmCommun, FcmCentral, FcmUnite, RH
- Implements art #418609 : creation tables FcmCentral|UniteMarins , creations models et modification model RH_marin pour la liaison OneToMany
- Implements art #412164 :
- Introduction du modèle User avec la relation inverse vers rh_marin.
- Implements art #412163 Mise en place Test Serveur Marin Uuid
- Commit #412161 : Test Verification Uuid Marin Confirmation Job
- Implements #411843: corrige le libelle des tests
- Rajout d'un paramètre "Unité par défaut" dans les settings du modèle RH. Cette unité a pour objectif de permettre à l'administrateur de préciser quelle est l'unité pour laquelle l'instance en cours edst en place. Rajout d'un scope global pour limiter les Marin à l'unité par défaut du module RH.
- Création du champs user_id dans le modèle Marin pour stocker la relation entre un marin et un user.
- Ajout des éléments de configuration du module RH
- Implémentation des permiers tests pest pour la ressource Marin.
- Petite correction typo du job confirmMarinUuidJob pour le cas des application non tenant aware.
- Nettoyage du seeder unités.
- Correction migration pour permettre des valeurs nulles pour les grades, specialites, brevets et unités.
- Définition des policies pour les modèles du module.
- Dissociation des utilisateurs dejà associés par défaut.
- Première implémentation de l'association Marin/User.
- Fin d'ajustement utilisation id/uuid. Retrait référence au secteur dans le modèle Marin.
- Modification de la migration, des seeders et des modèles du module RH.
- Correction namespace des factories
- Ajustement modele Grade et Seeder associe pour uuid

## 0.0.3 (November 05, 2024)
- Updated VERSION, Updated CHANGELOG.md, Bumped 0.0.2 –> 0.0.3
- Modificaiton bump-version

## 0.0.2 (November 05, 2024)
- Updated VERSION, Updated CHANGELOG.md, Bumped 0.0.1 –> 0.0.2
- Ajustement de la page de configuration.
- Ajustement du panneau RH. Version mise a jour dans module.json.
- wip API RH
- wip API exchanges client/server
- wip API
- wip API
- wip gestion des marins et api
- Introduction du widget PanelSwitcher et changement de nom du panneau.
- cast Marin data attribute to array
- wip
- Ajustement des migrations et des resources
- Creation des resources de base pour gerer les objets de ce module.
- Adaptation du module RH pour la multi tenancy
- Ajustement modèle Brevet et seeder associé.
- wip
- wip
- Created VERSION, Created CHANGELOG.md, Bumped to 0.0.1

## 0.0.1 (September 09, 2024)
- Created VERSION, Created CHANGELOG.md, Bumped to 0.0.1
- Initial commit

