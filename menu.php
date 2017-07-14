<?php

add_action("admin_menu", "ess_menu");

function ess_menu() {
	global $ess_plugin_name;
	global $ess_plugin_url;
	
	//top menu page
	add_menu_page($ess_plugin_name, $ess_plugin_name, "manage_options", "ess_settings", "ess_settings", $ess_plugin_url. "view/img/icon.png");
	add_submenu_page("ess_settings", $ess_plugin_name, __("All Settings", "essential"), "manage_options", "ess_settings", "ess_settings");
	
	//sub-menu pages
	add_submenu_page("ess_settings", $ess_plugin_name, __("Sliders", "essential"), "manage_options", "ess_slider", "ess_slider");
	//add_submenu_page("ess_settings", $ess_plugin_name, __("Multi Languages", "essential"), "manage_options", "ess_multilangs", "ess_multilangs");
}

function ess_settings() {
	if(!current_user_can("manage_options")) {
		wp_die(__("You do not have sufficient permissions to access this page.", "essential"));
	}
	require_once($GLOBALS["ess_controller"]. "/settings.php");
	require_once($GLOBALS["ess_view"]. "/settings.php");
}

function ess_slider() {
	if(!current_user_can("manage_options")) {
		wp_die(__("You do not have sufficient permissions to access this page.", "essential"));
	}
	
	require_once($GLOBALS["ess_model"]. "/slider_m.php");
	require_once($GLOBALS["ess_controller"]. "/slider.php");
}

function ess_multilangs() {
	if(!current_user_can("manage_options")) {
		wp_die(__("You do not have sufficient permissions to access this page.", "essential"));
	}

	require_once($GLOBALS["ess_model"]. "/multilangs_m.php");
	require_once($GLOBALS["ess_controller"]. "/multilangs.php");
}