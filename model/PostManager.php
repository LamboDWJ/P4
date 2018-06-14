<?php

namespace OpenClassrooms\Blog\Model;

require_once("model/Manager.php");

class PostManager extends Manager
{
    
    /* Récupération de tout les chapitres */
    
    public function getChaps()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts');

        return $req;
    }
    
    /* Récupération du premier chapitre */
    
    public function getFirstChap()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = 1');
        $chap = $req->fetch();
       
        return $chap;
    }
    
    /* Récupération du dernier chapitre */
    
     public function getLastChap()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = (SELECT MAX(id) FROM posts)');
        $chap = $req->fetch();
       
        return $chap;
    }
    
    /* Récupération de l'id du dernier chapitre */
    
    function getMaxId()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id FROM posts WHERE id = (SELECT MAX(id) FROM posts)');
        $maxId = $req->fetch();
       
        return $maxId;
        
    }
    
    /* Récupération d'un chapitre en particulier */

    function getChap($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
        $req->execute(array($postId));
        $chap = $req->fetch();

        return $chap;
    }
    
    /* Récupération du chapitre suivant */
    
        function getNextChap($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id > ? ORDER BY id ASC LIMIT 1');
        $req->execute(array($postId));
        $chap = $req->fetch();
        return $chap;
    }
    
    /* Récupération du chapitre précédent */
    
        function getPreviousChap($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id < ? ORDER BY id DESC LIMIT 1');
        $req->execute(array($postId));
        $chap = $req->fetch();

        return $chap;
    }
    
    /* Ajout de chapitre */
    
        public function postChap($titre, $chapitre)
    {
        $db = $this->dbConnect();
        $chaps = $db->prepare('INSERT INTO posts(title, content, creation_date) VALUES( ?, ?, NOW())');
        $affectedLines = $chaps->execute(array($titre, $chapitre));

        return $affectedLines;
    }
    
    /* Modification de chapitre */
    
      public function updateChapContent($id, $titre, $chapitre)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE posts SET title = :nvtitle, content = :nvcontent WHERE id = :id');
        $affectedLines = $req->execute(array(
        'nvcontent' => $chapitre,
        'nvtitle' => $titre,   
        'id' => $id    
        ));

        return $affectedLines;
    }
    
    /* Suppression de chapitre */

      public function suppressChap($chapId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM posts WHERE id = :id');
        $affectedLines = $req->execute(array(
        'id' => $chapId    
        ));

        return $affectedLines;
    }
}
