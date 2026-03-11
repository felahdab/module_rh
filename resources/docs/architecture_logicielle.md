# Architecture logicielle

## Modèles de données du module
Le module RH définit les modèles de données suivants:

### Marin
Ce modèle est destiné à décrire une personne physique relevant d'un corps de la Marine Nationale (officiers, officiers mariniers, quartiers maitres et matelots).

#### Modèle conceptuel de données
Chaque Marin est donc décrit par son nom, son prénom, son matricule, son NID. Ce sont les seules données impératives.
Il peut en outre avoir une date d'embarquement, une date de débarquement, une adresse email, un grade, une spécialité, un brevet et une unité d'affectation.

Le modèle Marin est accompagné des modèles suivants, utiles pour la bonne description d'un Marin: Grade, Specialite, Brevet

#### Modèle physique de données
Le modèle Marin a un champs "display_name" destiné à être utilisé pour représenter ce marin dans les listes, ou dans les pages.

### Unité
Ce modèle est destiné à décrire une unité administrative. 

#### Modèle conceptuel de données
Chaque Unité est décrite par un libelle_court et un libelle_long.
En outre, chaque Unité peut-être caractérisée par un type d'unité et un lieu.

#### Modèle physique de données
Outre les champs ci-dessus, une Unité est en outre décrite par:
- un UUID (qui garantit l'unicité et l'égalité des enregistrements)
- une chaine de caractère caractéristique de la branche ANNUDEF dans laquelle cette unité est décrite "libannudef". Cette chaine de caractère est utilisée lorsque l'application essaye de déterminer l'Unité à partir de la branche Annudef provenant d'une recherche Annudef.


## Règles métier
Le module introduit quelques règles métier:

### Attribution d'une Unité à un utilisateur
Le module permet de faire une association entre un utilisateur (modèle User de Skeletor) et une Unité.
Cette association permet de répondre à des besoins techniques du genre:
- l'utilisateur doit pouvoir manipuler les données de son unité;
- quels sont les utilisateurs affectés dans telle unité;

Pour ce besoin, une table intermédiaire permet de faire le lien entre Unité et User sans modifier la structure de la table users de Skeletor.

### Filtrage des marins visibles pour l'utilisateur
Par défaut, les objets de type Marin sont filtrés afin que l'utilisateur de l'application ne puisse pas avoir accès aux données de Marins auxquelles il n'a pas de raison légitime d'avoir accès. 

Ce filtrage se fait grâce à un [Global Scope](https://laravel.com/docs/12.x/eloquent#global-scopes).
Il s'agit donc d'un filtrage applicatif au niveau des requêtes en base de données (donc ce filtrage est fait, indépendamment des autres vérifications telles que permissions par exemple).

Ce scope:
- ne fait rien lorsque l'application est exécutée en ligne de commande (cas des commandes Artisan), ou que l'utilisateur n'est pas authentifié (requêtes anonymes).
- essaye de déterminer si l'utilisateur a une unité d'affectation attribuée (soit directement, soit parce qu'il est associé à un Marin et que ce dernier a une unité d'affectation)
- si l'utilisateur a une fiche de Marin mais pas d'unité, il n'a le droit d'accéder qu'à sa propre fiche de Marin.
- si l'utilisateur n'a ni unité ni fiche de Marin, il n'a accès à aucune fiche de Marin.
- si l'utilisateur a une unité d'affectation, il peut accéder aux Marin ayant la même unité d'affectation.
- si l'utilisateur a la permission rh::voir_tous_les_marins, alors aucun filtrage n'est appliqué et l'utilisateur peut accéder à tous les Marin en base, quelle que soit leur unité d'affectation. 

Il reviendra aux modules ayant recours au modèle Marin de déterminer quelles informations peuvent être mise à la disposition de l'utilisateur, et si des filtrages supplémentaires doivent être mis en place.

## Permissions et contrôle d'accès
Le module RH définit implicitement les permissions permettant de manipuler les objets de type brevet, grade, marin, specialite, unite, typeunite.

En outre, le module définit les permissions spécifiques suivantes;
- rh::change_module_configuration: Cette permission détermine si l'utilisateur a accès à la page de configuration du module.
- rh::voir_tous_les_marins: Cette permission outrepasse les filtrages par défaut et permet à l'utilisateur de voir tous les marins présents en base, indépendamment de sa propre unité d'affectation déclarée dans l'application.