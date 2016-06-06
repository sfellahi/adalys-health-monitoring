  <?php
include('html/mainheader.php');
?>
<div id="page-wrapper">
<div class="main-page">
<html>
  <head>
    <title>Administration</title>
  </head>
<body>
  <?php
    //connection au serveur:
    $cnx = mysql_connect( "localhost", "root", "root" ) ;
 
    //sélection de la base de données:
    $db = mysql_select_db( "adalys" ) ;
 
    //requête SQL:
    $sql = "SELECT *
	      FROM users
	      ORDER BY nom" ;
 
    //exécution de la requête:
    $requete = mysql_query( $sql, $cnx ) ;
 
    //affichage des données:
    while( $result = mysql_fetch_object( $requete ) )
    {
       echo(
           "<div align=\"left\">"
           .$result->nom." - ".$result->prenom." - ".$result->profil." - ".$result->email." 
       		<a href=\"admin_modification2.php?idPersonne=".$result->id."\">modifier</a></div>\n"
       ) ;
    }
  ?>
  <?php include("html/mainfooter.html");
echo( "</table><br>\n" );
?>
</body>
</html>