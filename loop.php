<?php
/***
Loop documentation
http://codex.wordpress.org/The_Loop to understand it and
http://codex.wordpress.org/Template_Tags to understand
***/
?>
<?php 
/*
 * Loop query string modifier to include our custom post types
 */
query_posts( argo_post_types_qs() ); 
?>
<?php
	/* Start the Loop.
	 *
	 * We sometimes check for whether we are on an
	 * archive page, a search page, etc., allowing for small differences
	 * in the loop on each template without actually duplicating
	 * the rest of the loop that is shared.
	 *
	 * Without further ado, the loop:
	 */ ?>
<?php while ( have_posts() ) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('grid_8 alpha'); ?>>
<?php if ( is_front_page() && is_sticky() ):  ?>
<?php    if ( navis_post_has_features() ): 
            $feature = navis_get_the_main_feature();
            $feature_posts = argo_get_recent_posts_for_term( $feature, 3, 1 );
            if ( $feature_posts ):
?>
        <div class="sticky-related clearfix"> 
           <dl> 
                <dt><?php echo $feature->name; ?></dt> 
<?php           foreach ( $feature_posts as $feature_post ): ?>

                    <dd><a href="<?php echo get_permalink( $feature_post->ID ); ?>"><?php echo get_the_title( $feature_post->ID ); ?></a></dd> 
<?php           endforeach; ?>
                
                <?php if ( count( $feature_posts ) == 3 ): ?>
                    <dd class="sticky-all"><a href="<?php echo get_term_link( $feature, $feature->taxonomy ); ?>">Full coverage <span class="meta-nav">&rarr;</span></a></dd> 
                <?php endif; ?>
            </dl> 
<?php       else: // feature_posts ?>
        <div class="sticky-solo clearfix">
<?php       endif; // feature_posts
        else: // navis_post_has_features ?> 
        <div class="sticky-solo clearfix">
<?php endif; // navis_post_has_features(); ?>
            <h5>BIG STORY</h5> 
<?php if ( has_post_thumbnail() ): ?>
    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
<?php endif; ?>
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2> 
            <p><?php navis_the_raw_excerpt(); // the_excerpt(); ?> <a href="<?php the_permalink(); ?>">View Post <span class="meta-nav">&rarr;</span></a></p> 
        </div>

<?php else: ?>
<header>

<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

		<div class="post-metadata">
        <h6 class="entry-date"><?php argo_posted_on(); ?> </h6>
            <h6>By <?php the_author_posts_link(); ?></h6>
        </div> <!-- /.grid_2 alpha-->
        
</header><!-- / entry header -->

    <?php if ( is_archive() ) :  ?>

            <?php the_content( 'Continue reading <span class="meta-nav">&rarr;</span>' ); ?>
	    <?php wp_link_pages( array( 'before' => '<div class="page-link">Pages:', 'after' => '</div>' ) ); ?>
	
    <?php else : ?>
            <?php the_content( 'Continue reading <span class="meta-nav">&rarr;</span>' ); ?>

            <?php wp_link_pages( array( 'before' => '<div class="page-link">Pages:', 'after' => '</div>' ) ); ?>

    <?php endif; ?>
<?php endif; // is_sticky() ?>
    <!--  ############## removed .entry-utility ######### -->
    </article><!-- #post-## -->
    <?php comments_template( '', true ); ?>
<?php endwhile; // End the loop. Whew. ?>
<?php if ( next_posts_link() || previous_posts_link() ) :  ?>
<div class="grid_8 alpha">
	<nav>
		<ul class="list-pagination">
		    <li class="older-posts"><?php next_posts_link( 'Older posts' ); ?></li>
		    <li class="newer-posts"><?php previous_posts_link( 'Newer posts' ); ?></li>
		</ul>
	</nav><!-- .list-pagination -->
</div> <!-- .grid_8 alpha -->
<?php endif; // check for pagination ?>