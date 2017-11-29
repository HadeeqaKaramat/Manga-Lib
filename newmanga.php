<?php
session_start();
if(isset($_SESSION['name'])){
	if ($_SESSION['name']=="admin"){?>
<!DOCTYPE html>
<html>
<?php include_once 'header.php';?>
<body class="background-newmanga">
<?php include_once 'navbar.php';?>
<div class="container">
	<div class="panel panel-transparent">
		<div class="panel-heading">
			<h1 align="center">NEW manga </h1>
		</div>
		<form action="" method="POST" enctype="multipart/form-data">
			<div class="form-group">
				<label for="Text">Titre</label>
				<input type="text" name="nom" class="form-control" placeholder="titre Complet" value="<?php $nom ?>"/>
			</div>
			<div class="form-group">
				<label for="text">Thème</label>
				<input type="text" name="theme" class="form-control" placeholder="Nom Complet"/>
			</div>
			<div class="form-group">
				<label for="Text">Année</label>
				<input type="text" name="annee" class="form-control" placeholder="année"/>
			</div>
			<div class="form-group">
				<label for="Text">Auteur</label>
				<input type="text" name="auteur" class="form-control" placeholder="Nom Complet"/>
			</div>
			<div class="form-group">
				<label for="text">Studio</label>
				<input type="text" name="studio" class="form-control" placeholder="Nom Complet"/>
			</div>
			<fieldset class="form-group">
				<label for="exampleTextarea">Resumé</label>
				<textarea class="form-control" id="resume" name="resume" rows="3"></textarea>
			</fieldset>
			<fieldset class="form-group">
				<label for="exampleInputFile">Photo</label>
				<input type="file" class="form-control-file" id="photo" name="photo">
			</fieldset>
			<input type="submit" class="btn btn-success"/>
		</form>
			<?php
			include_once 'db.php';
			if(isset($_POST['nom']))//&&isset($_POST['resume'])&&isset($_POST['auteur']))
			{
			  //$row = $mangaService->POSTMangaByTest($_POST['nom'])
				$data = file_get_contents($_FILES['photo']['tmp_name']);
				$photo = base64_encode($data);
				//var_dump($_POST['nom'],$_POST['resume'],$_POST['auteur'],$_POST['annee'],$_POST['theme'],$_POST['studio'],$photo);
				$mangaService->insertNewManga($_POST['nom'],$_POST['auteur'],$_POST['theme'],$_POST['annee'],$_POST['studio'],$_POST['resume'], $data);
			}
		}else{
			 header('Location:manga.php');
		}
	}else{
		 header('Location:index.php');
	}
			 ?>
<!-- javascript -->
	<script src="http://code.jquery.com/jquery-latest.min.js"></script>
	<script src="js/bootstrap.min.js"></script
</body>
</html>