<?php
session_start();
if(isset($_SESSION['name'])){?>
<!DOCTYPE html>
<html>
<?php include_once 'header.php';?>
<body class="background-directorymanga" >
<?php include_once 'navbar.php'?>
<div class="container">
	<div class="panel panel-transparent">
		<div class="row">
			<form action="" method="POST" >
			</form>
		</div>
		<div class="panel-body">
		<?php
		include_once 'db.php';
		if(isset ($_GET['year']))
		{
			$row = $mangaService->getMangaByYear($_GET['year']);
		}else if(isset($_GET['studio'])){
			$row = $mangaService->getMangaByStudio($_GET['studio']);
		}else if(isset($_GET['auteur'])){
			$row = $mangaService->getMangaByAuteur($_GET['auteur']);
		}else if(isset ($_POST['nom']))
		{
			$row = $mangaService->getMangaByName($_POST['nom']);
		}
		if(isset($row)){
		echo '<div class="row">';
		foreach ($row as $key => $value) {
			echo '<a href="detail.php?id='.$value['id'].'">';
			echo '<div class="col-md-4"><strong>'.$value['nom'].'</strong></div>';
		  echo '<div class="col-md-8"><img width="150px" height="100px" src="data:image/jpeg;base64,'.base64_encode($value['photo']).'"/></div>';
			echo '</a>';
		}
		echo '</div>';
		}else{
			header('Location:manga.php');
		}?>
	</div>
	</div>
	</div>
<?php $dbh = NULL; ?>
<!-- javascript -->
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
<?php }else{
	header('Location:index.php');
}
