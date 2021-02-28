<?php
    if (isset($_SESSION['id']) && isset($_SESSION['pseudo'])) {
    
    $pdo=new Mypdo();
    
    $proposeManager = new ProposeManager($pdo);
    $listeProposeVilles=$proposeManager->getProposeVilleDepart();
    date_default_timezone_set('Europe/Paris');
?>


<h2>Proposer un trajet</h2>

<?php if (empty ($_POST["vil_num1"]) && empty($_POST["vil_num2"])) { ?>

<form action="index.php?page=9" id="insert" method="post">

    <label for="vil_num1">Ville de départ : </label>
    <select name="vil_num1" id="vil_num1">
        <?php foreach ($listeProposeVilles as $villeDepart){ ?>
			<option value="<?php echo $villeDepart->getVilNum1(); ?>">
				<?php echo $villeDepart->getVilNom1(); ?></option>
        <?php } ?>
    </select>

    <input type="submit" value="Valider">
</form>


<?php }
if (!empty($_POST["vil_num1"]) && empty($_POST["vil_num2"])) { ?>

<form action="index.php?page=9" id="insert" method="post">
    <?php
        $villeManager = new VilleManager($pdo);
        $listeNomUneVille=$villeManager->getNameOneVille($_POST["vil_num1"]);
        $listeVillesArrivee=$proposeManager->getProposeVilleArrivee($_POST["vil_num1"]);
        
        $_SESSION["vil_num1"]=$_POST["vil_num1"];
        $_SESSION["vil_nom1"]=$listeNomUneVille->getVilNom();
    ?>

    <label for="vil_num1">Ville de départ : <?php echo $_SESSION["vil_nom1"] ?></label>

    <label for="vil_num2">Ville d'arrivée :</label>
    <select name="vil_num2" id="vil_num2">
        <?php foreach ($listeVillesArrivee as $villeArrivee){ ?>
			<option value="<?php echo $villeArrivee->getVilNum2(); ?>">
				<?php echo $villeArrivee->getVilNom2(); ?></option>
        <?php } ?>
    </select>

    <label for="pro_date">Date de départ <span class="infobulle" aria-label="Format : aaaa-mm-jj"><img src="image/info.png" alt="Informations"/></span> :</label>
    <input type="date" value="<?php echo date('Y-m-d'); ?>" name="pro_date" id="pro_date">

    <label for="pro_time">Heure de départ <span class="infobulle" aria-label="Format : hh:mm:ss"><img src="image/info.png" alt="Informations"/></span> :</label>
    <input type="datetime" value="<?php echo date('H:i:s'); ?>" name="pro_time" id="pro_time">

    <label for="pro_place">Nombre de places</label>
    <input type="number" name="pro_place" id="pro_place">

    <input type="submit" value="Valider">
</form>

<?php 
} 
if (empty($_POST["vil_num1"]) && !empty($_POST["vil_num2"])) {

    $parcours=$proposeManager->getNumOneParcours($_SESSION["vil_num1"], $_POST["vil_num2"]);

    $_POST["par_num"]=$parcours->getParNum();
    $_POST["per_num"]=$_SESSION["id"];
    $_POST["pro_sens"]=0;

    $propose = new Propose($_POST);

    $retour=$proposeManager->add($propose);

    if ($retour !=0) { ?>
        <p>Le trajet a été ajoutée</p>
    <?php } else { ?>
        <p>Le trajet n'a pas été ajouté</p>
<?php
    }
} 
} ?>