<?php
	wp_oembed_add_provider('#https?://(?:api\.)?soundcloud\.com/.*#i', 'http://soundcloud.com/oembed', true);
	function tvlgiao_wpdance_soundcloud_flash_widget($width,$height,$url) {
		
		$params = array(
			'url'			=>	$url,
			'show_user'		=> 'true',
			'auto_play'     => 'false',
			'show_comments' => 'true',
			'sharing'		=> 'true',
			//'color'         => '0066CC',
	    );
		
		// Build URL
		//$url = 'https://player.soundcloud.com/player.swf?' . http_build_query($params);
		$url = 'https://w.soundcloud.com/player?' . http_build_query($params, '', '&amp;');
		$width = $width !== 0 ? $width : '100%';
		$height = $height !== 0 ? $height : '255';
		
		//return sprintf('<iframe width="%s" height="%s" scrolling="no" frameborder="no" src="%s"></iframe>', $width, $height, $url);
		return sprintf('<iframe style="width:%s; height:%spx; overflow:hidden; border:none;" src="%s"></iframe>', $width, $height, $url);						
	}
?>