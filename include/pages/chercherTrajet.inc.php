<?php
    if (isset($_SESSION['id']) && isset($_SESSION['pseudo'])) {
        
    $pdo=new Mypdo();
    
    $proposeManager = new ProposeManager($pdo);
    $listeProposeVilles=$proposeManager->getProposeVilleDepart();
?>

<h2>Rechercher un trajet</h2>

<?php if (empty ($_POST["vil_num1"]) && empty($_POST["vil_num2"])) { ?>

    <form action="index.php?page=10" id="insert" method="post">

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
    
    <form action="index.php?page=10" id="insert" method="post">
        <?php
            $villeManager = new VilleManager($pdo);
            $listeNomUneVille=$villeManager->getNameOneVille($_POST["vil_num1"]);
            $listeVillesArrivee=$proposeManager->getProposeVilleArrivee($_POST["vil_num1"]);
            
            $_SESSION["vil_num1"]=$_POST["vil_num1"];
            $_SESSION["vil_nom1"]=$listeNomUneVille->getVilNom();
        ?>
        <label for="vil_num1">Ville de départ : <?php echo $_SESSION["vil_nom1"]; ?></label>

        
        <label for="vil_num2">Ville d'arrivée :</label>
        <select name="vil_num2" id="vil_num2">
            <?php foreach ($listeVillesArrivee as $villeArrivee){ ?>
                <option value="<?php echo $villeArrivee->getVilNum2(); ?>">
                    <?php echo $villeArrivee->getVilNom2(); ?></option>
            <?php } ?>
        </select>

        <label for="pro_date">Date de départ <span class="infobulle" aria-label="Format : aaaa-mm-jj"><img src="image/info.png" alt="Informations"/></span> :</label>
        <input type="date" name="pro_date" id="pro_date">


        <label for="precision">Précision :</label>
        <select name="precision" id="precision">
            <option value="0">Ce jour</option>
            <option value="1">+/- 1 jour</option>
            <option value="2">+/- 2 jours</option>
            <option value="3">+/- 3 jours</option>
        </select>

        <label for="pro_time">À partir de :</label>
        <select name="pro_time" id="pro_time">
            <option value="00:00:00">0h</option>
            <option value="01:00:00">1h</option>
            <option value="02:00:00">2h</option>
            <option value="03:00:00">3h</option>
            <option value="04:00:00">4h</option>
            <option value="05:00:00">5h</option>
            <option value="06:00:00">6h</option>
            <option value="07:00:00">7h</option>
            <option value="08:00:00">8h</option>
            <option value="09:00:00">9h</option>
            <option value="10:00:00">10h</option>
            <option value="11:00:00">11h</option>
            <option value="12:00:00">12h</option>
            <option value="13:00:00">13h</option>
            <option value="14:00:00">14h</option>
            <option value="15:00:00">15h</option>
            <option value="16:00:00">16h</option>
            <option value="17:00:00">17h</option>
            <option value="18:00:00">18h</option>
            <option value="19:00:00">19h</option>
            <option value="20:00:00">20h</option>
            <option value="21:00:00">20h</option>
            <option value="22:00:00">20h</option>
            <option value="23:00:00">20h</option>
        </select>

        <input type="submit" value="Valider">
    </form>

<?php }
if (empty($_POST["vil_num1"]) && !empty($_POST["vil_num2"])) { ?>

<?php
    $date_fin=date('Y-m-d', strtotime($_POST["pro_date"]. ' + '.$_POST["precision"].' days'));
    $listeProposeinfoTrajet=$proposeManager->getProposeInfoTrajet($_SESSION["vil_num1"], $_POST["vil_num2"], $_POST["pro_date"], $_POST["pro_time"], $date_fin);

    $personneManager = new PersonneManager($pdo);
    
    if (count($listeProposeinfoTrajet) == 0) {
?>
        <p>Désolé, pas de trajet disponible !</p>
        <img src="image/bonhomme_pleure.png" alt="bonhomme_qui_pleure" id="bonhomme_pleure">
    <?php } else { ?>
        <table>
            <tr>
                <th>Ville départ</th>
                <th>Ville arrivée</th>
                <th>Date départ</th>
                <th>Heure départ</th>
                <th>Nombre de place(s)</th>
                <th>Nom du covoitureur</th>
            </tr>
            <?php foreach ($listeProposeinfoTrajet as $trajet){ ?>
                <tr>
                    <td><?php echo $trajet->getVilNom1(); ?></td>
                    <td><?php echo $trajet->getVilNom2(); ?></td>
                    <td><?php echo $trajet->getProDate(); ?></td>
                    <td><?php echo $trajet->getProTime(); ?></td>
                    <td><?php echo $trajet->getProPlace(); ?></td>
                    <td><span class="infobulle2" aria-label="Moyenne des avis : 
                            <?php $avis_moyenne=$personneManager->getMoyAvisPersonne($trajet->getPerNum());
                                echo $avis_moyenne->getAviNote(); ?> / Dernier avis : 
                            <?php $avis_comm=$personneManager->getLastAvisPersonne($trajet->getPerNum());
                                echo $avis_comm->getAviComm(); ?>
                            "><?php echo $trajet->getPerNom().' '.$trajet->getPerPrenom(); ?></span></td>
                </tr>
            <?php } ?>
        </table>
    <?php } ?> 
<?php }
} ?>