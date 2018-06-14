<?php $title = 'Connexion'; ?>

<?php ob_start(); ?>

        
            <?php
    if (isset($_SESSION['user'])) // Si le mot de passe est bon
    {
        header('Location: index.php?action=admin');
    }
    // On affiche les codes
    ?>
        <p>Veuillez entrer le mot de passe :</p>
      <div class="navbox">
          <div id="loginform">
        <form action="index.php?action=tryLogin" method="post">
            <p>
            <input type="text" name="username" />
            <input type="password" name="password" />
            <input type="submit" value="Valider" />
            </p>
        </form>
        <p>Cette page est réservée à l'auteur Jean Forteroche.</p>
              </div>
          </div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>


