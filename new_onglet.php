<?php
//This page let display the list of topics of a category
include('html/mainheader.php');
if(isset($_GET['parent']))
{
	$id = intval($_GET['parent']);
	if(isset($_POST['onglet']))
	{
		$onglet = $_POST['onglet'];
		if(mysqli_query($link2,'insert into onglet (nom_onglet, id_formulaire) VALUES ("'.$onglet.'", "'.$id.'")'))
		{

			?>
			<div id="page-wrapper">
				<div class="main-page">
					<div class="row">
						<div class="flat-table" style="margin:0 auto;margin-top:15%;width:18%;height:200px">
							<div class="message"style="text-align:center ; font-weight:600;font-size:16px">L'onglet est en cours de création.<br /><br />
								<div class="showbox">
									<div class="loader">
										<svg class="circular" viewBox="25 25 50 50">
											<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
										</svg>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php include("html/mainfooter.html");?>
			<meta http-equiv="refresh" content="4; URL=list_onglet.php?parent=<?php echo $id;?>">
			<?php

		}
	}

	?>
	<div id="page-wrapper">
		<div class="main-page">
			<div class="row">
				<div class="flat-table" style="margin:0 auto;margin-top:15%;width:15%;height:150px">

					<form action="new_onglet.php?parent=<?php echo $id; ?>" method="post">
						<input type="hidden" value="<?php echo $id; ?>" name="parent">
					</br>
					<div style="text-align:center">
						<label for="formulaire" style="font-weight:600;font-size:16px" >Nom de l'onglet</label>

						<input type="text" name="onglet" />

					</div>
				</br>

				<div style="text-align:center">
					<button class="button" type="submit">Créer l'onglet</button>
				</div>

			</form>
		</div>
		<?php
	}
	?>

</div>
</div>
</div>
<?php include("html/mainfooter.html");?>