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

    echo 'Voir les statistiques d\'une autre année :<br /><br />';

    // formulaire permettant de choisir une date afin de voir les statistiques d'une autre année
    echo '<form action="./stat_annee.php" method="post">';
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

    echo 'Depuis la création du site, '.$total_pages_visitees_depuis_creation.' pages ont été visitées par '.$total_visiteur_depuis_debut.' visiteurs.<br /><br /><hr>';


    // on teste si $_POST['annee'] est vide et déclarée : si oui, c'est que l'on veut voir les statistiques de l'année en cours, sinon (elle n'est pas vide), c'est que l'on a remplit le formulaire qui précède afin de voir les statistiques d'une autre année

    if (!isset($_POST['annee'])) {
    	$date_annee = date("Y");
    }
    else {
    	if (empty($_POST['annee'])) {
    	$date_annee = date("Y");
    	}
    	else {
    	$date_annee = $_POST['annee'];
    	}
    }

    // on déclare un tableau ($visite_par_mois) qui aura 12 clés : de 0 à 11, chaque élément du tableau contiendra le nombre de pages vues pendant un mois (à la clé 0, on aura le nombre de pages vues au mois de janvier)
    $visite_par_mois = array();

    $sql = 'SELECT date FROM statistiques WHERE date LIKE "'.$date_annee.'%" ORDER BY date ASC';
    $result = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
    while ($data = mysql_fetch_array($result)) {
    	$date=$data['date'];

    	sscanf($date, "%4s-%2s-%2s %2s:%2s:%2s", $date_Y, $date_m, $date_d, $date_H, $date_i, $date_s);

    	if ($date_m < "10"){
    	$date_m = substr($date_m, -1);
    	}
    	$visite_par_mois[$date_m]=$visite_par_mois[$date_m]+1;
    }
    $total_pages_vu = mysql_num_rows($result);
    mysql_free_result($result);


    // on affiche le nombre de pages vues en fonction des mois
    echo '<br />Les statistiques de l\'année '.$date_annee.' : <br /><br />';

    for($i = 1; $i <= 12; $i++) {
    	if (!isset($visite_par_mois[$i])) {
    	echo 'Mois : '.$i.' : 0 page vue<br />';
    	}
    	else {
    	echo 'Mois : '.$i.' : '.$visite_par_mois[$i].' pages vues<br />';
    	}
    }


    // on calcule le nombre de visiteurs du mois
    $sql = 'SELECT DISTINCT(ip) FROM statistiques WHERE date LIKE "'.$date_annee.'%" ORDER BY date ASC';
    $result = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
    $total_visiteur = mysql_num_rows ($result);
    mysql_free_result($result);

    echo '<br />Soit un total de '.$total_pages_vu.' pages vues par '.$total_visiteur.' visiteurs.<br /><br />';


    // on recherche les pages qui ont été les plus vues sur le mois (on calcule au passage le nombre de fois qu'elles ont été vu)
    echo '<br />Les pages les plus vues :<br /><br />';

    $sql = 'SELECT distinct(page), count(page) as nb_page FROM statistiques WHERE date LIKE "'.$date_annee.'%" GROUP BY page ORDER BY nb_page DESC LIMIT 0,15';
    $result = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
    while ($data = mysql_fetch_array($result)) {
    	$nb_page = $data['nb_page'];
    	$page = $data['page'];
    	echo $nb_page.' '.$page.'<br />';
    }
    mysql_free_result($result);


    // on recherche les visiteurs qui ont été les plus connectes au site sur le mois (on calcule au passage le nombre de page qu'ils ont chargé)
    echo '<br />Les visiteurs les plus connectés :<br /><br />';

    $sql = 'SELECT distinct(host), count(host) as nb_host FROM statistiques WHERE date LIKE "'.$date_annee.'%" GROUP BY host ORDER BY nb_host DESC LIMIT 0,15';
    $result = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
    while ($data = mysql_fetch_array($result)) {
    	$nb_host = $data['nb_host'];
    	$host = $data['host'];
    	echo $nb_host.' '.$host.'<br />';
    }
    mysql_free_result($result);


    // on recherche les meilleurs referer sur l'année
    echo '<br />Les meilleurs referer :<br /><br />';

    $sql = 'SELECT distinct(referer), count(referer) as nb_referer FROM statistiques WHERE date LIKE "'.$date_annee.'%" AND referer!="" GROUP BY referer ORDER BY nb_referer DESC LIMIT 0,15';
    $result = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
    while ($data = mysql_fetch_array($result)) {
    	$nb_referer = $data['nb_referer'];
    	$referer = $data['referer'];
    	echo $nb_referer.' <a href="'.$referer.'" target="_blank">'.$referer.'</a><br />';
    }
    mysql_free_result($result);


    // on recherche les navigateurs et les OS utilisés par les visiteurs (on calcule au passage le nombre de page qui ont été chargés avec ces systèmes)
    echo '<br />Les navigateurs et OS :<br /><br />';

    $sql = 'SELECT distinct(navigateur), count(navigateur) as nb_navigateur FROM statistiques WHERE date LIKE "'.$date_annee.'%" GROUP BY navigateur ORDER BY nb_navigateur DESC LIMIT 0,15';
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