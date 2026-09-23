## 0.2.12 (September 23, 2026)
- Updated VERSION, Updated CHANGELOG.md, Bumped 0.2.11 –> 0.2.12
- Ajout de log pour informer l'utilisateur sur le nombre d unites identiques, manquantes, differentes et manquantes. Desactivation du seeder des unités: à partir de maintenant, les instances de production seront vierges. Mais elles pourront être initialisées via RabbitMQ à partir d'une instance de référnence.

## 0.2.11 (September 21, 2026)
- Updated VERSION, Updated CHANGELOG.md, Bumped 0.2.10 –> 0.2.11
- Merge branch 'tuleap-948951-implemente-une-verification-de-la-coherence-entre-branche-annudef-de-l-utilisateur-et-ou-du-marin-et-unite-d-affectation' into develop
- Ajustement de la commande de vérification des données RH pour faciliter son exploitation.

## 0.2.10 (September 18, 2026)
- Updated VERSION, Updated CHANGELOG.md, Bumped 0.2.9 –> 0.2.10
- Merge branch 'tuleap-948951-implemente-une-verification-de-la-coherence-entre-branche-annudef-de-l-utilisateur-et-ou-du-marin-et-unite-d-affectation' into develop
- Implements artifact #94895: implemente une commande artisan pour vérifier la qualité des données RH individuelles (unité d'affectation vs branche dans l'Annudef)
- Implements artifact #962552: le module RH peut envoyer une demande de mise à jour des unités à une instance distante. Celle-ci compare sa liste d'unités avec celle de l'instance, et envoie un bilan (unités identiques, différentes, manquantes et inconnues) en retour. Pour chaque unité manquante ou différente, l'instance de référence envoie également un message de définition. L'instance locale met à jour ou créé les lignes correspondantes.
- Renommage du seeder des permissions pour correspondre à l'attendu de la commande skeletor:seed-permissions
- Modifier le middleware d'authentification du panneau du module pour renvoyer l utilisateur vers le login
- Implements artifact #951395: le seeder des specialites ne contient plus d'id explicite et laisse ça à la base.

## 0.2.9 (September 03, 2026)
- Updated VERSION, Updated CHANGELOG.md, Bumped 0.2.8 –> 0.2.9
- Merge branch 'latest'
- Implement le helper du modele User pour deriver du User de Skeletor.
- Désactivation du endpoint de creation des marins.
- Implements artifact #691744: rajoute le uuid du marin dans le retour de l'API

## 0.2.8 (June 10, 2026)
- Updated VERSION, Updated CHANGELOG.md, Bumped 0.2.7 –> 0.2.8
- Introduction de l'information sur la version du module dans le menu de l'utilisateur.

## 0.2.7 (May 13, 2026)
- Updated VERSION, Updated CHANGELOG.md, Bumped 0.2.6 –> 0.2.7
- Ajustement des seeders pour permettre leur execution multiple lors du deploiement automatise.

## 0.2.6 (April 15, 2026)
- Updated VERSION, Updated CHANGELOG.md, Bumped 0.2.5 –> 0.2.6
- Ajustement du chemin de publication de la documentation.

## 0.2.5 (April 09, 2026)
- Updated VERSION, Updated CHANGELOG.md, Bumped 0.2.4 –> 0.2.5
- Implements artifact #696340: le module profite des évènements émis par Skeletor lors de la création d'un utilisateur. Il regarde si l'utilisateur a une information Annudef permettant de déterminer son unité d'affectation. Le cas échéant, il fait automatiquement l'association entre l'utilisateur et cette unité.
- Par ailleurs, il regarde si l'utilisateur a un grade (de Marin) et un NID. Le cas échéant, une fiche de Marin est créée, renseignée des informations de grade, de NID et d'unité connue, et cette fiche est associée à l'utilisateur.

- Merge branch 'tuleap-696340-a-la-creation-d-un-marin-depuis-la-recherche-annudef-verifier-si-un-utilisateur-existe-deja-et-pourrait-correspondre-et-proposer-l-association'
- Création de tests unitaires pour vérifier le fonctionnement des listeners déclanchés sur création d'un utilisateur local.

## 0.2.4 (April 01, 2026)
- Updated VERSION, Updated CHANGELOG.md, Bumped 0.2.3 –> 0.2.4
- Implements art #729207 : le formulaire de création des utilisateurs de la recherche Annudef peut désormais recevoir un préfixe qui limitera la liste des rôles proposés à l'utilisateur. Permet de restreindre les rôles qu'un utilisateur peut attribuer à un nouvel utilisateur qu'il créé.
- php-cs-fixer

## 0.2.3 (March 20, 2026)
- Updated VERSION, Updated CHANGELOG.md, Bumped 0.2.2 –> 0.2.3
- Implements artifact #715977 Retrait de l'attribut searchable de la colone "unité".
- Implements artifact #687886: ordonne la liste des unités du Wizard de création d'un marin par ordre alphabétique.

## 0.2.2 (March 11, 2026)
- Updated VERSION, Updated CHANGELOG.md, Bumped 0.2.1 –> 0.2.2
- Ajustement de l'action "Creer l'utilisateur" de la page d'édition du Marin. Ajustement de la méthode createUser pour qu'elle renvoit toujours l'utilisateur créé ou associé au Marin.

## 0.2.1 (March 11, 2026)
- Updated VERSION, Updated CHANGELOG.md, Bumped 0.2.0 –> 0.2.1
- Implements Art #713160 : Correction bug Exception pour la creation User Retouche de la Resource Marin RH avec  des filtres Avec/Sans Utilisateurs Creation Action Builker pour la creation User Marin
- Début de documentation du module.

## 0.2.0 (February 19, 2026)
- Updated VERSION, Updated CHANGELOG.md, Bumped 0.1.2 –> 0.2.0
- Ajustements pour supporter Filament V4 (donc Skeletor v4.0.0 +)
- Retrait de la dépendance aux police Google.

## 0.1.2 (February 13, 2026)
- Updated VERSION, Updated CHANGELOG.md, Bumped 0.1.1 –> 0.1.2
- Implements artifact #672604: permet d'associer un utilisateur à une unité du module RH.
- Création d'un relation manager pour afficher la liste des utilisateurs affectés sous la page d'édition d'une unité.
- Rajout des methodes dans User et Unite pour obtenir les utilisateurs affectes et l'unite d'affectation.
- Creation migration pour la création de la table user_unite
- Implements art #672983 : refonte du seeder unite ,  modification rh_unites, creation rh_lieu_unites faire un migrate
- Ajustement des vérifications d'autorisation pour l'accessibilité des pages préférées, des liens d'accès rapide, de la recherche Annudef et de la gestion des types d'unités (TypeUnite).
- Implements artifact #673196: créé une entrée pointant vers la liste des marins dans le menu d'accès direct, et dans la liste des pages préférées exposées par le module. Rajoute également la page de préférences utilisateur au panneau.

## 0.1.1 (January 14, 2026)
- Updated VERSION, Updated CHANGELOG.md, Bumped 0.1.0 –> 0.1.1
- Prise en compte du grade présent dans les informations Annudef dans le formulaire de création du Marin.

## 0.1.0 (January 13, 2026)
- Updated VERSION, Updated CHANGELOG.md, Bumped 0.0.6 –> 0.1.0
- Prise en compte du NID issu d'ANNUDEF pour pré-remplir le champs NID du formulaire de création de la fiche du Marin.
- Merge branch 'tuleap-665439-realiser-une-verification-de-qualite-du-code-phpstan'
- Corrections syntaxiques, suppression de fichiers devenus inutiles.
- Implements art #658135 : modification Pour formulaire incription
- Modifcation rech acces permission
- Modification Recherche Annuaire droits
- Restauration des fichiers supprimés à tord par le commit du 22/04/2025
- Création des méthodes pour faciliter le lien entre User et Marin.


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

