<?php
    $pdo=new Mypdo();
    $personneManager = new PersonneManager($pdo);
    $listePersonnes=$personneManager->getAllPersonne();

    $salarieManager = new SalarieManager($pdo);
    $etudiantManager = new EtudiantManager($pdo);
?>

<h2>Supprimer une personne</h2>

<?php if (empty($_POST["per_num"])) { ?>

<form action="index.php?page=4" id="drop" method="post">
    <label for="per_num">Choisir une personne</label>
    <select name="per_num" id="per_num">
        <?php foreach ($listePersonnes as $personne){ ?>
        <option value="<?php echo $personne->getPerNum(); ?>">
				<?php echo $personne->getPerPrenom().' '.$personne->getPerNom(); ?></option>
        <?php } ?>
    </select>

    <input type="submit" value="Valider">
</form>

<?php } 
    if (!empty($_POST["per_num"])) {
        
        $etudiant = new Etudiant($_POST);
        $retour=$etudiantManager->delete($etudiant);
        
        if ($retour != 0) { ?>
            <p>L'étudiant a été supprimée</p>
        <?php } else { ?>
            <p>L'étudiant n'a pas été supprimée</p>
        <?php }
        
        $salarie = new Salarie($_POST);
        $retour=$salarieManager->delete($salarie);
    
        if ($retour != 0) { ?>
            <p>Le salarié a été supprimée</p>
        <?php } else { ?>
            <p>Le salarié n'a pas été supprimée</p>
        <?php }
            
        $personne = new Personne($_POST);
        $retour=$personneManager->delete($personne);
    
        if ($retour != 0) { ?>
            <p>La personne a été supprimée</p>
        <?php } else { ?>
            <p>La personne n'a pas été supprimée</p>
        <?php }
         
            
        
    } ?>
