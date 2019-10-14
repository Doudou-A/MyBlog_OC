<?php $title = 'My Blog'; ?>

<?php 
ob_start(); 
session_start();
?>
<div class="container-fluid white">
	<div class="col-10 m-auto h-75 p-5 d-flex flex-column">
		<h2 class="text-center border-bottom border-secondary p-2 animated zoomIn"><?=$blogp->title();?></h2>
		<div class="col-lg-12 p-2 mt-2 text-justify animated fadeIn delay-1s">
			<?php echo nl2br($blogp->content()); ?>
		</div>
		<?php if($blogp->dateLastUpdate() == NULL) : ?>
			<div class="p-3 text-success">
				Article réalisé le : 
				<?php 
				$date = DateTime::createFromFormat('Y-m-d H:i:s', $blogp->dateCreated());
				echo $date->format('d/m/Y');
				?>
			</div>
		<?php else : ?>
			<div class="p-3 text-success">
				Article mis à jour le : 
				<?php 
				$date = DateTime::createFromFormat('Y-m-d H:i:s', $blogp->dateLastUpdate());
				echo $date->format('d/m/Y à H');
				echo "h";
				?>
			</div>
		<?php endif ?>
		<div class="p-3 text-success">
			Auteur :
			<?=$blogp->idAdministrator()->name()?> <?=$blogp->idAdministrator()->firstName()?>
		</div>
		<div class="font-weight-bold p-1 h4 text-center green lighten-2 text-white rounded col-4 offset-4 mt-3 cursor-pointer" id="commentsview">
			Afficher les Commentaires
		</div>
		<div class="mt-5">
			<div style="display: none;" id="comments">
		<?php 	foreach ($commentsBlogPost as $key => $commentBlogPost) :?>		
				<div class="col-lg-8 offset-lg-2 d-flex flex-wrap border p-3 mt-1 animated zoomIn">
					<div class="col-lg-12 border border-white  font-weight-bold">
						<?=htmlspecialchars($commentBlogPost->pseudo());?>	
					</div>
					<div class="col-lg-12 border border-white ">
						<?php 
							$date = DateTime::createFromFormat('Y-m-d H:i:s', $commentBlogPost->dateCreated());
							echo $date->format('d/m/Y H:i:s');
						?>
					</div>
					<div class="col-lg-12 border border-white mt-3">
						<?php echo nl2br(htmlspecialchars($commentBlogPost->content())); ?>
					</div>
				</div>
		<?php 	endforeach ?>
			</div>
			<div class="font-weight-bold p-2 h3">
				Ecrire un Commentaire
			</div>
			<form action="index.php?action=commentAddForm&amp;id=<?=$blogp->idBlogPost();?>" id="formAddBlogPost" method="POST">
			<div class="row col-12 p-0 m-0">
				<?php if(isset($_SESSION['id'])) : ?>
				<div class="row p-0 m-0 col-4">
				    <input class="col-lg-12 p-2 border-0" type="text" name="pseudo" value="<?=$commentAdmin->name();?> <?=$commentAdmin->firstName();?>" readonly />
				</div>
				<?php else : ?>
				<div class="row p-0 m-0 col-4">
				    <input class="col-lg-12 p-2" type="text" name="pseudo" placeholder="Pseudo" />
				</div>
				<?php endif ?>
				<div class="row p-0 m-0 col-12">
				    <textarea class="col-lg-12 p-2 border" type="text" name="content" maxlength="200" rows="5" placeholder="Commentaire"></textarea>
				</div>
				<input class="btn border-secondary col-6 offset-3 mt-4 rounded text-white mb-4" type="submit" name="valide" value="Valider">
			</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript"> blogPostFullView(); </script>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>