<?php
class FonctionManager{
	private $db;

	public function __construct($db){
		$this->db = $db;
	}
	public function add($fonction){
		$requete = $this->db->prepare(
					'INSERT INTO fonction (fon_libelle) VALUES (:fon_libelle);');

		$requete->bindValue(':fon_libelle',$fonction->getFonLibelle());

		$retour=$requete->execute();
		return $retour;
	}

	public function getAllFonction(){
		$listeFonctions = array();

		$sql = 'SELECT fon_num, fon_libelle FROM fonction ORDER BY 2';

		$requete = $this->db->prepare($sql);
		$requete->execute();

		while ($fonction = $requete->fetch(PDO::FETCH_OBJ)) {
			$listeFonctions[] = new Fonction($fonction);
		}

		$requete->closeCursor();
		return $listeFonctions;
	}
}
?>