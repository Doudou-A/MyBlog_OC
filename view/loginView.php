<?php $title = 'Page Connexion'; ?>

<?php ob_start(); ?>
<div class="row align-items-center h-100">
	<div class="col-md-12 m-auto h-50 aqua-gradient shadow d-flex">
		<img src="public/MyBlog.png" class=" h-50  m-auto">
		<div class="col-md-4 shadow h-110 p-4 mt-n3 white" style="margin-right:8.3333%;">
			<div class="text-center">
				<h2>Connexion</h2>
			</div>
			<form class="h-100" action="index.php?action=login" id="login" method="POST">
			    <p>
				    <input class="col-12 mt-4 rounded border p-2" type="text" name="email" placeholder="Email" />
				    </br>
				    <input class="col-12 mt-4 rounded border p-2" type="password" name="Password" placeholder="Mot de Passe" />
				    </br>
				    <input class="btn border-secondary col-6 offset-3 mt-4 rounded text-white" type="submit" name="valide">
				</p>
			</form>
		</div>
	</div>
</div>
<?php 
if(isset($error))
{
?>
		<style type="text/css">
				.formLogin{
					color: red;
				}

				.formLoginInput{
					border : red solid 1px;
				}
			</style>
<?php
	if(isset($errorEmail))
	{
?>
	<div class="text-red">Email Incorrect</div>
<?php
	}
	elseif(isset($errorPassword))
	{
?>
	<div class="text-red">Mot de passe Incorrect</div>
<?php
	}
	
?>		
<?php } ?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>