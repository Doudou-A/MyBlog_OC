<?php $title = 'Ajouter un Blog Post'; ?>

<?php 
ob_start(); 
session_start();
require('adminAccess.php');?>
<div class="container-fluid m-auto white p-5 d-flex flex-column  animated fadeIn">
	<h2>Ajouter un Blog Post</h1>
	<form action="index.php?action=blogPostAddForm&amp;id=<?=$_SESSION['id']?>" id="formAddBlogPost" method="POST" enctype="multipart/form-data">
		<div class="row col-12 p-0 m-0">
			<div class="row p-0 m-0 col-12">
			    <label class="col-lg-12 mt-4 animated fadeInRight">Titre :</label> <input class="col-lg-12 p-2 animated fadeInLeft border" type="text" name="title"/>
			</div>
			<div class="row p-0 m-0 col-12">
			    <label class="col-lg-12 mt-4 animated fadeInRight">Châpo :</label> <input class="col-lg-12 p-2 animated fadeInLeft border" type="text" name="chapo"/>
			</div>
			<div class="row p-0 m-0 col-12">
			    <label class="col-lg-12 mt-4 animated fadeInRight">Contenu :</label> <textarea class="col-lg-12 p-2 animated fadeInLeft" type="text" name="content" rows="10"></textarea>
			</div>
			<div class="row p-0 m-0 col-12">
				<label class="col-lg-12 mt-4 animated fadeInRight">Image : </label> <input type="file" name="image" accept="image/png, image/jpeg">
			</div>
			<input class="btn border-secondary col-6 offset-3 mt-4 animated fadeInRight rounded text-white" type="submit" name="valide">
		</div>
	</form>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>