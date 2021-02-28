<?php
    $pdo=new Mypdo();
    $parcoursManager = new ParcoursManager($pdo);
    $listeParcours=$parcoursManager->getAllParcours();
?>

<h2>Liste des villes</h2>

<?php if (count($listeParcours) == 0) { ?>
    <p>Aucun parcours n'est enregistré</p>
<?php } else if (count($listeParcours) == 1) { ?>
    <p>Actuellement 1 parcours est enregistré</p>
<?php } else { ?>
    <p>Actuellement <?php echo count($listeParcours) ?> parcours sont enregistrés</p>
<?php }?>

<table>
    <tr>
        <th>Numéro</th>
        <th>Nom ville</th>
        <th>Nom ville</th>
        <th>Nombre de Km</th>
    </tr>
    <?php foreach ($listeParcours as $parcours){ ?>
        <tr>
            <td><?php echo $parcours->getParNum();?></td>
            <td><?php echo $parcours->getVilNom1();?></td>
            <td><?php echo $parcours->getVilNom2();?></td>
            <td><?php echo $parcours->getParKm();?></td>
        </tr>
    <?php } ?>
</table>