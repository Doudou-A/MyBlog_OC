<?php $title = 'Ajouter un Blog Post'; ?>

<?php 
ob_start(); 
session_start();
require('adminAccess.php');
?>
<div class="h-100 m-auto h-100 p-5 d-flex flex-column  animated fadeIn">
	<h2>Modifier un Article</h1>
	<form action="index.php?action=blogPostUpdateForm" id="formUpdateBlogPost" method="POST">
	  <div class="row col-12 p-0 m-0">
			<div class="row p-0 m-0 col-12">
		   		<textarea class="formLoginInput d-none" type="text" name="idBlogPost"><?= $updateId ?></textarea>
		    </div>
		    <div class="row p-0 m-0 col-12">
		    	<label class="col-lg-12 mt-4 animated fadeInRight">Titre : </label> <input style=" resize:none;" class="col-lg-12 p-2 border animated fadeInLeft" type="text" name="title" rows="1" maxlength="10" value="<?= $updateTitle ?>"/>
		    </div>
		    <div class="row p-0 m-0 col-12">
		    	<label class="col-lg-12 mt-4 animated fadeInRight">Châpo : </label> <input class="col-lg-12 p-2 border animated fadeInLeft" style=" resize:none;" type="text" name="chapo" value="<?= $updateChapo ?>"/>
		    </div>
		    <div class="row p-0 m-0 col-12">
		    	<label class="col-lg-12 mt-4 animated fadeInRight">Auteur :</label>
		    	<select id="monselect" class="col-lg-12 p-2 border animated fadeInLeft" name="Administrator">
				  <option value="<?= $admin->idAdministrator(); ?>" selected><?= $admin->idAdministrator(); ?> - <?= $admin->name();?> <?= $admin->firstName();?></option>
				 <?php foreach ($administrators as $key => $administrator) :?>
				  <option value="<?=$administrator->idAdministrator();?>"><?=$administrator->idAdministrator();?> - <?=$administrator->name();?>  <?=$administrator->firstName();?></option>
				<?php endforeach ?>	
				</select> 
				<!--<input class="col-lg-12 p-2 border animated fadeInLeft" style=" resize:none;" type="text" name="chapo" value="<?= $admin->idAdministrator; ?> - <?= $admin->name;?> <?= $admin->firstName;?>"/>-->
		    </div>
		    <div class="row p-0 m-0 col-12">
		    	<label class="col-lg-12 mt-4 animated fadeInRight">Contenu : </label> <textarea class="col-lg-12 p-2 border animated fadeInLeft text-justify" style=" resize:none;" type="text" name="content" rows="10"><?= $updateContent ?></textarea>
		    </div>
		    <input class="btn border-secondary col-6 offset-3 mt-4 animated fadeInRight rounded text-white" type="submit" name="valide" value="Valider">
		</p>
	</form>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>