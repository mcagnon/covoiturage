<?php
class SalarieManager{
	private $db;

	public function __construct($db){
		$this->db = $db;
	}
	public function add($salarie){
		$requete = $this->db->prepare(
					'INSERT INTO salarie (per_num, sal_telprof, fon_num) VALUES (:per_num, :sal_telprof, :fon_num);');

		$requete->bindValue(':per_num',$salarie->getPerNum());
		$requete->bindValue(':sal_telprof',$salarie->getSalTelProf());
		$requete->bindValue(':fon_num',$salarie->getFonNum());

		$retour=$requete->execute();
		return $retour;
	}

	public function update($salarie){
		$requete = $this->db->prepare(
					'UPDATE salarie SET sal_telprof=:sal_telprof, fon_num=:fon_num
						WHERE per_num=:per_num;');

		$requete->bindValue(':per_num',$salarie->getPerNum());
		$requete->bindValue(':sal_telprof',$salarie->getSalTelProf());
		$requete->bindValue(':fon_num',$salarie->getFonNum());

		$retour=$requete->execute();
		return $retour;
	}

	public function delete($salarie){
		$requete = $this->db->prepare(
					'DELETE FROM salarie WHERE per_num:=per_num;');

		$requete->bindValue(':per_num',$salarie->getPerNum());

		$retour=$requete->execute();
		return $retour;
	}

	public function getAllSalarie(){
		$listeSalaries = array();

		$sql = 'SELECT per_num, sal_telprof, fon_num, fon_libelle FROM salarie s
					JOIN fonction f ON f.fon_num=s.fon_num';

		$requete = $this->db->prepare($sql);
		$requete->execute();

		while ($salarie = $requete->fetch(PDO::FETCH_OBJ)) {
			$listeSalaries[] = new Salarie($salarie);
		}

		$requete->closeCursor();
		return $listeSalaries;
	}

	public function getAllNumeroSalarie(){
		$listeSalaries = array();

		$sql = 'SELECT per_num FROM salarie';

		$requete = $this->db->prepare($sql);
		$requete->execute();

		while ($salarie = $requete->fetch(PDO::FETCH_OBJ)) {
			$listeSalaries[] = new Salarie($salarie);
		}

		$requete->closeCursor();
		return $listeSalaries;
	}

	public function getOneSalarie($id_salarie){
		$listeSalaries = array();

		$sql = "SELECT per_prenom, per_mail, per_tel, sal_telprof, fon_libelle
					FROM salarie s
					JOIN personne p ON p.per_num=s.per_num
					JOIN fonction f ON f.fon_num=s.fon_num
					WHERE s.per_num=$id_salarie";

		$requete = $this->db->prepare($sql);
		$requete->execute();

		while ($salarie = $requete->fetch(PDO::FETCH_OBJ)) {
			$listeSalaries[] = new Salarie($salarie);
		}

		$requete->closeCursor();
		return $listeSalaries;
	}

	public function getInfoOneSalarie($id_salarie){
		$sql = "SELECT per_prenom, per_mail, per_tel, sal_telprof, fon_libelle
					FROM salarie s
					JOIN personne p ON p.per_num=s.per_num
					JOIN fonction f ON f.fon_num=s.fon_num
					WHERE s.per_num=$id_salarie";

		$requete = $this->db->prepare($sql);
		$requete->execute();

		$salarie = new Salarie($requete->fetch(PDO::FETCH_OBJ));
		

		$requete->closeCursor();
		return $salarie;
	}
}
?>