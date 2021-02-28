<h2>Ajouter une ville</h2>
	
<?php if (empty($_POST["vil_nom"])){ ?>

<form action="index.php?page=7" id="insert" method="post">
	<label for="vil_nom">Nom : </label>
    <input type="text" name="vil_nom" id="vil_nom">
    <input type="submit" value="Valider">
</form>

<?php 
} else
{
    $pdo=new Mypdo();
    $villeManager = new VilleManager($pdo);
    $ville = new Ville($_POST);
    $retour=$villeManager->add($ville);

    if ($retour !=0) { ?>
        <p>La ville "<?php echo $_POST[vil_nom] ?>" a été ajoutée</p>
    <?php } else { ?>
        <p>La ville "<?php echo $_POST[vil_nom] ?>" n'a pas été ajoutée</p>
<?php
    }
} ?>