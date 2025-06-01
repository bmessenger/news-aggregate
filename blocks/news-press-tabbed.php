<?php

/**
 * Latest News Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

 // Create id attribute allowing for custom "anchor" value.
$id = $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}
// Create class attribute allowing for custom "className" and "align" values.
$className = 'latest-news';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

/* Get News */
$news_args = array(
	'post_type' 		=> 'news',
	'posts_per_page'	=> -1,
	'tax_query' => array(
        array(
            'taxonomy' => 'news-type',
            'field'    => 'slug',
            'terms'    => 'news',
        ),
    ),
);
$news = new WP_Query($news_args);

/* Get Press */
$press_args = array(
	'post_type' 		=> 'news',
	'posts_per_page'	=> -1,
	'tax_query' => array(
        array(
            'taxonomy' => 'news-type',
            'field'    => 'slug',
            'terms'    => 'press',
        ),
    ),
);
$press = new WP_Query($press_args);

/* Get Sync Posts */
$json = file_get_contents('https://sync.bloq.com/wp-json/wp/v2/posts?per_page=12&_embed');
?>

<?php if ( $news->have_posts() && $press->have_posts()) : ?>

	<div class="container news-press">

		<ul class="nav nav-tabs" id="news_press" role="tablist">
			<li class="nav-item">
				<a class="nav-link" id="news-tab" data-toggle="tab" href="#latest-news" role="tab" aria-controls="news" aria-selected="false">In the News</a>
			</li>
			<li class="nav-item">
				<a class="nav-link active" id="sync-tab" data-toggle="tab" href="#sync" role="tab" aria-controls="sync" aria-selected="true">Bloq</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="vesper-tab" data-toggle="tab" href="#vesper" role="tab" aria-controls="vesper" aria-selected="false">Vesper</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="metronome-tab" data-toggle="tab" href="#metronome" role="tab" aria-controls="metronome" aria-selected="false">Metronome</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="lumerin-tab" data-toggle="tab" href="#lumerin" role="tab" aria-controls="lumerin" aria-selected="false">Lumerin</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="atmos-tab" data-toggle="tab" href="#atmos" role="tab" aria-controls="atmos" aria-selected="false">Atmos</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="capsule-tab" data-toggle="tab" href="#capsule" role="tab" aria-controls="capsule" aria-selected="false">Capsule</a>
			</li>
			
		</ul>

		<div class="tab-content" id="myTabContent">
			
			<div class="tab-pane fade" id="latest-news" role="tabpanel" aria-labelledby="news-tab">
				<div class="row sync-posts">

					<?php while ( $news->have_posts() ) : $news->the_post(); ?>

						<div class="col-lg-3 col-md-6 mb-3">
							<a href="<?php echo get_field('url', get_the_ID()); ?>" target="_blank" class="news-item">
								<?php
								$image_data = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), "full" );
								$width = $image_data[1];
								$height = $image_data[2];
								?>
								<div class="news-press-img mb-3">
									<img src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'full'); ?>"
										width="<?php echo $width/2; ?>"
										height="<?php echo $height/2; ?>"
									>
								</div>
								<div class="news-title">
									<?php the_field('news_link_text', get_the_ID()); ?>
								</div>
							</a>
						</div>

					<?php endwhile; wp_reset_postdata(); ?>

				</div>
			</div><!-- news -->
			
			<!-- Sync Posts -->
			<div class="tab-pane fade show active" id="sync" role="tabpanel" aria-labelledby="sync-tab">
				<div class="sync-posts container latest-news">
					<div class="row"></div>
				</div>
			</div>

			<div class="tab-pane fade" id="press" role="tabpanel" aria-labelledby="press-tab">
				<div class="row">

					<?php while ( $press->have_posts() ) : $press->the_post(); ?>

						<div class="col-lg-3 col-md-6 mb-3">
							<a href="<?php echo get_the_permalink(); ?>" class="press-item">
								<div class="press-date">
									<?php echo get_the_date('M. j, Y'); ?>
								</div>
								<div class="press-title">
									<?php the_title(); ?>
								</div>
								<span>Read More</span>
							</a>
						</div>

					<?php endwhile; wp_reset_postdata(); ?>

				</div>
			</div><!-- press -->
				
			<div class="tab-pane fade" id="vesper" role="tabpanel" aria-labelledby="vesper-tab">
				<?php echo do_shortcode('[medium handle="@vesperfinance" num_posts="9" interval="21600"]'); ?>
			</div><!-- vesper -->
			
			<div class="tab-pane fade" id="metronome" role="tabpanel" aria-labelledby="metronome-tab">
				<?php echo do_shortcode('[medium handle="@metronomedao" num_posts="9" interval="21600"]'); ?>
			</div><!-- metronome -->
				
			<div class="tab-pane fade" id="lumerin" role="tabpanel" aria-labelledby="lumerin-tab">
				<?php echo do_shortcode('[medium handle="lumerin-blog" num_posts="9" interval="21600"]'); ?>
			</div><!-- lumerin -->
			
			<div class="tab-pane fade" id="atmos" role="tabpanel" aria-labelledby="atmos-tab">
				<?php echo do_shortcode('[medium handle="atmosxyz" num_posts="9" interval="21600"]'); ?>
			</div><!-- atmos -->
				
			<div class="tab-pane fade" id="capsule" role="tabpanel" aria-labelledby="capsule-tab">
				<?php echo do_shortcode('[medium handle="capsulenft" num_posts="9" interval="21600"]'); ?>
			</div><!-- capsule -->

		</div><!-- .tab-content -->
			
	</div>

<?php endif; ?>