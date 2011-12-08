<?php
$cat = $wp_query->get_queried_object();
$topic = argo_get_topic_for( $cat );
?>
<?php if ( $topic->post_content ): ?>
	<div class="coll-desc post clearfix"> 
		<h6>Background</h6>
		<ul class="meta-gestures">
		    <li class="twitter"> 
		        <a href="<?php echo esc_url( 'http://twitter.com/share?url=' . $topic->guid . '&text=' ) . rawurlencode( $topic->post_title ); ?>" class="twitter-share-button" data-count="horizontal">Tweet</a>
		    </li>
		    <li class="fb">
                <div id="fb-root"></div>
                <div class="fb-like" data-href="<?php echo esc_url($topic->guid); ?>" data-send="false" data-layout="button_count" data-width="150" data-show-faces="false" data-action="recommend"></div>
            </li>
		</ul>	
	    <?php echo apply_filters( 'the_content', $topic->post_content ); ?>
	</div>
<?php endif; ?>
