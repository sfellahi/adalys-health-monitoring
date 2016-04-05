<!DOCTYPE HTML>
<html>
<head>
<title>Disease</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Baxster Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<!-- font CSS -->
<link rel="icon" href="favicon.ico" type="image/x-icon" >
<!-- font-awesome icons -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
<!-- chart -->
<script src="js/Chart.js"></script>
<!-- //chart -->
 <!-- js-->
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/modernizr.custom.js"></script>
<!--webfonts-->
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
<!--//webfonts--> 
<!--animate-->
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
	<script>
		 new WOW().init();
	</script>
<!--//end-animate-->
<!-- Metis Menu -->
<script src="js/metisMenu.min.js"></script>
<script src="js/custom.js"></script>
<link href="css/custom.css" rel="stylesheet">
<!--//Metis Menu -->
</head> 
<body class="disease_checkbox">
	<form method="POST" action="disease_checkbox.php">
<center>
<input type="text" name="reponse_checkbox" size="20" value="reponse_checkbox" maxlength="35"> <br>
<input type="text" name="colonne_assoc" size="20" value="colonne_assoc" maxlength="35"><br>
<input type="submit" value="Envoyer" name="envoyer">
</center>
</form>

 <?php
// On commence par récupérer les champs
if(isset($_POST['reponse_checkbox']))      $reponse_checkbox=$_POST['reponse_checkbox'];
else      $reponse_checkbox="";

if(isset($_POST['colonne_assoc']))      $colonne_assoc=$_POST['colonne_assoc'];
else      $colonne_assoc="";


// On vérifie si les champs sont vides
if(empty($reponse_checkbox) OR empty($colonne_assoc))
    {
    echo '<font color="red">Attention, un champs est vide!</font>';
    }

// Aucun champ n'est vide, on peut enregistrer dans la table
else     
    {
       // connexion à la base
    // Connexion à la base de données
		$link = mysql_connect("localhost", "root", "")
		// $link = mysql_connect("localhost", "root", "")
		or die("Impossible de se connecter : " . mysql_error());
		
		// Rendre la base de données bdd, la base courante
		$db_selected = mysql_select_db('maladie', $link);
		if (!$db_selected){
			die ('Impossible de sélectionner la base de données : ' . mysql_error());
		}	
    
    // on écrit la requête sql
    $sql = "INSERT INTO checkbox(id_checkbox, reponse_checkbox, colonne_assoc) VALUES('','$reponse_checkbox','$colonne_assoc')";
    
    // on insère les informations du formulaire dans la table
    mysql_query($sql) or die('Erreur SQL !'.$sql.'<br>'.mysql_error());

    // on affiche le résultat pour le visiteur
    echo 'Vos infos on été ajoutées.';

    mysql_close();  // on ferme la connexion
    } 
?> 
				
						
									
</body>
</html>