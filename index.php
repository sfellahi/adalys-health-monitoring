<?php 
// Cacher les warnings
ini_set("display_errors",0);error_reporting(0);
include("html/mainheader.php");
$sql_nombre_projet='SELECT id_project FROM projects';
        $result_recup_nb_projet = mysqli_query($link,$sql_nombre_projet);
         $nb_projet = mysqli_num_rows($result_recup_nb_projet);
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
								<h3>Patients <span>enregistrés</span></h3>
								<p>452</p>
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
								<h3>Notre <span>status</span></h3>
								<p>125</p>
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
								<h3>Membres <span>connectés</span></h3>
								<p>6</p>
							</div>
							<div class="clearfix"> </div>
						</div>
					</div>
					<div class="clearfix"> </div>
				</div>
			</div>
		</div>
<?php include("html/mainfooter.html");?>