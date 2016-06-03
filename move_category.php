<?php
//This page let move a category
include('html/mainheader.php');

if(isset($_GET['id'], $_GET['action']) and ($_GET['action']=='up' or $_GET['action']=='down'))
{
$id = intval($_GET['id']);
$action = $_GET['action'];
$dn1 = mysqli_fetch_array(mysqli_query($link,'select count(c.id) as nb1, c.position, count(c2.id) as nb2 from categories as c, categories as c2 where c.id="'.$id.'" group by c.id'));
if($dn1['nb1']>0)
{
if(isset($_SESSION['email']) and $_SESSION['email']==$admin)
{
	if($action=='up')
	{
		if($dn1['position']>1)
		{
			if(mysqli_query($link,'update categories as c, categories as c2 set c.position=c.position-1, c2.position=c2.position+1 where c.id="'.$id.'" and c2.position=c.position-1'))
			{
				?><meta http-equiv="refresh" content="1; URL=forum.php"><?php
			}
			else
			{
				echo 'An error occured while moving the category.';
			}
		}
		else
		{
			echo '<h2>The action you want to do is impossible.</h2>';
		}
	}
	else
	{
		if($dn1['position']<$dn1['nb2'])
		{
			if(mysqli_query($link,'update categories as c, categories as c2 set c.position=c.position+1, c2.position=c2.position-1 where c.id="'.$id.'" and c2.position=c.position+1'))
			{
				?><meta http-equiv="refresh" content="1; URL=forum.php"><?php
			}
			else
			{
				?>
				<div id="page-wrapper">
            <div class="main-page"><?php
				echo 'An error occured while moving the category.';?></div></div>
                                         <?php include("html/mainfooter.html");
			}
		}
		else
		{
			?>
			<div id="page-wrapper">
            <div class="main-page"><?php
				echo '<h2>The action you want to do is impossible.</h2>';?></div></div>     <?php include("html/mainfooter.html");
			
		}
	}
}
else
{
	echo '<h2>You must be logged as an administrator to access this page: <a href="login.php">Login</a> - <a href="signup.php">Sign Up</a></h2>';
}
}
else
{
	echo '<h2>The category you want to move doesn\'t exist.</h2>';
}
}
else
{
	echo '<h2>The ID of the category you want to move is not defined.</h2>';
}
?>