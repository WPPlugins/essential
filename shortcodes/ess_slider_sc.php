<?php
/**
 * render for ess slider
 * format: [ess_slider id="<slider_id>"]
 * slider jssor guide: http://www.jssor.com/development/index.html
 */

add_shortcode("ess_slider", function($attr) {
	global $wpdb;
	
	$id = isset($attr["id"]) ? $attr["id"] : 0;
	$return = "";

	if($id == 0) {
		return $return;
	}
	
	//generate slider content
	require_once $GLOBALS["ess_model"]."slider_m.php";
	$model = new slider_m();
	$slider = $model->get($id);
	
	//load css, js
	wp_enqueue_style("jssor");
	wp_enqueue_script("jssor");
	?>
	
	<script type="text/javascript">
	jQuery(function($) {
		var jssor_slider_<?= $id; ?> = new $JssorSlider$('slider_<?= $id; ?>', {
			$AutoPlay: <?= $slider["bullet_nav"] ? "true" : "false"; ?>,
					
			//show bullet navigation button?
            $BulletNavigatorOptions: {                          
                $Class: $JssorBulletNavigator$,
                $ChanceToShow: <?= $slider["bullet_nav"] ? 2 : 0; ?>,//[Required] 0 Never, 1 Mouse Over, 2 Always
                $SpacingX: 10
            },

            //show prev/next button?
            $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$,
                $ChanceToShow: <?= $slider["prev_next"] ? 2 : 0; ?>//[Required] 0 Never, 1 Mouse Over, 2 Always
            }
		});
	});
	</script>
	
	<?php 
	
	//slider layout
	$return = "<div id='slider_$id' style='position: relative; top: 0px; left: 0px; width: ".$slider["width"]."px; height: ".$slider["height"]."px;'>
				<!-- slides container -->
				<div data-u='slides' style='cursor: move; position: absolute; overflow: hidden; left: 0px; top: 0px; width: ".$slider["width"]."px; height: ".$slider["height"]."px;'>
					##slides_container##
				</div>
				
				<!-- bullet navigator container -->
		        <div data-u='navigator' class='jssorb01' style='position: absolute; bottom: 16px; right: 10px;'>
		            <!-- bullet navigator item prototype -->
		            <div data-u='prototype' style='position: absolute; width: 12px; height: 12px;'></div>
		        </div>
			
				<!-- Arrow Left -->
		        <span data-u='arrowleft' class='jssora05l' style='width: 40px; height: 40px; top: 123px; left: 8px;'></span>
		        <!-- Arrow Right -->
		        <span data-u='arrowright' class='jssora05r' style='width: 40px; height: 40px; top: 123px; right: 8px'></span>
			  </div>";
	
	//slides content
	$slides_container = "";
	foreach($slider["slides"] as $a_slide) {
		$link = trim($a_slide["img_link_to_url"]);
		
		$slides_container .= "<div>".
								($link != "" ? "<a data-u='image' href='".esc_html($link)."'".($a_slide["img_open_new_tab"] ? " target='_blank' " : "").">" : "").
									"<img ".($link != "" ? "" : "data-u='image'")." src='".esc_html($a_slide["content"])."' title='".$a_slide["img_title"]."' alt='".$a_slide["img_alt"]."' />".
								($link != "" ? "</a>" : "").
							 "</div>";
	}
	
	$return = str_replace("##slides_container##", $slides_container, $return);
	
	return $return;
});