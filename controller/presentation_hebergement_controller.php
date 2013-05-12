<?php
include '../setup.php';
session_start();

$idHebergement = $_POST['id'];

use dao\MysqlDao;
use entity\Hebergement; // Non obligatoire, on ne crée pas l'objet ici
use entity\Service; // Non obligatoire ici

try{
    $dao = new MysqlDao();
    $hebergement = $dao->getHebergementById($idHebergement);
    $_SESSION['hebergement'] = $hebergement; // attention, peut-être soit un appartement, soit une villa
    
    $services_inclus = $dao->getAllServicesInclusByHebergement($idHebergement);
    $_SESSION['services_inclus'] = $services_inclus; // on pourrait regrouper sur une ligne
    
    $services_options = $dao->getAllServicesOptionnelsByHebergement($idHebergement);
    $_SESSION['services_options'] = $services_options;
    
    header("location:/ProjetVacances/public/presentation_hebergement.php");// on pourrait utiliser une constante, mais il faudrait une constante avec le contexte de l'application

} catch(PDOException $ex){
    // un log
    //    echo $ex->getMessage(); // pour débugguer

   header("location:/ProjetVacances/public/error.php"); // on redirige la personne vers une page d'erreur
} catch(Exception $ex) {
    echo $ex->getMessage();
}
?>
