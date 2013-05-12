<?php
namespace dao;

include_once '../setup.php'; // voir si ça fait doublon => à supprimer ?

// à vérifier
use \PDO;
use \entity\Appartement;
use \entity\Herbegement;
use \entity\Villa;
//use \entity\Client;
//use \entity\Location;
use \entity\Service;
use \entity\Cadre;

class MysqlDao{
    private $dbh;
    
    public function __construct() {
//        $this->dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASSWORD);       
//        $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // On peut rajouter une ligne, pour être sûr de récupérer les données en UTF-8 :
        // $this->dbh->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES utf8"); // cette ligne placée comme ça ne fonctionne pas..?
        
        // Version qui marche, pour afficher en UTF-8 :
        $attributes = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'");
        $this->dbh = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD, $attributes);
    }
    
//    public function getAllHebergementsWithCadre(){
//        $sql = "SELECT h.id, h.capacite, h.tarif_jour, h.numero, h.ville, h.descriptif, h.image, c.nom cadre, th.intitule type FROM hebergement h JOIN cadre c ON h.cadre = c.id JOIN type_hebergement th ON h.type = th.id ORDER BY th.intitule";
//        $stmt = $this->dbh->prepare($sql); // renvoie 1 objet de type statement
//        $stmt->execute();
//        return $stmt->fetchAll(PDO::FETCH_ASSOC); // tableau associatif des résultats, renvoyé directement
//    }
//    
    
// Ma proposition :
    public function getAllHebergements(){
        $sql = "SELECT * FROM hebergement";
        $stmt = $this->dbh->prepare($sql); // renvoie 1 objet de type statement
        $stmt->execute();
        $hebergements = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $id = $row['id'];
            $capacite = $row['capacite'];
            $tarifJour = $row['tarif_jour'];
            $numero = $row['numero'];
            $ville = $row['ville'];
            $descriptif = $row['descriptif'];
            $image = $row['image'];
            $cadre = $row['cadre'];
            $type = $row['type'];
            
            switch($type){
                case 1:
                    $sql2 = "SELECT etage FROM appartement WHERE id=:id";
                    $stmt2 = $this->dbh->prepare($sql2); // renvoie 1 objet de type statement
                    $stmt2->bindParam(":id", $row['id']);
                    $stmt2->execute();
                    $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
                    $etage = $row2['etage'];
                    // il faut récupérer d'abord l'étage
                    $appartement = new Appartement($etage, $capacite, $tarifJour, $numero, $ville, $descriptif, $image, $cadre, $id);
                    $hebergements['appart'][] = $appartement; // appart rentré au prochain emplacement disponible du sous-tableau appart
                    break;
                case 2:
                    $sql2 = "SELECT superficie_piscine FROM villa WHERE id=:id";
                    $stmt2 = $this->dbh->prepare($sql2); // renvoie 1 objet de type statement
                    $stmt2->bindParam(":id", $row['id']);
                    $stmt2->execute();
                    $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
                    $surfacePiscine = $row2['superficie_piscine'];
                    // il faut récupérer la piscine d'abord
                    $villa = new Villa($surfacePiscine, $capacite, $tarifJour, $numero, $ville, $descriptif, $image, $cadre, $id);
                    $hebergements['villa'][] = $villa; // villa rentrée au prochain emplacement disponible du sous-tableau villa
                    break;
                default:
                    header("location:/ProjetVacances/public/error.php"); // contexte de l'application
             }
            
        }
            return $hebergements; // retourne un tableau de tableaux
    }
    
    public function getHebergementById($idHebergement) {
        $sql = "SELECT * FROM hebergement WHERE ID=:id";
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindParam(":id", $idHebergement);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC); // Je ne fais pas de boucle, je récupère qu'un seul hébergement (appartement ou villa)
        //$idHebergement = $row['id'];
        $capacite = $row['capacite'];
        $tarifJour = $row['tarif_jour'];
        $numero = $row['numero'];
        $ville = $row['ville'];
        $descriptif = $row['descriptif'];
        $image = $row['image'];
        $cadre = $row['cadre'];
        $type = $row['type'];
        
        switch($type){
            case 1:
                $sql2 = "SELECT etage FROM appartement WHERE id=:id";
                $stmt2 = $this->dbh->prepare($sql2); // renvoie 1 objet de type statement
                $stmt2->bindParam(":id", $row['id']);
                $stmt2->execute();
                $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
                $etage = $row2['etage'];
                return $appartement = new Appartement($etage, $capacite, $tarifJour, $numero, $ville, $descriptif, $image, $cadre, $idHebergement);
                // retourne l'objet appartement avec toutes les données et sort de la fonction
                break;
            case 2:
                $sql2 = "SELECT superficie_piscine FROM villa WHERE id=:id";
                $stmt2 = $this->dbh->prepare($sql2); // renvoie 1 objet de type statement
                $stmt2->bindParam(":id", $row['id']);
                $stmt2->execute();
                $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
                $surfacePiscine = $row2['superficie_piscine'];
                return $villa = new Villa($surfacePiscine, $capacite, $tarifJour, $numero, $ville, $descriptif, $image, $cadre, $idHebergement);
                // retourne l'objet $villa avec toutes les données et sort de la fonction
                break;
            default:
                //header("location:/ProjetVacances/public/error.php"); // contexte de l'application
         } // fin switch
         throw new Exception("Erreur de récupération de l'hébergement");
     } // fin function
     
     public function getAllServicesInclusByHebergement($idHebergement){
        $sql = "SELECT S.id, S.intitule, S.description, S.actif, S.tarif 
            FROM service S, hebergement_services_inclus H 
            WHERE H.fk_service=S.id AND H.fk_hebergement=:id";
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindParam(":id", $idHebergement);
        $stmt->execute();
        $services = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
           $services[] = new Service(
                   $row['intitule'], $row['description'], 
                   $row['tarif'], $row['actif'], $row['id']
                   );
        }
        return $services; // tableau de services (inclus)
     }
     
     public function getAllServicesOptionnelsByHebergement($idHebergement){
        $sql = "SELECT S.id, S.intitule, S.description, S.actif, S.tarif 
            FROM service S, hebergement_services_options H 
            WHERE H.fk_service=S.id AND H.fk_hebergement=:id";
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindParam(":id", $idHebergement);
        $stmt->execute();
        $services = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
           $services[] = new Service(
                   $row['intitule'], $row['description'], 
                   $row['tarif'], $row['actif'], $row['id']
                   );
        }
        return $services; // tableau de services (optionnels)
     }
     
 }
?>
