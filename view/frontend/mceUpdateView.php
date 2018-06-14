<?php $title = 'Rédaction'; ?>


<?php ob_start(); ?>

<!--  Si pas de session admin, direction page d'accueil -->
 
 <?php
    if (!isset($_SESSION['user'])) 
    {
        header('Location: index.php');
    }
?>

<!--  Scripts MCE -->

<script type="text/javascript" src="public/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
        !--
        tinyMCE.init({
            mode: "textareas",
            valid_elements: "em/i,strike,u,strong/b,div[align],br,#p[align],-ol[type|compact],-ul[type|compact],-li",
            height: 500
        });
</script>

<!--  Editeur de texte -->

<form id="form1" method="post" action="index.php?action=updateChap&amp;id=<?= $chap['id'] ?>">
    Ins&eacute;rez votre commentaire<br />
    <div class="titlemce">Titre du chapitre</div>
    <input type="text" id="titre" name="titre" value="<?php echo htmlspecialchars($chap['title']); ?>"/>
    <textarea name="chapitre" id="chapitre" cols="45" rows="5">
        <?php
        if (isset($chap)) { 
        echo nl2br(htmlspecialchars($chap['content']));
        } ?>
    </textarea> 
    <br />
    <input name="Submit" type="submit" Value="Envoyer" />
</form>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>



