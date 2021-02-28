<?php
    $pdo=new Mypdo();
    $villeManager = new VilleManager($pdo);
    $villes=$villeManager->getAllVille();
?>

<h2>Liste des villes</h2>

<?php if (count($villes) == 0) { ?>
    <p>Aucune ville est enregistrée</p>
<?php } else if (count($villes) == 1) { ?>
    <p>Actuellement 1 ville est enregistrée</p>
<?php } else { ?>
    <p>Actuellement <?php echo count($villes) ?> villes sont enregistrées</p>
<?php }?>

<table>
    <tr>
        <th>Numéro</th>
        <th>Nom</th>
    </tr>
    <?php foreach ($villes as $ville){ ?>
        <tr>
            <td><?php echo $ville->getVilNum();?></td>
            <td><?php echo $ville->getVilNom();?></td>
        </tr>
    <?php } ?>
</table>