<?php
include('config.php');

if(empty($_SESSION['email'])){    
    header('Location: login.php');

}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Adalys</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Baxster Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<!-- font CSS -->
<link rel="icon" href="favicon.ico" type="image/x-icon" >
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
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
<!--//webfonts--> 
<!--animate-->
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
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
					<a href="index.php">
						<ul>	
							<li><img src="images/logo1.png" alt="" /></li>
							<li><h1>Adalys</h1></li>
							<div class="clearfix"> </div>
						</ul>
					</a>
				</div>
				<?php
										if(isset($_SESSION['email']))
											{
											$req=$link->query('select m1.id, m1.title, m1.timestamp, count(m2.id) as reps, users.id as userid, users.email from pm as m1, pm as m2,users where ((m1.user1="'.$_SESSION['userid'].'" and m1.user1read="no" and users.id=m1.user2) or (m1.user2="'.$_SESSION['userid'].'" and m1.user2read="no" and users.id=m1.user1)) and m1.id2="1" and m2.id=m1.id group by m1.id order by m1.id desc');
											$req2=$link->query('select m1.id, m1.title, m1.timestamp, count(m2.id) as reps, users.id as userid, users.email from pm as m1, pm as m2,users where ((m1.user1="'.$_SESSION['userid'].'" and m1.user1read="yes" and users.id=m1.user2) or (m1.user2="'.$_SESSION['userid'].'" and m1.user2read="yes" and users.id=m1.user1)) and m1.id2="1" and m2.id=m1.id group by m1.id order by m1.id desc');
											$req3=$link->query('select count(*) as nb_new_pm from pm where ((user1="'.$_SESSION['userid'].'" and user1read="no") or (user2="'.$_SESSION['userid'].'" and user2read="no")) and id2="1"');
											$nb_new_pm = mysqli_fetch_array($req3);
											$nb_new_pm = $nb_new_pm['nb_new_pm'];
											}
										?>
				<!--//logo-->
				<div class="header-right header-right-grid">
					<div class="profile_details_left"><!--notifications of menu start -->
						<ul class="nofitications-dropdown">
							<li class="dropdown head-dpdn">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i><span class="badge"><?php echo $nb_new_pm; ?></span></a>
								<ul class="dropdown-menu anti-dropdown-menu">
									<li>
										<div class="notification_header">
											<h3>Vous avez <?php echo $nb_new_pm; ?> messages</h3>
										</div>
									</li>
									<?php
									while($dn1 = mysqli_fetch_array($req))
									{
									?>
									<li><a href="read_pm.php?id=<?php echo $dn1['id']; ?>">
									   <div class="user_img"><img src="images/1.png" alt=""></div>
									   <div class="notification_desc">
										<p><?php echo htmlentities($dn1['title'], ENT_QUOTES, 'UTF-8'); ?></p>
										</div>
									   <div class="clearfix"></div>	
									</a></li>
									<?php
									}
									?>
									<li>
										<div class="notification_bottom">
											<a href="list_pm.php">See all messages</a>
										</div> 
									</li>
								</ul>
							</li>
							<li class="dropdown head-dpdn">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-bell"></i><span class="badge blue">3</span></a>
								<ul class="dropdown-menu anti-dropdown-menu">
									<li>
										<div class="notification_header">
											<h3>You have 3 new notification</h3>
										</div>
									</li>
									<li><a href="#">
										<div class="user_img"><img src="images/2.png" alt=""></div>
									   <div class="notification_desc">
										<p>Lorem ipsum dolor amet</p>
										<p><span>1 hour ago</span></p>
										</div>
									  <div class="clearfix"></div>	
									 </a></li>
									 <li class="odd"><a href="#">
										<div class="user_img"><img src="images/1.png" alt=""></div>
									   <div class="notification_desc">
										<p>Lorem ipsum dolor amet </p>
										<p><span>1 hour ago</span></p>
										</div>
									   <div class="clearfix"></div>	
									 </a></li>
									 <li><a href="#">
										<div class="user_img"><img src="images/3.png" alt=""></div>
									   <div class="notification_desc">
										<p>Lorem ipsum dolor amet </p>
										<p><span>1 hour ago</span></p>
										</div>
									   <div class="clearfix"></div>	
									 </a></li>
									 <li>
										<div class="notification_bottom">
											<a href="#">See all notifications</a>
										</div> 
									</li>
								</ul>
							</li>	
							
						</ul>
						<div class="clearfix"> </div>
					</div>
				</div>
				
				
				<div class="clearfix"> </div>
			</div>
			<!--search-box-->
				<div class="search-box">
					<form class="input">
						<input class="sb-search-input input__field--madoka" placeholder="Search..." type="search" id="input-31" />
					</form>
				</div>
				<!--//end-search-box-->
			<div class="header-right">
				
				<!--notification menu end -->
				<div class="profile_details">		
					<ul>
						<li class="dropdown profile_details_drop">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								<div class="profile_img">	
									<span class="prfil-img"><img src="images/a.png" alt=""> </span> 
									<div class="clearfix"></div>	
								</div>	
							</a>
							
							<ul class="dropdown-menu drp-mnu">
								<li> <a href="edit_profile.php"><i class="fa fa-cog"></i> Settings</a> </li> 
								<li> <a href="profile.php?id=<?php echo $_SESSION['userid']; ?>"><i class="fa fa-user"></i> Profile</a> </li> 
								<li> <a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a> </li>
							</ul>
						</li>
					</ul>
				</div>
				<!--toggle button start-->
				<button id="showLeftPush"><i class="fa fa-bars"></i></button>
				<!--toggle button end-->
				<div class="clearfix"> </div>				
			</div>
			<div class="clearfix"> </div>	
		</div>

		<!--left-fixed -navigation-->
		<div class="sidebar" role="navigation">
            <div class="navbar-collapse">
				<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right dev-page-sidebar mCustomScrollbar _mCS_1 mCS-autoHide mCS_no_scrollbar" id="cbp-spmenu-s1">
					<div class="scrollbar scrollbar1">
						<ul class="nav" id="side-menu">
							<li>
								<a href="index.php" class="active"><i class="fa fa-home nav_icon"></i>Accueil</a>
							</li>
							 <?php if($_SESSION['profil']=="user")
							{ ?>
							<li>
								<a href="#"><i class="fa fa-book nav_icon"></i>Patients<span class="fa arrow"></span></a>
								<ul class="nav nav-second-level collapse">
									<li>
										<a href="">Ajouter un patient</a>
									</li>
									<li>
										<a href="typography.html">Liste des patients</a>
									</li>
								</ul>
								<!-- /nav-second-level -->
							</li>
							
                            <?php 
                        	}
						?><?php
                                                        if($_SESSION['profil']=="admin")
							{
							?>
                                                        
							<li>
								<a href="#"><i class="fa fa-file-text-o nav_icon"></i>Projets<span class="fa arrow"></span></a>								
								<!-- //nav-second-level -->
								<ul class="nav nav-second-level collapse">
									<li>
										<a href="new_project.php">Créer un projet</a>
									</li>
									<li>
										<a href="list_project.php">Liste des projets</a>
									</li>
								</ul>
								<!-- //nav-second-level -->
							</li>
                                                        <?php }	
							?>
							<li>
								<a ><i class="fa fa-building-o nav_icon"></i>Générer un formulaire </span></a>								
								<!-- //nav-second-level -->
							</li>
						<?php 	

							if(isset($_SESSION['email'])){

							?>
							
							<li>
								<a href="#"><i class="fa fa-envelope nav_icon"></i>Email<span class="fa arrow"></span></a>
								<ul class="nav nav-second-level collapse">
									<li>
										<a href="list_pm.php">Boite de reception(<?php echo $nb_new_pm; ?>)</a>
									</li>
									<li>
										<a href="new_pm.php">Envoyer un email</a>
									</li>
								</ul>
								<!-- //nav-second-level -->
							</li>
							<?php
							}?>
							<li>
								<a href="forum.php" class="community-nav"><i class="fa fa-users nav_icon"></i>Communaut&eacute</a>
							</li>
							
						
						</ul>
					</div>
					<!-- //sidebar-collapse -->
				</nav>
			</div>
		</div>
		<!--left-fixed -navigation-->