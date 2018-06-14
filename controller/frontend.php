<?php

/*  Chargement des classes */

require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/UserManager.php');

/*  Recuperation de tout les chapitres */

function allChaps()
{
    $postManager = new \OpenClassrooms\Blog\Model\PostManager();
    $chaps = $postManager->getChaps();

    require_once ('view/frontend/listPostsView.php');
}

/*  Recuperation du premier chapitre */

function firstChap()
{
    $postManager = new \OpenClassrooms\Blog\Model\PostManager();
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
    
    $chap = $postManager->getFirstChap();
    $comments = $commentManager->getComments($chap['id']);
    
    $maxId = $postManager->getMaxId();

    require('view/frontend/postView.php');
}

/*  Recuperation du dernier chapitre */

function lastChap()
{
    $postManager = new \OpenClassrooms\Blog\Model\PostManager();
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();

    $chap = $postManager->getLastChap();
    $comments = $commentManager->getComments($chap['id']);
    
    $maxId = $postManager->getMaxId();

    require('view/frontend/postView.php');
}

/*  Recuperation d'un seul chapitre */

function chap()
{
    $postManager = new \OpenClassrooms\Blog\Model\PostManager();
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();

    $chap = $postManager->getChap($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);
    
    $maxId = $postManager->getMaxId();

    require('view/frontend/postView.php');
}

/*  Recuperation des commentaires pour la partie admin */

function adminComments()
{
    $postManager = new \OpenClassrooms\Blog\Model\PostManager();
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();

    $comments = $commentManager->getAllComments();
    
    $signaledComments = $commentManager->getSignaledComments();
    
    $chaps = $postManager->getChaps();
    $arrayChaps = $chaps->fetchAll();

    require('view/frontend/adminCommentsView.php');
}

/*  Pagination */

function nextChap()
{
    $postManager = new \OpenClassrooms\Blog\Model\PostManager();
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();

    $chap = $postManager->getNextChap($_GET['id']);
    $comments = $commentManager->getComments($chap['id']);
    
    $maxId = $postManager->getMaxId();

    require('view/frontend/postView.php');
}

function previousChap()
{
    $postManager = new \OpenClassrooms\Blog\Model\PostManager();
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();

    $chap = $postManager->getPreviousChap($_GET['id']);
    $comments = $commentManager->getComments($chap['id']);
    
    $maxId = $postManager->getMaxId();

    require('view/frontend/postView.php');
}

/*  Ajout de commentaire */

function addComment($postId, $author, $comment)
{
    $postManager = new \OpenClassrooms\Blog\Model\PostManager();
    $chap = $postManager->getChap($_GET['id']);
    
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();

    $affectedLines = $commentManager->postComment($postId, $chap['title'], $author, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=oneChap&id=' . $postId);
    }
}

/*  Signalement de commentaire */

function signalComment($commentId, $commentPostId)
{
    $postManager = new \OpenClassrooms\Blog\Model\PostManager();
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();

    $affectedLines = $commentManager->updateSignalComment($commentId);
    
    $chap = $postManager->getChap($_GET['postId']);
    $maxId = $postManager->getMaxId();
    $comments = $commentManager->getComments($chap['id']);

    require('view/frontend/postView.php');    
}

/*  Ajout de chapitre */

function addChap($titre, $chapitre)
{
    $postManager = new \OpenClassrooms\Blog\Model\PostManager();

    $affectedLines = $postManager->postChap($titre, $chapitre);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        require('view/frontend/adminView.php');    
    }
}

/*  Modification de chapitre */

function updateChap($id, $titre, $chapitre)
{
    $postManager = new \OpenClassrooms\Blog\Model\PostManager();

    $affectedLines = $postManager->updateChapContent($id, $titre, $chapitre);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        require('view/frontend/adminView.php');    
    }
}

/*  Affichage de la page de modification de chapitre */

function modifyChap($chapId)
{
    $postManager = new \OpenClassrooms\Blog\Model\PostManager();

    $chap = $postManager->getChap($_GET['id']);
    
    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        require('view/frontend/adminView.php');    
    }
}

/*  Recuperation d'un commentaire et affichage de la page pour le modifier */

function comment()
{
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
    
    $comment = $commentManager->getComment($_GET['id']);
    
    require('view/frontend/commentView.php');

}

/* Modification de commentaire */

function modifyComment($commentId, $comment, $postId)
{
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();

    $affectedLines = $commentManager->updateComment($commentId, $comment);
    
    $postManager = new \OpenClassrooms\Blog\Model\PostManager();

    $comments = $commentManager->getAllComments();
    $signaledComments = $commentManager->getSignaledComments();

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        require('view/frontend/adminCommentsView.php');
    }
}

/* Validation de commentaire */

function validateComment($commentId)
{
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();

    $affectedLines = $commentManager->validComment($commentId);
    
    $postManager = new \OpenClassrooms\Blog\Model\PostManager();

    $comments = $commentManager->getAllComments();
    $signaledComments = $commentManager->getSignaledComments();

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        require('view/frontend/adminCommentsView.php');
    }
}

/* Suppression de commentaire */

function deleteComment($commentId)
{
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();

    $affectedLines = $commentManager->suppressComment($commentId);
    
    $postManager = new \OpenClassrooms\Blog\Model\PostManager();

    $comments = $commentManager->getAllComments();
    $signaledComments = $commentManager->getSignaledComments();

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        require('view/frontend/adminCommentsView.php');
    }
}

/* Suppression de chapitre */

function deleteChap($chapId)
{
    $commentManager = new \OpenClassrooms\Blog\Model\PostManager();

    $affectedLines = $commentManager->suppressChap($chapId);
 
    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        allChaps();
    }
}

/* Affichage page d'accueil */

function accueil()
{
  require('view/frontend/accueilView.php');
}

/* Connexion session admin */

function tryLogin($postedName,$postedPassword)
{
    $userManager = new \OpenClassrooms\Blog\Model\UserManager();
    
    $user = $userManager->getUser();
    
    try {
          if($postedName == $user['username'])
            {
             if($postedPassword == $user['password'])
                {
                 $_SESSION['user'] = $user['username'];
                 require('view/frontend/adminView.php');
                }
              else
              {
                  throw new Exception('Mauvais mot de passe');
              }
            }
        else
        {
            throw new Exception('Mauvais nom');
        }
        }
    catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
}

/* Affichage editeur de chapitre */

function mce()
{
    if (isset($_GET['id']) && $_GET['id'] > 0) {
        $postManager = new \OpenClassrooms\Blog\Model\PostManager();
        $chap = $postManager->getChap($_GET['id']);
    }
    
  require('view/frontend/mceView.php');
}

/* Affichage editeur de chapitre à modifier*/

function mceUpdate()
{
    if (isset($_GET['id']) && $_GET['id'] > 0) {
        $postManager = new \OpenClassrooms\Blog\Model\PostManager();
        $chap = $postManager->getChap($_GET['id']);
    }
    
  require('view/frontend/mceUpdateView.php');
}

/* Affichage page admin*/

function admin()
{
  require('view/frontend/adminView.php');
}

/* Affichage page de connexion admin*/

function login()
{
  require('view/frontend/loginView.php');
}

/* Deconnexion session admin*/

function deco()
{
  session_destroy();
  accueil();
}
