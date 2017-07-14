<?php

$job = (isset($_REQUEST["job"]) ? $_REQUEST["job"] : "");
$view = $GLOBALS["ess_view"]."/multilangs/";
$ess_current_url = "?page=ess_multilangs";
$model = new multilangs_m();

switch($job) {
	case "edit":
		/* $slider = [];
		if(isset($_GET["id"])) {//get slider information
			$slider = $model->get($_GET["id"]);
		}*/
		$view .= "edit.php"; 
		break;
	/** ---------------------------------------------------------------------------------------------------- **/
	case "save":
		/* if(isset($_POST["submit"])) {
			$id = $model->save($_POST);
			wp_redirect($ess_current_url."&job=edit&id=$id");
		}else {
			wp_redirect($ess_current_url);
		} */
		break;
	/** ---------------------------------------------------------------------------------------------------- **/
	default:
		$list = $model->get_list();
		$view .= "list.php";
}

require_once $view;