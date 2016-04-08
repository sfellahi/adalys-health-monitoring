  <?php
include("html/mainheader.html");
include("html/menu.html");
?>
<div id="page-wrapper">
<div class="main-page">
<html>
  <head>
    <title>modification de données en PHP :: partie 1</title>
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
	      ORDER BY nom" ;
 
    //exécution de la requête:
    $requete = mysql_query( $sql, $cnx ) ;
 
    //affichage des données:
    while( $result = mysql_fetch_object( $requete ) )
    {
       echo(
           "<div align=\"center\">"
           .$result->nom." ".$result->prenom." ".$result->email
           ." <a href=\"modification2.php?idPersonne=".$result->id."\">modifier</a></div>\n"
       ) ;
    }
  ?>
  <?php include("html/mainfooter.html");
  echo'<a href="suppression1.php" > Suppression des profils </a>';
  echo'<br>';
  echo'<a href="signup.php" > créer un profil </a>';
echo( "</table><br>\n" );
?>
</body>
</html>