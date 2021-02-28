
<ul>
	<li><a href="index.php?page=0"><img src="image/logo.png" alt="Logo covoiturage IUT" title="Logo covoiturage IUT Limousin" /></a></li>
	<li><a href="index.php?page=0"><img src="image/accueil.gif" class="imagMenu" alt="Accueil"/>Accueil</a></li>
	<li>
		<img src="image/personne.png" class="imagMenu" alt="Personne"/>
		<a href="index.php?page=0">Personne</a>
		<ul>			
			<li><a href="index.php?page=1">Ajouter</a></li>
			<li><a href="index.php?page=2">Lister</a></li>
			<li><a href="index.php?page=3">Modifier</a></li>
			<li><a href="index.php?page=4">Supprimer</a></li>
		</ul>
	</li>
	<li>
		<img src="image/parcours.gif" class="imagMenu" alt="Parcours"/>
		<a href="index.php?page=0">Parcours</a>
		<ul>
			<li><a href="index.php?page=5">Ajouter</a></li>
			<li><a href="index.php?page=6">Lister</a></li>
		</ul>
	</li>
	<li>
		<img src="image/ville.png" class="imagMenu" alt="Ville"/>
		<a href="index.php?page=0">Ville</a>
		<ul>
			<li><a href="index.php?page=7">Ajouter</a></li>
			<li><a href="index.php?page=8">Lister</a></li>
		</ul>
	</li>
	<?php if (isset($_SESSION['id']) && isset($_SESSION['pseudo'])) { ?>
	<li>
		<img src="image/trajet.png" class="imagMenu" alt="Trajet"/>
		<a href="index.php?page=0">Trajet</a>
		<ul>
			<li><a href="index.php?page=9">Proposer</a></li>
			<li><a href="index.php?page=10">Rechercher</a></li>
		</ul>
	</li>
	<?php echo 'Bonjour '.$_SESSION['pseudo'].' !'; ?>
		<li><a href="index.php?page=12">Déconnexion</a></li>
	<?php } else { ?>
		<li><a href="index.php?page=11">Connexion</a></li>
	<?php } ?>
</ul>
