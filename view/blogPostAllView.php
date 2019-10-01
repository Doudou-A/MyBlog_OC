<?php $title = 'Affichage de tous les Articles'; ?>

<?php 
ob_start(); 
session_start();
?>
<div class="col-lg-12 p-5 h-100 grey lighten-3">
	<h2 class="border-bottom col-12">Tous les Articles</h2>
	<div  class="d-flex justify-content-around flex-wrap">
		<?php
				foreach ($blogposts as $key => $blogpost) {
		?>		
				<div class="col-md-3 m-1 mt-5">
					<div class="col-md-12 border border-green white p-2">
						<img src="upload/<?=$blogpost->image();?>" class="h-100 w-100">
					</div>
					<div class="col-md-12 border border-green white p-2 text-center">
						<?=$blogpost->title();?>
					</div>
					<div class="col-md-12 border border-green white p-2">
						<?=$blogpost->chapo();?>	
					</div>
					<div class="col-md-5 text-center p-2 border border-green rounded aqua-gradient white ">
						<a class="font-weight-bold text-white" href="index.php?action=blogPostFullView&amp;id=<?=$blogpost->idBlogPost();?>" >Lire l'Article</a>
					</div>
				</div>
		<?php
				}
		?>
	</div>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>