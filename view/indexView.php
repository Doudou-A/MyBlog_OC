<?php $title = 'My Blog'; ?>

<?php ob_start(); ?>
<h1>MyBlog</h1>
<p>Doudou Adel</p>

<a href="index.php?action=loginView">Espace Administrateur</a>
<a href="index.php?action=blogPostAllView">Affiché tous les Articles</a>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>