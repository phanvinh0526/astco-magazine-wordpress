<?php
	add_action('init', 'wd_partner_business_quick_search');
	function wd_partner_business_quick_search(){
	    global $wpdb;
	    if( isset($_REQUEST['search']) && $_REQUEST['search'] == 'quick-search' ) {
			
			//Data
			$key_word = $_GET['key_word'];
			$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
			$limit = 10;
			$start = ($current_page - 1) * $limit;
			//Query
			$sql = "
				SELECT * FROM astco_business
				where name like '%".$key_word."%' LIMIT ".$start.",".$limit."";
			$business = $wpdb->get_results($sql);
			//Redirect
			$url = plugin_dir_path( __FILE__ ).'/templates/wd_quick_search.php';
	        require($url);
	        die();
	    }
	    if( isset($_REQUEST['search']) && $_REQUEST['search'] == 'data-post' ) {
			
			$phrase = $_GET['phrase'];
			$sql = "SELECT name, id FROM astco_business WHERE name LIKE '%".$phrase."%' LIMIT 10";
			$business = $wpdb->get_results($sql);
			/*  Convert to JSON */
			$json = '[';
			foreach($business as $busines){
			    $json .= '{"name":"' . $busines->name . '", "id":"'.$busines->id.'"}';
	            if ($busines !== end($business)) {
	                $json .= ',';   
	            }   
			}
			 $json .= ']';
			$url = plugin_dir_path( __FILE__ ).'/templates/wd_data_complete.php';
	        require($url);
	        die();
		}
		/* ADVANCED SEARCH*/
		if( isset($_GET['searchType']) && $_GET['searchType'] == 'load_combobox' ) {
		    
		    $dnId = $_REQUEST['id'];

		    $sql_country = "select DISTINCT b.country from astco_business b
		            join (astco_business_category bc, astco_category c)
		            on (c.id=".$dnId." and c.id=bc.keyword_id and bc.bus_id=b.id)";
		    $sql_state = "select DISTINCT b.state from astco_business b
		            join (astco_business_category bc, astco_category c)
		            on (c.id=".$dnId." and c.id=bc.keyword_id and bc.bus_id=b.id)";
		    $sql_suburb = "select DISTINCT b.suburb from astco_business b
		            join (astco_business_category bc, astco_category c)
		            on (c.id=".$dnId." and c.id=bc.keyword_id and bc.bus_id=b.id)";
		    $res_country 	= $wpdb->get_results($sql_country);
		    $res_state 		= $wpdb->get_results($sql_state);
		    $res_suburb		= $wpdb->get_results($sql_suburb);
		    $json = "";

		    // Return
		    $json .= '<div class="form-group">
		    				<label>Quốc Gia: </label>
		                    <select name="country" class="input-large form-control" id="com_nation">';
		       foreach($res_country as $country){
		            $json .= '<option value="'.$country->country.'">'.$country->country.'</option>';
		        }
		    $json .='</select>
		        
		    </div>

		    <div class="form-group">
		    	<label>Tiểu Bang: </label>
		        <select name="state" class="input-large form-control" id="com_state">';
		        foreach($res_state as $state){
		             $json .= '<option value="'.$state->state.'">'.$state->state.'</option>';
		        }
		    $json .='</select>
		      
		    </div>

		    <div class="form-group">
		    	<label>Quận/ Huyện: </label>
		        <select name="suburb" class="input-large form-control" id="com_suburb">';
		        foreach($res_suburb as $suburb){
		            $json .= '<option value="'.$suburb->suburb.'">'.$suburb->suburb.'</option>';
		        }
		    $json .='</select>
		         
		    </div>'; 
		   
		    $url = plugin_dir_path( __FILE__ ).'/templates/wd_data_complete.php';
	        require($url);
	        die();
		}
		if( isset($_GET['search']) && $_GET['search'] == 'advanced-search' ) {
			//Data
			if(isset($_GET['key_word']) && isset($_GET['cat_keyword']) && isset($_GET['cat_keyword']) && isset($_GET['state']) && isset($_GET['suburb']) ){
				$key_word 		= $_GET['key_word'];
				$cat_keyword 	= $_GET['cat_keyword'];
				$country 		= $_GET['country'];
				$state 			= $_GET['state'];
				$suburb 		= $_GET['suburb'];
				//Pagination
				$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
				$limit = 10;
				$start = ($current_page - 1) * $limit;
				//Get Data
				$sql = "
	    			select * from astco_business b
					join ( astco_business_category bc, astco_category c)
					on (c.id=".$cat_keyword." and c.id=bc.keyword_id and bc.bus_id=b.id 
						and b.state = '".$state."' and b.country = '".$country."' and b.suburb = '".$suburb."')
					where name like '%".$key_word."%' limit ".$start.",".$limit."";
				$business = $wpdb->get_results($sql);
			}
			//Redirect
			$url = plugin_dir_path( __FILE__ ).'/templates/wd_advanced_search.php';
	        require($url);
	        die();			
		}
		// Get Data Category Nam
		if( isset($_GET['search']) && $_GET['search'] == 'select_category' ){
			$sql = "select * from astco_category_name";
			$categores = $wpdb->get_results($sql);
			//Redirect
			$url = plugin_dir_path( __FILE__ ).'/templates/wd_select_category.php';
	        require($url);
	        die();			
		}
	}
	


	//Pagination
	function wd_partner_pagination_business($num_pages_per_phrase,$limit){
		//Data
 		$actual_link = esc_url( home_url( '/' ).'quick-search/' );
 		if(isset($_GET['search'])){
 			$actual_link .= "?search=".$_GET['search'];
 		}
 		if(isset($_GET['key_word'])){
 			$actual_link .= "&key_word=".$_GET['key_word'];
 			$key_word = $_GET['key_word'];
 		}else{
 			$key_word ="";
 		}		

		// Total number records
		global $wpdb;
		$sql = "SELECT COUNT(*) FROM astco_business WHERE name LIKE '%".$key_word ."%'";
		$total_records = $wpdb->get_var($sql);

		//Limit and Current Page
		$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
		$limit 		  = $limit;
	
		// Total Page
		$total_page = ceil($total_records / $limit);
		
		if ($current_page > $total_page){
            $current_page = $total_page;
        }
        else if ($current_page < 1){
            $current_page = 1;
        }
        //Start Page
        $start = ($current_page - 1) * $limit;
 		//Show Pagination
 		
		$max_page = min(array($total_page,$num_pages_per_phrase));
		if( $max_page <= 0){ 
			$max_page = 1; 
		}
		$phrase = ceil($current_page/$max_page);
		$start_page = $max_page*($phrase-1) + 1; 

        if ($current_page > 1){
        	echo '<a class="first"  href="'.$actual_link.'&page=1">Fist</a>  ';
        }
        if ($current_page > 1 && $total_page > 1){
            echo '<a class="previous" href="'.$actual_link.'&page='.($current_page-1).'">Prev</a>  ';
        }
        if($phrase > 1){
        	echo '<a class="previous-phrase" href="'.$actual_link.'&page='.($max_page*($phrase-2) + 1).'">...</a>  ';
        }
        if( $total_page > 1 ) {
        	for( $i=0; ($start_page+$i) <= min(array($total_page, $start_page+$max_page-1)); $i++){
        		if($start_page + $i == $current_page){
        			echo '<span class="pager current">'.($start_page + $i).'</span>';
        		}else{
        			echo '<a href="'.$actual_link.'&page='.($start_page + $i).'">'.($start_page + $i).'</a>  ';	
        		}
        	}
        }
        if($phrase < ceil($total_page/$max_page)){
        	echo '<a class="next-phrase" href="'.$actual_link.'&page='.($max_page*$phrase + 1).'">...</a>  ';
        }
        if($current_page < $total_page){
        	echo '<a class="next" href="'.$actual_link.'&page='.($current_page+1).'">next</a>  ';
        	echo '<a class="last" href="'.$actual_link.'&page='.$total_page.'">last</a>  ';
        }      
	}

		//Pagination Advanced Search
	function wd_partner_pagination_business_advanced_search($num_pages_per_phrase,$limit){
		//Data
 		$actual_link = esc_url( home_url( '/' ).'advanced-search/' );
 		if(isset($_GET['search'])){
 			$actual_link .= "?search=".$_GET['search'];
 		}
 		if(isset($_GET['key_word'])){
 			$actual_link .= "&key_word=".$_GET['key_word'];
 			$key_word = $_GET['key_word'];
 		}else{
 			$key_word ="";
 		}
 		if(isset($_GET['cat_keyword'])){
 			$actual_link .= "&cat_keyword=".$_GET['cat_keyword'];
 			$cat_keyword  = $_GET['cat_keyword'];
 		}
  		if(isset($_GET['country'])){
 			$actual_link .= "&country=".$_GET['country'];
 			$country 	  = $_GET['country'];
 		}
  		if(isset($_GET['state'])){
 			$actual_link .= "&state=".$_GET['state'];
 			$state 		  = $_GET['state'];
 		}
  		if(isset($_GET['suburb'])){
 			$actual_link .= "&suburb=".$_GET['suburb'];
 			$suburb 	  = $_GET['suburb'];
 		}	

		// Total number records
		global $wpdb;
		$sql = "
    			select count(*) from astco_business b
				join ( astco_business_category bc, astco_category c)
				on (c.id=".$cat_keyword." and c.id=bc.keyword_id and bc.bus_id=b.id 
					and b.state = '".$state."' and b.country = '".$country."' and b.suburb = '".$suburb."')
				where b.name LIKE '%".$key_word."%' ";
		$total_records = $wpdb->get_var($sql);

		//Limit and Current Page
		$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
		$limit 		  = $limit;
	
		// Total Page
		$total_page = ceil($total_records / $limit);
		
		if ($current_page > $total_page){
            $current_page = $total_page;
        }
        else if ($current_page < 1){
            $current_page = 1;
        }
        //Start Page
        $start = ($current_page - 1) * $limit;
 		//Show Pagination
 		
		$max_page = min(array($total_page,$num_pages_per_phrase));
		if( $max_page <= 0){ 
			$max_page = 1; 
		}
		$phrase = ceil($current_page/$max_page);
		$start_page = $max_page*($phrase-1) + 1; 
	
        if ($current_page > 1){
        	echo '<a class="first"  href="'.$actual_link.'&page=1">Fist</a>  ';
        }
        if ($current_page > 1 && $total_page > 1){
            echo '<a class="previous" href="'.$actual_link.'&page='.($current_page-1).'">Prev</a>  ';
        }
        if($phrase > 1){
        	echo '<a class="previous-phrase" href="'.$actual_link.'&page='.($max_page*($phrase-2) + 1).'">...</a>  ';
        }
        if( $total_page > 1 ) {
        	for( $i=0; ($start_page+$i) <= min(array($total_page, $start_page+$max_page-1)); $i++){
        		if($start_page + $i == $current_page){
        			echo '<span class="pager current">'.($start_page + $i).'</span>';
        		}else{
        			echo '<a href="'.$actual_link.'&page='.($start_page + $i).'">'.($start_page + $i).'</a>  ';	
        		}
        	}
        }
        if($phrase < ceil($total_page/$max_page)){
        	echo '<a class="next-phrase" href="'.$actual_link.'&page='.($max_page*$phrase + 1).'">...</a>  ';
        }
        if($current_page < $total_page){
        	echo '<a class="next" href="'.$actual_link.'&page='.($current_page+1).'">next</a>  ';
        	echo '<a class="last" href="'.$actual_link.'&page='.$total_page.'">last</a>  ';
        }      
	}
	function wd_partner_get_category_name($business_id){
		global $wpdb;
		$sql = "select  c.id as category_id from astco_business b
		            join (astco_business_category bc, astco_category c)
		            on (b.id=".$business_id." and c.id=bc.keyword_id and bc.bus_id=b.id)";
		$category = $wpdb->get_results($sql);
		
		$cate_name_id =  substr($category[0]->category_id,0,1);
		if($cate_name_id!= ""){
			$sql = "select * from astco_category_name where cat_id=".$cate_name_id;	
			$cate_name_ = $wpdb->get_results($sql);
			return	$cate_name_[0]->cat_name;
		}else{
			return "";
		}
	}

	function wd_partner_get_type_business($business_id){
		global $wpdb;
		$sql = "select bt.type_description as type_description from astco_business b
		            join (astco_business_type bt)
		            on (b.id=".$business_id." and b.bustype_id=bt.type_id )";
		$type_bus = $wpdb->get_results($sql);
		return	$type_bus[0]->type_description;
	}
?>