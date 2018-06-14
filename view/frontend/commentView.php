

<!--Nouvelle view n'affichant que le commentaire sélectionné et le champ texte pour le modifier-->

<?php $title = 'Modifiez votre comentaire'; ?>


<?php ob_start(); ?>

<!--  Si pas de session admin, direction page d'accueil -->

      <?php
    if (!isset($_SESSION['user'])) 
    {
        header('Location: index.php');
    }
    
    ?>

<!--  Affichage du commentaire à modifier -->


<div id="commentModif">
<p>
    <?= nl2br(htmlspecialchars($comment['comment'])) ?>
</p>
    
</div>

<!--Formulaire de modification du commentaire-->

<div id="formcomment">
    <form action="index.php?action=modifyComment&amp;id=<?= $comment['id'] ?>&amp;postid=<?= $comment['post_id'] ?>" method="post">
        <textarea id="comment" name="comment">
            <?=nl2br(htmlspecialchars($comment['comment'])) ?>
        </textarea>
        <input type=submit />
    </form>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
