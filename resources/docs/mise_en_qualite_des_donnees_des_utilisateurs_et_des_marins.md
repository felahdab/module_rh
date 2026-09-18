# Mise en qualité des données des utilisateurs et des marins.

La mise en service de POSEIDON et du module RH a mis en évidence que la mise en qualité des données RH des utilisateurs et des marins présents en base nécessitait des outils d'assistance aux administrateurs de l'instance.

## La mise à jour des données de référence

Certaines données de références doivent pouvoir être tenues à jour dans toutes les instances de POSEIDON avec le moins d'interventions manuelle possible.
A cet effet, des mécanismes de mise à jour sont mis en place.

### Mise à jour de la liste des unités du module RH

Voir [Mise à jour des données depuis une autre instance](../mises_a_jour_des_donnees_depuis_une_autre_instance)


## La mise à jour des données relative à chaque utilisateur ou marin

Les données relatives à chaque utilisateur ou marin peuvent être controlées en interrogeant les autres SI exposant ces données.
A la date de rédaction, Annudef est utilisé pour cela.

La commande artisan rh:verifier_les_donnees_individuelles permet de réaliser ces vérifications et de proposer à l'utilisateur des modifications dans la base locale pour faire correspondre les données en base aux données issues de l'interrogation Annudef.

Au cours du processus, les données présentes en base de données peuvent également être corrigées si l'utilisateur le souhaite.