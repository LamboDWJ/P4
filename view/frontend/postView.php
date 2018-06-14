<?php $title = 'Lecture'; ?>


<?php ob_start(); ?>


<!--  Menu de navigation et pagination -->

<div class="navbox">
    <img id="book" src="public/img/book.jpg">

    <div class="navigation">
        <a href="index.php">Retour à l'accueil</a>
        <a href="index.php?action=firstChap">Premier chapitre</a>
        <a href="index.php?action=lastChap">Dernier chapitre</a>
        <a href="index.php?action=allChaps">Sommaire</a>
    </div>
    
    <div id="pagination">
        <?php
        if ($chap['id'] != 1) 
        {
        ?>

        <a href="index.php?action=previousChap&amp;id=<?= $chap['id'] ?>">Chapitre précédent</a>

        <?php       
        }
        ?>

        <?php
        if ($chap['id'] != $maxId['id']) {
        ?>

        <a href="index.php?action=nextChap&amp;id=<?= $chap['id'] ?>">Chapitre suivant</a>

        <?php
        }
        ?>
    </div>
</div>

<!--  Chapitre -->


<div class="paper">
    <div class="chapter">
            <h2><?= htmlspecialchars($chap['title']) ?></h2>
            <div class="mountainbox"> 
                <img class="mountain" src="public/img/mountain.png">
            </div>  
            <p><?= ($chap['content']) ?></p>
            <div class="mountainbox"> 
                <img class="mountain" src="public/img/mountain.png">
            </div>  
    </div>
</div>

<!--  Si session admin, boutons modifier et supprimer le chapitre -->

<div id="adminboutons">
        <?php
if (isset($_SESSION['user']))
{ ?>

            <a href='index.php?action=modifyChap&amp;id=<?= $chap['id'] ?>'>Modifier</a>

            <a href='index.php?action=deleteChap&amp;id=<?= $chap['id'] ?>'>Supprimer</a>

            <?php
}
?>
</div>

<!--  Menu de navigation et pagination -->

<div class="navbox">


    <div class="navigation">
        <a href="index.php">Retour à l'accueil</a>
        <a href="index.php?action=firstChap">Premier chapitre</a>
        <a href="index.php?action=lastChap">Dernier chapitre</a>
        <a href="index.php?action=allChaps">Sommaire</a>
    </div>

    <div id="pagination">
    <?php
    if ($chap['id'] != 1) 
    {
    ?>

    <a href="index.php?action=previousChap&amp;id=<?= $chap['id'] ?>">Chapitre précédent</a>

    <?php       
    }
    ?>

    <?php
    if ($chap['id'] != $maxId['id']) {
    ?>

    <a href="index.php?action=nextChap&amp;id=<?= $chap['id'] ?>">Chapitre suivant</a>

    <?php
    }
    ?>
    
    </div>
    
</div>

<!--  Menu de navigation et pagination -->

<div class="comments">
    <h2>Commentaires</h2>

    <form action="index.php?action=addComment&amp;id=<?= $chap['id'] ?>" method="post">
        <div>
            <label for="author">Auteur</label><br />
            <input type="text" id="author" name="author" />
        </div>
        <div>
            <label for="comment">Commentaire</label><br />
            <textarea id="comment" name="comment"></textarea>
        </div>
        <div>
            <input type="submit" />
        </div>
    </form>

    <?php
    while ($comment = $comments->fetch())
    {
    ?>
    <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le
        <?= $comment['comment_date_fr'] ?>
    </p>
    <p>
        <?= nl2br(htmlspecialchars($comment['comment'])) ?>
    </p>
    <a href="index.php?action=signalComment&amp;id=<?= $comment['id'] ?>&amp;postId=<?= $comment['post_id'] ?>">Signaler</a>
    <?php
    }
    ?>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
