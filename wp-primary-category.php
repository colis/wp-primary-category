<?php
/**
 * Plugin Name: WP Primary Category
 * Description: This plugin allows publishers to designate a primary category for posts.
 * Version:     1.0.0
 * Author:      Carmine Colicino
 * Author URI:  https://github.com/colis/
 * Text Domain: wp-primary-category
 * Domain Path: /languages/
 *
 * @package    wp_primary_category
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Runs during WP Primary Category activation.
 * This action is documented in includes/class-wp-primary-category-activator.php
 */
function activate_wp_primary_category() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-primary-category-activator.php';
	WP_Primary_Category_Activator::activate();
}

/**
 * Runs during WP Primary Category deactivation.
 * This action is documented in includes/class-wp-primary-category-deactivator.php
 */
function deactivate_wp_primary_category() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-primary-category-deactivator.php';
	WP_Primary_Category_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wp_primary_category' );
register_deactivation_hook( __FILE__, 'deactivate_wp_primary_category' );

/**
 * The core plugin class that is used to define utilities, internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-primary-category.php';

/**
 * Initialize WP Primary Category.
 *
 * @since    1.0.0
 */
function run_wp_primary_category() {

	$plugin = new WP_Primary_Category();
	$plugin->run();

}
run_wp_primary_category();
