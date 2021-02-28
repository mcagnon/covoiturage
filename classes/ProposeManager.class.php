<?php
class ProposeManager{
	private $db;

	public function __construct($db){
		$this->db = $db;
	}
	public function add($propose){
		$requete = $this->db->prepare(
					'INSERT INTO propose (par_num, per_num, pro_date, pro_time, pro_place, pro_sens) 
						VALUES (:par_num, :per_num, :pro_date, :pro_time, pro_place, :pro_sens);');

		$requete->bindValue(':par_num',$propose->getParNum());
		$requete->bindValue(':per_num',$propose->getPerNum());
		$requete->bindValue(':pro_date',$propose->getProDate());
		$requete->bindValue(':pro_time',$propose->getProTime());
		$requete->bindValue(':pro_place',$propose->getProPlace());
		$requete->bindValue(':pro_sens',$propose->getProSens());

		$retour=$requete->execute();
		return $retour;
	}

	public function getAllPropose(){
		$listeProposes = array();

		$sql = 'SELECT par_num, per_num, pro_date, pro_time, pro_place, pro_sens
					FROM propose';

		$requete = $this->db->prepare($sql);
		$requete->execute();

		while ($propose = $requete->fetch(PDO::FETCH_OBJ)) {
			$listeProposes[] = new Propose($propose);
		}

		$requete->closeCursor();
		return $listeProposes;
	}

	public function getProposeVilleDepart(){
		$listeProposes = array();

		$sql = 'SELECT DISTINCT vil_num1, v1.vil_nom AS vil_nom1, vil_num2, v2.vil_nom AS vil_nom2
					FROM parcours pa 
					JOIN ville v1 ON pa.vil_num1=v1.vil_num 
					JOIN ville v2 ON pa.vil_num2=v2.vil_num
					JOIN propose pr ON pr.par_num=pa.par_num
					WHERE pro_sens=0
				UNION
				SELECT DISTINCT vil_num2 AS vil_num1, v2.vil_nom AS vil_nom1, vil_num1 AS vil_num2, v1.vil_nom AS vil_nom2
					FROM parcours pa 
					JOIN ville v1 ON pa.vil_num1=v1.vil_num 
					JOIN ville v2 ON pa.vil_num2=v2.vil_num
					JOIN propose pr ON pr.par_num=pa.par_num
					WHERE pro_sens=1';

		$requete = $this->db->prepare($sql);
		$requete->execute();

		while ($propose = $requete->fetch(PDO::FETCH_OBJ)) {
			$listeProposes[] = new Propose($propose);
		}

		$requete->closeCursor();
		return $listeProposes;
	}

	public function getProposeVilleArrivee($villeDepart){
		$listeProposes = array();

		$sql = "SELECT DISTINCT v1.vil_nom AS vil_nom1, vil_num2, v2.vil_nom AS vil_nom2
					FROM parcours pa 
					JOIN ville v1 ON pa.vil_num1=v1.vil_num 
					JOIN ville v2 ON pa.vil_num2=v2.vil_num
					JOIN propose pr ON pr.par_num=pa.par_num
					WHERE pro_sens=0 AND vil_num1=$villeDepart
				UNION
				SELECT DISTINCT v2.vil_nom AS vil_nom1, vil_num1 AS vil_num2, v1.vil_nom AS vil_nom2
					FROM parcours pa 
					JOIN ville v1 ON pa.vil_num1=v1.vil_num 
					JOIN ville v2 ON pa.vil_num2=v2.vil_num
					JOIN propose pr ON pr.par_num=pa.par_num
					WHERE pro_sens=1 AND vil_num2=$villeDepart";

		$requete = $this->db->prepare($sql);
		$requete->execute();

		while ($propose = $requete->fetch(PDO::FETCH_OBJ)) {
			$listeProposes[] = new Propose($propose);
		}

		$requete->closeCursor();
		return $listeProposes;
	}

	public function getProposeInfoTrajet($villeDepart, $villeArrivee, $date, $heure, $date_fin){
		$listeProposes = array();

		$sql = "SELECT v1.vil_nom AS vil_nom1, v2.vil_nom AS vil_nom2, pro_date, pro_time, pro_place, pr.per_num, per_nom, per_prenom
					FROM parcours pa 
					JOIN ville v1 ON pa.vil_num1=v1.vil_num 
					JOIN ville v2 ON pa.vil_num2=v2.vil_num
					JOIN propose pr ON pr.par_num=pa.par_num
					JOIN personne pe ON pe.per_num=pr.per_num
					WHERE pro_sens=0 AND vil_num1=$villeDepart AND vil_num2=$villeArrivee
						AND pro_time >= '$heure' AND pro_date BETWEEN '$date' AND '$date_fin'
				UNION
				SELECT v2.vil_nom AS vil_nom1, v1.vil_nom AS vil_nom2, pro_date, pro_time, pro_place, pr.per_num, per_nom, per_prenom
					FROM parcours pa 
					JOIN ville v1 ON pa.vil_num1=v1.vil_num 
					JOIN ville v2 ON pa.vil_num2=v2.vil_num
					JOIN propose pr ON pr.par_num=pa.par_num
					JOIN personne pe ON pe.per_num=pr.per_num
					WHERE pro_sens=1 AND vil_num2=$villeDepart AND vil_num1=$villeArrivee
						AND pro_time >= '$heure' AND pro_date BETWEEN '$date' AND '$date_fin'";

		$requete = $this->db->prepare($sql);
		$requete->execute();

		while ($propose = $requete->fetch(PDO::FETCH_OBJ)) {
			$listeProposes[] = new Propose($propose);
		}

		$requete->closeCursor();
		return $listeProposes;
	}

	public function getNumOneParcours($ville_depart, $ville_arrive){
		$sql = "SELECT par_num FROM parcours 
					WHERE vil_num1=$ville_depart AND vil_num2=$ville_arrive
				UNION 
				SELECT par_num FROM parcours 
					WHERE vil_num2=$ville_depart AND vil_num1=$ville_arrive";

		$requete = $this->db->prepare($sql);
		$requete->execute();

		$parcours = new Propose($requete->fetch(PDO::FETCH_OBJ));
		
		$requete->closeCursor();
		return $parcours;
	}
}
?>