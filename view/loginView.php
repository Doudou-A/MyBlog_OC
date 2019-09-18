<?php $title = 'My Blog'; ?>

<?php ob_start(); ?>
<h1>Connexion</h1>
<form action="index.php?action=login" id="login" method="POST">
    <p>
	    <label class="formLogin" >Pseudo</label> <input class="formLoginInput" type="text" name="email"/>
	    </br>
	    <label class="formLogin" >Mot de passe</label> <input class="formLoginInput" type="password" name="Password"/>
	    </br>
	    <input type="submit" name="valide">
	</p>
</form>

<a href="index.php?action=registrationView">S'inscrire</a>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>