# Mise à jour des données depuis une autre instance POSEIDON

Le module RH peut être configuré pour mettre à jour ses données depuis une autre instance POSEIDON.

## Mise à jour de la liste des unités

La liste des unités présentes dans la base de données d'une instance POSEIDON peut être mise à jour à partir des données d'une autres instance de POSEIDON disposant du module RH.

Chaque instance POSEIDON est configurée lors de son déploiement pour utiliser une autre instance comme référence ou pas.

Lorsqu'une instance est désignée pour servir de référence à la liste des unités, le module RH peut envoyer des demandes de mise à jour.

``` mermaid
sequenceDiagram
  autonumber
  instance_locale->>instance_de_reference: RH_REQUEST_UNITES_UPDATE
  instance_de_reference->>instance_locale: RH_REQUEST_UNITES_UPDATE_RESPONSE
  loop Toutes les unités manquantes
      instance_de_reference->>instance_locale: RH_UNITE_DEFINITION
  end
  
  Note right of instance_locale: Les définitions transmises sont utilisées pour créér les unités dans la base locale.
  
```