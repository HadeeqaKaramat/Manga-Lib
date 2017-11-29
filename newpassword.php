<?php
session_start();
if(isset($_SESSION['name'])){?>
<!DOCTYPE html>
<html>
<?php include 'header.php';?>
<body class="background-manga">
<?php include_once 'navbar.php';?>;
<div class="container">
	<div class="panel panel-transparent">
		<div class="panel-body">
			<div class="row">
				<div class="col-lg-3">
				</div>
				<div class="col-lg-6 ">
					
					<form method="post" action="" class="center_div">
						<b>Account name : <?php echo $_SESSION['name'];?></b>
						<input type="password" name="pwd" class="form-control" placeholder="Type in your actual password">
						<input type="password" name="newpwd" class="form-control" placeholder="Type in your new password">
						<input type="password" name="newpwd2" class="form-control" placeholder="Retype in your new password">
						<button type="submit" class="btn btn-danger" name="send" >Submit</button>
					</form>
				</div>
				<div class="col-lg-3">
				</div>
			</div>
		</div>
	</div>
</div>
<!-- javascript -->
	<script src="http://code.jquery.com/jquery-latest.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
<?php
	include_once 'db.php';
	if(isset($_POST['send'])){	
		if(isset($_POST['pwd']) && isset($_POST['newpwd']) && isset($_POST['newpwd2'])) {
			$stmt=$dbh->prepare("SELECT * FROM users WHERE login=:login ");
			$stmt->bindParam(':login', $_SESSION['name'],PDO::PARAM_STR) ;
			$stmt->execute();
			if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				if($row['password']==$_POST['pwd'] && $_POST['newpwd']==$_POST['newpwd2'])
				{
					$stmt=$dbh->prepare("UPDATE users SET password=:pass WHERE login=:login");
					$stmt->bindParam(':pass', $_POST['newpwd'],PDO::PARAM_STR) ;
					$stmt->bindParam(':login', $_SESSION['name'],PDO::PARAM_STR) ;
					$stmt->execute();
					$row=$stmt->rowCount();
					echo '<span style="color:green"><center>The password had been changed</center></span>';
				}else{
					echo '<span style="color:red"><center>Wrong new password</center></span>';
				}
			}else
				echo '<span style="color:red"><center>Wrong actual password</center></span>';
		}else{
			echo '<span style="color:red"><center>Fill in all the text boxes</center></span>';
		}
	}
	$dbh=null;
} else{
	header('Location:index.php');
}?>
</body>
</html>