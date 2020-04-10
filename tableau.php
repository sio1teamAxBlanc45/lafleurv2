            <?php    
                session_start();
                require 'Connexion.php';
                
                $ref = htmlentities($_REQUEST['ref']);
                
                $sql = "SELECT * FROM produit p, categorie c WHERE p.pdt_categorie = c.cat_code AND cat_libelle LIKE '".$ref."%' ";
                
                
                $_SESSION['sql'] = $sql;
                header('location: listpdt.php');
            ?>