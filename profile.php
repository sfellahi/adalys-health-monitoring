<?php
include("html/mainheader.html");
include("html/menu.html");
?>
<div id="page-wrapper">
<div class="main-page">
<?php 
//connexion au serveur:
$cnx = mysql_connect( "localhost", "root", "" );
//sélection de la base de données:
$db= mysql_select_db( "adalys" );
//création de la requête SQL:
$sql = "SELECT * FROM users ORDER BY id";
//exécution de notre requête SQL:
$requete = mysql_query( $sql, $cnx ) or die( "ERREUR MYSQL numéro: ".mysql_errno()."<br>Type de cette erreur: ".mysql_error()."<br>\n" );
//récupération avec mysql_fetch_array(), et affichage de nos résultats :


echo( "<table border=\"3\" cellpadding=\"5\" cellspacing=\"0\" align=\"left\">\n" );
echo( "<tr>
<td><div align=\"center\">id</div></td>
<td><div align=\"center\">nom</div></td>
<td><div align=\"center\">prenom</div></td>
<td><div align=\"center\">date_inscription</div></td>
<td><div align=\"center\">date_cloture</div></td>
<td><div align=\"center\">email</div></td>
<td><div align=\"center\">date_naissance</div></td>
</tr>" );
 
while( $result = mysql_fetch_array( $requete ) )
{
echo( "<tr>\n" );
echo( "<td><div align=\"center\">".$result["id"]."</div></td>\n" );
echo( "<td><div align=\"center\">".$result["nom"]."</div></td>\n" );
echo( "<td><div align=\"center\">".$result["prenom"]."</div></td>\n" );
echo( "<td><div align=\"center\">".$result["date_inscription"]."</div></td>\n" );
echo( "<td><div align=\"center\">".$result["date_cloture"]."</div></td>\n" );
echo( "<td><div align=\"center\">".$result["email"]."</div></td>\n" );
echo( "<td><div align=\"center\">".$result["date_naissance"]."</div></td>\n" );
echo( "</tr>\n" );
}
?>
</div>
</div>
<?php 
include("html/mainfooter.html");
echo( "</table><br>\n" );
?>

