<?php
include('html/mainheader.php');
?>
<div id="page-wrapper">
            <div class="main-page">
                <div class="row">
<?php
$id=$_GET['parent'];
?>

<table class="flat-table" border="0" id="tableprojet" cellspacing="0">
    <tr>
    	<th>Liste des personnes lié au projet</th>
        <th>Lié un médecin</th>
        <th>Action</th>
    </tr> 

<td>
<?php
$dn1 = mysqli_query($link,'select id_user from project_user where id_project = "'.$id.'" and user_accept="yes"');
while($dnn1 = mysqli_fetch_array($dn1)){
	$dn3 = mysqli_query($link,'select nom, prenom from users where id = "'.$dnn1['id_user'].'"');
	$dnn3 = mysqli_fetch_array($dn3);
	echo $dnn3['nom'] ." ". $dnn3['prenom'];?><br><?php
}
?>
</td>
 		<form action="user_project.php?parent=<?php echo $id; ?>" method="post">
 			<td><select name="medecin">
 			<?php
 		$dn2 = mysqli_query($link,'select id, nom, prenom from users where profil = "medecin"'); 
 		while($dnn2 = mysqli_fetch_array($dn2)){
 			?>
		  	<option value="<?php echo $dnn2['id']; ?>"><?php echo $dnn2['nom'] ." ". $dnn2['prenom'] ; ?></option>
		  	<?php 
    		}
			?>
			</select>
			</td>
		
 			<td><button type="submit">Lié</button></td>
 		</form>			
    </tr>
</table>
<?php include("html/mainfooter.html");?>