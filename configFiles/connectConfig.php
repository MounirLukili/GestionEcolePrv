<?php
    $DB_SERVER="localhost";
    $DB_USERNAME="root";
    $DB_PASSWORD="";
    $DB_NAME="itsn_management";
    $link = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
    
    if($link->connect_error){
        die("Erreur de connexion. " . $link->connect_error);
    }
    
?>