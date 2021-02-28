<?php 

// Suppression des variables de session et de la session
$_SESSION["id"] = null;
$_SESSION["pseudo"] = null;

header('Location: index.php?page=0');
exit();
?>
