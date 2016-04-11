   <?php
include("html/mainheader.html");
include("html/menu.html");
?>
<div id="page-wrapper">
<div class="main-page">
 <html>
    <head>
    <title>Statistiques</title>
    </head>

    <body>
    <?php
    // connexion à la base de donnée
$base = mysql_connect('localhost', 'root', '');
    mysql_select_db('adalys', $base);

    // on écrit des liens permettant de naviguer entre les différentes pages de notre partie administration
    echo '<a href="./stat_jour.php">Les stats du jour</a><br />';
    echo '<a href="./stat_mois.php">Les stats du mois</a><br />';
    echo '<a href="./stat_annee.php">Les stats de l\'année</a><br /><br />';

    echo '- Voir les statistiques d\'un autre mois :<br /><br />';

    // formulaire permettant de choisir une date afin de voir les statistiques de cette date
    echo '<form action="./stat_mois.php" method="post">';
    echo '<select name="mois">';
    // on boucle sur 12 mois
    for($i = 1; $i <= 12; $i++) {
    	if ($i < "10") {
    	echo '<option>0'.$i.'</option>';
    	}
    	else {
    	echo '<option>'.$i.'</option>';
    	}
    }
    echo '</select>';

    echo '&nbsp;&nbsp;';

    echo '<select name="annee">';
    // on boucle sur 7 ans (à modifier à souhait)
    for($i = 2003; $i <= 2030; $i++) {
    	echo '<option>'.$i.'</option>';
    }
    echo '</select>';

    echo '<br /><br />';

    echo '<input type="submit" value="Voir">';
    echo '</form>';


    // on cherche le nombre de pages visitées depuis le début (création du site)
    $select = 'SELECT id FROM statistiques';
    $result = mysql_query($select) or die ('Erreur : '.mysql_error() );
    $total_pages_visitees_depuis_creation = mysql_num_rows($result);
    mysql_free_result($result);

    // on cherche le nombre de visiteurs depuis le début (création du site)
    $sql = 'SELECT DISTINCT(ip) FROM statistiques';
    $result = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
    $total_visiteur_depuis_debut = mysql_num_rows ($result);
    mysql_free_result($result);

    echo '- Depuis la création du site, '.$total_pages_visitees_depuis_creation.' pages ont été visitées par '.$total_visiteur_depuis_debut.' visiteurs.<br /><br /><hr>';


    // on teste si $_POST['mois'], $_POST['annee'] sont vides et déclarées : si oui, c'est que l'on veut voir les statistiques du mois en cours, sinon (elles ne sont pas vides), c'est que l'on a remplit le formulaire qui suit afin de voir les statistiques d'un autre mois

    if (!isset($_POST['mois']) || !isset($_POST['annee'])) {
    	$date_mois = date("Y-m");
    }
    else {
    	if (empty($_POST['mois']) && empty($_POST['annee'])) {
    	$date_mois = date("Y-m");
    	}
    	else {
    	$date_mois = $_POST['annee'].'-'.$_POST['mois'];
    	}
    }

    // on déclare un tableau ($visite_par_jour) qui aura 31 clés : de 0 à 30, chaque élément du tableau contiendra le nombre de pages vues pendant un jour (à la clé 0, on aura le nombre de pages vues le 1 er du mois)
    $visite_par_jour = array();

    $sql = 'SELECT date FROM statistiques WHERE date LIKE "'.$date_mois.'%" ORDER BY date ASC';
    $result = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
    while ($data = mysql_fetch_array($result)) {
    	$date=$data['date'];

    	sscanf($date, "%4s-%2s-%2s %2s:%2s:%2s", $date_Y, $date_m, $date_d, $date_H, $date_i, $date_s);

    	if ($date_d < "10"){
    	$date_d = substr($date_d, -1);
    	}
    	$visite_par_jour[$date_d]=$visite_par_jour[$date_d]+1;
    }
    $total_pages_vu = mysql_num_rows($result);
    mysql_free_result($result);

    sscanf($date_mois, "%4s-%2s-%2s %2s:%2s:%2s", $date_Y, $date_m, $date_d, $date_H, $date_i, $date_s);

    // on affiche le nombre de pages vues en fonction des jours
    echo '<br />- Les statistiques du '.$date_m.'/'.$date_Y.' : <br /><br />';

    for($i = 1; $i <= 31; $i++) {
    	if (!isset($visite_par_jour[$i])) {
    	echo 'le '.$i.' : 0 page vue<br />';
    	}
    	else {
    	echo 'le '.$i.' : '.$visite_par_jour[$i].' pages vues<br />';
    	}
    }


    // on calcule le nombre de visiteurs du mois
    $sql = 'SELECT DISTINCT(ip) FROM statistiques WHERE date LIKE "'.$date_mois.'%" ORDER BY date ASC';
    $result = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
    $total_visiteur = mysql_num_rows ($result);
    mysql_free_result($result);

    echo '<br /> - Soit un total de '.$total_pages_vu.' pages vues par '.$total_visiteur.' visiteurs.<br /><br />';


    // on recherche les pages qui ont été les plus vues sur le mois (on calcule au passage le nombre de fois qu'elles ont été vu)
    echo '<br />- Les pages les plus vues :<br /><br />';

    $sql = 'SELECT distinct(page), count(page) as nb_page FROM statistiques WHERE date LIKE "'.$date_mois.'%" GROUP BY page ORDER BY nb_page DESC LIMIT 0,15';
    $result = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
    while ($data = mysql_fetch_array($result)) {
    	$nb_page = $data['nb_page'];
    	$page = $data['page'];
    	echo $nb_page.' '.$page.'<br />';
    }
    mysql_free_result($result);


    // on recherche les visiteurs qui ont été les plus connectes au site sur le mois (on calcule au passage le nombre de page qu'ils ont chargé)
    echo '<br />- Les visiteurs les plus connectés :<br /><br />';

    $sql = 'SELECT distinct(host), count(host) as nb_host FROM statistiques WHERE date LIKE "'.$date_mois.'%" GROUP BY host ORDER BY nb_host DESC LIMIT 0,15';
    $result = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
    while ($data = mysql_fetch_array($result)) {
    	$nb_host = $data['nb_host'];
    	$host = $data['host'];
    	echo $nb_host.' '.$host.'<br />';
    }
    mysql_free_result($result);


    // on recherche les meilleurs  referer sur le mois
    echo '<br />- Les meilleurs referer :<br /><br />';

    $sql = 'SELECT distinct(referer), count(referer) as nb_referer FROM statistiques WHERE date LIKE "'.$date_mois.'%" AND referer!="" GROUP BY referer ORDER BY nb_referer DESC LIMIT 0,15';
    $result = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
    while ($data = mysql_fetch_array($result)) {
    	$nb_referer = $data['nb_referer'];
    	$referer = $data['referer'];
    	echo $nb_referer.' <a href="'.$referer.'" target="_blank">'.$referer.'</a><br />';
    }
    mysql_free_result($result);


    // on recherche les navigateurs et les OS utilisés par les visiteurs (on calcule au passage le nombre de page qui ont été chargés avec ces systèmes)
    echo '<br />- Les navigateurs et OS :<br /><br />';

    $sql = 'SELECT distinct(navigateur), count(navigateur) as nb_navigateur FROM statistiques WHERE date LIKE "'.$date_mois.'%" GROUP BY navigateur ORDER BY nb_navigateur DESC LIMIT 0,15';
    $result = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
    while ($data = mysql_fetch_array($result)) {
    	$nb_navigateur = $data['nb_navigateur'];
    	$navigateur = $data['navigateur'];
    	echo $nb_navigateur.' '.$navigateur.'<br />';
    }
    mysql_free_result($result);
    mysql_close();
    ?>
    </body>
    </html>