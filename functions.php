<?php

// site names should just be state names
DEFINE( 'SITE_NAME_PREFIX', 'StateImpact ' );
DEFINE( 'SW_ROOT', dirname(__FILE__));

// includes
require_once( 'includes/users.php' );
require_once( 'includes/sidebars.php' );
require_once( 'includes/stations.php' );
require_once( 'includes/static-widgets.php' );
require_once( 'includes/topics.php' );
require_once( 'includes/sw-widgets.php');
require_once( 'includes/settings.php' );
require_once( 'includes/template.php' );
require_once( 'includes/tables.php' );

add_action( 'admin_init', 'sw_agg_settings' );
function sw_agg_settings() {
    add_settings_field( 'network_feed_url', 'RSS Feed for Network Widget',
        'sw_network_feed_url_callback', 'agg', 'agg_settings' );
    register_setting( 'agg', 'network_feed_url' );
}

function sw_network_feed_url_callback() {
    $option = get_option( 'network_feed_url' );
    echo "<input type='text' value='$option' name='network_feed_url' />"; 
}

function sw_the_email_link() {
    if ( get_option( 'show_email_link' ) ) {
        echo '<li class="meta-email"><a href="mailto:?subject=';
        the_title();
        echo '&body=';
        the_permalink();
        echo '">Email</a></li>';
    }
}


add_action( 'init', 'remove_argo_actions' );
function remove_argo_actions() {    
    remove_action( 'navis_top_strip', 'argo_network_div' );
    remove_action( 'navis_network_icon', 'argo_network_icon' );
    remove_action( 'wp_footer', 'argo_build_network_panel' );
}

add_filter( 'bloginfo_rss', 'sw_fix_feed_title', 10, 2);
function sw_fix_feed_title($info, $show) {
    if ($show != 'name') {
        // in this case, we only care about the 'name' option
        return $info;
    } else {
        return SITE_NAME_PREFIX . $info;
    }
}

add_filter( 'post_class', 'sw_add_feature_labels', 10, 3);
function sw_add_feature_labels($classes, $class, $post_id) {
    global $wp_query;
    if ($wp_query->current_post == 0) $classes[] = 'first';
    if ($wp_query->current_post == ($wp_query->post_count - 1)) $classes[] = 'last';
    if(navis_post_has_features($post_id)) {
        $classes[] = 'has-features';
    }
    return $classes;
}
?>