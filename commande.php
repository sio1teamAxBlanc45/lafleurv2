<?php
    require 'Connexion.php';
    session_start();
    if (!isset($_SESSION['cliboo']))
      {
            $_SESSION['cliboo'] = True;
            $_SESSION['mdpboo'] = True;
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
                <h4 class='titre_contenu'>"Récapitulatif des articles commandés"</h4>
                <br>
                <div >
                    <?php
                       
                       if(isset($_SESSION["reference"])){
                       
                                           ?>
                        <table border="1" class="table_contenu_commande">
                            <thead>
                                <tr class="tab_bordure">    
                                    
                                    <th class="tab_ref">Ref</th>
                                    <th class="tab_des">Désignation</th>
                                    <th class="tab_px">Px Unit</th>
                                    <th class="tab_qte">Qté</th>
                                    <th class="tab_mont">Montant</th>
                                </tr>
                            </thead>
                            <tbody>
                    <?php
                            $b = count($_SESSION["reference"]);
                            $total = 0;
                            for ($a = 0;$a<$b;$a++)
                            {
                            $sqltable = "SELECT pdt_ref, pdt_designation, pdt_prix FROM produit WHERE pdt_ref ='".$_SESSION["reference"][$a]."'";
                            $table1 = $connection->query($sqltable) or die (print_r($connection->errorInfo()));
                            $nbligne1 = $table1->rowcount();
                            $rowall1 = $table1->fetchAll();

                    ?>
                            <tr class="tab_bordure">
                                
                                <td> <?php echo $rowall1[0][0] ?></td>
                                <td> <?php echo $rowall1[0]['pdt_designation'] ?></td>
                                <td class="tab_px"> <?php echo $rowall1[0]['pdt_prix'] ?> €</td>
                                <td class="tab_qte"> <?php echo $_SESSION["quantite"][$a] ?></td>
                                <td class="tab_mont"> <?php echo $_SESSION["quantite"][$a] * $rowall1[0]['pdt_prix']?> €</td>
                            </tr>
                            
                    <?php 
                                $total += $_SESSION["quantite"][$a] * $rowall1[0]['pdt_prix'];
                                }?>
                                <tr class="tab_bordure">
                                
                                <td colspan="4" class="total"> Total</td>
                                <td class="tab_montTot"><?php echo $total ?> €</td>

                            </tr>

                            </tbody>        
                        </table>                

                <div>
                    <?php 
                    if($_SESSION['cliboo'] == False){
                        echo "ce code client n'existe pas";
                    } elseif ($_SESSION['mdpboo'] == False) {
                        echo "le mot de passe est incorrect";
                    }
                        
                    ?>
                    <form autocomplete="off" action="envoyer.php" method="get">
	                    <label for="CodeClient">Code client :</label>
	                    <input autocomplete="off" type="text" id="CodeClient" name="CodeClient" required>
	                    &nbsp; 
	                    &nbsp; 
	                    <label for="mdp">Mot de passe :</label>
	                    <input autocomplete="off" type="password" id="mdp" name="mdp" required>
	                    <br>
	                    <br>
	                    <input type="submit" value="Envoyer la commande">
                    </form>
                </div>
                    <?php 
		            	}
		                if (empty($_SESSION["reference"])){
		                	echo "Pas d'article dans le panier.";
		                }
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
