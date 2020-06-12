<?php
require 'Connexion.php';
session_start();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$Cclient = htmlentities($_REQUEST['CodeClient']);
$mdp = htmlentities($_REQUEST['mdp']);

$sql3 = 'SELECT clt_motPasse FROM clientconnu WHERE clt_code = "'.$Cclient.'"';
$table = $connection->query($sql3) or die (print_r($connection->errorInfo()));
$nbligne = $table->rowcount();
$rowall = $table->fetchAll();
var_dump(date("Y-m-d"));
var_dump($rowall);
if ($nbligne == 1 && $mdp == $rowall[0]['clt_motPasse']){
    $strtime = strval(time());
    $sql4 = 'INSERT INTO commande VALUES( '.$strtime.',"'.$Cclient.'","'.date("Y-m-d").'")';
    $table = $connection->exec($sql4) or die (print_r($connection->errorInfo()));   
    for($i=0;$i<count($_SESSION["reference"]);$i++){
        $sql5 = 'INSERT INTO contenir VALUES ('.$strtime.',"'.$Cclient.'","'.$_SESSION['reference'][$i].'","'.$_SESSION['quantite'][$i].'")';
        $table = $connection->exec($sql5) or die (print_r($connection->errorInfo()));
    }
}
?>
