<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title><?= $title ?></title>
		<link rel="stylesheet" href="public/bootstrap.css" />
		<link rel="stylesheet" href="public/mdb.css" />
		<nav class="navbar navbar-expand-md navbar-dark green d-flex flex-wrap">
			<div class="w-100 green p-2 text-white">
				<?php if (isset($_SESSION['firstName'])){?>
		  		Bonjour <?=$_SESSION['firstName']?> <?=$_SESSION['name']?>
		  		<?php }?>
		  	</div>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>
		  <div class="collapse navbar-collapse" id="navbarCollapse">
		    <ul class="navbar-nav mr-auto">
		      <li class="nav-item active">
		        <a class="nav-link" href="index.php">Acceuil <span class="sr-only">(current)</span></a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="index.php?action=blogPostAllView">Tous les Articles</a>
		      </li>
		    </ul>
		      <?php if(isset($_SESSION['firstName'])){?>
					  <a class="btn btn-outline-success my-2 my-sm-0 text-white" href="index.php?action=destroy">
				      	Déconnexion
				      </a>
		  	<?php }else{ ?>
		      <a class="btn btn-outline-success my-2 my-sm-0 text-white" href="index.php?action=loginView">
		      	Connexion
		      </a>
		    <?php }?>
		  </div>
		</nav>
	</head>

	<body>
		<?= $content ?>
	</body>
</html>