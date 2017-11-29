<?php session_start();?>
<nav class="navbar navbar-fixed-top navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<h3>Manga </h3>
		</div>
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<form class="navbar-form navbar-left" role="search" method="POST" action="manga.php">
				<div class="form-group">
				  <input type="text" class="form-control" placeholder="Search" name="nom">
				</div>
				<button type="submit" class="btn btn-default">Submit</button>
			</form>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="manga.php">Home</a></li>
				<?php  if($_SESSION['name']=="admin"){
				echo '<li><a href="newmanga.php">New manga</a></li>';
				}?>
				<li class="dropdown">
				  <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Signed in as <?php echo $_SESSION['name'];?><span class="caret"></span></a>
				  <ul class="dropdown-menu">
					<li><a href="newpassword.php">Change Password</a></li>
					<li role="separator" class="divider"></li>
					<li><a href="index.php?logout">Log out</a></li>
				  </ul>
				</li>
			</ul>
		</div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>