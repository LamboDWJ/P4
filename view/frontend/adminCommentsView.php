<?php $title = 'Commentaires'; ?>

<?php ob_start(); ?>
<!--  Si pas de session admin, direction page d'accueil -->
      <?php
    if (!isset($_SESSION['user'])) // Si le mot de passe est bon
    {
        header('Location: index.php');
    }
    // On affiche les codes
    ?>
<!--  Menu de navigation -->
<div class="navbox">
    <div class="navigation">
<p><a href="index.php">Retour à l'accueil</a></p>
        </div>
    </div>

<div class="comments">
    
    <!--  Récupération des 5 derniers commentaires avec boutons supprimer et modifier -->

<h2>Derniers commentaires :</h2>

<?php
while ($data = $comments->fetch())
{
?>
    <div class="news">
        
        <p>  <?= htmlspecialchars($data['comment']) ?></p>
          <p>  <em>le <?= $data['comment_date_fr'] ?> par <?= $data['author'] ?> sur 
                <?= $data['post_title'] ?>
                
  
               </em></p>
        
        <a href='index.php?action=comment&amp;id=<?= $data['id'] ?>'>Modifier</a>
        <a href='index.php?action=deleteComment&amp;id=<?= $data['id'] ?>'>Supprimer</a>
    
        
    </div>
<?php
}
$comments->closeCursor();
?>
<!--  Récupération des 5 derniers commentaires avec boutons supprimer et modifier --><h2>Tout les commentaires signalés :</h2>

<?php
while ($data = $signaledComments->fetch())
{
?>
    <div class="news">
        
        <p>  <?= htmlspecialchars($data['comment']) ?> </p>
         <p>   <em>le <?= $data['comment_date_fr'] ?> par <?= $data['author'] ?> sur 
              
                
               </em></p>
        
        <a href='index.php?action=comment&amp;id=<?= $data['id'] ?>'>Modifier</a>
        <a href='index.php?action=deleteComment&amp;id=<?= $data['id'] ?>'>Supprimer</a>
            <a href='index.php?action=validateComment&amp;id=<?= $data['id'] ?>'>Valider</a>

        
    </div>
<?php
}
$signaledComments->closeCursor();
?>
    
    </div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>