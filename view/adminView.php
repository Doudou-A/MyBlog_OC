<?php $title = 'Administration'; ?>

<?php ob_start(); ?>
<p>Gérer les Blogs Posts</p>
<a href="index.php?action=addBlogPostView">Ajouter un Blog Post</a>
<a href="index.php?action=updateBlogPostView">Modifier un Blog Post</a>
<a href="index.php?action=deleteBlogPostView">Supprimer un Blog Post</a>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>