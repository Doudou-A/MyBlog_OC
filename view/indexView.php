<?php $title = 'My Blog'; ?>

<?php ob_start(); ?>
<h1>MyBlog</h1>
<p>Doudou Adel</p>

<a href="index.php?action=registrationView">S'inscrire</a>
<a href="index.php?action=loginView">Se connecter</a>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>