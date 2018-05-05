<?php
	add_action('wp_enqueue_scripts', 'custom_style_inline_script');
	function wd_load_gg_fonts() {
		global $wd_font_name;	
		$font_size_str = "";
		$font_size_str = ": 400,400italic,600,600italic,700,700italic,800,800italic";
		if( isset($wd_font_name) && strlen( $wd_font_name ) > 0 ){
			$font_name_id = strtolower($wd_font_name);
			$protocol = is_ssl() ? 'https' : 'http';
			wp_enqueue_style( "goodly-{$font_name_id}", "{$protocol}://fonts.googleapis.com/css?family={$wd_font_name}{$font_size_str}" );		
		}
	}	
	function custom_style_inline_script(){
		global $wd_font_name, $tvlgiao_wpdance_font_web;
		$xml_file 			= 'font_config';
		$objXML_font 		= simplexml_load_file(TVLGIAO_WPDANCE_THEME_WPDANCE."/config_xml/".$xml_file.".xml");
		ob_start();
		foreach ($objXML_font->children() as $child) {	 				
			foreach ($child->items->children() as $childofchild) { 		
				$name 	 			=  (string)$childofchild->name;		
				$slug 	 			=  (string)$childofchild->slug;
				$std 	 			=  (string)$childofchild->std;
				$frontend 			=  $childofchild->frontend; 		
				$font_name 		=  	get_theme_mod( $slug ,$std);
				if(!array_key_exists($font_name, $tvlgiao_wpdance_font_web)){
					$font_name  	= str_replace( " ", "+", $font_name );
					$wd_font_name 	= trim( $font_name );
					wd_load_gg_fonts();	
				}

			}
		}			
	}
?>