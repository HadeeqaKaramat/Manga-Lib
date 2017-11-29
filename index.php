<?php session_start();
if(isset($_SESSION['name'])&& !isset($_GET['logout'])){
	header('Location:manga.php');
}
else{ ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="shortcut icon" type="image/x-icon" href="img/manga.ico" />`
	<title>Manga</title>
	<link href="css/bootstrap.min.css" rel="stylesheet"/>
	<link href="css/custom.css" rel="stylesheet"/>
	<script src="js/respond.js"></script>
</head>
<body class="background-indexmanga">
<div class="container">
<div class="panel panel-transparent">
	<div class="panel-heading">
		<form method="POST" action="">
			<div class="row">
				<div class="col-lg-7 col-md-7 col-sm-7">
				</div>
				<div class="col-lg-5 col-md-5 col-sm-5 form-inline">
					<input type="text" name="id" class="form-control" style="width:33%"placeholder="Login" />
					<input type="password" name="password" class="form-control" style="width:33%" placeholder="Password"/>
					<button class="btn btn-success" type="submit" style="width:31%" name="connect">Se connecter</button>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-7 col-md-7 col-sm-7 ">
				</div>
				<div class="col-lg-5 col-md-5 col-sm-5">
					<input type="checkbox" name="remember"/> Se souvenir de moi &nbsp;
				</div>
				<?php
					require_once('db.php');
					if (!empty($_POST['id'])&& !empty($_POST['password']))
					{
						$param1=$_POST['id'];
						$param2=$_POST['password'];
						$stmt=$dbh->prepare("SELECT * FROM users WHERE Login=:login AND Password=:password LIMIT 1");
						$stmt->bindParam(':login', $param1,PDO::PARAM_STR) ;
						$stmt->bindParam(':password', $param2,PDO::PARAM_STR) ;
						$stmt->execute();

						if ($row = $stmt->fetch(PDO::FETCH_ASSOC))
						{
							$_SESSION['name']=$_POST['id'];
							header ('Location: manga.php');
						}else
						{
							echo '<span style="color:red">login et/ou mot de passe incorrecte(s)</span>';
						}
					}
					if (isset ($_GET['logout'])){
						session_destroy();
					}

					if (isset($_POST['remember'])){
						setcookie();
						$_COOKIE['log']=$_POST['id'];
						$_COOKIE['mdp']=$_POST['paswword'];
					}
				?>
			</div>
	</div>
	<div class="panel-body">
		<div class="row">
			<aside class="col-lg-7 col-md-7 ">
				<p><h2>Bienvenue</h2></p>
			</aside>
			<article class="col-lg-5 col-md-5">
				<h3>Création d'un compte :</h3>
				<div class="form-group">
					<input type="text" name="login" class="form-control" placeholder="Nom Complet"/>
				</div>
				<div class="form-group">
					<input type="email" name="mail" class="form-control" placeholder="Only gmail E-mail are accepted"/>
				</div>
				<div class="form-group">
					<input type="password" name="pass" class="form-control" placeholder="Mot de passe"/>
				</div>
				<div class="form-group">
					<input type="password" name="pass2" class="form-control" placeholder="Retapez le mot de passe"/>
				</div>
				<div class="form-group">
					<button class="btn  btn-success" style="width:30%" type="submit" name="sign" >S'inscrire</button>
					<button class="btn  btn-success pull-right" style="width:30%" type="reset" name="reset" >Recommencer</button>
				</div>
					<?php
					if (isset($_POST['sign']))
						if(!empty($_POST['login']) && !empty($_POST['pass'])&& !empty($_POST['pass2']) && !empty($_POST['mail'])){
							$param1=$_POST['login'];
							$stmt=$dbh->prepare("SELECT * FROM users WHERE login=:login OR mail=:email");
							$stmt->bindParam(':login', $param1,PDO::PARAM_STR) ;
							$stmt->bindParam(':email', $_POST['mail'],PDO::PARAM_STR) ;
							$stmt->execute();
							$utilisateur=$stmt->rowCount();
							if($utilisateur==0  )
							{
								if($_POST['pass']==$_POST['pass2']){
									$str =$_POST['mail'];
									$test="@gmail.com";
									if(substr_compare($str, $test, strlen($str)-strlen($test), strlen($test)) === 0){
										$unLogin = $_POST['login'];
										$unPassword = $_POST['pass'];
										$sql = 'INSERT INTO users (login, password) VALUES ( :login , :password)';
										$stmt = $dbh->prepare($sql);
										$stmt->bindParam(':login', $unLogin,PDO::PARAM_STR);
										$stmt->bindParam(':password', $unPassword,PDO::PARAM_STR);

										if($stmt->execute()){
											$_SESSION['name']=$_POST['id'];
											header ('Location: bienvenue.php');
										}
									}else
										echo '<span style="color:red">E-mail invalide</span>';

								}
							}else
								echo '<span style="color:red">Ce login est déjà utilisé par un autre utilisteur</span>';
						}else
							echo '<span style="color:red">Tout les champs n\'ont pas été rempli.</span>';

					?>
			</article>
		</div>
		</form>
	</div>
</div>
</div>
	<!-- javascript -->
	<script src="http://code.jquery.com/jquery-latest.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</div>
</body>
</html>
<?php } ?>
