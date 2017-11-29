<?php
session_start();
if(isset($_SESSION['name'])){?>
<!DOCTYPE html>
<html>
<?php include_once 'header.php';?>
<body class="background-manga">
<?php include_once 'navbar.php';?>
<div class="container">
	<div class="panel panel-transparent">
		<div class="panel-body">
		<?php
		include_once 'db.php';
		$row = $mangaService->getAllMangas();
		if(isset ($_POST['nom']))
		{
			$row = $mangaService->getMangaByName($_POST['nom']);
		}
		echo '<div class="row">';
		foreach ($row as $key => $value) {
			echo '<a href="detail.php?id='.$value['id'].'">';
			echo '<div class="col-md-7"><img width="150px" height="100px" src="data:image/jpeg;base64,'.base64_encode($value['photo']).'"/></div>';
			echo '<div class="col-md-3"><strong>'.$value['nom'].'</strong></div>';
			if($_SESSION['name']=="admin"){
			echo '<div class="col-md-2"><a href="modify.php?id='.$value['id'].'&action=modifier" class="btn btn-primary active" role="button">Modify</a><a href="modify.php?id='.$value['id'].'&action=supprimer" class="btn btn-primary active" role="button">Delete</a></div>';
			}
			echo '</a>';
		}
		echo '</div>';?>
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
