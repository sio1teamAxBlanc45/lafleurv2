<?php
    require 'Connexion.php';
    session_start();
 
    
    
    $sql2 = 'SELECT * FROM panier';
    $panier = $connection -> query($sql2);
    
  
    
    if (isset($_SESSION['sql'])){
    
    $sql = $_SESSION['sql'];
    $table = $connection->query($sql) or die (print_r($connection->errorInfo()));
    $nbligne = $table->rowcount();
    $rowall = $table->fetchAll();
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
               
            <?php
               
               if(isset($_SESSION['sql'])){
               
               if ($nbligne !=0)
                {
            ?>
                <table border="1" class="table-contenu">
                    <thead>
                        <tr>    
                            <th>Photo</th>
                            <th>Référence</th>
                            <th>Désignation</th>
                            <th>Prix</th>
                        </tr>
                    </thead>
                    <tbody>
            <?php
                    foreach ($rowall as $row)
                    {
                    
            ?>
                    <tr>
                        <td> <img src=<?php echo 'Images'.'&#92;'.$row['pdt_image'].'.JPG' ?> ></td>
                        <td> <?php echo $row['pdt_ref'] ?></td>
                        <td> <?php echo $row['pdt_designation'] ?></td>
                        <td> <?php echo $row['pdt_prix'] ?></td>
                    </tr>
            <?php 
                        }
                    }
            }
            ?>      
                    </tbody>        
                </table>                
 
                <br>
                <br> 
                
                <div>
                    <form action="panier.php" method="GET" class="button">
                        <select name="produits" id="produits">
                        <?php
                            foreach ($rowall as $rowb){
                            ?>
                        <option value="<?php echo $rowb['pdt_ref'] ?>"><?php echo $rowb['pdt_designation'] ?></option>
                            <?php
                            }
                            ?>
                        </select>  
                    
                        <label for="quantite">Quantité :</label>
                        <input type="text" id="quantite" name="quantite" placeholder="0" required >
                
                    <br>
                    <br>

                    <input type="submit" value="Ajouter au panier" name="ajouter">
                            
                    </form>
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