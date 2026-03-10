# Utilisation

## Gestion des marins
La page de gestion des Marin présente la liste des Marins stockés en base.
La liste qui s'affiche dépend de l'application du filtrage applicatif décrit dans la page [architecture logicielle](architecture_logicielle.md).

Sur chaque ligne représentant un marin, l'utilisateur peut trouver 3 actions:
- l'accès à la page d'édition des informations du marin (un clic n'importe où sur la ligne fait la même chose)
- la possibilité d'associer ce marin à un utilisateur de l'application
- la possibilité de créér un utilisateur de l'application qui sera automatiquement associé à ce Marin.

## Gestion des utilisateurs
La page de gestion des Utilisateurs présente la liste des comptes utilisateur de l'application présents en base.

Sur chaque ligne représentant un utilisateur, l'utilisateur peut trouver une action: "Attribuer une unité", ou "Retirer une unité".
Ces 2 actions sont exclusives l'une de l'autre.

- Lorsque l'utilisateur n'a pas encore d'unité attribuée, seule l'action "Attribuer une unité" apparait. Lorsque l'on clique dessus, un popup apparait et permet de sélectionner l'unité à attribuer à l'utilisateur sélectionné.
- Lorsqu'utilisateur a déjà une unité attribuée, seule l'action "Retirer une unité" apparait. Lorsque l'on clique dessus, une confirmation est demandée, puis en cas de validation, l'unité attribuée précédemment est retirée de l'utilisateur.

La gestion de l'association entre l'utilisateur et les unités est utilisée par le module RH pour filtrer la liste des Marins qui sont accessibles aux utilisateurs. Elle peut être utilisée par les autres modules pour des fonctions de filtrage ou pour accorder des permissions.

## Recherche Annudef
La page de recherche dans l'Annudef permet de faire une recherche dans Annudef puis de réaliser des actions sur la liste des résultats obtenus.  

En particulier, lorsque la recherche renvoit des résultats, l'utilisateur peut:
- cliquer sur "Créé un utilisateur local et/ou une fiche de marin" en bout de ligne à droite: il a ensuite accès à un petit assistant qui le guide pour créér l'utilisateur local, la fiche de Marin et faire le lien entre les deux.
- sélectionner un ou plusieurs résultats (case à cocher à gauche), puis cliquer sur le bouton "Créé l'utilisateur local" au dessus de la liste. Cette action permet de créér d'un seul coup plusieurs comptes utilisateurs.