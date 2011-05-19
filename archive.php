<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 */
?>

<?php get_header(); ?>

<div id="content" class="grid_8" role="main">

<?php
	/* Queue the first post, that way we know
	 * what date we're dealing with (if that is the case).
	 *
	 * We reset this later so we can run the loop
	 * properly with a call to rewind_posts().
	 */
	if ( have_posts() )
		the_post();
?>

<?php if ( !is_author() ): ?>
<nav class="archive-dropdown">
<select name="archive-dropdown" onchange='document.location.href=this.options[this.selectedIndex].value;'> <option value=""><?php echo esc_attr(__('Select Month')); ?></option> <?php wp_get_archives(apply_filters('widget_archives_dropdown_args', array('type' => 'monthly', 'format' => 'option', 'show_post_count' => $c))); ?> </select>
</nav>

<h3 class="page-title">
    <?php if ( is_month() ) : ?>
        <?php printf( 'Monthly Archives: <span>%s</span>', get_the_date('F Y') ); ?>
    <?php elseif ( is_year() ) : ?>
        <?php printf( 'Yearly Archives: <span>%s</span>', get_the_date('Y') ); ?>
    <?php else : ?>
        Blog Archives
    <?php endif; ?>
</h3>
<?php endif; ?>

<?php if ( is_author() ) : ?>
    <h3 class="page-title"><?php the_author(); ?></h3>
    <div class="author-info">
        <?php echo get_avatar( get_the_author() ); ?>
        <h4><?php the_author_meta( 'sw_title' ); ?></h4>
        <div class="author-description">
            <?php the_author_meta( 'description' ); ?>
        </div>
    </div>
<?php endif; ?>
<nav>		
<ul class="list-pagination">
    <li class="older-posts"><?php next_posts_link( 'Older posts' ); ?></li>
    <li class="newer-posts"><?php previous_posts_link( 'Newer posts' ); ?></li>
</ul>
</nav>
<!--/.pagination-->

<?php
	/* Since we called the_post() above, we need to
	 * rewind the loop back to the beginning that way
	 * we can run the loop properly, in full.
	 */
	 rewind_posts();

	/* Run the loop for the archives page to output the posts.
	 * If you want to overload this in a child theme then include a file
	 * called loop-archives.php and that will be used instead.
	 */
	 get_template_part( 'loop', 'archive' );
?>
			
</div><!--/ #content .grid_8-->

<aside id="sidebar" class="grid_4">
<?php get_sidebar(); ?>
</aside>
<!-- /.grid_4 -->

<?php get_footer(); ?>
