API :
- Se travaille avec du Json => installer le bundle sur symfony : composer require symfony-bundles/json-request-bundle

- Pour faire du Json ds un controller, il faut retourner $this->json() il acceptent plusieurs param : 
1. la donnée qu'on beut sérialiser en Json
2. le status code (200, 400)

- Processus de serialisation : symfony va transformer l'entité en Json. ATTENTION a ne pas faire de boucle infini dans la serialisation. Pr regler le pb il faut mettre l'annotation @IGnore au dessus de la propriété, elle sera ignorée et pas transformée en Json

- Rajouter dans les route la méthode : methods={"GET} ou POST etc..

- Formulaire : dans les API les form sont differents des forms calssiques. Une API a ses propres formulaires. Ces form doivent respecter 3 choses :
1. Desactiver le prefixe : public function getBlockPrefix() et retourne une string vide
2. Pas beosin de l aprotection csrf pr les forms d'API, à desactiver 'csfr_protection' => false
3. Pas de bouton submit dans le builder

- Dans le controller de l'API, en method POST pour créer, on créer le form. Dans le if, on retourne $this->json($form->getData(), 201);

et en dehors du if retourne $this->json($form->getErrors(), 400);

- Dans le fichier http :
1. Method + Url de requete avec les ressources
2. Content-Type : application/json
3. On saute 2 lignes et on passe au body :
4. code JSon, ex : 
{
    "name" : "poivre",
    "price" : 0.10
}

NB : Json => string = double quote
          => Jamais de virgule apres le dernier