<?php
class Salarie {

	private $per_num;
	private $sal_telprof;
	private $fon_num;
	private $fon_libelle;
	private $per_prenom;
	private $per_mail;
	private $per_tel;

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
				case 'sal_telprof': 
					$this->setSalTelProf($valeur); 
					break;
				case 'fon_num': 
					$this->setFonNum($valeur); 
					break;
				case 'fon_libelle': 
					$this->setFonLib($valeur); 
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
			}
		}
	}

	public function getPerNum() {
		return $this->per_num;
	}

	public function setPerNum($id){
		$this->per_num=$id;
	}

	public function getSalTelProf() {
		return $this->sal_telprof;
	}

	public function setSalTelProf($id){
		$this->sal_telprof=$id;
	}

	public function getFonNum() {
		return $this->fon_num;
	}

	public function setFonNum($id){
		$this->fon_num=$id;
	}

	public function getFonLib() {
		return $this->fon_libelle;
	}

	public function setFonLib($id){
		$this->fon_libelle=$id;
	}

	public function getPerPrenom() {
		return $this->per_prenom;
	}

	public function setPerPrenom($id){
		$this->per_prenom=$id;
	}
	
	public function getPerTel() {
		return $this->per_tel;
	}

	public function setPerTel($id){
		$this->per_tel=$id;
	}

	public function getPerMail() {
		return $this->per_mail;
	}

	public function setPerMail($id){
		$this->per_mail=$id;
	}
}
?>