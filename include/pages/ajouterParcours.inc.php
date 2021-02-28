<?php
    $pdo=new Mypdo();
    
    $villeManager = new VilleManager($pdo);
    $listeVilles=$villeManager->getAllVille();
?>

<h2>Ajouter un parcours</h2>

<?php if (empty($_POST["par_km"])){ ?>
	
<form action="index.php?page=5" id="insert" method="post">
    <label for="vil_num1">Ville 1 : </label>
    <select name="vil_num1" id="vil_num1">
        <?php foreach ($listeVilles as $ville){ ?>
		    <option value="<?php echo $ville->getVilNum(); ?>">
				<?php echo $ville->getVilNom(); ?></option>
		<?php } ?>
    </select>

    <label for="vil_num2">Ville 2 : </label>    
    <select name="vil_num2" id="vil_num2">
        <?php foreach ($listeVilles as $ville){ ?>
		    <option value="<?php echo $ville->getVilNum(); ?>">
				<?php echo $ville->getVilNom(); ?></option>
		<?php } ?>
    </select>
    
    <label for="par_km">Nombre de kilomètre(s) : </label>
    <input type="text" name="par_km" id="par_km">
    
    <input type="submit" value="Valider">
</form>

<?php 
} else
{
    if($_POST["vil_num1"] == $_POST["vil_num2"]) { ?>
        <p>Pas possible ! Un parcours ne peut pas avoir la même ville de départ et d'arrivée</p>
    <?php } else { 
        $parcoursManager = new ParcoursManager($pdo);
        $parcours = new Parcours($_POST);
        $retour=$parcoursManager->add($parcours);

        if ($retour !=0) { ?>
            <p>Le parcours a été ajoutée</p>
        <?php } else { ?>
            <p>Le parcours n'a pas été ajouté</p>
<?php
        }
    }
} ?>