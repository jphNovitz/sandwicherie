# Creation d'un CustomPersister
=
 
## Rappel
**Interface**: Classe Abstraite qui n'implémente aucune méthode, son utilité est simplement de forcer à respecter un contrat: chacune des méthodes doivent se retrouver dans les classes qui l'implémentent.
**Service**: Classe dont l'objectif est d'être réutilisée, principalement pour éviter la duplication de code.

## Objectif:
* La création d'un CustomPersister me permetrait de mettre la logique qui consiste à insérer, updater ou supprimer des données dans la base de donnée.  
* Ce code réutilisable permettrait de gagner du temps, d'eviter des erreurs en évitant de dupliquer du code et surtout d'alléger mes controller.  
* Simplification pour la creation, modification et les test de cette fonctionnalité: un seul endroit où travailler et tout se répercute

## Action:
* création d'un dossiere Model pour placer l'interface [CustomPersisterInterface](blob/master/src/Model/CustomPersister.md)
*  création d'un dossier Service pour mettre mon service [CustomPersister]()
* Le service implémente le l'inteface et ses methodes.
* Injection du service dans le controller
* utilisation du service `php $this->customPersister->insert($provider);`
  
