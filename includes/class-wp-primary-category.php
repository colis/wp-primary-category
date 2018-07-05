<?php
/**
 * WP Primary Category core class.
 *
 * A class definition that includes hooks & functions used by the
 * admin area.
 *
 * @package    wp_primary_category
 * @subpackage wp_primary_category/includes
 * @link       https://github.com/colis/wp-primary-category
 * @since      1.0.0
 * @author     Carmine Colicino <carminecolicino@gmail.com>
 */

/**
 * WP Primary Category core class.
 *
 * This is used to define internationalization, assets and the admin UI.
 *
 * Also maintains the unique identifier for WP Primary Category as well as
 * the current version of the plugin.
 */
class WP_Primary_Category {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      WP_Primary_Category_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of WP Primary Category.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * The Option Prefix for WP Primary Category.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $option_name    The option prefix for WP Primary Category.
	 */
	protected $option_name;

	/**
	 * Define the core functionality of WP Primary Category.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the assets and the admin area.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name = 'wp-primary-category';
		$this->version     = '1.0.0';
		$this->option_name = 'wp_primary_category_';

		$this->load_dependencies();
		$this->set_locale();
		$this->enqueue_assets();
		$this->render_ui();

	}

	/**
	 * Load the required dependencies for WP Primary Category.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - WP_Primary_Category_Loader. Orchestrates the hooks of the plugin.
	 * - WP_Primary_Category_i18n. Defines internationalization functionality.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wp-primary-category-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wp-primary-category-i18n.php';

		/**
		 * The class responsible for enqueuing all the assets.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wp-primary-category-assets.php';

		/**
		 * The class responsible for implementing the UI to change the primary category
		 * in the categories metabox.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wp-primary-category-admin.php';

		$this->loader = new WP_Primary_Category_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the WP_Primary_Category_I18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new WP_Primary_Category_I18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register the hooks related to the WP Primary Category assets.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function enqueue_assets() {

		$wp_primary_category_assets = new WP_Primary_Category_Assets();

		// Enqueue assets.
		$this->loader->add_action( 'admin_enqueue_scripts', $wp_primary_category_assets, 'enqueue_wp_primary_category_assets' );

	}

	/**
	 * Initialize the WP Primary Category UI.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function render_ui() {

		$wp_primary_category_admin = new WP_Primary_Category_Admin();

		// Build the WP Primary Category custom meta box.
		$this->loader->add_action( 'add_meta_boxes', $wp_primary_category_admin, 'add_wp_primary_category_box' );

		// Save the primary category in a post meta field.
		$this->loader->add_action( 'save_post', $wp_primary_category_admin, 'save_wp_primary_category' );
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {

		$this->loader->run();

	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {

		return $this->plugin_name;

	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Boomerang_API_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {

		return $this->loader;

	}

	/**
	 * Retrieve the version number of WP Primary Category.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {

		return $this->version;

	}

	/**
	 * Retrieve the option prefix for WP Primary Category.
	 *
	 * @since     1.0.0
	 * @return    string    The option name prefix of the plugin.
	 */
	public function get_option_name() {

		return $this->option_name;

	}

}
