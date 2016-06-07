<?php
// Connexion à la base de données
		$link = mysqli_connect("localhost", "root", "root","adalys");
		if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

// Connexion à la base de données
		$link2 = mysqli_connect("localhost", "root", "root","adalys");
		if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
		
		// Rendre la base de données bdd, la base courante
		
		//Nom dutilisateur de ladministrateur
$admin='ray_95@hotmail.fr';

/******************************************************
----------------Configuration Optionelle---------------
******************************************************/

//Nom du fichier de laccueil
$url_home = 'index.php';
$url_forum = 'forum.php';

//Nom du design
$design = 'default';


/******************************************************
----------------------Initialisation-------------------
******************************************************/
include('init.php');
?>