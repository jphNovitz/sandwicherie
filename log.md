# isl ei 2018 : La Clémentine - Log
  
 memo / todo  

 améliorer  affichage erreurs dans les formulaires
 remplacer les id par les slugs dans les routes
 separer menu lateral du template -> mettre dans _elements
 bread et sauce dans formulaire ingredient
 ajouter une fonctionnalité pour categorie :   
 dans le formulaire de modification: ajouter la possibilité d'ajouter les ingrédients   

### 28 janvier 2018
##### Input = entrées de marchandises  
***Avancement***  
* Travail sur les entrées de marchandies (inputs)  
* une entrée de marchandise est une collection de 'lignes'
* C'est le même principe que j'utiliserais pour les commandes
* utilisation de la Single Table Inheritance
* part se divise en line et item (le élements communs se trouvent dans part)
* modification du schéma (entité)
* InputType et LineType
* fait la plus grosse partie du controller -> reste update
* vues 
  
  
### 27janvier 2018  
##### Product  
***Avancement***  
* modification entité, formType, formulaire twig 
* inclusion vich uploader pour une relation Many To Many
* correction des Constraints et messages d'erreur  
* modification (nettoyage) entité image
   
   
### 26 janvier 2018
#####  collection updload
***Avancement***  
* continué le travail des autres jours pour arriver à une cohésion : la même structure les mêmes éléments 
* ajout d'upload d'images pour (One To Many) l'entité Ingrédients -> utilisation de jQuery
***Réfléxions***
VichUploader se révèle bien il s'intègre assez facilement, je vais peut-être le garder.  
Appris à faire une collection d'upload -> utilisation de JQuery  
[lien vers la doc](https://symfony.com/doc/current/form/form_collections.html) 

### 23 janvier 2018
#####  Provider -> city (ville)
***Avancement***  
* rempli la table de villes / cp
* modifié pour que que cp puisse etre multiple  
* __toString pour afficher 'cp ville'
* intégration du champs 'city' dans le ProviderType
* modification template / css   
* installation LOGGER


### 22 janvier 2018  
#####  Provider  
***Avancement***   
maj chemins parametres formulaire et affichage erreurs pour PROVIDER   
quelques corrections  

### 21 janvier 2018  
#####  Type  
***Avancement***  
corrections erreurs (php7), utilisation des parametre vers les vues ds Controlleurs.  Amélioration form et vues:
* Products
* Types


### 19 janvier 2018  
##### Allergy finalisation d'une version de base  
***Avancement***
* finalisation de vich uploader bundle  dans les formulaire (allergy) add et update  
* mise en forme des formulaires add et update avec un peu de style (css) 
* amélioration affichage erreur l'erreur pour nom s'affiche en dessous de l'imput
* modification du controller pour modifier les chemins vers les templates pour utiliser des parametres  
  
***Réflexions***  
partie à retravailler plus tard mais version qui se tient. Je peux avancer.

### 18 janvier 2018
##### Allergy - updload images  
**Avancement**
* création Admin controller pour une page d'accueil dans l'admin. 
* quelque corrections
* installation vich bundle pour updload image -> ajout dans formulaire ajout allergie
* travail sur allergy   
**Reflexion**  
Beaucoup de temps gagner avec vich, pour l'instant cela me permet d'avancer. Continuer a tester vich avec
des entites/relations plus complexes.
     
### 17 janvier 2018
##### Continué le travail des jours précédents  
**Avancements**  
Modification entité ingredients, products, type, allergie .... ajout de propriétés dont SLUG  
Corrections dans les controllers des jours précédent + même structure des actions pour input, product,
type, ...  
Modification de la structure des controller et des templates pour une meilleure lisibilité  
**Reflexions**  
ressemble plus à mes idées.
 
### 16 janvier 2018
##### ingredientController, ProviderController  
**Avancements**  
Avancements identitques pour les controller ingredients et provider + modification des vues.  
corrections de petites erreurs dans categoryController.   
Petites corrections dans le css.
**Reflexions**  
Les vues sont rapidement modifiables grâce aux héritages -> elles ont toutes les mêmes bases/structure
les seuls changements sont pour des nom de variables et pour des titres.  
les controllers pourraient peut-être être optimisé mais seraient peut-être plus complexes à lire.
    
### 15 janvier 2018
##### Correction categoryController et ingredientController

**Avancements**:
Corrections du CategoryController: modification des routes avec ajout d'une route  et d'une 
methode 'générales' au controller + modification des vues pour coincider aux modifications.  
Début de travail sur le controller des Ingredients en appliquant la même philosophie que dans catégories.  action add ok.
**Réflexions** 
La route pour le controlleur a simplifié les routes pour chacune des actions

### du 3 au 13 janvier 2018
##### Crétion des vues pour une catégorie

**Avancements**:
Création des vues pour les liste de catégories, l'ajout de catégorie.  
Inspiration du visuel de 'material design' de google.
Utilisation de plusieurs niveaux d'héritage pour les vues.
Recréation totale du scss mais en gardant un semblant de structure et des noms de class de bootstrap.

**Réflexions** 
Utilisation de material design pour la partie admin car j'ai besoin que l'utilisation 
soit facile et instinctive.  Je suis certain que la cliente saura l'utiliser car 
elle utilise tous les jours goole et facebook et ces deux interfaces ont beaucoup de similitude.

### Du 12 decembre au 2 janvier 2018
##### Création des schéma et création des entité  
  
**Avancement**  
Création du Schéma Entités/Relation  
Création de toutes les entités et des relations entre elles  
création du schéma des entités  
Rédaction du cahier des charges  
  
 **Réflexions**  
 Les entités et/ou relations pourraient changer 

