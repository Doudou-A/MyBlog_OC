<?php $title = 'My Blog'; ?>

<?php ob_start(); ?>
<h1>Connexion</h1>
<form action="index.php?action=login" id="login" method="POST">
    <p>
	    <label class="formLogin" >Email</label> <input class="formLoginInput" type="text" name="email"/>
	    </br>
	    <label class="formLogin" >Mot de passe</label> <input class="formLoginInput" type="password" name="Password"/>
	    </br>
	    <input type="submit" name="valide">
	</p>
</form>
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