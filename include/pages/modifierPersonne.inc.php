<?php
    $pdo=new Mypdo();
    $personneManager = new PersonneManager($pdo);
    $salarieManager = new SalarieManager($pdo);
    $etudiantManager = new EtudiantManager($pdo);

    $listePersonnes=$personneManager->getAllPersonne();
?>

<h2>Modifier une personne</h2>

<?php if (empty($_POST["per_num"]) && empty($_POST["per_nom"])) {
?>

<form action="index.php?page=3" id="choisirPersonne" method="post">
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
 if (!empty($_POST["per_num"]) && empty($_POST["per_nom"])) {

    $_SESSION["per_num"]=$_POST["per_num"];
    $personne=$personneManager->getInfoOnePersonne($_POST["per_num"]);
?>

    <form action="index.php?page=3" id="modifierPersonne" method="post">
		<label for="per_nom">Nom : </label>
		<input type="text" name="per_nom" id="per_nom" value="<?php echo $personne->getPerNom(); ?>">

		<label for="per_prenom">Prénom : </label>
		<input type="text" name="per_prenom"  id="per_prenom" value="<?php echo $personne->getPerPrenom(); ?>">

		<label for="per_tel">Téléphone : </label>
		<input type="tel" name="per_tel" id="per_tel" value="<?php echo $personne->getPerTel(); ?>">

		<label for="per_mail">Mail : </label>
		<input type="email" name="per_mail" id="per_mail" value="<?php echo $personne->getPerMail(); ?>">


        <?php 
        $listeEtudiant=$etudiantManager->getOneEtudiant($_POST["per_num"]); 
        
        if (count($listeEtudiant) != 0) { 
            
            $divisionManager = new DivisionManager($pdo);
		    $listeDivisions=$divisionManager->getAllDivision();
		
		    $departementManager = new DepartementManager($pdo);
		    $listeDepartements=$departementManager->getAllDepartement();?> 

            <label for="div_num">Année : </label>
            <select name="div_num" id="div_num">
                <?php foreach ($listeDivisions as $division){ ?>
                    <option value="<?php echo $division->getDivNum(); ?>">
                        <?php echo $division->getDivNom(); ?></option>
                <?php } ?>
            </select>

            <label for="dep_num">Département : </label>
            <select name="dep_num" id="dep_num">
                <?php foreach ($listeDepartements as $departement){ ?>
                    <option value="<?php echo $departement->getDepNum(); ?>">
                        <?php echo $departement->getDepNom(); ?></option>
                <?php } ?>
            </select>
        <?php }
        $listeSalarie=$salarieManager->getOneSalarie($_POST["per_num"]); 
        
        if (count($listeSalarie) != 0) { 
            $salarie=$salarieManager->getInfoOneSalarie($_POST["per_num"]); 

            $fonctionManager = new FonctionManager($pdo);
            $listeFonctions=$fonctionManager->getAllFonction(); ?>

            <label for="sal_telprof">Téléphone professionnnel : </label>
			<input type="tel" name="sal_telprof" id="sal_telprof" value="<?php echo $salarie->getSalTelProf(); ?>" >

			<label for="fon_num">Fonction : </label>
				<select name="fon_num" id="fon_num">
				<?php foreach ($listeFonctions as $fonction){ ?>
					<option value="<?php echo $fonction->getFonNum(); ?>">
						<?php echo $fonction->getFonLibelle(); ?></option>
				<?php } ?>
			</select>
        <?php } ?>  

		<input type="submit" value="Valider">
    </form>

<?php }

if (empty($_POST["per_num"]) && !empty($_POST["per_nom"])) {

    $numero_personne2 = $personneManager->getNumOnePersonne($_SESSION["per_nom"], $_SESSION["per_prenom"]);
    
    $_POST["per_num"]=$_SESSION["per_num"];

	$personne = new Personne($_POST);
	$retour=$personneManager->update($personne);

	if ($retour != 0) { ?>
		<p>La personne a été modifiée</p>
	<?php } else { ?>
		<p>La personne n'a pas été modifiée</p>
    <?php }
    
    if(!empty($_POST["div_num"]) && !empty($_POST["dep_num"])) { 
        
        $etudiant = new Etudiant($_POST);
        $retour=$etudiantManager->update($etudiant);
        
        if ($retour != 0) { ?>
            <p>L'étudiant a été modifiée</p>
        <?php } else { ?>
            <p>L'étudiant n'a pas été modifiée</p>
        <?php }
    }


    if(!empty($_POST["sal_telprof"]) && !empty($_POST["fon_num"])) {

        $salarie = new Salarie($_POST);
        $retour=$salarieManager->update($salarie);

        if ($retour != 0) { ?>
            <p>Le salarié a été modifiée</p>
        <?php } else { ?>
            <p>Le salarié n'a pas été modifiée</p>
        <?php }
    }
} ?>