 <meta http-equiv="refresh" content="2; URL=administration_suppression.php">
  <?php
include("html/mainheader.html");
?>
<div id="page-wrapper">
<div class="main-page">
<?php
  //connection au serveur:
  $cnx = mysql_connect( "localhost", "root", "root" ) ;
 
  //sélection de la base de données:
  $db = mysql_select_db( "adalys" ) ;
 
  //récupération de la variable d'URL,
  //qui va nous permettre de savoir quel enregistrement supprimer:
  $id  = $_GET["idPersonne"] ;
 
  //requête SQL:
  $sql = "DELETE 
            FROM users
	    WHERE id = ".$id ;
  echo $sql ;	    
  //exécution de la requête:
  $requete = mysql_query( $sql, $cnx ) ;
 
  //affichage des résultats, pour savoir si la suppression a marchée:
  if($requete)
  {
    echo("La suppression à été correctement effectuée") ;
  }
  else
  {
    echo("La suppression à échouée") ;
  }
?>