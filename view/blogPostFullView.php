<?php $title = 'Valider un Commentaire'; ?>

<?php ob_start(); ?>

<div class="col-10 m-auto h-100 p-5 d-flex flex-column">
	<h2><?=$blogp->title();?></h2>
	<div class="d-flex flex-column">
		<img src="upload/<?=$blogp->image();?>" class="h-100">
		<div class="row p-0 m-0 col-12">
			<div class="col-lg-12 p-2 border mt-2 text-justify">
				<?= $blogp->content(); ?>
			</div>
		</div>
	</div>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>