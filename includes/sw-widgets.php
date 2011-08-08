<?php
add_action('widgets_init', 'sw_add_widgets');
function sw_add_widgets() {
    register_widget( 'About_StateImpact' );
    register_widget( 'Impact_Network_Widget' );
    register_widget( 'StateImpact_LikeBox' );
    add_filter( 'navis_feedburner_widget_title', 'sw_feedburner_widget_title' );
    add_filter( 'navis_feedburner_blogname', 'sw_feedburner_blogname' );
    add_filter( 'navis_feedburner_placeholder', 'sw_feedburner_placeholder' );
}

function sw_feedburner_widget_title($title) {
    return "";
}

function sw_feedburner_blogname($name) {
    return "StateImpact " . get_option('blogname');
}

function sw_feedburner_placeholder($placeholder) {
    return "Email Address";
}

class About_StateImpact extends WP_Widget {
    
    function About_StateImpact() {
		$site_title = SITE_NAME_PREFIX . get_option('blogname');
        $widget_opts = array(
            'classname' => 'sw-about',
            'description' => 'About StateImpact'
        );
        $this->WP_Widget( 'about-widget', "About $site_title", $widget_opts);
    }
        
	function widget( $args, $instance ) {
		extract($args);
		$site_title = SITE_NAME_PREFIX . get_option('blogname');
		$about = get_static_page('about');
		$title = apply_filters( 'widget_title', "About $site_title", $instance, $this->id_base);
		$text = apply_filters( 'widget_text', $about->post_content, $instance );
		echo $before_widget;
		if ( !empty( $title ) ) { echo "<h3>$title</h3>"; } ?>
			
			<div class="textwidget"><?php echo $text; ?></div>
			
			<ul class="sw-info clearfix"> 
                <li><a href="<?php echo get_permalink( $about->ID ); ?>">Learn More &raquo;</a></li>
				<?php if ( get_option( 'support_link' ) ): ?>
                    <li><a href="<?php echo get_option( 'support_link' ); ?>">Support <?php echo SITE_NAME_PREFIX . get_bloginfo( 'name' ); ?> &raquo;</a></li>
                <?endif; ?>
            </ul>
            
            <ul class="sw-social clearfix">
                <?php if ( get_option( 'twitter_link' ) ) : ?>
                    <li class="sw-twitter">
                        <a href="<?php echo get_option( 'twitter_link' ); ?>" title="Follow us on Twitter">Twitter</a>
                    </li> 
                <?php endif; ?>
                <?php if ( get_option( 'facebook_link' ) ) : ?>
                    <li class="sw-fb">
                        <a href="<?php echo get_option( 'facebook_link' ); ?>" title="Follow us on Facebook">Facebook</a>
                    </li>
                <?php endif ?> 
                
                <li class="sw-rss" title="Subscribe with RSS"><?php echo the_feed_link( 'RSS' ); ?></li>
            </ul> 
        
		<?php
		echo $after_widget;
	}
    
}

$SITES = array(
    'texas'         => 'Texas',
    'indiana'       => 'Indiana',
    'pennsylvania'  => 'Pennsylvania',
    'new-hampshire' => 'New Hampshire',
    'florida'       => 'Florida',        
    'ohio'          => 'Ohio',
    'oklahoma'      => 'Oklahoma',
    'idaho'         => 'Idaho'
);

class Impact_Network_Widget extends WP_Widget {
        
    function Impact_Network_Widget() {
        $widget_opts = array(
            'classname' => 'iog_network_news',
            'description' => __('StateImpact Network Highlights', 'network')
        );
        $this->WP_Widget( 'impact-network-widget', __('Impact Network Widget', 'network'), $widget_opts );
    }
    
    function get_site_info( $url ) {
        global $SITES;
        foreach ( $SITES as $state => $title ) {
            if ( preg_match( "/\/$state\//", $url ) ) {
                return array( $state, $title );
            }
        }
        return array( 'stateimpact', 'StateImpact' );
    }
    
	function widget( $args, $instance ) {        
    	extract( $args );
        $feed_url = get_option('network_feed_url', 'http://pipes.yahoo.com/pipes/pipe.run?_id=ead495cc3467b86874819c5faa72f01d&_render=rss');
    	$title = empty($instance['title']) ? "StateImpact Network News" : $instance['title'];
    	$huburl = get_option('hub_url', '/');
    	/* Before widget (defined by themes). */
            echo $before_widget;
            include_once( ABSPATH . WPINC . '/class-feed.php' );
            $feed = new SimplePie();
            $feed->set_cache_duration( 600 );
            $feed->set_cache_location( '/tmp' );
            // XXX: temporary
            $feed->set_feed_url( $feed_url );
            $feed->init();
            $feed->handle_content_type();
            
            ?>
            <div class="sw-network-news"> 
            <h3><?php echo $title ?></h3>
            <p class="swnn-tagline"><a href="<?php echo $huburl; ?>">Issues That Matter. Close To Home.</a></p>
            <ul> <?php
            foreach ( array_slice( $feed->get_items(), 0, 5 ) as $i => $item ):
                $encs = $item->get_enclosures();
                $thumbnail = '';
                if ($encs) {
                    foreach ( $encs as $enc ) {
                        if ( $enc->get_thumbnail() ) {
                            $thumbnail = $enc->get_thumbnail();
                            break;
                        }
                    }
                }
                
                // grab all our metadata
                $site_info  = $this->get_site_info( $item->get_permalink() );
                $hostname = "http://stateimpact.npr.org";
                $themedir = "statewatch";
                $state = $site_info[ 0 ];
                $site_name  = $site_info[ 1 ];

        // actual template is html
        ?>
        <h6><?php echo $site_name; ?></h6>
        <h5><a href="<?php echo $item->get_permalink(); ?>"><?php echo $item->get_title(); ?></a></h5>
    <?php endforeach; ?>
        </div> <!-- /.network-news -->
        
    <?php /* After widget (defined by themes). */ ?>
    <?php echo $after_widget;
    // close out the function
    }
// close out the class
}

class StateImpact_LikeBox extends WP_Widget {
    
    function StateImpact_LikeBox() {
        $widget_opts = array(
            'classname' => 'sw-facebook',
            'description' => 'A Facebook LikeBox tied to your site\'s Facebook account as defined in your social media settings.'
        );
        $this->WP_Widget( 'facebook-widget', "Follow us on Facebook", $widget_opts);
    }
        
    function widget( $args, $instance ) {
        extract($args);
        if ( ! get_option( 'facebook_link' ) )
            return;
        echo $before_widget; ?>
            
            <iframe src="http://www.facebook.com/plugins/likebox.php?href=<?php echo urlencode(get_option( 'facebook_link' )); ?>&amp;width=300&amp;colorscheme=light&amp;show_faces=true&amp;border_color&amp;stream=false&amp;header=true&amp;height=290" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:300px; height:290px;" allowTransparency="true"></iframe>
        
        <?php
        echo $after_widget;
    }
    
}

?>