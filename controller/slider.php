<?php

$job = (isset($_REQUEST["job"]) ? $_REQUEST["job"] : "");
$view = $GLOBALS["ess_view"]."/slider/";
$ess_current_url = "?page=ess_slider";
$model = new slider_m();

switch($job) {
	case "edit":
		$slider = [];
		if(isset($_GET["id"])) {//get slider information
			$slider = $model->get($_GET["id"]);
		}
		$view .= "edit.php";
		
		//assign messages
		if(isset($_GET["updated"]) && $_GET["updated"] == "true") {
			add_settings_error("ess_slider", esc_attr('updated'), __("Saved successfully!", "essential"), "updated");
		}
		break;
	/** ---------------------------------------------------------------------------------------------------- **/
	case "save":
		if(isset($_POST["submit"])) {
			$id = $model->save($_POST);
			wp_redirect($ess_current_url."&job=edit&id=$id&updated=true");
		}else {
			wp_redirect($ess_current_url);
		}
		break;
	/** ---------------------------------------------------------------------------------------------------- **/
	case "delete":
		$message = "&deleted=true";
		
		if(isset($_GET["id"])) {
			$model->delete($_GET["id"]);
		}elseif(isset($_POST["selected_sliders"])) {
			$model->delete($_POST["selected_sliders"]);
		}else {
			$message = "";
		}
		
		//back to list of sliders
		wp_redirect($ess_current_url.$message);
		break;
	/** ---------------------------------------------------------------------------------------------------- **/
	default:
		$list = $model->get_list();
		$view .= "list.php";
		
		//assign messages
		if(isset($_GET["deleted"]) && $_GET["deleted"] == "true") {
			add_settings_error("ess_slider", esc_attr('updated'), __("Deleted successfully!", "essential"), "updated");
		}
}

require_once $view;