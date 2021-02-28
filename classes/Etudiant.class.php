<?php
class Etudiant {
	
	private $per_num;
	private $dep_num;
	private $div_num;
	private $per_prenom;
	private $per_mail;
	private $per_tel;
	private $dep_nom;
	private $vil_nom;

	public function __construct($valeurs = array()){
		if (!empty($valeurs))
				 $this->affecte($valeurs);
	}

	public function affecte($donnees){
		foreach ($donnees as $attribut => $valeur){
			switch ($attribut){
				case 'per_num': 
					$this->setPerNum($valeur); 
					break;
				case 'dep_num': 
					$this->setDepNum($valeur); 
					break;
				case 'div_num': 
					$this->setDivNum($valeur); 
					break;
				case 'per_prenom': 
					$this->setPerPrenom($valeur); 
					break;
				case 'per_mail': 
					$this->setPerMail($valeur); 
					break;
				case 'per_tel': 						
					$this->setPerTel($valeur); 
					break;
				case 'dep_nom': 
					$this->setDepNom($valeur); 
					break;
				case 'vil_nom': 						
					$this->setVilNom($valeur); 
					break;
			}
		}
	}

	public function getPerNum() {
		return $this->per_num;
	}

	public function setPerNum($id){
		$this->per_num=$id;
	}

	public function getDepNum() {
		return $this->dep_num;
	}

	public function setDepNum($id){
		$this->dep_num=$id;
	}

	public function getDivNum() {
		return $this->div_num;
	}

	public function setDivNum($id){
		$this->div_num=$id;
	}

	public function getPerPrenom() {
		return $this->per_prenom;
	}

	public function setPerPrenom($id){
		$this->per_prenom=$id;
	}

	public function getPerMail() {
		return $this->per_mail;
	}

	public function setPerMail($id){
		$this->per_mail=$id;
	}

	public function getPerTel() {
		return $this->per_tel;
	}

	public function setPerTel($id){
		$this->per_tel=$id;
	}

	public function getDepNom() {
		return $this->dep_nom;
	}

	public function setDepNom($id){
		$this->dep_nom=$id;
	}

	public function getVilNom() {
		return $this->vil_nom;
	}

	public function setVilNom($id){
		$this->vil_nom=$id;
	}
}
?>