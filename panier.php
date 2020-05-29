<?php
require 'Connexion.php';
session_start();

$ajout = htmlentities($_REQUEST["ajout"]);

if ($ajout == 0){    
    $produits = htmlentities($_REQUEST["produits"]);
    $quantite = htmlentities($_REQUEST["quantite"]);
    $i = count($_SESSION["reference"]);
    $_SESSION["reference"][$i] = $produits;
    $_SESSION["quantite"][$i] = $quantite;
    header("Location: listpdt.php");    
}else{
    unset($_SESSION["reference"],$_SESSION["quantite"]);
    header("Location: accueil.php");
}

?>
