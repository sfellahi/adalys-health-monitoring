      <?php
include("html/mainheader.html");
include("html/menu.html");
?>
<div id="page-wrapper">
<div class="main-page">
    <?php
    // on teste si le formulaire a été soumis
    if (isset ($_POST['go']) && $_POST['go']=='Poster') {
    	// on teste la déclaration de nos variables
    	if (!isset($_POST['auteur']) || !isset($_POST['titre']) || !isset($_POST['message'])) {
    	$erreur = 'Les variables nécessaires au script ne sont pas définies.';
    	}
    	else {
    	// on teste si les variables ne sont pas vides
    	if (empty($_POST['auteur']) || empty($_POST['titre']) || empty($_POST['message'])) {
    		$erreur = 'Au moins un des champs est vide.';
    	}

    	// si tout est bon, on peut commencer l'insertion dans la base
    	else {
    		// on se connecte à notre base
    		$base = mysql_connect ('localhost', 'root', '');
    		mysql_select_db ('adalys', $base) ;

    		// on calcule la date actuelle
    		$date = date("Y-m-d H:i:s");

    		// préparation de la requête d'insertion (pour la table forum_sujets)
    		$sql = 'INSERT INTO forum_sujets VALUES("", "'.mysql_escape_string($_POST['auteur']).'", "'.mysql_escape_string($_POST['titre']).'", "'.$date.'")';

    		// on lance la requête (mysql_query) et on impose un message d'erreur si la requête ne se passe pas bien (or die)
    		mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());

    		// on recupère l'id qui vient de s'insérer dans la table forum_sujets
    		$id_sujet = mysql_insert_id();

    		// lancement de la requête d'insertion (pour la table forum_reponses
    		$sql = 'INSERT INTO forum_reponses VALUES("", "'.mysql_escape_string($_POST['auteur']).'", "'.mysql_escape_string($_POST['message']).'", "'.$date.'", "'.$id_sujet.'")';
    		
    		echo'<a href="./forum.php">Retour au forum</a>';
    		// on lance la requête (mysql_query) et on impose un message d'erreur si la requête ne se passe pas bien (or die)
    		mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());

    		// on ferme la connexion à la base de données
    		mysql_close();

    		// on redirige vers la page d'accueil
    		header('Location: forum.php');

    		// on termine le script courant
    		exit;
    	}
    	}
    }
    ?>
    <html>
    <head>
    <title>Insertion d'un nouveau sujet</title>
    </head>

    <body>

    <!-- on fait pointer le formulaire vers la page traitant les données -->
    <form action="insert_sujet.php" method="post">
    <table>
    <tr><td>
    Auteur :
    </td><td>
    <input type="text" name="auteur" maxlength="30" size="50" value="<?php if (isset($_POST['auteur'])) echo htmlentities(trim($_POST['auteur'])); ?>">
    </td></tr><tr><td>
    Titre :
    </td><td>
    <input type="text" name="titre" maxlength="50" size="50" value="<?php if (isset($_POST['titre'])) echo htmlentities(trim($_POST['titre'])); ?>">
    </td></tr><tr><td>
   	Message :
    </td><td>
    <textarea name="message" cols="50" rows="10"><?php if (isset($_POST['message'])) echo htmlentities(trim($_POST['message'])); ?></textarea>
    </td></tr><tr><td><td align="right">
    <input type="submit" name="go" value="Poster">
    </td></tr></table>
    </form>
    <?php
    // on affiche les erreurs éventuelles
    if (isset($erreur)) echo '<br /><br />',$erreur;
    ?>
    
    <a href="./forum.php">Retour au forum</a>
    </body>
    </html>