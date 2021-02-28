<?php 
class DivisionManager{
	private $db;

	public function __construct($db){
		$this->db = $db;
	}
	public function add($division){
		$requete = $this->db->prepare(
					'INSERT INTO division (div_nom) VALUES (:div_nom);');

		$requete->bindValue(':div_nom',$division->getDivNom());

		$retour=$requete->execute();
		return $retour;
	}

	public function getAllDivision(){
		$listeDivisions = array();

		$sql = 'SELECT div_num, div_nom FROM division ORDER BY 2';

		$requete = $this->db->prepare($sql);
		$requete->execute();

		while ($division = $requete->fetch(PDO::FETCH_OBJ)) {
			$listeDivisions[] = new Division($division);
		}

		$requete->closeCursor();
		return $listeDivisions;
	}
}
?>