<?php
include("html/mainheader.html");
include("html/menu.html");
?>
<div id="page-wrapper">
<div class="main-page">
    <?php
    // on teste si le formulaire a été soumis
    if (isset ($_POST['go']) && $_POST['go']=='Poster') {
    	// on teste le contenu de la variable $auteur
    	if (!isset($_POST['auteur']) || !isset($_POST['message']) || !isset($_GET['numero_du_sujet'])) {
    	$erreur = 'Les variables nécessaires au script ne sont pas définies.';
    	}
    	else {
    	if (empty($_POST['auteur']) || empty($_POST['message']) || empty($_GET['numero_du_sujet'])) {
    		$erreur = 'Au moins un des champs est vide.';
    	}
    	// si tout est bon, on peut commencer l'insertion dans la base
    	else {
    		// on se connecte à notre base de données
    		$base = mysql_connect ('localhost', 'root', '');
    		mysql_select_db ('adalys', $base) ;

    		// on recupere la date de l'instant présent
    		$date = date("Y-m-d H:i:s");

    		// préparation de la requête d'insertion (table forum_reponses)
    		$sql = 'INSERT INTO forum_reponses VALUES("", "'.mysql_escape_string($_POST['auteur']).'", "'.mysql_escape_string($_POST['message']).'", "'.$date.'", "'.$_GET['numero_du_sujet'].'")';
    		echo'<a href="./forum.php">Retour au forum</a>';
    		// on lance la requête (mysql_query) et on impose un message d'erreur si la requête ne se passe pas bien (or die)
    		mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());

    		// préparation de la requête de modification de la date de la dernière réponse postée (dans la table forum_sujets)
    		$sql = 'UPDATE forum_sujets SET date_derniere_reponse="'.$date.'" WHERE id="'.$_GET['numero_du_sujet'].'"';

    		// on lance la requête (mysql_query) et on impose un message d'erreur si la requête ne se passe pas bien (or die)
    		mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());

    		// on ferme la connexion à la base de données
    		mysql_close();

    		// on redirige vers la page de lecture du sujet en cours
    		header('Location: lire_sujet.php?id_sujet_a_lire='.$_GET['numero_du_sujet']);

    		// on termine le script courant
    		exit;
    	}
    	}
    }
    ?>

    <html>
    <head>
    <title>Insertion d'une nouvelle réponse</title>
    </head>

    <body>

    <!-- on fait pointer le formulaire vers la page traitant les données -->
    <form action="insert_reponse.php?numero_du_sujet=<?php echo $_GET['numero_du_sujet']; ?>" method="post">
    <table>
    <tr><td>
    Auteur :
    </td><td>
    <input type="text" name="auteur" maxlength="30" size="50" value="<?php if (isset($_POST['auteur'])) echo htmlentities(trim($_POST['auteur'])); ?>">
    </td></tr><tr><td>
    Message :
    </td><td>
    <textarea name="message" cols="50" rows="10"><?php if (isset($_POST['message'])) echo htmlentities(trim($_POST['message'])); ?></textarea>
    </td></tr><tr><td><td align="right">
    <input type="submit" name="go" value="Poster">
    </td></tr></table>
    </form>
    <?php
    if (isset($erreur)) echo '<br /><br />',$erreur;
    ?>
    <a href="./forum.php">Retour au forum</a>
    </body>
    </html>