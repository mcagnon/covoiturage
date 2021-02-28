<?php
	$pdo=new Mypdo();
	
	$personneManager = new PersonneManager($pdo);
?>


<h2>Ajouter une personne</h2>
	
<?php if (empty($_POST["per_nom"]) && empty($_POST["per_prenom"]) && empty($_POST["per_tel"]) 
			&& empty($_POST["per_mail"]) && empty($_POST["per_login"]) && empty($_POST["per_pwd"])
			&& empty($_POST["div_num"]) && empty($_POST["dep_num"]) && empty($_POST["sal_telprof"]) && empty($_POST["fon_num"])){ ?>

	<form action="index.php?page=1" id="insertPersonne" method="post">
		<label for="per_nom">Nom : </label>
		<input type="text" name="per_nom" id="per_nom">

		<label for="per_prenom">Prénom : </label>
		<input type="text" name="per_prenom"  id="per_prenom">

		<label for="per_tel">Téléphone : </label>
		<input type="tel" name="per_tel" id="per_tel">

		<label for="per_mail">Mail : </label>
		<input type="email" name="per_mail" id="per_mail">

		<label for="per_login">Login : </label>
		<input type="login" name="per_login" id="per_login">

		<label for="per_pwd">Mot de passe : </label>
		<input type="password" name="per_pwd" id="per_pwd">

		<label for="per_categorie">Catégorie : </label>
		<div>
				<input type="radio" name="per_categorie" id="per_etudiant" value="per_etudiant" /> 
				<label for="per_etudiant">Étudiant</label>
			</div>
			<div>
				<input type="radio" name="per_categorie" id="per_salarie" value="per_salarie" />
				<label for="per_salarie">Salarié</label>
			</div>

		<input type="submit" value="Valider">
	</form>

<?php }
if (!empty($_POST["per_categorie"]) && $_POST["per_categorie"]=="per_etudiant"){ ?>

	<?php
		$divisionManager = new DivisionManager($pdo);
		$listeDivisions=$divisionManager->getAllDivision();
		
		$departementManager = new DepartementManager($pdo);
		$listeDepartements=$departementManager->getAllDepartement();

		$password=$_POST["per_pwd"];
		$password_crypte= sha1(sha1($password).$salt);
		$_POST["per_pwd"]=$password_crypte;

    	$personne = new Personne($_POST);
		$retour=$personneManager->add($personne);

    	if ($retour == 0) { ?>
        	<p>La personne <?php echo $_POST["per_prenom"].' '.$_POST["per_nom"]; ?> n'a pas été ajouté</p>
    	<?php } else { ?>
        	<p>La personne <?php echo $_POST["per_prenom"].' '.$_POST["per_nom"]; ?> a été ajouté</p>
		
		<?php $_SESSION["per_nom"]=$_POST["per_nom"];
		$_SESSION["per_prenom"]=$_POST["per_prenom"]; ?>

	<h2>Ajouter un étudiant </h2>
	<form action="index.php?page=1" id="insertEtudiant" method="post">
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

		<input type="submit" value="Valider">
	</form>
<?php }
} 

if(!empty($_POST["div_num"]) && !empty($_POST["dep_num"])) {
		$numero_personne = $personneManager->getNumOnePersonne($_SESSION["per_nom"], $_SESSION["per_prenom"]);
		$_POST["per_num"]=$numero_personne->getPerNum();

		$etudiantManager = new EtudiantManager($pdo);
		$etudiant = new Etudiant($_POST);
		$retour=$etudiantManager->add($etudiant);

	if ($retour != 0) { ?>
		<p>L'étudiant a été ajouté</p>
	<?php } else { ?>
		<p>L'étudiant n'a pas été ajouté</p>
	<?php } 
}

if (!empty($_POST["per_categorie"]) && $_POST["per_categorie"] == "per_salarie"){ ?>

		<?php
			$fonctionManager = new FonctionManager($pdo);
			$listeFonctions=$fonctionManager->getAllFonction();

			$password=$_POST["per_pwd"];
			$password_crypte= sha1(sha1($password).$salt);
			$_POST["per_pwd"]=$password_crypte;

    		$personne = new Personne($_POST);
			$retour=$personneManager->add($personne);

			if ($retour == 0) { ?>
				<p>La personne <?php echo $_POST["per_prenom"].' '.$_POST["per_nom"]; ?> n'a pas été ajouté</p>
			<?php } else { ?>
				<p>La personne <?php echo $_POST["per_prenom"].' '.$_POST["per_nom"]; ?> a été ajouté</p>
			
			<?php $_SESSION["per_nom"]=$_POST["per_nom"];
			$_SESSION["per_prenom"]=$_POST["per_prenom"]; ?>

		<h2>Ajouter un salarié</h2>
		<form action="index.php?page=1" id="insertSalarie" method="post">
			<label for="sal_telprof">Téléphone professionnnel : </label>
			<input type="tel" name="sal_telprof" id="sal_telprof">

			<label for="fon_num">Fonction : </label>
				<select name="fon_num" id="fon_num">
				<?php foreach ($listeFonctions as $fonction){ ?>
					<option value="<?php echo $fonction->getFonNum(); ?>">
						<?php echo $fonction->getFonLibelle(); ?></option>
				<?php } ?>
			</select>

			<input type="submit" value="Valider">
		</form>
<?php }
} 

if (!empty($_POST["sal_telprof"]) && !empty($_POST["fon_num"])) { 

	$numero_personne2 = $personneManager->getNumOnePersonne($_SESSION["per_nom"], $_SESSION["per_prenom"]);
	$_POST["per_num"]=$numero_personne2->getPerNum();

	$salarieManager = new SalarieManager($pdo);
	$salarie = new Salarie($_POST);
	$retour=$salarieManager->add($salarie);

	if ($retour != 0) { ?>
		<p>Le salarié a été ajouté</p>
	<?php } else { ?>
		<p>Le salarié n'a pas été ajouté</p>
	<?php }
} ?>