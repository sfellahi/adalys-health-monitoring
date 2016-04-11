<?php
  //connection au serveur
  $cnx = mysql_connect( "localhost", "root", "" ) ;
 
  //sélection de la base de données:
  $db  = mysql_select_db( "adalys" ) ;
 
  //récupération des valeurs des champs:
  //nom:
  $nom     = $_POST["nom"] ;
  //prenom:
  $prenom = $_POST["prenom"] ;
  //adresse:
  $email = $_POST["email"] ;
  //code postal:
  // $password = stripslashes(md5($_POST['password']));
 $password = $_POST['password'];
  //création de la requête SQL:
  $sql = "INSERT  INTO users (nom, prenom, email, password)
            VALUES ( '$nom', '$prenom', '$email', '$password') " ;
 
  //exécution de la requête SQL:
  $requete = mysql_query($sql, $cnx) or die( mysql_error() ) ;
 
  //affichage des résultats, pour savoir si l'insertion a marchée:
  if($requete)
  {
    echo("L'insertion a été correctement effectuée") ;
    echo'<a href="login.php" > se connecter </a>';
  }
  else
  {
    echo("L'insertion à échouée") ;
    echo'<a href="signup.php" > revenir à inscrire </a>';
  }
?>