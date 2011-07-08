<?php
/**
 * The template for displaying Tag Archive pages.
 */

$tag = $wp_query->get_queried_object();
$topic = argo_get_topic_for( $tag );
?>

<?php get_header(); ?>
<?php get_template_part( 'includes/collection-header' ); ?>

<div id="content" class="grid_8" role="main">
<?php get_template_part( 'includes/collection-background' ); ?>	
<div id="crp"><h6>Recent Posts</h6></div> 
<?php
/* Run the loop for the tag archive to output the posts
 * If you want to overload this in a child theme then include a file
 * called loop-tag.php and that will be used instead.
 */
 get_template_part( 'loop', 'tag' );
?>
</div>
<!-- /.grid_8 #content -->
			
<aside id="sidebar" class="grid_4">
	<?php get_template_part( 'includes/collection-links' ); ?>
    <?php get_sidebar('topic'); ?>
</aside>
<!-- /.grid_4 -->
<?php get_footer(); ?>
