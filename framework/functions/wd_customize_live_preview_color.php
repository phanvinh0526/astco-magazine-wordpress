<?php
	add_action( 'customize_preview_init', 'tvlgiao_wpdance_customize_live_preview_color');
	if(!function_exists ('tvlgiao_wpdance_customize_live_preview_color')){
		function tvlgiao_wpdance_customize_live_preview_color($wp_customize){
			add_action( 'wp_footer', 'tvlgiao_wpdance_customize_preview', 50);
			add_action( 'wp_enqueue_scripts', 'tvlgiao_wpdance_set_footer_primary_color' , 100000);
		}
	}
	
	// Live Priview Color
	function tvlgiao_wpdance_customize_preview($wp_customize) { ?>
		<div class="wd-custom-color-site">
		    <script type="text/javascript">
		        ( function( $ ) {  
		    	// Live Color File XML
				<?php
				$xml_file_customize	=  get_theme_mod( 'tvlgiao_wpdance_styling_primary_color' ,'color_default');
				$xml_file 			= $xml_file_customize;
				$objXML_color 		= simplexml_load_file(TVLGIAO_WPDANCE_THEME_WPDANCE."/config_xml/".$xml_file.".xml");
				foreach ($objXML_color->children() as $child) {	 				
					foreach ($child->items->children() as $childofchild) { 			
						$name 		=  (string)$childofchild->name;					
						$slug 		=  (string)$childofchild->slug; 					
						$std 		=  (string)$childofchild->std;
						$important 	=  (isset($childofchild->important) &&  (int)$childofchild->important == 1) ? '!important' : ''; 
						$frontend 	=  $childofchild->frontend;
						// Data
						foreach ($frontend->children() as $childoffrontend) {	//frondend => f*
							$attr 		= (string)$childoffrontend->attribute;
							$selector 	= (string)$childoffrontend->selector; ?>
								wp.customize('<?php echo esc_attr($slug); ?>',function( value ) {
					                value.bind(function(to) {
					                    $('<?php echo ($selector); ?>').css('<?php echo esc_attr($attr); ?>', to );
					                });
					            });
						<?php }	
					}
				} ?>
				// Live Color Config
				<?php 
					$array_setting_color 	= array('tvlgiao_wpdance_page_404_bg_color');
					$array_select_class		= array('.wd-404-error');
					$array_attribute		= array('background-color');
					$number_element			= count($array_setting_color);
					$i = 0;	
				?>
		    	<?php for($i; $i < $number_element; $i++){ ?>
					wp.customize('<?php echo esc_attr($array_setting_color[$i]); ?>',function( value ) {
		                value.bind(function(to) {
		                    $('<?php echo ($array_select_class[$i]); ?>').css('<?php echo esc_attr($array_attribute[$i]); ?>', to );
		                });
		            });
		        <?php $i++; } ?>		    	
		    	} )( jQuery )
		    </script>
	    </div>
	<?php }

	// Live Priview Primary Color
	function tvlgiao_wpdance_get_css_xml_file($xml_file_customize,$status_privew){
		$objXML_color 		= simplexml_load_file(TVLGIAO_WPDANCE_THEME_WPDANCE."/config_xml/".$xml_file_customize.".xml");
		ob_start();
		foreach ($objXML_color->children() as $child) {	 				
			foreach ($child->items->children() as $childofchild) { 			
				$name 		=  (string)$childofchild->name;					
				$slug 		=  (string)$childofchild->slug; 					
				$std 		=  (string)$childofchild->std;
				$important 	=  (isset($childofchild->important) &&  (int)$childofchild->important == 1) ? '!important' : ''; 
				$frontend 	=  $childofchild->frontend;
				// Data
				$data_style 	=  get_theme_mod( $slug ,$std);
				foreach ($frontend->children() as $childoffrontend) {	//frondend => f*
					$attr 		= $childoffrontend->attribute;
					$selector 	= $childoffrontend->selector;
						echo ($selector).'{';
							if( $data_style != $std && $status_privew == 0){
								echo esc_attr($attr).': '.esc_attr($data_style).esc_attr($important).';';
							}else{
								echo esc_attr($attr).': '.esc_attr($std).esc_attr($important).';';
							}
						echo '}'."\n";	
				}	
			}
		}
		$ret_html = ob_get_contents();
		ob_end_clean(); 
		return $ret_html;
	}
	// Output live privew primary color
	function tvlgiao_wpdance_set_footer_primary_color(){

		$file_name_exist 	= 	TVLGIAO_WPDANCE_THEME_SLUG.'file_xml_color_privew';
	    if( !get_option( $file_name_exist) ) {
	        update_option(TVLGIAO_WPDANCE_THEME_SLUG.'file_xml_color_privew', 'color_default' );
	    }
		$file_xml_old 		=  get_option(TVLGIAO_WPDANCE_THEME_SLUG.'file_xml_color_privew', '');	
		$file_xml_new		=  get_theme_mod( 'tvlgiao_wpdance_styling_primary_color' ,'color_default');
		$status_privew	 	= 0;
		if(	$file_xml_old != $file_xml_new ){
			$status_privew = 1;
			update_option(TVLGIAO_WPDANCE_THEME_SLUG.'file_xml_color_privew', $file_xml_new );
		} 
		wp_enqueue_style('tvlgiao-wpdance-style-color-preview', TVLGIAO_WPDANCE_THEME_CSS.'/wd_custom_style.css');
		$custom_css = tvlgiao_wpdance_get_css_xml_file($file_xml_new,$status_privew);
		wp_add_inline_style( 'tvlgiao-wpdance-style-color-preview', $custom_css );
	}
?>