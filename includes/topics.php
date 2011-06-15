<?php
add_action( 'init', 'sw_topic_setup' );
function sw_topic_setup() {
    if ( has_action( 'save_post', 'argo_update_topic_taxonomy' ) ) {
        remove_action( 'save_post', 'argo_update_topic_taxonomy', 10, 2 );
    }
    
    if ( has_action( 'edited_term', 'argo_create_topic_page' ) ) {
        remove_action( 'edited_term', 'argo_create_topic_page', 10, 3 );
    }
    
}

add_action( 'init', 'sw_setup_menus' );
function sw_setup_menus() {
    $location = 'featured-topics';
    $label = __('Featured Topics');
    register_nav_menus(array(
        $location => $label
    ));
    
    if ( ! has_nav_menu( $location ) ) {

        // get or create the nav menu
        $nav_menu = wp_get_nav_menu_object( $label );
        if ( ! $nav_menu ) {
            $new_menu_id = wp_create_nav_menu( $label );
            $nav_menu = wp_get_nav_menu_object( $new_menu_id );
        }

        // wire it up to the location
        $locations = get_theme_mod( 'nav_menu_locations' );
        $locations[ $location ] = $nav_menu->term_id;
        set_theme_mod( 'nav_menu_locations', $locations );
    }
}

class SW_Topics_Walker extends Walker {
    
    var $tree_type = array( 'post_type', 'taxonomy', 'custom' );
    var $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );
    
    function start_el( &$output, $item, $depth, $args ) {
    	$obj = get_post( $item->object_id );
    	if ( $obj->post_type == "topic" ) {
    	    // get term for topic, use term permalink
    	}
    	$output .= '<div class="grid_3 alpha">';
    	if ( has_post_thumbnail( $obj->ID ) ) {
    	    $output .= get_the_post_thumbnail( $obj->ID, array(60, 60) );
    	}
    	$output .= '	<h3><a href="'. get_permalink( $obj->ID ) . '">' . $obj->post_title . '</a></h3>';
    }
    
    function end_el( &$output, $item, $depth ) {
        $output .= '	</div>';
    }
}

// topic links
add_action( 'add_meta_boxes', 'sw_topic_links_metabox' );
function sw_topic_links_metabox() {
    add_meta_box( 'featured-links', 'Featured Links', 'sw_featured_links',
                  'topic', 'normal', 'high');
}

function sw_featured_links($post) { ?>
    <table class="form-table">
        <tr>
            <td></td>
            <th>Link Title</th>
            <th>URL</th>
            <th>Source</th>
        </tr>
        
        <?php // this feels dirty ?>
        <?php foreach( range(0, 4) as $i ): ?>
        <tr>
            <td><?php echo $i + 1; ?></td>
            <?php $fields = array( 'title', 'url', 'source' ); ?>
            <?php foreach( $fields as $field ): ?>
            <td>
                <?php $name = "link_" . $i . "_" . $field; ?>
                <?php $value = get_post_meta( $post->ID, $name, true ); ?>
                <input type="text" id="<?php echo $name; ?>" 
                       name="<?php echo $name; ?>" 
                       value="<?php echo $value; ?>" />
            </td>
            <?php endforeach; ?>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php
}

add_action( 'save_post', 'sw_update_topic_links' );
function sw_update_topic_links($post_id) {
    $fields = array( 'title', 'url', 'source' );
    foreach( range(0, 4) as $i ) {
        foreach( $fields as $field ) {
            $name = "link_" . $i . "_" . $field;
            $value = $_POST[$name];
            update_post_meta( $post_id, $name, $value );
        }
    }
}

function sw_get_topic_featured_links($post) {
    $results = array();
    $fields = array( 'title', 'url', 'source' );
    foreach( range(0, 4) as $i ) {
        $link = array();
        foreach( $fields as $field ) {
            $name = "link_" . $i . "_" . $field;
            $link[$field] = get_post_meta( $post->ID, $name, true );
        }
        $results[$i] = $link;
    }
    
    return $results;
}

?>