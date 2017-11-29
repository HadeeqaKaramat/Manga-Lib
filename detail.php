<?php
session_start();
if(isset($_SESSION['name'])){?>
<!DOCTYPE html>
<html>
<?php include_once 'header.php';?>
<body class="background-detailmanga">
<?php include_once 'navbar.php';?>
<div class="container">
	<div class="panel panel-transparent">
		<div class="row">
			<form action="" method="POST" >
			</form>
		</div>
		<div class="panel-body">
		<?php
		include_once 'db.php';
		if(isset($_GET['id'])){
			$row = $mangaService->getMangaById($_GET['id']);
			echo '<div class="row"><h2>'.$row['nom'].'</h2></div>';
			echo '<div class="row">';
			//echo '<div class="col-md-4">'.$row['nom'].'</div>';
			echo'<div class="col-md-8"><img width="150px" height="150px" class="pull-left" src="data:image/jpeg;base64,'.base64_encode($row['photo']).'"/>';
			//echo '<article class="col-lg-5 col-md-5">';
			echo '<h3>'. $row['resume'].'</h3></div>';
			echo '</div><div class="row">';
			echo '<div class="col-md-6"><h4>année: </h4><a href="directory.php?year='.$row['anne'].'">'.$row['anne'].'</a><h4> théme: </h4>'.$row['theme'].'<br/>';
			echo '<h4>auteur: </h4><a href="directory.php?auteur='.$row['autheur'].'">'.$row['autheur'].'</a><h4> studio: </h4><a href="directory.php?studio='.$row['studio'].'">'.$row['studio'].'</a><br/></div></div>';

		}
		if(isset ($_POST['nom']))
		{
			$row = $mangaService->getMangaByName($_POST['nom']);
			echo '<div class="row">';
			foreach ($row as $key => $value) {
				echo '<a href="detail.php?id='.$value['id'].'">';
				echo '<div class="col-md-8"><img width="150px" height="100px" src="data:image/jpeg;base64,'.base64_encode($value['photo']).'"/></div>';
				echo '<div class="col-md-4"><strong>'.$value['nom'].'</strong></div>';
				echo '</a>';
			}
		}
		?>
		</div>
	</div>
</div>
	<!-- javascript -->
	<script src="http://code.jquery.com/jquery-latest.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
<?php }else{
	header('Location:index.php');
}
