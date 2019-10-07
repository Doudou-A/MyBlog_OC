<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title><?= $title ?></title>
		<link rel="stylesheet" href="public/bootstrap.css" />
		<link rel="stylesheet" href="public/mdb.css" />
		<script type="text/javascript" src="/public/style.js"></script>
		<nav class="navbar navbar-expand-md navbar-dark green d-flex flex-wrap">
			<div class="w-100 green p-2 text-white">
				<?php if (isset($_SESSION['firstName'])) : ?>
		  		Utilisateur : <?=$_SESSION['name']?> <?=$_SESSION['firstName']?>
		  		<?php endif?>
		  	</div>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>
		  <div class="collapse navbar-collapse" id="navbarCollapse">
		    <ul class="navbar-nav mr-auto">
		      <li class="nav-item active">
		        <a class="nav-link" href="index.php">Accueil <span class="sr-only">(current)</span></a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="index.php?action=blogPostAllView">Tous les Articles</a>
		      </li>
		      <?php if(isset($_SESSION['firstName'])) : ?>
		       <li class="nav-item">
		        <div class="nav-link admin-btn" id="Administration">Administration</div>
				  <div class="d-flex flex-column aqua-gradient">
					<btn style="display: none;" class="admin-btn p-3 font-weight-bold animated bounceIn" id="BlogsPosts" >Articles
						<div style="display: none;" id="BlogsPostsLinks">
							<div class="border-top font-weight-light">
								<a class="text-white" href="index.php?action=blogPostAddView">Ajouter un Article</a>
							</div>
							<div class="border-top font-weight-light">
								<a class="text-white" href="index.php?action=blogPostGetView">Modifier/Supprimer un Article</a>
							</div>
						</div>
					</btn>
					<btn style="display: none;" class="admin-btn p-3 border-primary border-top font-weight-bold animated bounceIn" id="Comments">Commentaires
						<div style="display: none;" id="CommentsLinks">
							<div class="border-top font-weight-light">
								<a class="text-white" href="index.php?action=commentGetView">Valider un Commentaire</a>
							</div>
						</div>
					</btn>
					<btn style="display: none;" class="admin-btn p-3 border-primary border-top font-weight-bold animated bounceIn" id="Administrators">Utilisateurs
						<div style="display: none;" id="AdministratorsLinks">
							<div class="border-top font-weight-light">
								<a class="text-white" href="index.php?action=administratorAddView">Ajouter un Utilisateur</a>
							</div>
							<div class="border-top font-weight-light">
								<a class="text-white" href="index.php?action=administratorGetView">Modifier/Supprimer un Utilisateur</a>
							</div>
						</div>
					</btn>
				</div>
		      </li>
		  	<?php endif ?>
		    </ul>
		      <?php if(isset($_SESSION['firstName'])) :?>
					  <a class="btn btn-outline-success my-2 my-sm-0 text-white" href="index.php?action=destroy">
				      	Déconnexion
				      </a>
		  	<?php 	else : ?>
		      <a class="btn btn-outline-success my-2 my-sm-0 text-white" href="index.php?action=loginView">
		      	Connexion
		      </a>
		    <?php endif?>
		  </div>
		</nav>
	</head>

	<body>
		<?= $content ?>
	</body>
	<script type="text/javascript">
			var Administration = document.getElementById('Administration');
			var BlogsPosts = document.getElementById('BlogsPosts');
			var BlogsPostLinks = document.getElementById('BlogsPostsLinks');
			var Comments = document.getElementById('Comments');
			var CommentsLinks = document.getElementById('CommentsLinks');
			var Administrators = document.getElementById('Administrators');
			var AdministratorsLinks = document.getElementById('AdministratorsLinks');
			
			Administration.onclick = function(){
				if (BlogsPosts.style.display === "none"){
				BlogsPosts.style.display = "block";
				Comments.style.display = "block";
				Administrators.style.display = "block";
				} else {
				BlogsPosts.style.display = "none";
				Comments.style.display = "none";
				Administrators.style.display = "none";
				}
			}
			BlogsPosts.onclick = function(){
				if (BlogsPostsLinks.style.display === "none"){
				BlogsPostsLinks.style.display = "block";
				CommentsLinks.style.display = "none";
				AdministratorsLinks.style.display = "none";
				} else {
				BlogsPostsLinks.style.display = "none";
				}
			}
			Comments.onclick = function(){
				if (CommentsLinks.style.display === "none"){
				CommentsLinks.style.display = "block";
				BlogsPostsLinks.style.display = "none";
				AdministratorsLinks.style.display = "none";
				} else {
				CommentsLinks.style.display = "none";
				}
			}
			Administrators.onclick = function(){
				if (AdministratorsLinks.style.display === "none"){
				AdministratorsLinks.style.display = "block";
				BlogsPostsLinks.style.display = "none";
				CommentsLinks.style.display = "none";
				} else {
				AdministratorsLinks.style.display = "none";
				}
			}
		</script>
</html>