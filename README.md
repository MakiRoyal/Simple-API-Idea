# Simple-API-Idea
L'exercice était de créer une API simple où on pouvait envoyer à une base de données, des informations saisies sur l'application PostMan.

(Every filling fields should be a string of length <= 255)

/pokemon :

POST: This command will create a new Pokemon, you must write its name, gender and type. If it belongs to a trainer, please write its trainer's id.

GET: This command will give every Pokemon who has been created with the POST method.

DELETE: This command will give you the right to delete a Pokemon (You have to enter the pokemon's id in order to delete it).

PUT: This command will give you the right to update a Pokemon (You have to enter the pokemon's id in order to delete it).

/trainer :

POST: This command will create a new Trainer, you must write its name, gender and wallet. (This time, as parameters, you must use $trainerName, wallet, $trainerGender)

GET: This command will give every Trainer who has been created with the POST method.

DELETE: This command will give you the right to delete a Trainer (You have to enter the pokemon's id in order to delete it).

PUT: This command will give you the right to update a Trainer (You have to enter the pokemon's id in order to delete it).
