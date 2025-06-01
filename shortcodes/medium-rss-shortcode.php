<?php
/**
 * Custom shortcodes for this theme
 *
 * @package vesper
 */

function medium_posts( $atts = array() ) {

	// set up default parameters
	extract( shortcode_atts( array(
	 'num_posts' => '12',
	 'interval' => '21600',
	 'handle' => 'vesperfinance'
	), $atts ) );

	// Include native WordPress RSS container
	include_once(ABSPATH . WPINC . '/feed.php');

	if( function_exists( 'fetch_feed' ) ) :
		
		$feed = fetch_feed( 'https://medium.com/feed/' .$handle. '/' ); // RSS feed URL + Handle passed into the shortcode arguments
		
		if ( !is_wp_error( $feed ) ) : $feed->init();
			
			$feed->set_output_encoding( 'UTF-8' ); // encoding param
			$feed->handle_content_type(); // double-checks the encoding type
			$feed->set_cache_duration( $interval ); // 21,600 seconds = six hours
			$limit = $feed->get_item_quantity( $num_posts ); // fetches the 3 most recent RSS feed stories
			$items = $feed->get_items( 0, $limit ); // sets the limit and array for parsing the feed
			
			$blocks = array_slice( $items, 0, $num_posts ); // Items zero through $num_posts will be displayed here
		
			//ob_start(); // We're returning a bunch of HTML so running through output buffering
			?>
				<?php if ( $blocks )  : ?>
					<div class="medium-posts">
						<div class="row d-flex justify-content-center slick slick-news">
							<?php foreach ( $blocks as $block ) : $i = 0; ?>
								<?php
								$link = $block->get_permalink();
								$title = $block->get_title();
								$desc = $block->get_description();
								$thumbStart = strpos( $desc, '<figure>' );
								$thumbEnd = strpos( $desc, '</figure>', $thumbStart );
								$thumbnail = substr( $desc, $thumbStart, ( $thumbEnd - $thumbStart + 9 ) ); 
								str_replace('<img','<img class="img-fluid"', $thumbnail);
								?>
								<div class="col-sm-6 col-lg-4 mb-3">
									<div class="medium-post d-flex flex-column m-2 m-md-0">
										<a href="<?php echo $link; ?>" target="_blank" rel="noreferrer noopener" class="d-block">
											<?php echo $thumbnail; ?>
										</a>
										<h3 class="pt-2 f17"><?php echo $title; ?></h3>
										<p class="pt-1 mt-auto">
											<a href="<?php echo $link; ?>" target="_blank" rel="noreferrer noopener" class="pill d-inline-block">View on Medium</a>
										</p>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
						<div class="medium-more text-center my-5">
							<a class="btn btn-fade" href="https://medium.com/<?php echo $handle; ?>" target="_blank">More posts from <?php echo $handle; ?></a>
						</div>
					</div>
				<?php endif; ?>
			<?php
			//return ob_get_clean();
		
		else :
			
			return '';
			
		endif; //!is_wp_error($feed)
		
	endif; //function_exists('fetch_feed')
}


add_shortcode( 'medium', 'medium_posts' );

