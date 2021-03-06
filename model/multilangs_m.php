<?php
class multilangs_m {
	/** ---------------------------------------------------------------------------------------------------- **/
	/* function save($data) {
		global $wpdb;
		$slide_id = 0;
		
		//new dBug($data);exit;
		
		if($data["id"] == 0) {//insert
			//add into [ess_slider]
			if($wpdb->insert("ess_slider", [
					"title" 		=> $data["title"],
					"author" 		=> get_current_user_id(),
					"created_date" 	=> date($GLOBALS["ess_date_format"]),
					"updated_date" 	=> date($GLOBALS["ess_date_format"]),
					
					//settings
					"width" 		=> $data["width"],
					"height" 		=> $data["height"],
					"auto_play" 	=> isset($data["auto_play"]) ? 1 : 0,
					"auto_loop" 	=> isset($data["auto_loop"]) ? 1 : 0,
					"prev_next" 	=> isset($data["prev_next"]) ? 1 : 0,
					"bullet_nav" 	=> isset($data["bullet_nav"]) ? 1 : 0
				])) {
				$slide_id = $wpdb->insert_id;
				
				//add into [ess_slider_detail]
				$order = 0;
				foreach($data["slides"] as $a_slide) {
					$order += 1;
					$wpdb->insert("ess_slider_detail", [
						"item_type"			=> 0,//0 is image
						"content"			=> $a_slide["slide_content"],
						"ess_slider_id"		=> $slide_id,
						"img_title"			=> $a_slide["img_title"],
						"img_alt"			=> $a_slide["img_alt"],
						"img_link_to_url"	=> $a_slide["img_link_to_url"],
						"img_open_new_tab"	=> isset($a_slide["img_new_tab"]) ? 1 : 0,
						"sort_order"		=> $order
					]);
				}
			}
		}else {//update
			//update [ess_slider]
			$wpdb->update("ess_slider", [
				"title" 		=> $data["title"],
				"author" 		=> get_current_user_id(),
				"updated_date" 	=> date($GLOBALS["ess_date_format"]),
					
				//settings
				"width" 		=> $data["width"],
				"height" 		=> $data["height"],
				"auto_play" 	=> isset($data["auto_play"]) ? 1 : 0,
				"auto_loop" 	=> isset($data["auto_loop"]) ? 1 : 0,
				"prev_next" 	=> isset($data["prev_next"]) ? 1 : 0,
				"bullet_nav" 	=> isset($data["bullet_nav"]) ? 1 : 0
			], [
				"id"			=> $data["id"]
			]);
			
			//update [ess_slider_detail]
			//update or add new slides by user
			$slide_ids = [];
			$order = 0;
			foreach($data["slides"] as $a_slide) {
				$order += 1;
				if(isset($a_slide["slide_id"])) {//update
					//collect slide ids
					$slide_ids[] = $a_slide["slide_id"];
					
					$wpdb->update("ess_slider_detail", [
						"item_type"			=> 0,//0 is image
						"content"			=> $a_slide["slide_content"],
						"img_title"			=> $a_slide["img_title"],
						"img_alt"			=> $a_slide["img_alt"],
						"img_link_to_url"	=> $a_slide["img_link_to_url"],
						"img_open_new_tab"	=> isset($a_slide["img_new_tab"]) ? 1 : 0,
						"sort_order"		=> $order
					], [
						"ess_slider_id"		=> $data["id"],
						"id"				=> $a_slide["slide_id"]
					]);
				}else {//user add more new slide
					$wpdb->insert("ess_slider_detail", [
						"item_type"			=> 0,//0 is image
						"content"			=> $a_slide["slide_content"],
						"ess_slider_id"		=> $data["id"],
						"img_title"			=> $a_slide["img_title"],
						"img_alt"			=> $a_slide["img_alt"],
						"img_link_to_url"	=> $a_slide["img_link_to_url"],
						"img_open_new_tab"	=> isset($a_slide["img_new_tab"]) ? 1 : 0,
						"sort_order"		=> $order
					]);
					
					//collect slide ids
					$slide_ids[] = $wpdb->insert_id;
				}
			}
			
			//delete slides by user
			$ids = [];
			foreach($slide_ids as $tmp___) {
				$ids[] = "%d";
			}
			$tmp_ids = [];
			$tmp_ids[0] = $data["id"];
			$del_params = array_merge($tmp_ids, $slide_ids);
			
			$wpdb->query($wpdb->prepare("delete from ess_slider_detail 
							where ess_slider_id = %d
							and id not in (".implode(",", $ids).")", $del_params));
		}
		
		return ($data["id"] == 0 ? $slide_id : $data["id"]);
	} */
	
	/** ---------------------------------------------------------------------------------------------------- **/
	/* function get($id) {
		global $wpdb;
		
		$slider = $wpdb->get_row(
					$wpdb->prepare("select s.*, u.user_nicename author_name 
						from ess_slider s
						left join wp_users u on s.author = u.id 
						where s.id = %d", [$id]
					), ARRAY_A);
		
		$slider["slides"] = $wpdb->get_results(
					$wpdb->prepare("select * 
						from ess_slider_detail 
						where ess_slider_id = %d
						order by sort_order", [$id])
					, ARRAY_A);
		
		return $slider;
	} */
	
	/** ---------------------------------------------------------------------------------------------------- **/
	function get_list() {
		global $wpdb;
		
		$list = [];
		
		/* $list = $wpdb->get_results("select s.*, u.user_nicename author_name 
					from ess_slider s
					left join wp_users u on s.author = u.id"
				, ARRAY_A); */
		
		return $list;
	}	
}
