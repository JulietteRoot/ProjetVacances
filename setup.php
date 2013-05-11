<?php
define('ROOT', realpath(__DIR__).DIRECTORY_SEPARATOR); // chemin absolu vers le répertoire où est mon script
define('ENTITY', ROOT."entity".DIRECTORY_SEPARATOR);
define('DAO', ROOT."dao".DIRECTORY_SEPARATOR);
define('CONTROLLER', ROOT."controller".DIRECTORY_SEPARATOR);
define('VIEW', ROOT."public".DIRECTORY_SEPARATOR); // pas PUBLIC, nom réservé
define('TEST', ROOT."test".DIRECTORY_SEPARATOR);
define('CONF', ROOT."conf".DIRECTORY_SEPARATOR);

$conf = parse_ini_file(CONF."configuration.ini"); // charge le fichier ini et retourne les confs qui s'y trouvent sous forme d'un tableau associatif
//var_dump($conf);

define('DB_NAME' , $conf['DB_NAME']);
define('DB_HOST' , $conf['DB_HOST']);
define('DB_USER' , $conf['DB_USER']);
define('DB_PASSWORD' , $conf['DB_PASSWORD']);

function myAutoload($class){ // passe par là qd on essaye de créer une classe
    $className = str_replace("\\", "/", $class);
    include "$className.php";
}

spl_autoload_register('myAutoload');

?>
