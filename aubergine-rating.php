<?php
/*
* Plugin Name:  Aubergine Rating Scale
* Plugin URI:   https://gibsonworksllc.com/
* Description:  Displays the number of eggplants out of five as a scale of easy (1) to difficult (5)
* Version:      1.0
* Author:       Gibsonworks, LLC
* Author URI:   https://gibsonworksllc.com/
* License:      GPL2
* License URI:  https://www.gnu.org/licenses/gpl-2.0.html

* This program is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*/


// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  Not much I can do when called directly.';
	exit;
}

function eggplant_shortcodes_init()
{
    // [eggplant rating="numeral-one-through-five"]
	function eggplant_func( $atts = [], $content = null ) {
		
		// normalize attribute keys, lowercase
	    $atts = array_change_key_case((array)$atts, CASE_LOWER);
	
			$a = shortcode_atts( array(
				'rating' => '5',
			), $atts );

		$rating = "rating = {$a['rating']}";

// need to read https://speckyboy.com/getting-started-with-wordpress-shortcodes-examples/ & https://developer.wordpress.org/plugins/plugin-basics/
		if ( $a['rating']==5 ) {
			echo '<img class="eggplant-full" src="' site_url(); '/wp-content/uploads/2019/05/full-aubergine.png">' +
				 '<img class="eggplant-full" src="' site_url(); '/wp-content/uploads/2019/05/full-aubergine.png">' +
				 '<img class="eggplant-full" src="' site_url(); '/wp-content/uploads/2019/05/full-aubergine.png">' +
				 '<img class="eggplant-full" src="' site_url(); '/wp-content/uploads/2019/05/full-aubergine.png">' +
				 '<img class="eggplant-full" src="' site_url(); '/wp-content/uploads/2019/05/full-aubergine.png">' ;

		} elseif ( $a['rating']==4 ) {
			echo '<img class="eggplant-full" src="' site_url(); '/wp-content/uploads/2019/05/full-aubergine.png">' +
				 '<img class="eggplant-full" src="' site_url(); '/wp-content/uploads/2019/05/full-aubergine.png">' +
				 '<img class="eggplant-full" src="' site_url(); '/wp-content/uploads/2019/05/full-aubergine.png">' +
				 '<img class="eggplant-full" src="' site_url(); '/wp-content/uploads/2019/05/full-aubergine.png">' +
				 '<img class="eggplant-empty" src="' site_url(); '/wp-content/uploads/2019/05/empty-aubergine.png">' ;
		
		} elseif ( $a['rating']==3 ) {
			echo '<img class="eggplant-full" src="' site_url(); '/wp-content/uploads/2019/05/full-aubergine.png">' +
				 '<img class="eggplant-full" src="' site_url(); '/wp-content/uploads/2019/05/full-aubergine.png">' +
				 '<img class="eggplant-full" src="' site_url(); '/wp-content/uploads/2019/05/full-aubergine.png">' +
				 '<img class="eggplant-empty" src="' site_url(); '/wp-content/uploads/2019/05/empty-aubergine.png">' +
				 '<img class="eggplant-empty" src="' site_url(); '/wp-content/uploads/2019/05/empty-aubergine.png">' ;

		} elseif ( $a['rating']==2 ) {
			echo '<img class="eggplant-full" src="' site_url(); '/wp-content/uploads/2019/05/full-aubergine.png">' +
				 '<img class="eggplant-full" src="' site_url(); '/wp-content/uploads/2019/05/full-aubergine.png">' +
				 '<img class="eggplant-empty" src="' site_url(); '/wp-content/uploads/2019/05/empty-aubergine.png">' +
				 '<img class="eggplant-empty" src="' site_url(); '/wp-content/uploads/2019/05/empty-aubergine.png">' +
				 '<img class="eggplant-empty" src="' site_url(); '/wp-content/uploads/2019/05/empty-aubergine.png">' ;

		} elseif ( $a['rating']==1 ) {
			echo '<img class="eggplant-full" src="' site_url(); '/wp-content/uploads/2019/05/full-aubergine.png">' +
				 '<img class="eggplant-empty" src="' site_url(); '/wp-content/uploads/2019/05/empty-aubergine.png">' +
				 '<img class="eggplant-empty" src="' site_url(); '/wp-content/uploads/2019/05/empty-aubergine.png">' +
				 '<img class="eggplant-empty" src="' site_url(); '/wp-content/uploads/2019/05/empty-aubergine.png">' +
				 '<img class="eggplant-empty" src="' site_url(); '/wp-content/uploads/2019/05/empty-aubergine.png">' ;
		
		} else {
		  return "<pre> the rating of " . $rating . " is invalid.</pre>";
		}

	}
	add_shortcode( 'eggplant', 'eggplant_func' );
}
add_action('init', 'eggplant_shortcodes_init');


// html for admin page
/*
function eggplant_func_admin_page(){
	if (!current_user_can('manage_options'))  {
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}
    echo "<h1>URL Replacement</h1>";
    echo '<div class="sidebar"><a href="https://earthlinginteractive.com/"><img class="logo" src="' . esc_url( plugins_url( 'assets/images/earthling-interactive-logo.png', __FILE__ ) ) . '" ></a></div>';
   
    echo '<div class="section">';
    echo '<div class="section-header">About</div>';
    echo "<p>This plugin will replace abslute urls with relative when you save a post, page or widget. It will then display a absolute url in the editing pages and on the front end.</p><p> You can also use the search and replace below to change  urls that are already in the database.</p>";
    echo '</div>';
    echo '<div class="section">';
    echo '<div class="section-header">Search & Replace in Database</div>';
    echo "<p><strong>WARNING!</strong> Make sure you have backed up your database before using search & replace!</p><p>Select the tables from the list below that you would like to replace absolute urls with relative urls.<br>Hold down the Ctrl (windows) / Command (Mac) button to select multiple options.</p>";
    echo '<form method="post">';
    echo '<select id="ei-table-select" name="select_tables[]" multiple="multiple" size="15">';
    global $wpdb;
    $tables = $wpdb->get_col( 'SHOW TABLES' );
	foreach ( $tables as $table ) {
		echo "<option value='$table'>$table </option>";
	}

	echo '</select><br><br>';
	echo '<strong>Dry Run</strong>  <input type="checkbox" name="dryrun" value="dryrun" checked="checked"> If checked, no changes will be made to the database and each change will be displayed so that you can check it over before making any changes to the database.<br><br>';
	echo '<input type="hidden" name="relative-urls">
        <button type="submit" class="button-primary">Run URL Replacement</button>
    </form>';

    if(isset($_POST["select_tables"])) {
    	echo '</div>';
    	echo '<div class="results">';

		ei_replace_relative_url_with_absolute_in_database();

		echo '</div>';

	} elseif (isset($_POST["relative-urls"]) && !isset($_POST["select_tables"])) {

		echo '<div class="notice notice-error">Please select one or more tables from the list</div>';
		echo '</div>';
	}
}


// add admin page
function eggplant_func_setup_menu(){
        add_menu_page( 'EGGPLANT', 'EGGPLANT', 'manage_options', 'eggplant-rating', 'eggplant_func_admin_page', 'dashicons-update' );
}
add_action('admin_menu', 'eggplant_func_setup_menu');

// admin page styles
function load_custom_wp_admin_style($hook) {
        // Load only on ?page=eggplant-rating
        if($hook != 'toplevel_page_eggplant-rating') {
                return;
        }
        wp_enqueue_style( 'custom_wp_admin_css', plugins_url('assets/css/admin-styles.css', __FILE__) );
}
add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );
*/
