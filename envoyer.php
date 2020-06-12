<?php
require 'Connexion.php';
session_start();

$Cclient = htmlentities($_REQUEST['CodeClient']);
$mdp = htmlentities($_REQUEST['mdp']);

$sql3 = 'SELECT clt_motPasse FROM clientconnu WHERE clt_code = "'.$Cclient.'"';
$table = $connection->query($sql3) or die (print_r($connection->errorInfo()));
$nbligne = $table->rowcount();
$rowall = $table->fetchAll();
//var_dump(date("Y-m-d"));
//var_dump($rowall);
if ($nbligne == 1 && $mdp == $rowall[0]['clt_motPasse']){
    $strtime = strval(time());
    $sql4 = 'INSERT INTO commande VALUES( '.$strtime.',"'.$Cclient.'","'.date("Y-m-d").'")';
    $table = $connection->exec($sql4) or die (print_r($connection->errorInfo()));   
    for($i=0;$i<count($_SESSION["reference"]);$i++){
        $sql5 = 'INSERT INTO contenir VALUES ('.$strtime.',"'.$Cclient.'","'.$_SESSION['reference'][$i].'","'.$_SESSION['quantite'][$i].'")';
        $table = $connection->exec($sql5) or die (print_r($connection->errorInfo()));
    $resu = "Votre commande a bien été prise.";
}
}else{
	$resu ="Accès refusé.";
}

?>

<!DOCTYPE html>


<html>
    <head>
        <title>Accueil Société Lafleur</title>
        <meta charset="UTF-8">
        <link href="css.css" rel="stylesheet">
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
        
    
    <body class='body'>
        
        <div class="content">
          <div class="gauche">
            <div>
              <header>
                <h1 class="titre">Sté Lafleur</h1>
                <hr class="titre">
                <br>
                6, cloitre St Aignan
                <br>
                45000 Orléans
              </header>
            </div>

            <div class="menu">                    
              <a class="onglets"> 
                  <form action="nous-ecrire.php">
                      <input type="hidden" name="ref" value=""><input type="submit" value="Nous écrire" class="link-lookalike link-lookalike-ecrire">
                  </form> 
                  <form action="accueil.php">
                      <input type="hidden" name="ref" value="accueil.php"><input type="submit" value="Accueil" class="link-lookalike link-lookalike-acceuil">
                  </form> 
              </a>

              <hr class="new">
            

              <b class="nos-produits" >Nos produits </b>
                <?php
                $req = 'SELECT cat_libelle FROM categorie'; 
                
                $menu = $connection ->query($req);    
                
                while($ligne = $menu->fetch()) { ?>   
                  <a class="onglets">
                    <form action="tableau.php">
                        <input type="hidden" name="ref" <?php echo 'value="'.$ligne['cat_libelle'].'"'?>><input type="submit" <?php echo 'value="'.$ligne['cat_libelle'].'"'?> class="link-lookalike ">
                    </form>
                  </a>
                <?php 
                }  
                ?>
            </div>
            <hr class="new">
            <form action="panier.php" method="get" class="bouton">
              <input type="submit" value="Vider le panier" name="vider">
            </form>
            <br>
            <form action="commande.php" method="get" class="bouton">
              <input type="submit" value="Commander">
            </form>
          </div> 
          
            <div class='div-contenu'>
                <h4 class='titre_contenu'>"État de la commande"</h4>
                <br>
                <div >
                    <?php
                    echo $resu;
                    ?>
                </div>
            </div>
        </div>

     
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <footer>
            <h2 class="pied_page">® copyrights Votre nom réalisé le ...</h2>
        </footer>
        
    </body>
</html>
