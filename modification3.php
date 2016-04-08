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
  //email:
  $email = $_POST["email"] ;
  //password
  $password        = $_POST["password"] ;

 
  //récupération de l'identifiant de la personne:
  $id         = $_POST["id"] ;
 
  //création de la requête SQL:
  $sql = "UPDATE users
            SET nom         = '$nom', 
	          prenom     = '$prenom',
		 	  email    = '$email',
			  password          = '$password'
           WHERE id = '$id' " ;
 
  //exécution de la requête SQL:
  $requete = mysql_query($sql, $cnx) or die( mysql_error() ) ;
 
 
  //affichage des résultats, pour savoir si la modification a marchée:
  if($requete)
  {
    echo("La modification à été correctement effectuée") ;
    echo'<br>';
    echo'<a href="modification1.php" > Revenir à modifier les profils </a>';
  }
  else
  {
    echo("La modification à échouée") ;
    echo'<br>';
    echo'<a href="modification1.php" > Revenir à modifier les profils </a>';
  }
?>