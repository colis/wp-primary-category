<?php
/**
 * WP Primary Category Admin class.
 *
 * @package    wp_primary_category
 * @subpackage wp_primary_category/includes
 * @link       https://github.com/colis/wp-primary-category
 * @since      1.0.0
 * @author     Carmine Colicino <carminecolicino@gmail.com>
 */

/**
 * This class implements the UI to change the primary category
 * in the categories metabox.
 */
class WP_Primary_Category_Admin {

	/**
	 * Create the primary category custom meta box.
	 *
	 * @since    1.0.0
	 */
	public function add_wp_primary_category_box() {

		/**
		 * Filters which post types the primary category meta box can be visualized on.
		 *
		 * @param array  The array of post types.
		 */
		$post_types = apply_filters( 'wp_primary_category_post_types', array( 'post' ) );

		foreach ( $post_types as $post_type ) {
			add_meta_box(
				'wp_primary_category_box_id',
				__( 'Primary Category', 'wp-primary-category' ),
				array( $this, 'wp_primary_category_custom_box_html' ),
				$post_types,
				'side',
				'high'
			);
		}
	}

	/**
	 * Render the HTML for the primary category custom meta box.
	 *
	 * @since    1.0.0
	 * @param    object $post The current post.
	 */
	public function wp_primary_category_custom_box_html( $post ) {
		$primary_category = get_post_meta( $post->ID, 'wp_primary_category', true );

		$post_categories = get_the_category( $post->ID );
		?>

		<p><?php esc_html_e( 'Choose a category from the list to make it primary, and update the post.', 'wp-primary-category' ); ?></p>

		<select name="wp-primary-category-select" id="wp-primary-category-select" class="postbox">
			<option value=""><?php esc_html_e( 'Select a category...', 'wp-primary-category' ); ?></option>

			<?php
			foreach ( $post_categories as $post_category ) {
				?>
				<option value="<?php echo esc_attr( $post_category->term_id ); ?>" <?php echo selected( $primary_category, $post_category->term_id ); ?>><?php echo esc_html( $post_category->name ); ?></option>
				<?php
			}
			?>

		</select>

		<?php
		wp_nonce_field( 'save-wp-primary-category', 'wp_primary_category_nonce' );
	}

	/**
	 * Save the primary category as a post meta.
	 *
	 * @since    1.0.0
	 * @param    int $post_id The post ID.
	 */
	public function save_wp_primary_category( $post_id ) {
		$primary_category_id = filter_input( INPUT_POST, 'wp-primary-category-select', FILTER_SANITIZE_NUMBER_INT );

		if ( null !== $primary_category_id && check_admin_referer( 'save-wp-primary-category', 'wp_primary_category_nonce' ) ) {
			update_post_meta( $post_id, 'wp_primary_category', $primary_category_id );
		}
	}

}
