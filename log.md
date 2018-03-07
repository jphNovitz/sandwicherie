# isl ei 2018 : La Clémentine - Log
  
 memo / todo  
! le service delete renvoie vers la liste d'ingredient !!! changer la destination ou mettre un path
decalage vers le bas different entre ingredients et inputs -> checker

 adresse media queries https://v4-alpha.getbootstrap.com/layout/overview/
 remplacer les id par les slugs dans les routes  
 separer menu lateral du template -> mettre dans _elements  
 bread et sauce dans formulaire ingredient  
 ajouter une fonctionnalité pour categorie :    
 dans le formulaire de modification: ajouter la possibilité d'ajouter les ingrédients   

## 7 mars 2018
***Avancement***
* Refactor css pour certains formats écrans qui posaient problèmes
* Mise en place du composant sécurité: installation, configuration de base, controller, formulaire login

## 5 et 6 mars 2018
***Avancement***
* Modification Product et Provider pour:
** controller -> deleteAction
** controller -> remplacement id par slug
** form
** card  
* modificatin/menu floatin pour avoir un différent dans les card (detail) + ajoutt/changement des liens.

##28 février 2018
***Avancement***  
* Modification Allergy, Category, Type pour:
** controller -> deleteAction
** controller -> remplacement id par slug
** form
** card  

##26 et 27 février 2018
***Avancement***
* modification du controller pour l'action delete  
 -> trop long, raccourci par la création d'un deleteType pour la création du formulaire.  
 -> création d'un service pour exécuter l'action de  supprimer.  
 * debut de création de l'affichage du détail (card) pour un ingrédient.  
    
##24 février 2018
***Avancement***  
* petits ajustements affichage container list et lateral toolbar
* correction bd entité ingredient pour éviter erreur contrainte lors de suppression ingrédient -> cascadegit 
##19 février 2018
***Avancement***  
* fait plus ou moins le tour du css (pour l'instant)  
* début d'ajout d'action suppression -> routes  

##16 février 2018  
***Avancement***  
L'ajout de lien dans _loop_entity_list et donc l'utilisation de route/path  
Pour que cela fonctionne j'ai besoin de recuperer le nom de l'entité à laquelle appartient l'élement  
-> j'ai créer un filtre twig (src/Twig)  

##du 12 au 15 février 2018
***Avancement***
* Continuer à adapter le css pour les versions au delà des smartphones vers les laptops -> pages d'accueil
* sur la page accueil admin pour version ordi (grand écran) pour afficher plus que les liens vers les pages
** affichage de cinq éléments pour chaque entité
** utilisation d'un 'element partiel' à inclure plusieurs fois-> un seul élément à modifier pour tout 
mettre en forme d'un coup.

##11 février 2018  
***Avancement***  
* Mise en forme des éléments aux media queries supérieur auw smarphones -> ok pour page accueil jusque 768px

##8 février 2018 
* Entité Ingredient -> ajout vegetable pour crudité.
* Modifications css  

##5 février 2018
***Avancement***  
Mise en forme de la page accueil admin avec des logos material design
***Reflexions*** 
Pas certains que ces logos soient compréhensibles soit:
* je met le mot en dessous pour aider
* je change de librairie icones pour avoir des plus clairs
* je reviens aux mots seuls.  

##4 fevrier 2018
**Avancement**  
* Integration du floating menu dans le tempate list
* verifiaction que ce la ne pose pas de problème avec links/path/chemins ->ok
* Ajout dans le readme.md 

##3 fébrier 2018
*Avancement*  
Sur le côté préparation d'un 'floating action menu' dans le style google par exemple inbox qui sera à intégrer à 
mon template.

##31 janvier / 01 fevirer 2018
##### INPUTS & LINES  
***Avancement***
* ajouté un champs pour le codebar et intégré les champs qui ne l'étaient pas comme la température.
* de la mise en forme de la page d'ajout/modification input avec lines integré.
* ajout de quelques contraintes.
* ajout messages d'erreurs ! implémentation des messages d'erreurs non verifiée.  
***Réflexion***
Petit soucis causés dans la mise en forme par la collection de line dans Input.  
Solutions trouvées. Interface pas au top du top mais lisible, claire et en tous cas satisfaisante pour l'instant.

### 29 et 30 janvier 2018
##### Input form add et update
***Avancement***  
Probleme résolu: lors de la creation d'un input dans la table part (line) la reference à l'input 
restait à null.  Solution. il faut ajouter 'by_reference'=> false dans le type sinon les adders ne sont pas pris en compte.
Un peu de mise en forme css  

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

