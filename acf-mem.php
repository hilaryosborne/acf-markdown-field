<?php

/*
Plugin Name: Advanced Custom Fields: Medium Editor Markdown Field
Plugin URI: https://github.com/hilaryosborne/acf-mem-field
Description: Adds a medium editor markdown field.
Version: 1
Author: hilaryosborne
Author URI: https://www.hilaryosborne.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/


load_plugin_textdomain( 'acf-mem', false, dirname( plugin_basename(__FILE__) ) . '/lang/' );

function include_field_types_markdown( $version ) {

	include_once('acf-mem-v5.php');
}

add_action('acf/include_field_types', 'include_field_types_markdown');


function register_fields_markdown() {

	include_once('acf-mem-v4.php');
}

add_action('acf/register_fields', 'register_fields_markdown');

?>