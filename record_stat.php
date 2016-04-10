    <?php
include("html/mainheader.html");
include("html/menu.html");
?>
<div id="page-wrapper">
<div class="main-page">
    <?php
    // récupération de l'heure courante
    $date_courante = date("Y-m-d H:i:s");

    // récupération de l'adresse IP du client (on cherche d'abord à savoir si il est derrière un proxy)
    if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    elseif(isset($_SERVER['HTTP_CLIENT_IP'])) {
      $ip  = $_SERVER['HTTP_CLIENT_IP'];
    }
    else {
      $ip = $_SERVER['REMOTE_ADDR'];
    }
    // récupération du domaine du client
    $host = gethostbyaddr($ip);

    // récupération du navigateur et de l'OS du client
    $navigateur = $_SERVER['HTTP_USER_AGENT'];

    // récupération du REFERER
    if (isset($_SERVER['HTTP_REFERER'])) {
    	if (eregi($_SERVER['HTTP_HOST'], $_SERVER['HTTP_REFERER'])) {
    	$referer ='';
    	}
    	else {
    	$referer = $_SERVER['HTTP_REFERER'];
    	}
    }
    else {
      $referer ='';
    }

    // récupération du nom de la page courante ainsi que ses arguments
    if ($_SERVER['QUERY_STRING'] == "") {
      $page_courante = $_SERVER['PHP_SELF'];
    }
    else {
      $page_courante = $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
    }

    // connexion à la base de données
$base = mysql_connect('localhost', 'root', '');
    mysql_select_db('adalys', $base);

    // insertion des éléments dans la base de données
    $sql = 'INSERT INTO statistiques VALUES("", "'.$date_courante.'", "'.$page_courante.'", "'.$ip.'", "'.$host.'", "'.$navigateur.'", "'.$referer.'")';
    mysql_query($sql) or die('Erreur : '.$sql.'<br />'.mysql_error());

    // fermeture de la connexion à la base de données
    mysql_close();
    ?>