<html>
  <head>
    <title>modification de données en PHP :: partie2</title>
  </head>
<body>
 <?php
  //connection au serveur:
  $cnx = mysql_connect( "localhost", "root", "" ) ;
 
  //sélection de la base de données:
  $db = mysql_select_db( "adalys" ) ;
 
  //récupération de la variable d'URL,
  //qui va nous permettre de savoir quel enregistrement modifier
  $id  = $_GET["idPersonne"] ;
 
  //requête SQL:
  $sql = "SELECT *
            FROM users
	    WHERE id = ".$id ;
 
  //exécution de la requête:
  $requete = mysql_query( $sql, $cnx ) ;
 
  //affichage des données:
  if( $result = mysql_fetch_object( $requete ) )
  {
  ?>
  <?php
include("html/mainheader.html");
include("html/menu.html");
?>
<div id="page-wrapper">
<div class="main-page">
  <form name="insertion" action="modification3.php" method="POST">
  <input type="hidden" name="id" value="<?php echo($id) ;?>">
  <table border="3" align="center" cellspacing="2" cellpadding="2">
    <tr align="center">
      <td>nom</td>
      <td><input type="text" name="nom" value="<?php echo($result->nom) ;?>"></td>
    </tr>
    <tr align="center">
      <td>prenom</td>
      <td><input type="text" name="prenom" value="<?php echo($result->prenom) ;?>"></td>
    </tr>
    <tr align="center">
      <td>email</td>
      <td><input type="text" name="email" value="<?php echo($result->email) ;?>"></td>
    </tr>
    <tr align="center">
      <td>password</td>
      <td><input type="password" name="password" value="<?php echo($result->password) ;?>"></td>

    <tr align="center">
      <td colspan="2"><input type="submit" value="modifier"></td>
    </tr>
  </table>
</form>
  <?php
  }//fin if 
  echo'<a href="modification1.php" > Modification des profils </a>';
  echo'<br>';
  echo'<a href="signup.php" > créer un profil </a>';
  ?>
  </body>
</html>