<?php
include("html/mainheader.html");
include("html/menu.html");
?>
<div id="page-wrapper">
<div class="main-page">
    <html>
    <head>
    <title>Lecture d'un sujet</title>
    </head>
    <body>

    <?php
    if (!isset($_GET['id_sujet_a_lire'])) {
    	echo 'Sujet non défini.';
    }
    else {
    ?>
    	<table width="500" border="3"><tr>
    	<td>
    	Auteur
    	</td><td>
    	Messages
    	</td></tr>
    	<?php
    	// on se connecte à notre base de données
    	$base = mysql_connect ('localhost', 'root', '');
    	mysql_select_db ('adalys', $base) ;

    	// on prépare notre requête
    	$sql = 'SELECT auteur, message, date_reponse FROM forum_reponses WHERE correspondance_sujet="'.$_GET['id_sujet_a_lire'].'" ORDER BY date_reponse ASC';

    	// on lance la requête (mysql_query) et on impose un message d'erreur si la requête ne se passe pas bien (or die)
    	$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());

    	// on va scanner tous les tuples un par un
    	while ($data = mysql_fetch_array($req)) {

    	// on décompose la date
    	sscanf($data['date_reponse'], "%4s-%2s-%2s %2s:%2s:%2s", $annee, $mois, $jour, $heure, $minute, $seconde);

    	// on affiche les résultats
    	echo '<tr>';
    	echo '<td>';

    	// on affiche le nom de l'auteur de sujet ainsi que la date de la réponse
    	echo htmlentities(trim($data['auteur']));
    	echo '<br />';
    	echo $jour , '-' , $mois , '-' , $annee , ' ' , $heure , ':' , $minute;

    	echo '</td><td>';

    	// on affiche le message
    	echo nl2br(htmlentities(trim($data['message'])));
    	echo '</td></tr>';
    	}

    	// on libère l'espace mémoire alloué pour cette reqête
    	mysql_free_result ($req);
    	// on ferme la connection à la base de données.
    	mysql_close ();
    	?>

    	<!-- on ferme notre table html -->
    	</table>
    	<br /><br />
    	<!-- on insère un lien qui nous permettra de rajouter des réponses à ce sujet -->
    	<a href="./insert_reponse.php?numero_du_sujet=<?php echo $_GET['id_sujet_a_lire']; ?>">Répondre</a>
    	<?php
    }
    ?>
    <br /><br />
    <!-- on insère un lien qui nous permettra de retourner à l'accueil du forum -->
    <a href="./forum.php">Retour au forum</a>

    </body>
    </html>