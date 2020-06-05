<?php
require 'Connexion.php';
session_start();

$a = False;
if (isset($_GET['ajouter'])){    
    $produits = htmlentities($_REQUEST["produits"]);
    $quantite = htmlentities($_REQUEST["quantite"]);
    $i = count($_SESSION["reference"]);
    for ($j=0;$j<$i;$j++) {
        if ($_SESSION["reference"][$j] == $produits){
            $a = True;
            $_SESSION["quantite"][$j] += $quantite;
        }
    }
    if ($a==False){
    $_SESSION["reference"][$i] = $produits;
    $_SESSION["quantite"][$i] = $quantite;
    }
    header("Location: listpdt.php");    
}elseif(isset($_GET['vider'])){
    unset($_SESSION["reference"],$_SESSION["quantite"]);
    header("Location: accueil.php");
}else{
    echo '????';
}

?>
