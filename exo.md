Exercice de formation de requête RESTFull
Exemple : J'aimerais récupérer tout les plats

Requete:
GET http://localhost:4444/dishes
Resource: Collection

1. J'aimerais récupérer tout les ingrédients

Requete :
GET http://localhost:4444/ingredients
Ressource : Collection

2. J'aimerais récupérer l'utilisateur avec l'id 4

Requete :
GET http://localhost:4444/users/4
Ressource : Document


3. J'aimerais supprimer le plat avec l'id 2

Requete :
DELETE http://localhost:4444/dishes/2
Ressource : ?

4. J'aimerais créer un nouveau plat

Requete :
POST http://localhost:4444/dishes
Ressource : Document


5. J'aimerais modifier l'ingredient avec l'id 8

Requete :
PUT http://localhost:4444/ingredients/8
Ressource : Document

6. J'aimerais récupérer les ingrédients du plat avec l'id 9

Requete :
GET http://localhost:4444/dishes/9/ingredients
Ressource : Collection


7. J'aimerais récupérer tout les plats dont le nom contient "Pizza"

Requete :
GET http://localhost:4444/dishes?name=%pizza%
Ressource : Collection


8. J'aimerais ajouter un ingrédient au plat avec l'id 2

Requete :
POST http://localhost:4444/dishes/3/ingredients
Ressource : Document


9. J'aimerais récupérer tout les plats ordonées par prix croissant et limiter à 4 résultat

Requete :
GET http://localhost:4444/dishes?sort=+price/limit=4
Ressource : Collection

