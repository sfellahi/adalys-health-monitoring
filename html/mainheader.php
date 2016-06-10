<?php
include ('config.php');

if (empty ( $_SESSION ['email'] )) {
	header ( 'Location: login.php' );
}
?>

<!DOCTYPE HTML>
<html>
<head>
<style media="print" type="text/css">
.noImpr {
	display: none;
}
</style>
<title>Adalys</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords"
	content="Baxster Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<!-- font CSS -->
<link rel="icon" href="favicon.ico" type="image/x-icon">
<!-- font-awesome icons -->
<link href="css/font-awesome.css" rel="stylesheet">
<!-- //font-awesome icons -->
<!-- chart -->
<script src="js/Chart.js"></script>
<!-- //chart -->
<!-- js-->
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/modernizr.custom.js"></script>
<!--webfonts-->
<link
	href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic'
	rel='stylesheet' type='text/css'>
<!--//webfonts-->
<!--animate-->
<link href="css/animate.css" rel="stylesheet" type="text/css"
	media="all">
<script src="js/wow.min.js"></script>
<script>
		 new WOW().init();
	</script>
<!--//end-animate-->
<!-- Metis Menu -->
<script src="js/metisMenu.min.js"></script>
<script src="js/custom.js"></script>
<link href="css/custom.css" rel="stylesheet">
<link href="css/tablestyle.css" rel="stylesheet">
<!--//Metis Menu -->
</head>
<body class="cbp-spmenu-push">
	<div class="main-content">
		<!-- header-starts -->
		<div class="sticky-header header-section ">
			<div class="header-left">
				<!--logo -->
				<div class="logo">
					<a href="index.php" class="noImpr">
						<ul>
							<li><img src="images/logo1.png" alt="" /></li>
							<li><h1>Adalys</h1></li>
							<div class="clearfix"></div>
						</ul>
					</a>
				</div>
				<?php
				if (isset ( $_SESSION ['email'] )) {
					$req = $link->query ( 'select m1.id, m1.title, m1.timestamp, count(m2.id) as reps, users.id as userid, users.email from pm as m1, pm as m2,users where ((m1.user1="' . $_SESSION ['userid'] . '" and m1.user1read="no" and users.id=m1.user2) or (m1.user2="' . $_SESSION ['userid'] . '" and m1.user2read="no" and users.id=m1.user1)) and m1.id2="1" and m2.id=m1.id group by m1.id order by m1.id desc' );
					$req2 = $link->query ( 'select m1.id, m1.title, m1.timestamp, count(m2.id) as reps, users.id as userid, users.email from pm as m1, pm as m2,users where ((m1.user1="' . $_SESSION ['userid'] . '" and m1.user1read="yes" and users.id=m1.user2) or (m1.user2="' . $_SESSION ['userid'] . '" and m1.user2read="yes" and users.id=m1.user1)) and m1.id2="1" and m2.id=m1.id group by m1.id order by m1.id desc' );
					$req3 = $link->query ( 'select count(*) as nb_new_pm from pm where ((user1="' . $_SESSION ['userid'] . '" and user1read="no") or (user2="' . $_SESSION ['userid'] . '" and user2read="no")) and id2="1"' );
					$nb_new_pm = mysqli_fetch_array ( $req3 );
					$nb_new_pm = $nb_new_pm ['nb_new_pm'];
				}
				?>
				<!--//logo-->
				<div class="header-right header-right-grid noImpr">
					<div class="profile_details_left">
						<!--notifications of menu start -->
						<ul class="nofitications-dropdown">
							<li class="dropdown head-dpdn"><a href="#"
								class="dropdown-toggle" data-toggle="dropdown"><i
									class="fa fa-envelope"></i><span class="badge"><?php echo $nb_new_pm; ?></span></a>
								<ul class="dropdown-menu anti-dropdown-menu">
									<li>
										<div class="notification_header">
											<h3>Vous avez <?php echo $nb_new_pm; ?> messages</h3>
										</div>
									</li>
									<?php
									if ($nb_new_pm != 0) {
										while ( $dn1 = mysqli_fetch_array ( $req ) ) {
											$newtext = wordwrap ( $dn1 ['title'], 20, "<br />\n" );
											?>
									<li><a href="read_pm.php?id=<?php echo $dn1['id']; ?>">
											<div class="user_img">
												<img src="upload/users/<?php echo $dn1['userid'];?>.jpg"
													alt="">
											</div>
											<div class="notification_desc">
												<p><?php echo $newtext; ?></p>
											</div>
											<div class="clearfix"></div>
									</a></li>
									<?php
										}
									} else {
										?>	<li><div class="notification_desc">
											<p>Vous n'avez aucun nouveau message</p>
										</div>
										<div class="clearfix"></div></li><?php
									}
									?>
									<li>
										<div class="notification_bottom">
											<a href="list_pm.php">See all messages</a>
										</div>
									</li>
								</ul></li>
							<?php
							if (isset ( $_SESSION ['email'] )) {
								$req4 = $link->query ( 'select count(*) as notif from project_user where id_user ="' . $_SESSION ['userid'] . '" and user_read ="no"' );
								$nb_notif = mysqli_fetch_array ( $req4 );
								$nb_new_notif = $nb_notif ['notif'];
							}
							?>
							<li class="dropdown head-dpdn"><a href="#"
								class="dropdown-toggle" data-toggle="dropdown"
								aria-expanded="false"><i class="fa fa-bell"></i><span
									class="badge blue"><?php echo $nb_new_notif; ?></span></a>
								<ul class="dropdown-menu anti-dropdown-menu">
									<li>
										<div class="notification_header">
											<h3>Vous avez <?php echo $nb_new_notif; ?> notification</h3>
										</div>
									</li>
									<?php
									if ($nb_new_notif != 0) {
										
										$req5 = $link->query ( 'select id_project, id_project_user from project_user where id_user ="' . $_SESSION ['userid'] . '" and user_read ="no"' );
										while ( $dn4 = mysqli_fetch_array ( $req5 ) ) {
											$req6 = $link->query ( 'select nom_project from projects where id_project ="' . $dn4 ['id_project'] . '"' );
											$nom_projet = mysqli_fetch_array ( $req6 );
											$message1 = "Une demande d'association du projet '" . $nom_projet ['nom_project'] . "' vous a été associé";
											$newtext1 = wordwrap ( $message1, 26, "<br />\n" );
											?>
										<li><a href="accept_notif.php?parent=<?php echo $dn4['id_project_user']; ?>">
											<div class="notification_desc">
												<p><?php echo $newtext1; ?></p>
											</div>
											<div class="clearfix"></div>
									</a></li>
										<?php
										}
									} else {
										?>
										<li>
										<div class="notification_desc">
											<p>Vous n'avez aucune notification en cours</p>
										</div>
										<div class="clearfix"></div>
									</li>
																			 <?php
									}
									?>
									<div class="notification_bottom"></div>
									<li></li>
								</ul></li>

						</ul>
						<div class="clearfix"></div>
					</div>
				</div>


				<div class="clearfix"></div>
			</div>
			<!--search-box-->
			<div class="search-box noImpr">
				<form class="input">
					<input class="sb-search-input input__field--madoka"
						placeholder="Search..." type="search" id="input-31" />
				</form>
			</div>
			<!--//end-search-box-->
			<div class="header-right noImpr">

				<!--notification menu end -->
				<div class="profile_details">
					<ul>
						<li class="dropdown profile_details_drop"><a href="#"
							class="dropdown-toggle" data-toggle="dropdown"
							aria-expanded="false">
								<div class="profile_img">
									<span class="prfil-img"><img
										src="upload/users/<?php echo $_SESSION['userid'];?>.jpg" alt=""> </span>
									<div class="clearfix"></div>
								</div>
						</a>

							<ul class="dropdown-menu drp-mnu">
								<li><a href="edit_profile.php"><i class="fa fa-cog"></i> Options</a>
								</li>
								<li><a href="profile.php?id=<?php echo $_SESSION['userid']; ?>"><i
										class="fa fa-user"></i> Mon profil</a></li>
								<li><a href="logout.php"><i class="fa fa-sign-out"></i> Se déconnecter</a></li>
							</ul></li>
					</ul>
				</div>
				<!--toggle button start-->
				<button id="showLeftPush">
					<i class="fa fa-bars"></i>
				</button>
				<!--toggle button end-->
				<div class="clearfix"></div>
			</div>
			<div class="clearfix"></div>
		</div>

		<!--left-fixed -navigation-->
		<div class="sidebar noImpr" role="navigation">
			<div class="navbar-collapse">
				<nav
					class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right dev-page-sidebar mCustomScrollbar _mCS_1 mCS-autoHide mCS_no_scrollbar"
					id="cbp-spmenu-s1">
					<div class="scrollbar scrollbar1">
						<ul class="nav" id="side-menu">
							<li><a href="index.php" class="active"><i
									class="fa fa-home nav_icon"></i>Accueil</a></li>
							 
						 <?php
							
if ($_SESSION ['profil'] == "super_admin") {
								?>
							
                                                        <li>
								<!-- /nav-second-level --> <a href="#"><i
									class="fa fa-book nav_icon"></i>Administration<span
									class="fa arrow"></span></a>
								<ul class="nav nav-second-level collapse">
									<li><a href="administration_modification.php">Modifier les profils</a></li>
									<li><a href="administration_suppression.php">Supprimer les profils</a></li>
								</ul>
							</li>
							
							
                            <?php
							}
							?>
						<?php
						if ($_SESSION ['profil'] == "admin") {
							?>
                                                        
							<li><a href="#"><i class="fa fa-file-text-o nav_icon"></i>Projets<span
									class="fa arrow"></span></a> <!-- //nav-second-level -->
								<ul class="nav nav-second-level collapse">
									<li><a href="new_project.php">Créer un projet</a></li>
									<li><a href="list_project.php">Liste des projets</a></li>
								</ul> <!-- //nav-second-level --></li>
                                                        <?php
						
}
						
						if ($_SESSION ['profil'] == "medecin") {
							$sql_select_projet_associé = "SELECT project_user.user_accept,
projects.id_project,projects.nom_project,projects.nombre_patient,
users.id,users.email,users.profil
FROM project_user LEFT JOIN projects ON project_user.id_project=projects.id_project
LEFT JOIN users ON project_user.id_user=users.id WHERE project_user.user_accept='yes' AND users.email='" . $_SESSION ['email'] . "'";
							$result_projet_en_cours = mysqli_query ( $link, $sql_select_projet_associé );
							while ( $temp_projet_medecin = mysqli_fetch_array ( $result_projet_en_cours ) ) {
							?>	
								<li>
                                                                <a href="#"><i class="fa fa-file-text-o nav_icon"></i>Projets <?php echo $temp_projet_medecin['nom_project'];?><span class="fa arrow"></span></a>        
                                                                <!-- //nav-second-level -->
                                                                <ul class="nav nav-second-level collapse">
                                                                 <li>
                                                                
                                                                <a href="#"><i class="fa fa-user-md nav_icon"></i>Ajouters des patients<span class="fa arrow"></span></a>
                                                                   <ul class="nav nav-third-level collapse">
                                                                                                                                            
                                                                  <?php $sql_formulaire="SELECT project_formulaire.id_formulaire,formulaire.nom_formulaire,etat_formulaire ";
                                                                                                                                                    $sql_formulaire.="FROM project_formulaire LEFT JOIN formulaire ";
                                                                                                                                                    $sql_formulaire.="ON project_formulaire.id_formulaire=formulaire.id_formulaire ";
                                                                                                                                                    $sql_formulaire.="WHERE etat_formulaire!='En création' "; 
                                                                                                                                                    $result_liste_formulaire=mysqli_query($link, $sql_formulaire);
                                                                                                                                                    while($temp_formulaire_en_cours=  mysqli_fetch_array($result_liste_formulaire)){
                                                                                                                                                        
                                                                                                                                                   
                                                                                                                                            
                                                                                                                                            
                                                                                                                                            ?>
                                                                                                                                        <li style="margin-left:40px;">
                                                                                                                                            <form action="ajout_patient.php" method="POST">
                                                                                                                                                <input type="hidden" id="formulaire" name="formulaire" value="<?php echo $temp_formulaire_en_cours['id_formulaire']; ?>">                                                                                                                                               
                                                                  <input type="submit" style="background-color:transparent;color:white;border:none;padding-top:7px;margin-left:45px;font-size:90%" value="Formulaire <?php echo $temp_formulaire_en_cours['nom_formulaire']; ?>">
                                                                                                                                            </form>
                                                                 </li>
                                                                                                                            
                                                                                                                                                    <?php } ?>
                                                                                                                                        </ul>
                                                                                                                        
                                                                 </li>
                                                                 <li>
                                                                  <a href="#"><i class="fa fa-hospital-o nav_icon"></i>Liste des patients<span class="fa arrow"></span></a>
                                                                  <ul class="nav nav-third-level collapse">
                                                                  
                                                                  <?php $sql_formulaire="SELECT project_formulaire.id_formulaire,project_formulaire.id_project,formulaire.nom_formulaire,etat_formulaire ";
                                                                                                                                                    $sql_formulaire.="FROM project_formulaire LEFT JOIN formulaire ";
                                                                                                                                                    $sql_formulaire.="ON project_formulaire.id_formulaire=formulaire.id_formulaire ";
                                                                                                                                                    $sql_formulaire.="WHERE etat_formulaire!='En création' "; 
                                                                                                                                                    $result_liste_formulaire=mysqli_query($link, $sql_formulaire);
                                                                                                                                                    while($temp_formulaire_en_cours=  mysqli_fetch_array($result_liste_formulaire)){
                                                                                                                                                        
                                                                                                                                                   
                                                                                                                                            
                                                                                                                                            
                                                                                                                                            ?>
                                                                                                                                            <li style="margin-left:40px;">
                                                                  <form action="info_patient.php" method="POST">
                                                                                                                                            <input type="hidden" id="project" name="project" value="<?php echo $temp_formulaire_en_cours['id_project']; ?>">
                                                                                                                                                <input type="hidden" id="formulaire" name="formulaire" value="<?php echo $temp_formulaire_en_cours['id_formulaire']; ?>">                                                                                                                                               
                                                                  <input type="submit" style="background-color:transparent;color:white;border:none;padding-top:7px;margin-left:45px;font-size:90%" value="Formulaire <?php echo $temp_formulaire_en_cours['nom_formulaire']; ?>">
                                                                                                                                            </form>
                                                                 </li>
                                                                 <?php } ?>
                                                                </ul></ul>
                                                                <!-- //nav-second-level -->
                                                               </li>
                                                                                                                                <?php }
                                                                                                                                
                                                                                                                                }
							
                                                                                                                                ?>
							<li><a href="#"><i class="fa fa-archive nav_icon"></i>Exporter un
								formulaire<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level collapse">
								<?php
								
$sql_formulaire2 = "SELECT project_formulaire.id_formulaire,project_formulaire.id_project,formulaire.nom_formulaire,etat_formulaire ";
								$sql_formulaire2 .= "FROM project_formulaire LEFT JOIN formulaire ";
								$sql_formulaire2 .= "ON project_formulaire.id_formulaire=formulaire.id_formulaire ";
								$result_liste_formulaire2 = mysqli_query ( $link, $sql_formulaire2 );
								while ( $temp_formulaire_en_cours2 = mysqli_fetch_array ( $result_liste_formulaire2 ) ) {
									?>
									<li style="margin-left: 40px;">
									<form action="export_csv.php" method="POST">
										<input type="hidden" id="formulaire" name="formulaire"
											value="<?php echo $temp_formulaire_en_cours2['id_formulaire']; ?>">
										<input type="hidden" id="project" name="project"
											value="<?php echo $temp_formulaire_en_cours2['id_project']; ?>">
										<input type="submit"
											style="background-color: transparent; color: white; border: none; padding-top: 7px; margin-left: 45px; font-size: 90%"
											value="Formulaire <?php echo $temp_formulaire_en_cours2['nom_formulaire']; ?>">
									</form>
								</li>
									<?php
								}
								?>
								</ul></li>
						
						<?php
						
						if (isset ( $_SESSION ['email'] )) {
							
							?>
							
							<li><a href="#"><i class="fa fa-envelope nav_icon"></i>Email<span
								class="fa arrow"></span></a>
							<ul class="nav nav-second-level collapse">
								<li><a href="list_pm.php">Boite de reception(<?php echo $nb_new_pm; ?>)</a>
								</li>
								<li><a href="new_pm.php">Envoyer un email</a></li>
							</ul> <!-- //nav-second-level --></li>
							<?php
						}
						?>
							<li><a href="forum.php" class="community-nav"><i
								class="fa fa-users nav_icon"></i>Communaut&eacute</a></li>


						</ul>
					</div>
					<!-- //sidebar-collapse -->
				</nav>
			</div>
		</div>
		<!--left-fixed -navigation-->