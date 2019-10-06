<?php $title = 'Ajouter un Blog Post'; ?>

<?php 
ob_start(); 
session_start();
require('adminAccess.php');?>
  <div class="d-flex flex-column">
	<btn class=" p-3 font-weight-bold text-center h3" id="BlogsPosts" >Articles
		<div id="BlogsPostsLinks">
			<div class="border-top font-weight-light text-center col-4 offset-4">
				<a class="text-black-50" href="index.php?action=blogPostAddView">Ajouter un Article</a>
			</div>
			<div class="border-top font-weight-light text-center col-4 offset-4">
				<a class="text-black-50" href="index.php?action=blogPostGetView">Modifier/Supprimer un Article</a>
			</div>
		</div>
	</btn>
	<btn class=" p-3 border-primary font-weight-bold text-center h3" id="Comments">Commentaires
		<div id="CommentsLinks">
			<div class="border-top font-weight-light text-center text-center col-4 offset-4">
				<a class="text-black-50" href="index.php?action=commentGetView">Valider un Commentaire</a>
			</div>
		</div>
	</btn>
	<btn class=" p-3 border-primary font-weight-bold text-center h3" id="Administrators">Utilisateurs
		<div id="AdministratorsLinks">
			<div class="border-top font-weight-light text-center col-4 offset-4">
				<a class="text-black-50" href="index.php?action=administratorAddView">Ajouter un Utilisateur</a>
			</div>
			<div class="border-top font-weight-light text-center col-4 offset-4">
				<a class="text-black-50" href="index.php?action=administratorGetView">Modifier/Supprimer un Utilisateur</a>
			</div>
		</div>
	</btn>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>