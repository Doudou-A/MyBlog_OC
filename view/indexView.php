<?php $title = 'My Blog'; ?>

<?php ob_start(); ?>
<h1>MyBlog</h1>
<p>Doudou Adel</p>

<a href="index.php?action=blogPostAllView">Afficher tous les Articles</a>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>