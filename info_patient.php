<?php
include('html/mainheader.php');

function mysqli_field_name($result, $field_offset)
{
	$properties = mysqli_fetch_field_direct($result, $field_offset);
	return is_object($properties) ? $properties->name : null;
}

if(isset($_POST['formulaire']) and isset($_POST['project'])){
	$id_form = $_POST['formulaire'];
	$id_projet = $_POST['project'];

	$table = "donneeprojet".$id_projet."formulaire".$id_form;
	// fetch mysql table rows
	$sql = "select * from $table";
	$result = mysqli_query($link, $sql) or die("Selection Error " . mysqli_error($link));


    
    $numfields = mysqli_num_fields($result);
    ?>
    <div id="page-wrapper">
    <div class="main-page">
    <?php 
    echo "<table>\n<tr>";
    
    for ($i=0; $i < $numfields; $i++) // Header
    { echo '<th>'.mysqli_field_name($result, $i).'</th>'; }
    
    echo "</tr>\n";
    
    while ($row = mysqli_fetch_row($result)) // Data
    { echo '<tr><td>'.implode($row,'</td><td>')."</td></tr>\n"; }
    
    echo "</table>\n";?>
    </div></div><?php
    
	if ($i==0) {
		?>
					<div id="page-wrapper">
					<div class="main-page">Il n'y a pas de donnée remplie </div></div>
					<?php
	}
    
mysqli_close($link);
}


include("html/mainfooter.html");?>