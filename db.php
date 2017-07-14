<?php
/**
 * setup your own database structure here, in [ess_db_setup] function
 * $ess_db_version should be changed to new content each time you want to update
 * the function is automatic run after the plugin is loaded by declare an add_action function
 * [add_action("plugins_loaded", "ess_db_setup");]
 */

require_once(ABSPATH. 'wp-admin/includes/upgrade.php');//to use dbDelta function

global $ess_db_version;
$ess_db_version = "1.0";

function ess_db_setup() {
	global $ess_db_version;
	global $wpdb;
	
	if(get_option("ess_db_version") != $ess_db_version) {
		//note that dbDelta just is used for create/alter table, not for drop
		dbDelta([
					//create table [ess_slider]
					"CREATE TABLE ess_slider (
						id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
						title varchar(50) DEFAULT NULL,
						author bigint(20) DEFAULT NULL,
						created_date datetime DEFAULT NULL,
						updated_date datetime DEFAULT NULL,
						slider_status varchar(20) DEFAULT NULL,
						width varchar(5) DEFAULT NULL,
						height varchar(5) DEFAULT NULL,
						auto_play tinyint(1) DEFAULT NULL,
						auto_loop tinyint(1) DEFAULT NULL,
						prev_next tinyint(1) DEFAULT NULL,
						bullet_nav tinyint(1) DEFAULT NULL
					) ENGINE=InnoDB DEFAULT CHARSET=utf8;",
					
					//create table [ess_slider_detail]
					"CREATE TABLE ess_slider_detail (
						id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
						item_type int(11) DEFAULT NULL,
						content text,
						ess_slider_id int(11) DEFAULT NULL,
						img_title varchar(50) DEFAULT NULL,
						img_alt varchar(50) DEFAULT NULL,
						img_link_to_url varchar(250) DEFAULT NULL,
						img_open_new_tab tinyint(1) DEFAULT NULL,
						sort_order int(11) DEFAULT NULL
					) ENGINE=InnoDB DEFAULT CHARSET=utf8;"
				], true);
		 
		//update db version into table [wp_options]
		update_option("ess_db_version", $ess_db_version);
    }
}