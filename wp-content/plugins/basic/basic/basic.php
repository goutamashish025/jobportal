
<?php
/**
 * basic
 *
 * @package       BASIC
 * @author        Rudraksh
 * @license       gplv2
 * @version       1.0.0
 *
 * @wordpress-plugin
 * Plugin Name:   basic
 * Plugin URI:    https://basic.com
 * Description:   It Is Just a Basic Plugin For Demo
 * Version:       1.0.0
 * Author:        Rudraksh
 * Author URI:    https://your-author-domain.com
 * Text Domain:   basic
 * Domain Path:   /languages
 * License:       GPLv2
 * License URI:   https://www.gnu.org/licenses/gpl-2.0.html
 *
 * You should have received a copy of the GNU General Public License
 * along with basic. If not, see <https://www.gnu.org/licenses/gpl-2.0.html/>.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;
// Plugin name
define( 'BASIC_NAME',			'basic' );

// Plugin version
define( 'BASIC_VERSION',		'1.0.0' );

// Plugin Root File
define( 'BASIC_PLUGIN_FILE',	__FILE__ );

// Plugin base
define( 'BASIC_PLUGIN_BASE',	plugin_basename( BASIC_PLUGIN_FILE ) );

// Plugin Folder Path
define( 'BASIC_PLUGIN_DIR',	plugin_dir_path( BASIC_PLUGIN_FILE ) );

// Plugin Folder URL
define( 'BASIC_PLUGIN_URL',	plugin_dir_url( BASIC_PLUGIN_FILE ) );

/**
 * Load the main class for the core functionality
 */
require_once BASIC_PLUGIN_DIR . 'core/class-basic.php';

/**
 * The main function to load the only instance
 * of our master class.
 *
 * @author  Rudraksh
 * @since   1.0.0
 * @return  object|Basic
 */
function BASIC() {
	return Basic::instance();
}

BASIC();

/**
 *  create a table wp_Contact.
 */


global $jal_db_version;
$jal_db_version = '1.0';

function jal_install() {
	global $wpdb;
	global $jal_db_version;

	$table_name = $wpdb->prefix . 'Contact';
	
	// Function for create or update the table

	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		name varchar(250) DEFAULT '' NOT NULL,
		time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		email varchar(250) DEFAULT '' NOT NULL,
		subject varchar(250) DEFAULT '' NOT NULL,
		descripton text NOT NULL,
		PRIMARY KEY  (id)
	) $charset_collate;";

	require_once ABSPATH . 'wp-admin/includes/upgrade.php';
	dbDelta( $sql );

	// Versio information

	add_option( 'jal_db_version', $jal_db_version );
}

function jal_install_data() {
	global $wpdb;
	

	// Adding Initial Data
	
	$welcome_name = 'Mr. WordPress';
	$welcome_email = 'example@gmail.com';
	$Welcome_subject = 'Welcome message';
	$welcome_text = 'Congratulations, you just completed the installation!';
	
	$table_name = $wpdb->prefix . 'Contact';
	
	$wpdb->insert( 
		$table_name, 
		array( 
			'time' => current_time( 'mysql' ), 
			'name' => $welcome_name, 
			'email' => $welcome_email,
			'subject' => $Welcome_subject,
			'descripton' => $welcome_text, 
		) 
	);
}

// Calling the functions

register_activation_hook( __FILE__, 'jal_install' );
register_activation_hook( __FILE__, 'jal_install_data' );

// Update Option 

global $wpdb;
$installed_ver = get_option( "jal_db_version" );

if ( $installed_ver != $jal_db_version ) {

	$table_name = $wpdb->prefix . 'Contact';

	
	$sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		name varchar(250) DEFAULT '' NOT NULL,
		time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		email varchar(250) DEFAULT '' NOT NULL,
		subject varchar(250) DEFAULT '' NOT NULL,
		descripton text NOT NULL,
		PRIMARY KEY  (id)
	);";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );

	update_option( "jal_db_version", $jal_db_version );
}


function myplugin_update_db_check() {
    global $jal_db_version;
    if ( get_site_option( 'jal_db_version' ) != $jal_db_version ) {
        jal_install();
    }
}
add_action( 'plugins_loaded', 'myplugin_update_db_check' );



/**
 * Registers the basic post type.
 */
function basic_register_post_types() {

	// Set UI labels for the basic post type.
	$labels = array(
		'name' => _x( 'basic', 'Post Type General Name', 'basic' ),
		'singular_name' => _x( 'basic', 'Post Type Singular Name', 'basic' ),
		'menu_name' => __( 'basic', 'basic' ),
		'parent_item_colon' => __( 'Parent basic', 'basic' ),
		'all_items' => __( 'All basic', 'basic' ),
		'view_item' => __( 'View basic', 'basic' ),
		'add_new_item' => __( 'Add New basic', 'basic' ),
		'add_new' => __( 'Add New', 'basic' ),
		'edit_item' => __( 'Edit basic', 'basic' ),
		'update_item' => __( 'Update basic', 'basic' ),
		'search_items' => __( 'Search basic', 'basic' ),
		'not_found' => __( 'Not Found', 'basic' ),
		'not_found_in_trash' => __( 'Not found in Trash', 'basic' ),
	);

	// Set other arguments for the basic post type.
	$args = array(
		'label' => __( 'basic', 'basic' ),
		'description' => __( 'basic.', 'basic' ),
		'labels' => $labels,
		'supports' => array(
			'title',
			'editor',
			'excerpt',
			'author',
			'thumbnail',
			'comments',
			'revisions',
			'custom-fields',
		),
		'taxonomies' => array(),
		'hierarchical' => false,
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'show_in_admin_bar' => true,
		'menu_position' => 5,
		'can_export' => true,
		'has_archive' => true,
		'exclude_from_search' => false,
		'publicly_queryable' => true,
		'capability_type' => 'post',
		'show_in_rest' => true,
	);

	// Registes the basic post type.
	register_post_type( 'basic', $args );

}
add_action( 'init', 'basic_register_post_types' );


function get_username( $prefix = '' ){
    $user_exists = 1;
    do {
       $rnd_str = sprintf("%06d", mt_rand(1, 999999));
	   
       $user_exists = username_exists( $prefix . $rnd_str );
   } while( $user_exists > 0 );
   return $prefix . $rnd_str;
}



function subscribe_link_shortcode() {

	include dirname( __FILE__ ) . './my_form_template.php';
	
  }
  
  add_shortcode('basic-subscribe', 'subscribe_link_shortcode');
  
