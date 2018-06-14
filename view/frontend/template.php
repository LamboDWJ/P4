<!--  Template général d'affichage du site -->

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <link href="public/css/style.css" rel="stylesheet" /> 
    </head>
       
    <body>
        <?php include('header.php'); ?>

        <?= $content ?>
        
        <?php include('footer.php'); ?>
    </body>
</html>