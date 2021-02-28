<?php
class PersonneManager{
	private $db;

	public function __construct($db){
		$this->db = $db;
	}
	public function add($personne){
		$requete = $this->db->prepare(
					'INSERT INTO personne (per_nom, per_prenom, per_tel, per_mail, per_login, per_pwd) 
						VALUES (:per_nom, :per_prenom, :per_tel, :per_mail, :per_login, :per_pwd);');

		$requete->bindValue(':per_nom',$personne->getPerNom());
		$requete->bindValue(':per_prenom',$personne->getPerPrenom());
		$requete->bindValue(':per_tel',$personne->getPerTel());
		$requete->bindValue(':per_mail',$personne->getPerMail());
		$requete->bindValue(':per_login',$personne->getPerLogin());
		$requete->bindValue(':per_pwd',$personne->getPerPwd());

		$retour=$requete->execute();
		return $retour;
	}

	public function update($personne){
		$requete = $this->db->prepare(
					'UPDATE personne SET per_nom=:per_nom, per_prenom=:per_prenom, per_tel=:per_tel, per_mail=:per_mail  
						WHERE per_num=:per_num;');

		$requete->bindValue(':per_num',$personne->getPerNum());
		$requete->bindValue(':per_nom',$personne->getPerNom());
		$requete->bindValue(':per_prenom',$personne->getPerPrenom());
		$requete->bindValue(':per_tel',$personne->getPerTel());
		$requete->bindValue(':per_mail',$personne->getPerMail());

		$retour=$requete->execute();
		return $retour;
	}

	public function delete($personne){
		$requete = $this->db->prepare(
					'DELETE FROM personne WHERE per_num=:per_num;');

		$requete->bindValue(':per_num',$personne->getPerNum());

		$retour=$requete->execute();
		return $retour;
	}

	public function getAllPersonne(){
		$listePersonnes = array();

		$sql = 'SELECT per_num, per_nom, per_prenom FROM personne ORDER BY 2';

		$requete = $this->db->prepare($sql);
		$requete->execute();

		while ($personne = $requete->fetch(PDO::FETCH_OBJ)) {
			$listePersonnes[] = new Personne($personne);
		}

		$requete->closeCursor();
		return $listePersonnes;
	}

	public function getNumOnePersonne($nom, $prenom){
		$sql = "SELECT per_num FROM personne 
					WHERE per_nom='$nom' AND per_prenom='$prenom'";

		$requete = $this->db->prepare($sql);
		$requete->execute();

		$personne = new Personne($requete->fetch(PDO::FETCH_OBJ));
		
		$requete->closeCursor();
		return $personne;
	}

	public function getLoginAndPasswordPersonne($login){

		$sql = "SELECT per_num, per_pwd FROM personne
					WHERE per_login='$login'";

		$requete = $this->db->prepare($sql);
		$requete->execute();

		$personne= new Personne($requete->fetch(PDO::FETCH_OBJ));
		$requete->closeCursor();
		return $personne;
	}

	public function getInfoOnePersonne($id){
		$sql = "SELECT per_nom, per_prenom, per_tel, per_mail FROM personne 
					WHERE per_num = $id";

		$requete = $this->db->prepare($sql);
		$requete->execute();

		$personne = new Personne($requete->fetch(PDO::FETCH_OBJ));
		
		$requete->closeCursor();
		return $personne;
	}

	public function getMoyAvisPersonne($id){
		$sql = "SELECT AVG(avi_note) AS avi_note FROM avis 
					WHERE per_per_num = $id";

		$requete = $this->db->prepare($sql);
		$requete->execute();

		$personne = new Personne($requete->fetch(PDO::FETCH_OBJ));
		
		$requete->closeCursor();
		return $personne;
	}

	public function getLastAvisPersonne($id){
		$sql = "SELECT avi_comm FROM avis 
					WHERE per_per_num = $id
					AND avi_date >= ALL (SELECT avi_date FROM avis
						WHERE per_per_num = $id)";

		$requete = $this->db->prepare($sql);
		$requete->execute();

		$personne = new Personne($requete->fetch(PDO::FETCH_OBJ));
		
		$requete->closeCursor();
		return $personne;
	}
}
?>