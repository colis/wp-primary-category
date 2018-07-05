<?php
/**
 * WP Primary Category assets class.
 *
 * @package    wp_primary_category
 * @subpackage wp_primary_category/includes
 * @link       https://github.com/colis/wp-primary-category
 * @since      1.0.0
 * @author     Carmine Colicino <carminecolicino@gmail.com>
 */

/**
 * Enqueues the WP Primary Category assets.
 */
class WP_Primary_Category_Assets {

	/**
	 * Register the assets.
	 *
	 * @since    1.0.0
	 * @param    $string $hook The current admin page.
	 */
	public function enqueue_wp_primary_category_assets( $hook ) {

		if ( in_array( $hook, array( 'post.php', 'post-new.php' ), true ) ) {

			wp_register_script( 'wp-primary-category-js', plugins_url( '../dist/scripts/scripts.min.js', __FILE__ ), array( 'jquery' ), false, true );
			wp_enqueue_script( 'wp-primary-category-js' );

		}
	}

}
