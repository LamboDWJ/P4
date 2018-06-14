<?php session_start() ?>

<?php
require('controller/frontend.php');

try {
    if (isset($_GET['action'])) {
      
/*  Bouton premier chapitre */
        
        if ($_GET['action'] == 'firstChap') {
            firstChap();
        }
        
/*  Bouton dernier chapitre */
        
        elseif ($_GET['action'] == 'lastChap') {
            lastChap();
        }
        
/*  Bouton sommaire */
        
        elseif ($_GET['action'] == 'allChaps') {
            allChaps();
        }
        
/*  Appel d'un seul chapitre, via le sommaire ou autres */
        
        elseif ($_GET['action'] == 'oneChap') {
            chap();
        }
        
/*  Pagination */
        
        elseif ($_GET['action'] == 'nextChap') {
            nextChap();
        }
        
        elseif ($_GET['action'] == 'previousChap') {
            previousChap();
        }
        
/*  Ajout d'un commentaire */

        
        elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                }
                else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        
/*  Ajout d'un chapitre */
        
        elseif ($_GET['action'] == 'addChap') {
            if (!empty($_POST['titre'])) {
                if (!empty($_POST['chapitre'])) {
                    addChap($_POST['titre'],$_POST['chapitre']);
                }
                else {
                    throw new Exception('Veuillez écrire un chapitre.');
                     }
                }
            else {
                throw new Exception('Veuillez renseigner le titre.');
                 }
            }
        
/*  Modification d'un chapitre */
        
           elseif ($_GET['action'] == 'updateChap') {
            if (!empty($_POST['titre'])) {
                if (!empty($_POST['chapitre'])) {
                   updateChap($_GET['id'],$_POST['titre'],$_POST['chapitre']);
                }
                else {
                    throw new Exception('Veuillez écrire un chapitre.');
                     }
                }
                else {
                throw new Exception('Veuillez renseigner le titre.');
                 }
            }
        
/*  Accès à la page de modification du chapitre */
        
        elseif ($_GET['action'] == 'modifyChap') {
            mceUpdate();
           }
            
/*  Ajout d'un commentaire */
       
        elseif ($_GET['action'] == 'comment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                comment();
            }
                else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
        }
        
/*  Modification de commentaire */
        
         elseif ($_GET['action'] == 'modifyComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0)
            {
                if (isset($_GET['postid']) && $_GET['postid'] > 0)
                {   
                    if (!empty($_POST['comment'])) {
                    modifyComment($_GET['id'], $_POST['comment'], $_GET['postid']);
                    }
                else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                    }
                }
                else {
                    throw new Exception('Aucun identifiant de commentaire envoyé');
                }
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        
/*  Validation d'un commentaire signalé */
        
        elseif ($_GET['action'] == 'validateComment') {
            validateComment($_GET['id']);
        }
        
/*  Connexion à la session admin */
        
        elseif ($_GET['action'] == 'tryLogin') {
            if (!empty($_POST['username']))
            {
                if (!empty($_POST['password']))
                {
                    tryLogin($_POST['username'],$_POST['password']);
                }
                else
                {
                    throw new Exception('Veuillez renseigner un mot de passe !');
                }
            }
            else
            {
                throw new Exception('Veuillez renseigner un nom !');
            }
    }
        
/*  Accès à l'éditeur de chapitre */
        
        elseif ($_GET['action'] == 'mce') {
            mce();
        }
        
/*  Accès à la page d'admin */
        
        elseif ($_GET['action'] == 'admin') {
            admin();
        }
        
/*  Accès à la page d'administration des commentaires */
        
        elseif ($_GET['action'] == 'adminComments') {
            adminComments();
        }
        
/*  Accès à la page de connexion admin */
        
        elseif ($_GET['action'] == 'login') {
            login();
        }
        
/*  Signalement d'un commentaire */
        
        elseif ($_GET['action'] == 'signalComment') {
            signalComment($_GET['id'],$_GET['postId']);
        } 
        
/*  Suppression d'un commentaire */
        
        elseif ($_GET['action'] == 'deleteComment') {
            deleteComment($_GET['id']);
        }
        
/*  Suppression d'un chapitre */
        
        elseif ($_GET['action'] == 'deleteChap') {
            deleteChap($_GET['id']);
        }
        
/*  Deconnexion de la session admin */
        
        elseif ($_GET['action'] == 'deco') {
            deco();
        }
    }
    
/*  Si aucune action, affichage de la page d'accueil */
    
        else {
        accueil();
    }

}

catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
