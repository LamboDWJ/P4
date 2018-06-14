<?php

namespace OpenClassrooms\Blog\Model;

require_once("model/Manager.php");

class CommentManager extends Manager
{
    
    /* Recuperation de tout les commentaires d'un chapitre donné */
    
    public function getComments($postId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr, post_id FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
        $comments->execute(array($postId));

        return $comments;
    }
    
    /* Recuperation des 5 derniers commentaires*/
    
       public function getAllComments()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, post_id, post_title, author, signalement, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments ORDER BY comment_date DESC LIMIT 0, 5');
        
        return $req;
    }
    
    /* Recuperation des commentaires signalés*/
    
         public function getSignaledComments()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, post_id, post_title, author, signalement, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE signalement = 1 ORDER BY comment_date DESC');
        
        return $req;
    }
    
    /* Recuperation des commentaires de l'article suivant */
    
        public function getNextComments($postId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id > ? ORDER BY comment_date DESC');
        $comments->execute(array($postId));

        return $comments;
    }
    
    /* Recuperation des commentaires de l'article précédent */
    
           public function getPreviousComments($postId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id < ? ORDER BY comment_date DESC');
        $comments->execute(array($postId));

        return $comments;
    }
    
    /* Recuperation d'un commentaire en particulier */
    
      public function getComment($commentId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, post_id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE id = ?');
        $req->execute(array($commentId));
        $comment = $req->fetch();


        return $comment;
    }
    
    /* Ajout d'un commentaire */
    
    public function postComment($postId, $postTitle, $author, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(post_id, post_title, author, comment, comment_date, signalement) VALUES(?, ?, ?, ?, NOW(),0)');
        $affectedLines = $comments->execute(array($postId, $postTitle, $author, $comment));

        return $affectedLines;
    }
    
    /* Modification d'un commentaire */
    
     public function updateComment($commentId, $comment)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET comment = :nvcomment, signalement = :nvsignal WHERE id = :id');
        $affectedLines = $req->execute(array(
        'nvcomment' => $comment,
        'nvsignal' => 0,    
        'id' => $commentId    
        ));

        return $affectedLines;
    }
    
    /* Suppression d'un commentaire */
    
      public function suppressComment($commentId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM comments WHERE id = :id');
        $affectedLines = $req->execute(array(
        'id' => $commentId    
        ));

        return $affectedLines;
    }
    
    /* Validation d'un commentaire */
    
       public function validComment($commentId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET signalement = :nvsignal WHERE id = :id');
        $affectedLines = $req->execute(array(
        'nvsignal' => 0,    
        'id' => $commentId    
        ));

        return $affectedLines;
    }
    
    /* Signalement d'un commentaire */
    
     public function updateSignalComment($commentId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET signalement = :nvsignal WHERE id = :id');
        $affectedLines = $req->execute(array(
        'nvsignal' => 1,
        'id' => $commentId    
        ));

        return $affectedLines;
    }
}
