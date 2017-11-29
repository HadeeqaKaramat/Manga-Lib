<?php
session_start();
if(isset($_SESSION['name'])){
	if ($_SESSION['name']=="admin"){?>
<!DOCTYPE html>
<html>
<?php include_once 'header.php';?>
<body class="background-newmanga">
<?php include_once 'navbar.php'?>
<div class="container">
	<div class="panel panel-transparent">
		<div class="panel-heading">
			<h1 align="center">NEW manga </h1>
		</div>
		<?php
		include_once 'db.php';
		$nom ="titre Complet";
		$theme ="Theme";
		$anne ="Année";
		$auteur ="Auteur";
		$studio ="Studio";
		$resume ="Résumé";
		if(isset($_GET['id']))
		{
			switch($_GET['action']){
				case "supprimer":
					$row=$mangaService->deleteManga($_GET['id']);
					header('Location:manga.php');
					break;
				case "modifier" :
					$row=$mangaService->getMangaById($_GET['id']);
					$nom =$row['nom'];
					$theme =$row['theme'];
					$anne =$row['anne'];
					$auteur =$row['autheur'];
					$studio =$row['studio'];
					$resume =$row['resume'];
					break;
			}
		}
		?>
		<form action="" method="POST" enctype="multipart/form-data">
			<div class="form-group">
				<label for="Text">Titre</label>
				<input type="text" name="nom" class="form-control" value="<?php echo $nom; ?>"/>
			</div>
			<div class="form-group">
				<label for="text">Thème</label>
				<input type="text" name="theme" class="form-control" value="<?php echo $theme; ?>"/>
			</div>
			<div class="form-group">
				<label for="Text">Année</label>
				<input type="text" name="annee" class="form-control" value="<?php echo $anne; ?>" />
			</div>
			<div class="form-group">
				<label for="Text">Auteur</label>
				<input type="text" name="auteur" class="form-control" value="<?php echo $auteur; ?>"/>
			</div>
			<div class="form-group">
				<label for="text">Studio</label>
				<input type="text" name="studio" class="form-control" value="<?php echo $studio; ?>"/>
			</div>
			<fieldset class="form-group">
				<label for="exampleTextarea">Resumé</label>
				<textarea class="form-control" id="resume" name="resume" rows="3"><?php echo $resume;?></textarea>
			</fieldset>
			<fieldset class="form-group">
				<label for="exampleInputFile">Photo</label>
				<input type="file" class="form-control-file" id="photo" name="photo">
			</fieldset>
			<div class="col-lg-7 col-md-7 col-sm-7">
				<button type="submit" name="envoyer" class="btn btn-success">Submit</button>
				<!--<button type="hidden" name="id" value="<?php $_GET['id'] ?>" ></button>-->
			</form>
					<a href="manga.php" class="btn btn-primary active" role="button">Home</a>
					<a href="index.php?logout" class="btn btn-primary active" role="button">Log out</a>
			</div>
			<?php

			if(isset($_POST['envoyer']))//&&isset($_POST['resume'])&&isset($_POST['auteur']))
			{
			  //$row = $mangaService->POSTMangaByTest($_POST['nom']);
					if(isset($_POST['photo'])){
					$data = file_get_contents($_FILES['photo']['tmp_name']);
					$photo = base64_encode($data);
					//var_dump($_POST['nom'],$_POST['auteur'],$_POST['theme'],$_POST['annee'],$_POST['studio'],$_POST['resume'],$photo);
					$mangaService->updateManga($_POST['nom'],$_POST['auteur'],$_POST['theme'],$_POST['annee'],$_POST['studio'],$_POST['resume'], $data,$_GET['id']);
			}
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
<script src="js/bootstrap.min.js"></script>
</body>
</html>
