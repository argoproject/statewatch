<div class="featured-topics grid_12">

	<h2>Essential Reading</h2>
	<?php wp_nav_menu( array( 
	    'theme_location' => 'featured-topics',
	    'menu'           => 'featured-topics',
	    'container'      => false,
	    'walker'         => new SW_Topics_Walker
	) ); ?>
    
    <!--
	<div class="grid_3 alpha">
		<img src="<?php bloginfo('stylesheet_directory'); ?>/img/dev-img/1.jpg">
		<h3><a href="#">What is a drilling impact fee?</a></h3>
	</div>

	<div class="grid_3">
		<img src="<?php bloginfo('stylesheet_directory'); ?>/img/dev-img/2.jpg">
		<h3><a href="#">Everything you need to know about the Marcellus Shale</a></h3>
	</div>

	<div class="grid_3">
		<img src="<?php bloginfo('stylesheet_directory'); ?>/img/dev-img/3.jpg">
		<h3><a href="#">Fracking 101</a></h3>
	</div>

	<div class="grid_3 omega">
		<img src="<?php bloginfo('stylesheet_directory'); ?>/img/dev-img/4.jpg">
		<h3><a href="#">Woman "made unrecognizeable" by barium poisoning</a></h3>
	</div>
	
	<div class="alltopics"><a href="#">View all topics &raquo;</a></div>
    -->
</div><!-- .grid_12 -->