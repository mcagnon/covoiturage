<?php
class ParcoursManager{
	private $db;

	public function __construct($db){
		$this->db = $db;
	}
	public function add($parcours){
		$requete = $this->db->prepare(
					'INSERT INTO parcours (par_km, vil_num1, vil_num2) VALUES (:par_km, :vil_num1, :vil_num2);');

		$requete->bindValue(':par_km',$parcours->getParKm());
		$requete->bindValue(':vil_num1',$parcours->getVilNum1());
		$requete->bindValue(':vil_num2',$parcours->getVilNum2());

		$retour=$requete->execute();
		return $retour;
	}

	public function getAllParcours(){
		$listeParcours = array();

		$sql = 'SELECT par_num, vil_num1, v1.vil_nom AS vil_nom1, vil_num2, v2.vil_nom AS vil_nom2, par_km FROM parcours p 
					JOIN ville v1 ON p.vil_num1=v1.vil_num 
					JOIN ville v2 ON p.vil_num2=v2.vil_num';

		$requete = $this->db->prepare($sql);
		$requete->execute();

		while ($parcours = $requete->fetch(PDO::FETCH_OBJ)) {
			$listeParcours[] = new Parcours($parcours);
		}

		$requete->closeCursor();
		return $listeParcours;
	}
}
?>