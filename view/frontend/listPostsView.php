<?php $title = 'Sommaire'; ?>

<?php ob_start(); ?>

<!--  Menu de navigation -->


<id class="navigation">
    <p><a href="index.php">Retour à l'accueil</a></p>
</id>


<!--  Récupération des chapitres et affichage sous forme de sommaire -->

<?php
while ($data = $chaps->fetch())
{
?>
    <div class="chaplist">
        <a href="index.php?action=oneChap&amp;id=<?= $data['id'] ?>">
            <?= htmlspecialchars($data['title']) ?>
            <em>le <?= $data['creation_date_fr'] ?></em>
        </a>
    </div>
<?php
}
$chaps->closeCursor();
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>