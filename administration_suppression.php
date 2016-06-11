  <?php
  // Cacher les warnings
  ini_set("display_errors",0);error_reporting(0);
include('html/mainheader.php');
?>
<div id="page-wrapper">
<div class="main-page">
<html>
  <head>
    <title>supprimer</title>
    <script language="javascript">

      function confirme( identifiant )
      {
        var confirmation = confirm( "Voulez vous vraiment supprimer cet enregistrement ?" ) ;
	if( confirmation )
	{
	  document.location.href = "admin_suppression2.php?idPersonne="+identifiant ;
	}
      }

    </script>
  </head>
<body>
<?php
    //connection au serveur:
    $cnx = mysql_connect( "localhost", "root", "" ) ;
 
    //sélection de la base de données:
    $db = mysql_select_db( "adalys" ) ;
 
    //requête SQL:
    $sql = "SELECT *
	      FROM users
	      ORDER BY id" ;
 
    //exécution de la requête:
    $requete = mysql_query( $sql, $cnx ) ;
 
    //affichage des données:
    while( $result = mysql_fetch_object( $requete ) )
    {
       echo("<div align=\"left\">".$result->nom." - ".$result->prenom." - ".$result->email." - ".$result->profil." <a href=\"#\" onClick=\"confirme('".$result->id."')\" >supprimer</a><br>\n") ;
    }
  ?>
   <?php include("html/mainfooter.html");
   echo'<a href="administration_modification.php" > Modification des profils </a>';
   
echo( "</table><br>\n" );
?>
  </body>
</html>