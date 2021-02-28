<?php
class EtudiantManager{
	private $db;

	public function __construct($db){
		$this->db = $db;
	}
	public function add($etudiant){
		$requete = $this->db->prepare(
					'INSERT INTO etudiant (per_num, dep_num, div_num) VALUES (:per_num, :dep_num, :div_num);');

		$requete->bindValue(':per_num',$etudiant->getPerNum());
		$requete->bindValue(':dep_num',$etudiant->getDepNum());
		$requete->bindValue(':div_num',$etudiant->getDivNum());

		$retour=$requete->execute();
		return $retour;
	}

	public function update($etudiant){
		$requete = $this->db->prepare(
					'UPDATE etudiant SET dep_num=:dep_num, div_num=:div_num
						WHERE per_num=:per_num;');

		$requete->bindValue(':per_num',$etudiant->getPerNum());
		$requete->bindValue(':dep_num',$etudiant->getDepNum());
		$requete->bindValue(':div_num',$etudiant->getDivNum());

		$retour=$requete->execute();
		return $retour;
	}

	public function delete($etudiant){
		$requete = $this->db->prepare(
					'DELETE FROM etudiant WHERE per_num=:per_num;');

		$requete->bindValue(':per_num',$etudiant->getPerNum());

		$retour=$requete->execute();
		return $retour;
	}

	public function getAllEtudiant(){
		$listeEtudiants = array();

		$sql = 'SELECT per_num, dep_num, div_num FROM etudiant';

		$requete = $this->db->prepare($sql);
		$requete->execute();

		while ($etudiant = $requete->fetch(PDO::FETCH_OBJ)) {
			$listeEtudiants[] = new Etudiant($etudiant);
		}

		$requete->closeCursor();
		return $listeEtudiants;
	}

	public function getOneEtudiant($id_etudiant){
		$listeEtudiants = array();

		$sql = "SELECT per_prenom, per_mail, per_tel, dep_nom, vil_nom 
					FROM etudiant e 
					JOIN personne p ON p.per_num=e.per_num
					JOIN departement d ON d.dep_num=e.dep_num
					JOIN ville v ON v.vil_num=d.vil_num
					WHERE e.per_num=$id_etudiant;";

		$requete = $this->db->prepare($sql);
		$requete->execute();

		while ($etudiant = $requete->fetch(PDO::FETCH_OBJ)) {
			$listeEtudiants[] = new Etudiant($etudiant);
		}

		$requete->closeCursor();
		return $listeEtudiants;
	}
}
?>