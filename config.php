<?php
// Connexion à la base de données
		$link = mysqli_connect("localhost", "root", "root","adalys");
		if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

		
		// Rendre la base de données bdd, la base courante
		
?>