<?php
include("html/mainheader.html");
include("html/menu.html");
?>
<div id="page-wrapper">
<div class="main-page">
<?php
    if(isset($_POST['requete']) && $_POST['requete'] != NULL) 
    {
    $base = mysql_connect ('localhost', 'root', '');
    mysql_select_db ('adalys', $base) ;
    $requete = htmlentities($_POST['requete'], ENT_QUOTES); 
     
    $query = mysql_query("SELECT * FROM forum_sujets WHERE auteur LIKE '%$requete%' ORDER BY id DESC") or die (mysql_error()); 
    $nb_resultats = mysql_num_rows($query); 
    if($nb_resultats != 0) 
    {
    	
    ?>
    <h3>Résultats de votre recherche.</h3>
    <p>Nous avons trouvé <?php echo $nb_resultats; 
    if($nb_resultats > 1) { echo ' résultats '; } else { echo ' résultat '; } 
    ?>
    dans notre base de données. Voici les résultats que nous avons trouvé :<br/>
    <br/>
    <?php
    while($donnees = mysql_fetch_array($query)) 
    {
    ?>
    id: <?php echo $donnees['id']; ?></br>
    auteur: <?php echo $donnees['auteur']; ?></br>
    titre: <?php echo $donnees['titre']; ?></br>
    date_derniere_reponse: <?php echo $donnees['date_derniere_reponse']; ?></br>
    <?php
    } 
    ?><br/>
    <br/>
    <a href="recherche_forum.php">Faire une nouvelle recherche</a></p>
    <a href="./forum.php">Revenir au forum</a>
    <?php
    } 
    else
    { 
    ?>
    <h3>Pas de résultats</h3>
    <p>Nous n'avons trouvé aucun résultats pour votre requête "<?php echo $_POST['requete']; ?>". <a href="recherche_forum.php">Réessayez</a> avec autre chose.</p>
    <?php
    }
    mysql_close(); 
    }
    else
    { 
    ?>
    <p>Rechercher dans le forum (l'auteur du sujet)</p>
     <form action="<?php $_SERVER['PHP_SELF'] ?>" method="Post">
    <input type="text" name="requete" size="10">
    <input type="submit" value="Ok"></br>
    <a href="./forum.php">Revenir au forum</a></br>
    </form>
    <?php
    }
     
    ?>