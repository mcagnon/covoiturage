<?php 
session_start();
require_once("include/config.inc.php");
require_once("include/autoLoad.inc.php");
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/style.css" />
    <link
      href="https://fonts.googleapis.com/css2?family=Nunito:wght@300&display=swap"
      rel="stylesheet"
    />
	<title>Bienvenue sur le site de covoiturage de l'IUT</title>
  </head>
    
  <body>
    <header>        
        <nav>
          <?php require_once("include/menu.inc.php"); ?>
        </nav>
    </header>
      
    <main>
      <h1>Covoiturage de l'IUT - Partagez plus que votre véhicule !!!</h1>
      <?php require_once("include/texte.inc.php"); ?>
    </main>

    <footer>
        <?php require_once("include/footer.inc.php"); ?>
    </footer>
  </body>
</html>
