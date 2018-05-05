<?php
	add_action('customize_save_after','tvlgiao_wpdance_save_custom_style',10000000);
	if(!function_exists ('tvlgiao_wpdance_save_custom_style')){
		function tvlgiao_wpdance_save_custom_style(){
			//Update Option
			$file_name_exist 	= 	TVLGIAO_WPDANCE_THEME_SLUG.'file_xml_color';
		    if( !get_option( $file_name_exist) ) {
		        update_option(TVLGIAO_WPDANCE_THEME_SLUG.'file_xml_color', 'color_default' );
		    }
			$file_xml_old 		= get_option(TVLGIAO_WPDANCE_THEME_SLUG.'file_xml_color', '');		
			$file_xml_new		= get_theme_mod( 'tvlgiao_wpdance_styling_primary_color' ,'color_default');
			$remove_color 	= 0;
			if(	$file_xml_old 	!= $file_xml_new ){
				$remove_color 	= 1;
				update_option(TVLGIAO_WPDANCE_THEME_SLUG.'file_xml_color', $file_xml_new );
			}
			$xml_file 			= $file_xml_new;
			$objXML_color 		= simplexml_load_file(TVLGIAO_WPDANCE_THEME_WPDANCE."/config_xml/".$xml_file.".xml");
			ob_start();
			foreach ($objXML_color->children() as $child) {	 				
				foreach ($child->items->children() as $childofchild) { 			
					$name 		=  (string)$childofchild->name;					
					$slug 		=  (string)$childofchild->slug; 					
					$std 		=  (string)$childofchild->std;
					$important 	=  (isset($childofchild->important) &&  (int)$childofchild->important == 1) ? '!important' : ''; 
					$frontend 	=  $childofchild->frontend;
					// Data
					if( $remove_color 	== 1) remove_theme_mod( $slug );
					$data_style 		=  	get_theme_mod( $slug ,$std); 
					foreach ($frontend->children() as $childoffrontend) {	//frondend => f*
						$attr 		= $childoffrontend->attribute;
						$selector 	= $childoffrontend->selector;
							echo ($selector).'{';
							if( $data_style != $std){
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
			update_option(TVLGIAO_WPDANCE_THEME_SLUG.'custom_style', $ret_html );
		}
	}
?>