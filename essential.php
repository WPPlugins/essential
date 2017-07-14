<?php
/*
Plugin Name: Essential
Plugin URI: https://www.facebook.com/essential.wp
Description: Essential tools for your site (Slider, Portfolio, Blog, Multi languages, Shop, ...).
Author: bizsuppo
Version: 1.0.2
Author URI: https://profiles.wordpress.org/bizsuppo
*/

/** plugin configs **/
$ess_plugin_path = dirname(__FILE__);
$ess_plugin_name = "Essential";
$ess_plugin_url = plugins_url(). "/essential/";
$ess_view = "$ess_plugin_path/view/";
$ess_controller = "$ess_plugin_path/controller/";
$ess_model = "$ess_plugin_path/model/";
$ess_date_format = "Y/m/d";
$ess_front_url = $ess_plugin_url."front/";

/** build admin menu items **/
require_once "$ess_plugin_path/menu.php";

/** setup db when the plugin is active by wordpress admin **/
require_once("$ess_plugin_path/db.php");
add_action("plugins_loaded", "ess_db_setup");

/** custom media interface **/
add_filter("media_view_strings", function($strings) {
	//in case of slider
	if(isset($_GET["page"]) && $_GET["page"] == "ess_slider" && $_GET["job"] == "edit") {
		//change texts
		$strings["insertIntoPost"] = __("Add To Slider", "essential");
		$strings["insertMediaTitle"] = __("Images", "essential");
		
		//hide items on the media manager screen
		unset($strings["insertFromUrlTitle"]);	//insert from URL
		unset($strings["createGalleryTitle"]);	//create gallery
	}
	
	return $strings;
});

/** register css, js at admin screen **/
add_action("admin_init", function() {
	//register css script
	wp_register_style("ess_slider", $GLOBALS["ess_plugin_url"]."view/css/slider.css");
	wp_register_style("font-awesome", $GLOBALS["ess_plugin_url"]."view/css/font-awesome-4.2.0/css/font-awesome.min.css");
});

/** 
 * register css, js at front site
 * http://codex.wordpress.org/Plugin_API/Action_Reference/wp_head
 * **/
//always load jquery first
add_action("wp_enqueue_scripts", function() {
	wp_enqueue_script("jquery");
});
add_action("wp_head", function() {
	wp_register_script("jssor", $GLOBALS["ess_plugin_url"]."view/js/slider/js/jssor.slider.min.js");
	wp_register_style("jssor", $GLOBALS["ess_front_url"]."slider/style.css");
});

/** register shortcodes for the functionalities **/
require_once($ess_plugin_path."/shortcodes/ess_slider_sc.php");

//allow redirect, even if the theme starts to send output to the browser
add_action('init', function() {
	ob_start();
});
