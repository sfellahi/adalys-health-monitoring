<?php
include("html/mainheader.php");
// Connexion au serveur MySQL

// mysql_connect(DB_SERVER, SERVER_USER, SERVER_PASSWORD);


		$link = mysqli_connect("localhost", "root", "root","maladie2");
		if (mysqli_connect_errno())
  {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
     

$array_test=array();

echo $recup_question="SELECT id_question,type_question,id_type,colonne_assoc FROM ordre_question ORDER BY id_question ASC";

$resultat_recup_question=mysqli_query($link,$recup_question) or die(mysqli_error($link)); 
 while($temp_recup_question = mysqli_fetch_assoc($resultat_recup_question)){
 

	

	if($temp_recup_question['type_question']=='checkbox'){
		
		
	$array_test[]=$temp_recup_question['colonne_assoc'];	
	}
 else{

 	$array_test[]=$temp_recup_question['colonne_assoc']; 
 }
 
 }
 
$aaa=count($array_test);


$ajout_sql="INSERT INTO donnee (".$array_test[0]."";
$test=1;
while($test<$aaa){
$ajout_sql.=",".$array_test[$test]."";

$test++;
}
$ajout_sql.=") VALUE ('".$_POST[$array_test[0]]."'";
$test2=1;
while($test2<$aaa){
$ajout_sql.=",'".$_POST[$array_test[$test2]]."'";

$test2++;
}
$ajout_sql.=")";
echo $ajout_sql;
mysqli_query($link,$ajout_sql) or die(mysqli_error($link));

include("html/mainfooter.html");