<?php
class VilleManager{
	private $db;

	public function __construct($db){
		$this->db = $db;
	}
	public function add($ville){
		$requete = $this->db->prepare(
					'INSERT INTO ville (vil_nom) VALUES (:vil_nom);');

		$requete->bindValue(':vil_nom',$ville->getVilNom());

		$retour=$requete->execute();
		return $retour;
	}

	public function getAllVille(){
		$listeVilles = array();

		$sql = 'SELECT vil_num, vil_nom FROM ville ORDER BY 2';

		$requete = $this->db->prepare($sql);
		$requete->execute();

		while ($ville = $requete->fetch(PDO::FETCH_OBJ)) {
			$listeVilles[] = new Ville($ville);
		}

		$requete->closeCursor();
		return $listeVilles;
	}

	public function getNameOneVille($numero_ville){
		$sql = "SELECT vil_nom FROM ville WHERE vil_num=$numero_ville";

		$requete = $this->db->prepare($sql);
		$requete->execute();

		$ville = new Ville($requete->fetch(PDO::FETCH_OBJ));
		
		$requete->closeCursor();
		return $ville;
	}
}
?>