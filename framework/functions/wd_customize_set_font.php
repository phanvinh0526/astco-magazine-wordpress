<?php
	if(!function_exists ('tvlgiao_wpdance_set_font_style')){
		function tvlgiao_wpdance_set_font_style(){
			//Update Option
			$xml_file 			= 'font_config';
			$objXML_font 		= simplexml_load_file(TVLGIAO_WPDANCE_THEME_WPDANCE."/config_xml/".$xml_file.".xml");
			ob_start();
			foreach ($objXML_font->children() as $child) {	 				//items_setting => general
				foreach ($child->items->children() as $childofchild) { 		//items => item
					$name 	 		=  (string)$childofchild->name;					//name
					$slug 	 		=  (string)$childofchild->slug; 				//slug
					$std 	 		=  (string)$childofchild->std;
					$frontend 		=  $childofchild->frontend; 					//std
					$data_style 	=  	get_theme_mod( $slug ,$std);
					foreach ($frontend as $childoffrontend) {	//frondend => f*
						$attr 		= 'font-family';
						$selector 				= (string)$childoffrontend->selector_normal;
						$selector_important 	= (string)$childoffrontend->selector_important;
						echo ($selector).'{';
							echo esc_attr($attr).': '.esc_attr($data_style).';';
						echo '}'."\n";
						if($selector_important!=''){
							echo ($selector_important).'{';
								echo esc_attr($attr).': '.esc_attr($data_style).' !important ;';
							echo '}'."\n";							
						}	
					}
				}
			}
			$ret_html = ob_get_contents();
			ob_end_clean();
			return $ret_html;
		}
	}
?>