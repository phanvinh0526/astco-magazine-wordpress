<?php
	if(!function_exists ('tvlgiao_wpdance_wd_get_embbed_daily')){
		function tvlgiao_wpdance_wd_get_embbed_daily($video_url,$width = 940,$height = 558){
			$url_embbed = "http://www.dailymotion.com/swf/".tvlgiao_wpdance_wd_parse_daily_link($video_url);
			return '<object width="'.$width.'" height="'.$height.'">
						<param name="movie" value="'.$url_embbed.'"></param>
						<param name="allowFullScreen" value="true"></param>
						<param name="allowScriptAccess" value="always"></param>
						<embed type="application/x-shockwave-flash" src="'.$url_embbed.'" width="'.$width.'" height="'.$height.'" allowfullscreen="true" allowscriptaccess="always"></embed>
					</object>';
		}
	}
	if(!function_exists ('tvlgiao_wpdance_wd_get_embbed_vimeo')){
		function tvlgiao_wpdance_wd_get_embbed_vimeo($video_url,$width,$height){
			return '//player.vimeo.com/video/'.tvlgiao_wpdance_wd_parse_vimeo_link($video_url);
		}
	}
	if(!function_exists ('tvlgiao_wpdance_wd_parse_vimeo_link')){
		function tvlgiao_wpdance_wd_parse_vimeo_link($video_url){
			if (preg_match('~^https://(?:www\.)?vimeo\.com/(?:clip:)?(\d+)~', $video_url, $match)) {
				return $match[1];
			}
			else{
				return substr($video_url,10,strlen($video_url));
			}
		}
	}
	if(!function_exists ('tvlgiao_wpdance_wd_parse_youtube_link')){
		function tvlgiao_wpdance_wd_parse_youtube_link($youtube_link){
			preg_match('%(?:youtube\.com/(?:user/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $youtube_link, $match);
			if(count($match) >= 2)
				return $match[1];
		   else
			   return '';
		}
	}
	if(!function_exists ('tvlgiao_wpdance_get_embbed_video')){
		function tvlgiao_wpdance_get_embbed_video($video_url,$width = 940,$height = 558){
			if(strstr($video_url,'youtube.com') || strstr($video_url,'youtu.be')){
				return "http://www.youtube.com/embed/".tvlgiao_wpdance_wd_parse_youtube_link($video_url)."";
							
			}
			elseif(strstr($video_url,'vimeo.com')){
				return tvlgiao_wpdance_wd_get_embbed_vimeo($video_url,$width,$height);
			}
			elseif(strstr($video_url,'dailymotion.com')){
				return tvlgiao_wpdance_wd_get_embbed_daily($video_url,$width,$height);
			}	
		}
	}
?>