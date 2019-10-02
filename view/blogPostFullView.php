<?php $title = 'My Blog'; ?>

<?php 
ob_start(); 
session_start();
?>
<div  class="h-25 overflow-hidden text-center">
	<img src="upload/<?=$blogp->image();?>">
</div>
<div class="col-10 m-auto h-75 p-5 d-flex flex-column">
	<h2 class="text-center border-bottom border-secondary p-2"><?=$blogp->title();?></h2>
		<div class="col-lg-12 p-2 mt-2 text-justify">
			<?php echo nl2br($blogp->content()); ?>
		</div>
		<div class="p-3 text-success">
			Dernière Mise à Jour de l'Artcile : 
			<?php 
				$date = DateTime::createFromFormat('Y-m-d H:i:s', $blogp->dateLastUpdate());
				echo $date->format('d/m/Y H:i:s');
			?>
		</div>
	<div class="mt-5">
		<div style="display: none;" id="comments">
			<?php
			foreach ($commentsBlogPost as $key => $commentBlogPost) {
			?>		
			<div class="col-lg-8 offset-2 d-flex flex-wrap border p-3 mt-1">
				<div class="col-lg-12 border border-white  font-weight-bold">
					<?=$commentBlogPost->pseudo();?>	
				</div>
				<div class="col-lg-12 border border-white ">
					<?php 
						$date = DateTime::createFromFormat('Y-m-d H:i:s', $commentBlogPost->dateCreated());
						echo $date->format('d/m/Y H:i:s');
					?>
				</div>
				<div class="col-lg-12 border border-white mt-3">
					<?php echo nl2br($commentBlogPost->content()); ?>
				</div>
			</div>
			<?php
			}
			?>
		</div>
		<div class="font-weight-bold p-1 h4 text-center green lighten-2 text-white rounded col-4 offset-4 mt-3 cursor-pointer" id="commentsview">
			Afficher les Commentaires
		</div>
		<div class="font-weight-bold p-2 h3">
			Ecrire un Commentaire
		</div>
		<form action="index.php?action=commentAddForm&amp;id=<?=$blogp->idBlogPost();?>" id="formAddBlogPost" method="POST">
		<div class="row col-12 p-0 m-0">
			<div class="row p-0 m-0 col-4">
			    <input class="col-lg-12 p-2" type="text" name="pseudo" placeholder="Pseudo" />
			</div>
			<div class="row p-0 m-0 col-12">
			    <textarea class="col-lg-12 p-2 " type="text" name="content" maxlength="200" rows="5" placeholder="Commentaire"></textarea>
			</div>
			<input class="btn border-secondary col-6 offset-3 mt-4 rounded text-white mb-4" type="submit" name="valide" value="Valider">
		</div>
		</form>
	</div>
</div>

<script type="text/javascript">
	
	var comments = document.getElementById('comments');
		var commentsview = document.getElementById('commentsview');
		commentsview.onclick = function(){
			if (comments.style.display === "none"){
				comments.style.display = "block";
				commentsview.innerHTML = "Cacher les Commentaires";
				} else {
				comments.style.display = "none";
				commentsview.innerHTML = "Afficher les Commentaires";
				}
		}
</script>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>