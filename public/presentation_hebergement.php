<?php
include '../setup.php';

use entity\Appartement;
use entity\Villa;
use entity\Service;

session_start();

$hebergement = $_SESSION['hebergement']; // attention, peut-être soit un objet appartement, soit un objet villa
if ( $hebergement instanceof Villa) {
    $type = 'villa';
} elseif ($hebergement instanceof Appartement) {
    $type = 'appartement';
} else {
    // On pourrait faire une fonction pour renvoyer une Exception ici...
    header("location:/ProjetVacances/public/error.php"); 
}
//var_dump($hebergement);

?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/style.css" rel="stylesheet">
        <title>Présentation de l'hébergement choisi</title>
    </head>
    <body>
        <?php if(strcmp($type, "appartement") == 0) : //alternative, pour comparer 2 chaines de caractères. Renvoie zéro si elles sont identiques ?>
            <h1>Appartement à <?php echo $hebergement->getVille();?></h1>
            <p><?php echo $hebergement->getDescriptif();?></p>
            <p><?php echo "{$hebergement->getCapacite()}m², étage N°{$hebergement->getEtage()}, {$hebergement->getTarifJour()} € par jour" ?></p>
            
        <?php else : ?>
            <h1>Villa à <?php echo $hebergement->getVille();?></h1>
            <p><?php echo $hebergement->getDescriptif();?></p>
            <p><?php echo "{$hebergement->getCapacite()}m², piscine de {$hebergement->getSurfacePiscine()}m2, {$hebergement->getTarifJour()} € par jour"; ?></p>
        <?php endif; ?>
            
            <ul>Les services inclus sont :
                <?php foreach ($_SESSION['services_inclus'] as $service): ?>
                    <li><?php echo "{$service->getIntitule()}. {$service->getDescription()} pour {$service->getTarif()} €"; ?></li>
                <?php endforeach; ?>
            </ul>
            
            <p>Vous pouvez choisir des services optionnels :</p>
            <form action="#" method="POST">
                <?php foreach ($_SESSION['services_options'] as $service): ?>
                    <input type="checkbox" name="services[]" value="<?php echo $service->getIntitule() ?>"><?php echo "{$service->getIntitule()}. {$service->getDescription()} pour {$service->getTarif()} €"; ?><br>
                <?php endforeach; ?>
                <input id="validation" type="submit" value="valider"> <input id="annulation" type="reset" value="annuler">
            </form>
            
            <?php // ATTENTION, ci-dessous un simple test. Il faudrait normalement faire les vérifs et renvoyer vers un controller puis une vue récapitulative !!
            
            if(isset($_POST['services']) && count($_POST['services']) != 0):?>
            <ul>Vous avez choisi :
            <?php
            foreach($_POST['services'] as $service) {
                echo "<li>$service</li>";
            }
            ?>
            </ul>
            <?php endif; ?>
    </body>
</html>
