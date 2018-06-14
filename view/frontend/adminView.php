<?php $title = 'Administration'; ?>

<?php ob_start(); ?>

<!--  Si pas de session admin, direction page d'accueil -->

<?php
    if (!isset($_SESSION['user'])) // Si le mot de passe est bon
    {
        header('Location: index.php');
    }
    // On affiche les codes
    ?>

    <!--  Menu de l'espace admin -->

    <div class="navbox">
        <div class="navigation">
            <a href="index.php?action=mce">Ecrire</a>
            <a href="index.php?action=allChaps">Vos écrits</a>
            <a href="index.php?action=adminComments">Les commentaires</a>
            <a href="index.php">Accueil</a>
            <a href="index.php?action=deco">Déconnexion</a>
        </div>
    </div>

    <?php $content = ob_get_clean(); ?>

    <?php require('template.php'); ?>
