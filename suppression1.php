  <?php
include("html/mainheader.html");
include("html/menu.html");
?>
<div id="page-wrapper">
<div class="main-page">
<html>
  <head>
    <title>suppression de données en PHP :: partie 1</title>
    <script language="javascript">

      function confirme( identifiant )
      {
        var confirmation = confirm( "Voulez vous vraiment supprimer cet enregistrement ?" ) ;
	if( confirmation )
	{
	  document.location.href = "suppression2.php?idPersonne="+identifiant ;
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
       echo("<div align=\"center\">".$result->nom." ".$result->prenom." ".$result->email." <a href=\"#\" onClick=\"confirme('".$result->id."')\" >supprimer</a><br>\n") ;
    }
  ?>
   <?php include("html/mainfooter.html");
   echo'<a href="modification1.php" > Modification des profils </a>';
   echo'<br>';
   echo'<a href="signup.php" > créer un profil </a>';
echo( "</table><br>\n" );
?>
  </body>
</html>