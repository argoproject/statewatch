<?php
/**
 * Template Name: About
 */
?>

<?php get_header(); ?>

<article id="content" class="grid_8" role="main">

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


<h2 class="module-title"><?php the_title(); ?></h2>



<div class="grid_8 alpha">
	
	
	<div class="sw-about abt-module grid_4 alpha">
	
		<h3 class="module-title">StateImpact <? bloginfo('name'); ?></h3>
		<div class="content"><?php the_content(); ?></div>
		
	    <ul class="sw-social clearfix">
	    <?php if ( get_option( 'twitter_link' ) ): ?>
	        <li class="sw-twitter"><a href="<?php echo get_option( 'twitter_link' ); ?>">Twitter</a></li>
	    <?php endif; ?>
	    <?php if ( get_option( 'facebook_link' ) ): ?>
	        <li class="sw-fb"><a href="<?php echo get_option( 'facebook_link' ); ?>">Facebook</a></li>
	    <?php endif; ?>
	        <li class="sw-rss"><?php echo the_feed_link( 'RSS' ); ?></li>
	    </ul>

	</div><!-- .sw-about -->
	<!-- <?php $state_img = strtolower( str_replace(' ', '', get_bloginfo('name'))); ?>
	<img src="<?php bloginfo('stylesheet_directory'); ?>/img/dev-img/<?php echo $state_img; ?>.png" alt="<? bloginfo('name'); ?>" width="300" /> -->	
	
	<div class="abt-module grid_4 omega">
		<h3 class="module-title">Partners</h3>
		<?php $stations = sw_get_stations(); ?>
		<?php while ( $stations->have_posts() ): ?>
		    <?php $stations->the_post(); ?>

    
		    <div class="partner-station clearfix">
		    <?php if ( has_post_thumbnail() ) { ?>
		        <a href="<?php echo get_post_meta( get_the_ID(), 'url', true ); ?>">
		        <?php the_post_thumbnail( array(140) ); ?>
				</a>
			<?php } ?>
	
		        <h4><a href="<?php echo get_post_meta( get_the_ID(), 'url', true ); ?>"><?php the_title(); ?></a></h4>
				<h5><?php echo get_post_meta( get_the_ID(), 'city', true); ?> <b><?php echo get_post_meta( get_the_ID(), 'frequency', true ); ?></b></h5>
		        <h5><a href="<?php echo get_post_meta( get_the_ID(), 'support_url', true ); ?>">Support</a></h5>
		    </div><!-- / .partner-station -->
		<?php endwhile; ?>
			<ul>
		        <li><a href="http://www.npr.org/templates/stations/stations/">Station Finder &raquo;</a></li>
		    </ul>
		</div>
		<?php $supporters = sw_get_supporting_orgs(); ?>
		<?php if ( $supporters->have_posts() ): ?>
		<div class="supporting-orgs clearfix">
		    <h3 class="module-title">Supporting Organizations</h3>
			<?php while ( $supporters->have_posts() ): $supporters->the_post(); ?>
		        <h4><a href="<?php echo get_post_meta( get_the_ID(), 'url', true ); ?>"><?php the_title(); ?></a></h4>
			<?php endwhile; ?>
		</div>
		<?php endif; ?>
		<div class="clearfix"></div>
	</div>
	<div class="abt-module grid_8 alpha omega abt-field">
		<h3 class="module-title">Staff</h3>
		<?php $staff = sw_get_staff(); ?>
		<?php foreach ( array_keys($staff) as $key ): ?>
		<div class="abt-staff grid_4 <?php 
			$foo = ($key == count($staff)-1) ? "omega" : "alpha"; print $foo; 
			?>">
		    <?php echo get_avatar( $staff[$key]->ID, 60 ); ?>
		    <h4><a href="<?php echo get_author_posts_url( $user->ID ); ?>"><?php the_author_meta( 'display_name', $staff[$key]->ID ); ?></a></h4>
		    <h5><?php the_author_meta( 'sw_title', $staff[$key]->ID ); ?></h5>
		    <p><?php the_author_meta( 'description', $staff[$key]->ID ); ?></p>
		</div><!-- /.abt-staff -->
		<? endforeach; ?>
	</div>

	
<div class="grid_8 alpha omega abt-field">
<h3 class="module-title">The Network</h3>
<div id="sw-abt-network" class="abt-module grid_4 alpha">
	

	<h4>Issues that matter. Close to home.</h4>
	    <p>StateImpact seeks to inform and engage local communities with broadcast and online news focused on how state government decisions affect your lives.</p>
	    <p>We aim to put news in context, providing insight and background rather than just the latest headlines. We work to give you the information they need to hold state government accountable. We look at the costs of government action, and of not taking action. Our reporters travel the state to learn about issues from the people affected by them, and we invite discussion on this site about those issues.</p>
	    <p>StateImpact is a collaboration of local public radio stations in eight states and NPR. The participating stations in each state have chosen one of four policy areas to focus on: state budgets, education, energy and the economy.</p>
</div> <!-- /#sw-abt-network -->

<div id="sw-network-partners">
    <h4 class="module-title">Participating States</h4>
    <dl>
        <dt><strong>Florida</strong></dt>
		  <dd>Education</dd>
        <dt><strong>Idaho</strong></dt>
		  <dd>State budget</dd>
        <dt><a href="/ohio/">Ohio</a></dt>
		  <dd>Education</dd>
        <dt><a href="/indiana/">Indiana</a></dt>
		  <dd>Education</dd>
        <dt><strong>New Hampshire</strong></dt>
		  <dd>State economy</dd>
        <dt><strong>Oklahoma</strong></dt>
		  <dd>State budget</dd>
        <dt><a href="/pennsylvania/">Pennsylvania</a></dt>
		  <dd>Energy</dd>
        <dt><strong>Texas</strong></dt>
		  <dd>Energy</dd>
    </dl>
</div> <!-- /#sw-network-partners -->

<div id="sw-abt-npr">
	<h4 class="module-title">About NPR</h4>
    <p>A thriving media organization at the forefront of digital innovation, NPR creates and distributes award-winning news, information, and music programming to a network of 900 independent stations. Through them, NPR programming reaches 26.8 million listeners every week. <a href="http://www.npr.org/about/aboutnpr/">More information &raquo;</a></p>
</div> <!-- /#sw-abt-npr -->

<!--
<div id="sw-sponsors">
<h4>Sponsors</h4>

<h5><a href="#">Sponsor Name</a></h5>

<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud.</p>
</div> <!-- /#sw-sponsors -->

</div><!-- / .grid_4 omega -->
					
</div><!-- #post-## -->


<?php endwhile; ?>

</article><!-- / #content .grid8 -->

<aside id="sidebar" class="grid_4">
<?php get_sidebar( 'about' ); ?>
</aside>
<!-- /.grid_4 -->
<?php get_footer(); ?>
