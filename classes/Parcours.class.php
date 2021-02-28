<?php
class Parcours {
	
	private $par_num;
	private $par_km;
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
				case 'par_km': 
					$this->setParKm($valeur); 
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

	public function getParKm() {
		return $this->par_km;
	}

	public function setParKm($id){
		$this->par_km=$id;
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