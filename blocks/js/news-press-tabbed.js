(function($) {
	
	function getData(prefix, url, set) {
		$.getJSON(url, function(data) {
			
			/* Setup initial vars for our pool grid */
			$posts = '';
			
			$.each(data, function(key, val) {				
					
				$title = val['title']['rendered'];
				$link = val['link'];
				$img = val['jetpack_featured_media_url'];
					
				$posts += '<div class="col-lg-4 col-md-6 mb-3"><a href="' + $link + '" target="_blank" class="sync-post d-block"><img src="' + $img + '" alt="' + $title + '" class="img-fluid sync-img"><div class="sync-content d-flex flex-column"><h5>' + $title + '</h5></div></a></div>';
								
			});
			
			if (set == true) {
				$('#sync > .sync-posts > .row').append($posts);
			} else if ( $posts != $prevData ) {
				$('#sync > .sync-posts > .row').html($posts);
			} else if ( $posts == $prevData ) {
				console.log('no change in data');
			}
			
			$prevData = $posts;
			
		});
	}

	/* Call once on first page load, wrap in respective link address */
	getData('er', 'https://website.com/wp-json/wp/v2/posts?per_page=12', true);

	/* Call every 10 seconds */
	setInterval(function() {
		getData('er', 'https://website.com/wp-json/wp/v2/posts?per_page=12', false);
	}, 60000);


})(jQuery);