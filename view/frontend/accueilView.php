<?php $title = 'Accueil'; ?>

<?php ob_start(); ?>

<!-- Icone livre et menu de navigation -->

<div class="navbox">
    <img id="book" src="public/img/book.jpg">
    <div class="navigation">
        <a href="index.php?action=firstChap">Premier chapitre</a>
        <a href="index.php?action=lastChap">Dernier chapitre</a>
        <a href="index.php?action=allChaps">Sommaire</a>
        <a href="">Site officiel</a>
    </div>
</div>

<!-- Chapitre -->

<div class="paper">
    <div class="chapter">
        <h2>Billet simple pour l'Alaska</h2>
        <!-- Icone montagne -->
        <div class="mountainbox">
            <img class="mountain" src="public/img/mountain.png">
        </div>
        <!-- Contenu du chapitre -->
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam in lacus libero. Suspendisse potenti. Nulla ut laoreet enim, eu consectetur tellus. In eleifend lorem ut porttitor facilisis. Duis consectetur neque a aliquam placerat. Ut pharetra ligula ac arcu placerat, non mattis est tincidunt. Ut risus nisi, tempus sit amet egestas eu, placerat sit amet libero. Quisque ligula orci, semper et semper sed, finibus a velit. Vestibulum felis eros, rutrum non hendrerit eget, tristique nec velit. Maecenas mollis lorem quis tortor iaculis, volutpat vestibulum ipsum mattis. Proin pharetra eget ex et porttitor. Proin ipsum velit, ultricies et maximus nec, suscipit quis risus. Nunc elementum nisi quis facilisis commodo. Nam velit magna, ultricies ut ipsum vitae, iaculis porttitor leo. Nam maximus mattis metus, quis efficitur diam tristique et. Donec orci orci, condimentum ac ex vitae, viverra suscipit eros. Phasellus sagittis mollis sapien, nec feugiat turpis finibus eget. Morbi a egestas velit, nec interdum nunc. Donec vel ullamcorper nulla. In ac feugiat diam. Cras ultrices lacus ut blandit convallis.</p>
        <!-- Icone montagne -->
        <div class="mountainbox"> 
            <img class="mountain" src="public/img/mountain.png">
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
