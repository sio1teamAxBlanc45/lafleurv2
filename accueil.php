<?php
  include 'Connexion.php';
  if (!isset($_SESSION["reference"]))
      {
            $_SESSION["reference"]=array();
            $_SESSION["quantite"]=array();
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
            "Dites-le avec Lafleur"
            <br>
            <br>
            <img src="Images\ACCUEIL.JPG" alt="Fleur accueil">
            <br>
            <br>
            Constituez votre panier en naviguant, puis cliquer sur le bouton Commander
            <hr>
            <p>Vous devez être recencé comme client pour pouvoir commander
            Envoyez un mail en laissant vos coordonnées pour être contacté
            par notre service commercial</p>
          </div>

      </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <footer>
            <h2 class="pied_page">® copyrights Votre nom réalisé le ...</h2>
        </footer>
        
    </body>
</html>