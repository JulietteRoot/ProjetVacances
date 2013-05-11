<?php
include '../setup.php';

use entity\Appartement;
use entity\Villa;

session_start();

$hebergement = $_SESSION['hebergement']; // attention, peut-être soit un objet appartement, soit un objet villa
if ( $hebergement instanceof Villa) {
    $type = 'villa';
} elseif ($hebergement instanceof Appartement) {
    $type = 'appartement';
} else {
    $type = "autre";    
}
var_dump($hebergement);

?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/style.css" rel="stylesheet">
        <title></title>
    </head>
    <body>
        <?php if(strcmp($type, "appartement") == 0): ?>
            <h1>Appartement</h1>
        <?php elseif(strcmp($type, "villa") == 0) : ?>
            <h1>Villa</h1>
        <?php else : ?>
            <h1>Erreur ?</h1>
        <?php endif; ?>        
        
    </body>
</html>
