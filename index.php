<?php 
include("html/mainheader.php");
$sql_nombre_projet='SELECT id_project FROM projects';
        $result_recup_nb_projet = mysqli_query($link,$sql_nombre_projet);
         $nb_projet = mysqli_num_rows($result_recup_nb_projet);
         
         
         $result = mysqli_query($link2,"SELECT MAX(id_formulaire) as maxi FROM formulaire");
         $row = mysqli_fetch_array($result);
         
         $result2 = mysqli_query($link2,"SELECT MAX(id_project) as max FROM projects");
         $row2 = mysqli_fetch_array($result2);
          
         $a = 0;
         $b =0;
         for($i=1;$i<= $row2['max'];$i++){
         	for($y=1;$y<= $row['maxi'];$y++){
         		$table = "donneeprojet".$i."formulaire".$y;
         		$s = mysqli_query($link,"SHOW TABLES LIKE '".$table."'");
         		if (mysqli_num_rows($s) == 1) {		
         					$arry[$a] = $table;			
         					$req= mysqli_query($link,"select nom,prenom from $table");				
         					while($data = mysqli_fetch_array($req))
         					{
         						$nom_complet = $data['nom']."  ".$data['prenom'];				
         						$ary[$b] = $nom_complet;
         						$b++;
         					
         					}	
         				}
         			$a++;
         			}
         		}
         
         $result = array_unique($ary);
         $c = count($result);
         
         $query = mysqli_query($link2,"SELECT count(*) as nb FROM users");
         $row3 = mysqli_fetch_array($query);
         $nb_users = $row3['nb'] -1 ;
         
         $query2 = mysqli_query($link2,"SELECT count(*) as nb_f FROM formulaire");
         $row4 = mysqli_fetch_array($query2);
         $nb_form = $row4['nb_f'];
         
?>
		<!-- //header-ends -->
		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page">
			
				<!-- four-grids -->
				<div class="row four-grids">
                                    	<div class="col-md-3 ticket-grid">
						<div class="tickets">
							<div class="grid-left">
								<div class="book-icon">
                                                                    <a href="list_project.php"><i class="fa fa-rocket"></i></a>
                                                                </div>
							</div>
							<div class="grid-right">
								<h3>Projets<span>Crées</span></h3>
								<p><?php echo $nb_projet; ?></p>
							</div>
							<div class="clearfix"> </div>
						</div>
					</div>
					<div class="col-md-3 ticket-grid">
						<div class="tickets">
							<div class="grid-left">
								<div class="book-icon">
									<i class="fa fa-book"></i>
								</div>
							</div>
							<div class="grid-right">
								<h3>Formulaires<span>créés</span></h3>
								<p><?php echo $nb_form; ?></p>
							</div>
							<div class="clearfix"> </div>
						</div>
					</div>
				
					<div class="col-md-3 ticket-grid">
						<div class="tickets">
							<div class="grid-left">
								<div class="book-icon">
									<i class="fa fa-bar-chart"></i>
								</div>
							</div>
							<div class="grid-right">
								<h3>Patients <span>enregistrés</span></h3>
								<p><?php echo $c; ?></p>
							</div>
							<div class="clearfix"> </div>
						</div>
					</div>
					<div class="col-md-3 ticket-grid">
						<div class="tickets">
							<div class="grid-left">
								<div class="book-icon">
									<i class="fa fa-user"></i>
								</div>
							</div>
							<div class="grid-right">
								<h3>Membres <span>abonnées</span></h3>
								<p><?php echo $nb_users; ?></p>
							</div>
							<div class="clearfix"> </div>
						</div>
					</div>
					<div class="clearfix"> </div>
				</div>
			</div>
		</div>
<?php include("html/mainfooter.html");?>