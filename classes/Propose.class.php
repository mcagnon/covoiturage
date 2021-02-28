<?php
class Propose {
	
	private $par_num;
	private $per_num;
	private $per_nom;
	private $per_prenom;
	private $pro_date;
	private $pro_time;
	private $pro_place;
	private $pro_sens;
	private $vil_num1;
	private $vil_nom1;
	private $vil_num2;
	private $vil_nom2;


	public function __construct($valeurs = array()){
		if (!empty($valeurs))
				 $this->affecte($valeurs);
	}

	public function affecte($donnees){
		foreach ($donnees as $attribut => $valeur){
			switch ($attribut){
				case 'par_num': 
					$this->setParNum($valeur); 
					break;
				case 'per_num': 
					$this->setPerNum($valeur); 
					break;
				case 'per_nom': 
					$this->setPerNom($valeur); 
					break;
				case 'per_prenom': 
					$this->setPerPrenom($valeur); 
					break;
				case 'pro_date': 
					$this->setProDate($valeur); 
					break;
				case 'pro_time': 
					$this->setProTime($valeur); 
					break;
				case 'pro_place': 
					$this->setProPlace($valeur); 
					break;
				case 'pro_sens': 
					$this->setProSens($valeur); 
					break;
				case 'vil_num1': 
					$this->setVilNum1($valeur); 
					break;
				case 'vil_nom1': 
					$this->setVilNom1($valeur); 
					break;
				case 'vil_num2': 
					$this->setVilNum2($valeur); 
					break;
				case 'vil_nom2': 
					$this->setVilNom2($valeur); 
					break;
			}
		}
	}

	public function getParNum() {
		return $this->par_num;
	}

	public function setParNum($id){
		$this->par_num=$id;
	}

	public function getPerNum() {
		return $this->per_num;
	}

	public function setPerNum($id){
		$this->per_num=$id;
	}

	public function getPerNom() {
		return $this->per_nom;
	}

	public function setPerNom($id){
		$this->per_nom=$id;
	}

	public function getPerPrenom() {
		return $this->per_prenom;
	}

	public function setPerPrenom($id){
		$this->per_prenom=$id;
	}

	public function getProDate() {
		return $this->pro_date;
	}

	public function setProDate($id){
		$this->pro_date=$id;
	}
	
	public function getProTime() {
		return $this->pro_time;
	}

	public function setProTime($id){
		$this->pro_time=$id;
	}

	public function getProPlace() {
		return $this->pro_place;
	}

	public function setProPlace($id){
		$this->pro_place=$id;
	}

	public function getProSens() {
		return $this->pro_sens;
	}

	public function setProSens($id){
		$this->pro_sens=$id;
	}

	public function getVilNum1() {
		return $this->vil_num1;
	}

	public function setVilNum1($id){
		$this->vil_num1=$id;
	}

	public function getVilNom1() {
		return $this->vil_nom1;
	}

	public function setVilNom1($id){
		$this->vil_nom1=$id;
	}

	public function getVilNum2() {
		return $this->vil_num2;
	}

	public function setVilNum2($id){
		$this->vil_num2=$id;
	}

	public function getVilNom2() {
		return $this->vil_nom2;
	}

	public function setVilNom2($id){
		$this->vil_nom2=$id;
	}
}
?>