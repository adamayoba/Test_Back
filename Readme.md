Les endpoints disponible sur cette api:

pour cette api j'ai utilisé comme server Apache :
phpmyadmin 

et pour la base de donnée: 
mysql
pour mon cas j'ai utilisé XAMPP

ci-joint la requête pour la creation de la base de donnée: 
api_test.sql dans le projet

## Niveau user:

Endpoint de Creation d'un utilisateur:
http://localhost/Test_Back/users/create.php

Pour créer un user pas besoin de l'id sachant qu'il est auto-increment

{
"name": "Test",
"email": "tes@gmail.com"
}

---

Endpoint de Modification d'un utilisateur:
http://localhost/Test_Back/users/update.php

Pour modifier un user

{
"id": 1,
"name": "Testmodif",
"email": "tesmodif@gmail.com"
}

---

Endpoint d'affichage de tout les utilisateurs:
http://localhost/Test_Back/users/read.php

---

Endpoint d'affichage d'un seul utilisateur:
http://localhost/Test_Back/users/read_one.php

Pour afficher un user

{
"id": 1
  
 }

---

Endpoint de suppression d'un utilisateur:
http://localhost/Test_Back/users/delete.php

Pour supprimer un user

{
"id": 1
  
 }

---

---

---

## Niveau task:

Endpoint de Creation d'une tâche:
http://localhost/Test_Back/tasks/create.php

Pour créer un task pas besoin de l'id sachant qu'il est auto-increment,
valable aussi pour la creation_date qui est en curent par contre il faudra un
user_id existant sinon conflit avec la db

{
"user_id": 1,
"title": "Test",
"description": "Pour le test",
"status": "status"
  
 }

---

Endpoint de Modification d'une tâche:
http://localhost/Test_Back/tasks/update.php

Pour modifier un task pas besoin de la creation_date puis qu'on parle
de la date de création

{
"id": 1,
"user_id": 1,
"title": "Testmodif"
"description": "Pour le tester la modification",
"status": "status"
  
 }

---

Endpoint d'affichage de toutes les tâches:
http://localhost/Test_Back/tasks/read.php

---

Endpoint d'affichage d'une seule tâche:
http://localhost/Test_Back/tasks/read_one.php

Pour afficher un user

{
"id": 1
  
 }

---

Endpoint de suppression d'une tâche:
http://localhost/Test_Back/tasks/delete.php

Pour supprimer un task

{
"id": 1
  
 }

---
Endpoint d'affichage de toutes les tâche d'un utilisateur:
http://localhost/Test_Back/tasks/read_user.php

Pour afficher les tasks d'un user

{
  
 "user_id": 1
  
 }

---
