# P4
Projet de formation OpenClassrooms

1 - Copiez le dossier P4 dans le dossier 'www' de votre serveur local
2 - Importez la base de données 'blog.sql'via phpMyAdmin
3 - Dans le dossier 'model', ouvrez 'Manager.php' avec votre éditeur de texte
4 - Cherchez cette ligne :

$db = new \PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
return $db;

... et remplacez root par votre nom d'administrateur et l'espace après par votre mot de passe
(ceux que vous utilisez pour phpMyAdmin)

... Enjoy !
