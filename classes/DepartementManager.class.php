<?php 
class DepartementManager {
    
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function add($departement) {
        $requete = $this->db->prepare(
                   'INSERT INTO departement (dep_nom, vil_num) VALUES (:dep_nom, :vil_num);');

        $requete->bindValue(':dep_nom',$departement->getDepNom());
        $requete->bindValue(':vil_num',$departement->getVilNum());

        print_r($requete->debugDumpParams());
        return $retour;
    }

    public function getAllDepartement(){
        $listeDepartements = array();

        $sql = 'SELECT dep_num, dep_nom FROM departement ORDER BY 2';

        $requete = $this->db->prepare($sql);
        $requete->execute();

        while ($departement = $requete->fetch(PDO::FETCH_OBJ)) {
            $listeDepartements[] = new Departement($departement);
        }

        $requete->closeCursor();
        return $listeDepartements;
    }
}
?>