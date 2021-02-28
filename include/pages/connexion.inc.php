<?php
    $pdo=new Mypdo();
    
    $personneManager = new PersonneManager($pdo);
    
?>

<h2>Se connecter</h2>

<?php if (empty($_POST["per_login"]) && empty($_POST["per_pwd"])){ ?>

    <form action="index.php?page=11" id="insert" method="post">
        <label for="per_login">Nom d'utiliateur : </label>
        <input type="text" name="per_login" id="per_login">

        <label for="per_pwd">Mot de passe : </label>
        <input type="password" name="per_pwd" id="per_pwd">

        <?php $nb_images=9;

            $nom_images[1]="1.jpg";
            $nom_images[2]="2.jpg";
            $nom_images[3]="3.jpg";
            $nom_images[4]="4.jpg";
            $nom_images[5]="5.jpg";
            $nom_images[6]="6.jpg";
            $nom_images[7]="7.jpg";
            $nom_images[8]="8.jpg";
            $nom_images[9]="9.jpg";

            srand((double)microtime()*1000000);
            $aff_image1=rand(1,$nb_images);
            $_SESSION["aff_image1"] = $aff_image1;
            $aff_image2=rand(1,$nb_images); 
            $_SESSION["aff_image2"] = $aff_image2; ?>
        
        <p><img src="image/nb/<?php echo $nom_images[$aff_image1];?>" border=0 width=50 height=50 alt="Image aléatoire" /> + <img src="image/nb/<?php echo $nom_images[$aff_image2];?>" border=0 width=50 height=50 alt="Image aléatoire" /></p>
        
        <input type="text" name="resultat_image" id="resultat_image">

        <input type="submit" value="Valider">
    </form>

<?php }
if (!empty($_POST["per_login"]) && !empty($_POST["per_pwd"]) && !empty($_POST["resultat_image"])){ 

    $loginPasswordPersonne=$personneManager->getLoginAndPasswordPersonne($_POST["per_login"]);
    $passwordBD = $loginPasswordPersonne->getPerPwd();

    $passwordRentre = sha1(sha1($_POST["per_pwd"]).$salt);

    if ($passwordRentre == $passwordBD) {

        if ($_POST["resultat_image"] != $_SESSION["aff_image1"]+$_SESSION["aff_image2"]) { ?>
           <p>La connexion n'a pas marché ! Vous êtes sûr de votre calcul ?</p>
        <?php } else {
            
            $_SESSION['id'] = $loginPasswordPersonne->getPerNum();
            $_SESSION['pseudo'] = $_POST["per_login"];
            
            
            header('Location: index.php?page=0');
            exit();

        }
    } else { ?>
        <p>Mot de passe incorrect !</p>
    <?php }
} ?>