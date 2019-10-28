<?php $title = 'MyBlog'; ?>

<?php 
ob_start(); 
session_start()
//Vue gestion des articles
;
require('adminAccess.php');?>

<div class="container-fluid h-100 p-5 grey lighten-3">
	<h2 class="border-bottom animated slideInDown">Gérer les Articles</h2>
	<div class="col-lg-12 d-flex green text-white mt-3 animated slideInUp faster">
		<div class="col-lg-1 border border-white text-center font-weight-bold">Article N°</div>
		<div class="col-lg-2 border border-white text-center font-weight-bold">Titre Article</div>
		<div class="col-lg-2 border border-white text-center font-weight-bold">Résumé</div>
		<div class="col-lg-5 border border-white text-center font-weight-bold">Contenu</div>
		<div class="col-lg-2 border border-white text-center font-weight-bold">Action</div>
	</div>
<?php foreach ($blogposts as $key => $blogpost) : ?>
	<div class="col-lg-12 d-flex animated slideInUp">
		<div class="col-lg-1 border border-white text-center">
			<?=$blogpost->idBlogPost();?>	
		</div>
		<div class="col-lg-2 border border-white text-center">
			<?=$blogpost->title();?>
		</div>
		<div class="col-lg-2 border border-white text-truncate pl-2">
			<?=$blogpost->chapo();?>
		</div>
		<div class="col-lg-5 border border-white text-truncate pl-2">
			<?=$blogpost->content();?>
		</div>
		<div class="col-lg-1 border border-white text-center animated zoomIn">
			<a href="index.php?action=blogPostUpdateView&amp;id=<?=$blogpost->idBlogPost();?>" >Modifier</a>
		</div>
		<div class="col-lg-1 border border-white text-center animated zoomIn">
			<a class="text-danger" href="index.php?action=blogPostDelete&amp;id=<?=$blogpost->idBlogPost();?>&amp;jeton=<?=$_SESSION['jeton']?>" >Supprimer</a>
		</div>
	</div>
<?php endforeach	?>
</div>
<?php if(isset($_GET['protection']) && $_GET['protection'] == 1) : ?>
<script type="text/javascript">alert('Vous n\'êtes pas autorisé à supprimer un article');</script>
<?php endif ?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>