  
<?php
    require 'Connexion.php';
    session_start();
    
    if (isset($_SESSION['sql'])){
    
    $sql = $_SESSION['sql'];
    $table = $connection->query($sql) or die (print_r($connection->errorInfo()));
    $nbligne = $table->rowcount();
    $rowall = $table->fetchAll();
    }

    $sqltable = "SELECT pdt_ref, pdt_designation, pdt_prix FROM produit WHERE pdt_ref ='b01'";
    $table1 = $connection->query($sqltable) or die (print_r($connection->errorInfo()));
    $nbligne1 = $table1->rowcount();
    $rowall1 = $table1->fetchAll();
?>

<!DOCTYPE html>


<html>
    <head>
        <title>Accueil Société Lafleur</title>
        <meta charset="UTF-8">
        <link href="css.css" rel="stylesheet">
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
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
                       
                       if(isset($sqltable)){
                       
                       if ($nbligne1 !=0)
                        {
                    ?>
                        <table border="1" class="table-contenu">
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
                            foreach ($rowall as $row)
                            {
                            
                    ?>
                            <tr class="tab_bordure">
                                
                                <td> <?php echo $row['pdt_ref'] ?></td>
                                <td> <?php echo $row['pdt_designation'] ?></td>
                                <td class="tab_px"> <?php echo $row['pdt_prix'] ?> €</td>
                                <td class="tab_qte"> XX</td>
                                <td class="tab_mont"> XX €</td>
                            </tr>
                            
                    <?php 
                                }?>
                                <tr class="tab_bordure">
                                
                                <td colspan="4" class="total"> Total</td>
                                <td class="tab_montTot">XX €</td>

                            </tr><?php
                            }
                    }
                    ?>      
                            </tbody>        
                        </table>                
         
                
                                   
                </div>
                <div>
                    <label for="CodeClient">Code client :</label>
                    <input type="text" id="CodeClient" name="CodeClient" required>
                    &nbsp; 
                    &nbsp; 
                    <label for="mdp">Mot de passe :</label>
                    <input type="text" id="mdp" name="mdp" required>
                    <br>
                    <br>
                    <form action="envoyer.php" method="get">
                        <input type="button" value="Envoyer la commande">
                    </form>
                </div>        
            </div>   
        </div>

     


        <footer>
            <h2 class="pied_page">® copyrights ... réalisé le </h2>
        </footer>
        
    </body>
</html>