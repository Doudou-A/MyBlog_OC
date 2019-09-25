<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title><?= $title ?></title>
		<link rel="stylesheet" href="public/bootstrap.css" />
		<link rel="stylesheet" href="public/mdb.css" />
		<script type="text/javascript" scr="public/style.js"></script>
	</head>

	<body>
	<div class="d-flex h-100">
		<div class="col-md-2 d-flex flex-column h-100 aqua-gradient">
			<btn class="btn border-bottom-login" id="BlogsPosts">Gérer les Articles
				<div style="display: none;" id="BlogsPostsLinks">
					<div class="border-top">
						<a href="index.php?action=blogPostAddView">Ajouter un Blog Post</a>
					</div>
					<div class="border-top">
						<a href="index.php?action=blogPostGetView">Modifier/Supprimer un Blog Post</a>
					</div>
				</div>
			</btn>
			<btn class="btn border-bottom-login" id="Comments">Gérer les Commentaires
				<div style="display: none;" id="CommentsLinks">
					<div class="border-top">
						<a href="index.php?action=commentGetView">Valider un Commentaire</a>
					</div>
				</div>
			</btn>
			<btn class="btn border-bottom-login" id="Administrators">Gérer les Utilisateurs
				<div style="display: none;" id="AdministratorsLinks">
					<div class="border-top"">
						<a href="index.php?action=registrationView">Ajouter un Utilisateur</a>
					</div>
					<div class="border-top">
						<a href="index.php?action=blogPostGetView">Modifier/Supprimer un Utilisateur</a>
					</div>
				</div>
			</btn>
		</div>

		<script type="text/javascript">
			var BlogsPosts = document.getElementById('BlogsPosts');
			var BlogsPostLinks = document.getElementById('BlogsPostsLinks');
			var Comments = document.getElementById('Comments');
			var CommentsLinks = document.getElementById('CommentsLinks');
			var Administrators = document.getElementById('Administrators');
			var AdministratorsLinks = document.getElementById('AdministratorsLinks');
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
		<?= $content ?>
	</div>
	</body>
</html>