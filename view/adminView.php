<?php $title = 'Administration'; ?>

<?php 
ob_start();
session_start();
 ?>

<p>Gérer les Blogs Posts</p>
	<div>Gérer les Blogs Posts
		<a href="index.php?action=blogPostAddView">Ajouter un Blog Post</a>
		<a href="index.php?action=blogPostGetView">Modifier/Supprimer un Blog Post</a>
	</div>
	<div>Gérer les Commentaires
		<a href="index.php?action=blogPostAddView">Ajouter un Commentaire</a>
		<a href="index.php?action=blogPostGetView">Modifier/Supprimer un Blog Post</a>
	</div>
	<div>Gérer les Utilisateurs
		<a href="index.php?action=blogPostAddView">Ajouter un Utilisateur</a>
		<a href="index.php?action=blogPostGetView">Modifier/Supprimer un Utilisateur</a>
	</div>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>