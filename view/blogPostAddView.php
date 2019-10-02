<?php $title = 'Ajouter un Blog Post'; ?>

<?php 
ob_start(); 
session_start();
$Name = htmlspecialchars($_SESSION['Name']);
$firstName = htmlspecialchars($_SESSION['firstName']);
?>
<div class="col-10 m-auto h-100 p-5 d-flex flex-column">
	<h2>Ajouter un Blog Post</h1>
	<form action="index.php?action=blogPostAddForm" id="formAddBlogPost" method="POST" enctype="multipart/form-data">
		<div class="row col-12 p-0 m-0">
			<div class="row p-0 m-0 col-12">
			    <label class="col-lg-12 mt-4">Titre :</label> <input class="col-lg-12 p-2" type="text" name="title"/>
			</div>
			<div class="row p-0 m-0 col-12">
			    <label class="col-lg-12 mt-4">Châpo :</label> <input class="col-lg-12 p-2" type="text" name="chapo"/>
			</div>
			<div class="row p-0 m-0 col-12">
			    <label class="col-lg-12 mt-4">Contenu :</label> <textarea class="col-lg-12 p-2" type="text" name="content" rows="10"></textarea>
			</div>
			<div class="row p-0 m-0 col-12">
				<label class="col-lg-12 mt-4">Image : </label> <input type="file" name="image" accept="image/png, image/jpeg">
			</div>
			<input class="btn border-secondary col-6 offset-3 mt-4 rounded text-white" type="submit" name="valide">
		</div>
	</form>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('templateAdmin.php'); ?>