<?php
    $pdo=new Mypdo();
    $personneManager = new PersonneManager($pdo);
    $listePersonnes=$personneManager->getAllPersonne();
?>

<h2>Liste des personnes enregistrées</h2>

<?php if (count($listePersonnes) == 0) { ?>
    <p>Aucune personne n'est enregistrée</p>
<?php } else if (count($listePersonnes) == 1) { ?>
    <p>Actuellement 1 personne est enregistrée</p>
<?php } else { ?>
    <p>Actuellement <?php echo count($listePersonnes) ?> personnes sont enregistrées</p>
<?php }?>

<table>
    <tr>
        <th>Numéro</th>
        <th>Nom</th>
        <th>Prénom</th>
    </tr>
    <?php foreach ($listePersonnes as $personne){ ?>
        <tr>
            <td><a href="index.php?page=2&numero=<?php echo $personne->getPerNum();?>"><?php echo $personne->getPerNum();?></a></td>
            <td><?php echo $personne->getPerNom();?></td>
            <td><?php echo $personne->getPerPrenom();?></td>
        </tr>
    <?php } ?>
</table>


<?php $etudiantManager = new EtudiantManager($pdo);
$numero=$_GET["numero"];
$listeEtudiant=$etudiantManager->getOneEtudiant($numero); 
if (count($listeEtudiant) != 0) { ?>
    <h2>Détail sur l'étudiant </h2>

    <table>
        <tr>
            <th>Prénom</th>
            <th>Mail</th>
            <th>Téléphone</th>
            <th>Département</th>
            <th>Ville</th>
        </tr>
        <?php foreach ($listeEtudiant as $etudiant){ ?>
            <tr>
                <td><?php echo $etudiant->getPerPrenom();?></td>
                <td><?php echo $etudiant->getPerMail();?></td>
                <td><?php echo $etudiant->getPerTel();?></td>
                <td><?php echo $etudiant->getDepNom();?></td>
                <td><?php echo $etudiant->getVilNom();?></td>
            </tr>
        <?php } ?>
    </table>

<?php }
$salarieManager = new SalarieManager($pdo);
$numero=$_GET["numero"];
$listeSalarie=$salarieManager->getOneSalarie($numero); 
if (count($listeSalarie) != 0) { ?>

    <h2>Détail sur le salarié </h2>

    <table>
        <tr>
            <th>Prénom</th>
            <th>Mail</th>
            <th>Téléphone</th>
            <th>Téléphone pro</th>
            <th>Fonction</th>
        </tr>
        <?php foreach ($listeSalarie as $salarie){ ?>
            <tr>
                <td><?php echo $salarie->getPerPrenom();?></td>
                <td><?php echo $salarie->getPerMail();?></td>
                <td><?php echo $salarie->getPerTel();?></td>
                <td><?php echo $salarie->getSalTelProf();?></td>
                <td><?php echo $salarie->getFonLib();?></td>
            </tr>
        <?php } ?>
    </table>

<?php } ?>