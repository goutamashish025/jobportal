<?php
/**
 * Theme functions and definitions
 *
 * @package HelloElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'HELLO_ELEMENTOR_VERSION', '2.7.1' );

if ( ! isset( $content_width ) ) {
	$content_width = 800; // Pixels.
}

if ( ! function_exists( 'hello_elementor_setup' ) ) {
	/**
	 * Set up theme support.
	 *
	 * @return void
	 */
	function hello_elementor_setup() {
		if ( is_admin() ) {
			hello_maybe_update_theme_version_in_db();
		}

		if ( apply_filters( 'hello_elementor_register_menus', true ) ) {
			register_nav_menus( [ 'menu-1' => esc_html__( 'Header', 'hello-elementor' ) ] );
			register_nav_menus( [ 'menu-2' => esc_html__( 'Footer', 'hello-elementor' ) ] );
		}

		if ( apply_filters( 'hello_elementor_post_type_support', true ) ) {
			add_post_type_support( 'page', 'excerpt' );
		}

		if ( apply_filters( 'hello_elementor_add_theme_support', true ) ) {
			add_theme_support( 'post-thumbnails' );
			add_theme_support( 'automatic-feed-links' );
			add_theme_support( 'title-tag' );
			add_theme_support(
				'html5',
				[
					'search-form',
					'comment-form',
					'comment-list',
					'gallery',
					'caption',
					'script',
					'style',
				]
			);
			add_theme_support(
				'custom-logo',
				[
					'height'      => 100,
					'width'       => 350,
					'flex-height' => true,
					'flex-width'  => true,
				]
			);

			/*
			 * Editor Style.
			 */
			add_editor_style( 'classic-editor.css' );

			/*
			 * Gutenberg wide images.
			 */
			add_theme_support( 'align-wide' );

			/*
			 * WooCommerce.
			 */
			if ( apply_filters( 'hello_elementor_add_woocommerce_support', true ) ) {
				// WooCommerce in general.
				add_theme_support( 'woocommerce' );
				// Enabling WooCommerce product gallery features (are off by default since WC 3.0.0).
				// zoom.
				add_theme_support( 'wc-product-gallery-zoom' );
				// lightbox.
				add_theme_support( 'wc-product-gallery-lightbox' );
				// swipe.
				add_theme_support( 'wc-product-gallery-slider' );
			}
		}
	}
}
add_action( 'after_setup_theme', 'hello_elementor_setup' );

function hello_maybe_update_theme_version_in_db() {
	$theme_version_option_name = 'hello_theme_version';
	// The theme version saved in the database.
	$hello_theme_db_version = get_option( $theme_version_option_name );

	// If the 'hello_theme_version' option does not exist in the DB, or the version needs to be updated, do the update.
	if ( ! $hello_theme_db_version || version_compare( $hello_theme_db_version, HELLO_ELEMENTOR_VERSION, '<' ) ) {
		update_option( $theme_version_option_name, HELLO_ELEMENTOR_VERSION );
	}
}

if ( ! function_exists( 'hello_elementor_scripts_styles' ) ) {
	/**
	 * Theme Scripts & Styles.
	 *
	 * @return void
	 */
	function hello_elementor_scripts_styles() {
		$min_suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		if ( apply_filters( 'hello_elementor_enqueue_style', true ) ) {
			wp_enqueue_style(
				'hello-elementor',
				get_template_directory_uri() . '/style' . $min_suffix . '.css',
				[],
				HELLO_ELEMENTOR_VERSION
			);
		}

		if ( apply_filters( 'hello_elementor_enqueue_theme_style', true ) ) {
			wp_enqueue_style(
				'hello-elementor-theme-style',
				get_template_directory_uri() . '/theme' . $min_suffix . '.css',
				[],
				HELLO_ELEMENTOR_VERSION
			);
		}
	}
}
add_action( 'wp_enqueue_scripts', 'hello_elementor_scripts_styles' );

if ( ! function_exists( 'hello_elementor_register_elementor_locations' ) ) {
	/**
	 * Register Elementor Locations.
	 *
	 * @param ElementorPro\Modules\ThemeBuilder\Classes\Locations_Manager $elementor_theme_manager theme manager.
	 *
	 * @return void
	 */
	function hello_elementor_register_elementor_locations( $elementor_theme_manager ) {
		if ( apply_filters( 'hello_elementor_register_elementor_locations', true ) ) {
			$elementor_theme_manager->register_all_core_location();
		}
	}
}
add_action( 'elementor/theme/register_locations', 'hello_elementor_register_elementor_locations' );

if ( ! function_exists( 'hello_elementor_content_width' ) ) {
	/**
	 * Set default content width.
	 *
	 * @return void
	 */
	function hello_elementor_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'hello_elementor_content_width', 800 );
	}
}
add_action( 'after_setup_theme', 'hello_elementor_content_width', 0 );

if ( is_admin() ) {
	require get_template_directory() . '/includes/admin-functions.php';
}

/**
 * If Elementor is installed and active, we can load the Elementor-specific Settings & Features
*/

// Allow active/inactive via the Experiments
require get_template_directory() . '/includes/elementor-functions.php';

/**
 * Include customizer registration functions
*/
function hello_register_customizer_functions() {
	if ( is_customize_preview() ) {
		require get_template_directory() . '/includes/customizer-functions.php';
	}
}
add_action( 'init', 'hello_register_customizer_functions' );

if ( ! function_exists( 'hello_elementor_check_hide_title' ) ) {
	/**
	 * Check hide title.
	 *
	 * @param bool $val default value.
	 *
	 * @return bool
	 */
	function hello_elementor_check_hide_title( $val ) {
		if ( defined( 'ELEMENTOR_VERSION' ) ) {
			$current_doc = Elementor\Plugin::instance()->documents->get( get_the_ID() );
			if ( $current_doc && 'yes' === $current_doc->get_settings( 'hide_title' ) ) {
				$val = false;
			}
		}
		return $val;
	}
}
add_filter( 'hello_elementor_page_title', 'hello_elementor_check_hide_title' );

/**
 * BC:
 * In v2.7.0 the theme removed the `hello_elementor_body_open()` from `header.php` replacing it with `wp_body_open()`.
 * The following code prevents fatal errors in child themes that still use this function.
 */
if ( ! function_exists( 'hello_elementor_body_open' ) ) {
	function hello_elementor_body_open() {
		wp_body_open();
	}
}

register_post_type( 'jobs',
array(
	'labels' => array(
		'name' => 'Jobs ',
	),
	'public' => true,
	'supports' => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'author' ),
	'has_archive' => true
)
);
add_action( 'init', 'custom_taxonomy', 0 );
function custom_taxonomy() {
$label1 = array(
'name' => _x( 'Job Categories', 'taxonomy general name' ),
'singular_name' => _x( 'Job Category', 'taxonomy singular name' ),
'supports' => __( 'thumbnail'),
'search_items' =>  __( 'Search Category' ),
'all_items' => __( 'All Category' ),
'parent_item' => __( 'Parent Category' ),
'parent_item_colon' => __( 'Parent Category:' ),
'edit_item' => __( 'Edit Category' ), 
'update_item' => __( 'Update Category' ),
'add_new_item' => __( 'Add New Category' ),
'new_item_name' => __( 'New Category Name' ),
'menu_name' => __( 'Categories' ),
); 
register_taxonomy('job_category',array('jobs'), array(
'hierarchical' => true,
'labels' => $label1,
'show_ui' => true,
'show_admin_column' => true,
'query_var' => true,
'rewrite' => array( 'slug' => 'job_category' ),
));
}

// add_action( 'init', 'books', 0 );
// register_post_type( 'books',
// array(
// 	'labels' => array(
// 		'name' => 'Books ',
// 	),
// 	'public' => true,
// 	'supports' => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
// 	'has_archive' => true
// )
// );
// function books() {
// 	$label1 = array(
// 		'name' => _x( 'Books Categories' , 'taxonomy general name '),
// 		'singular_name' => _x('Book category', 'taxonomy singular name' ),
// 		'search_items' => __('Search Category' ),
// 		'all_items' => __(  'All Category' ),
// 		'parent_item' => __( 'Parent Category' ),
// 		'parent_item_colon' => __( 'Parents Category'),
// 		'edit_item' => __( 'Edit category'),
// 		'update_item' => __( 'Update Category'),
// 		'add_new_item' => __( 'Add new Category'),
// 		'new_item_name' => __(  'New Category Name'),
// 		'menu_name' => __(  "Categories"),
// 	);
// 	register_taxonomy('book_category', array('books'), array(
// 		'hierarchical' => true,
// 		'labels' => $label1,
// 		'show_ui' => true,
// 		'show_admin_column' => true,
// 		'query_var' => true,
// 		'rewrite' => array( 'slug' => 'book_category')
// 	));
// }

function add_category_image_field() {
    ?>
    <div class="form-field">
        <label for="category-image"><?php _e('Category Image'); ?></label>
        <button class="custom_media_upload">Upload Image</button>
    </div>
    <?php
}

add_action('category_add_form_fields', 'add_category_image_field', 10, 2);

function display_category_image_field($term) {
    $image = get_term_meta($term->term_id, 'category-image', true);
    ?>
    <tr class="form-field">
        <th scope="row"><label for="category-image"><?php _e('Category Image'); ?></label></th>
        <td>
            <input type="file" class="custom_media_url" name="category-image" id="category-image" value="<?php echo $image; ?>">
            <button class="custom_media_upload">Upload Image</button>
        </td>
    </tr>
    <?php
}

add_action('category_edit_form_fields', 'display_category_image_field', 10, 2);

function save_category_image_field($term_id) {
    if (isset($_POST['category-image'])) {
        update_term_meta($term_id, 'category-image', $_POST['category-image']);
    }
}

add_action('edited_category', 'save_category_image_field', 10, 2);
add_action('create_category', 'save_category_image_field', 10, 2);

// Add a custom category image field to the custom taxonomy
function add_custom_taxonomy_image_field() {
    ?>
    <div class="form-field">
        <label for="taxonomy-image"><?php _e('Category Image'); ?></label>
        <input type="file" class="custom_media_url" name="taxonomy-image" id="taxonomy-image" value="">
        <button class="custom_media_upload">Upload Image</button>
    </div>
    <?php
}

add_action('custom_taxonomy_add_form_fields', 'add_custom_taxonomy_image_field', 10, 2);

// Add a custom category image field to the custom taxonomy edit page
function display_custom_taxonomy_image_field($term) {
    $image = get_term_meta($term->term_id, 'taxonomy-image', true);
    ?>
    <tr class="form-field">
        <th scope="row"><label for="taxonomy-image"><?php _e('Category Image'); ?></label></th>
        <td>
            <input type="file" class="custom_media_url" name="taxonomy-image" id="taxonomy-image" value="<?php echo $image; ?>">
            <button class="custom_media_upload">Upload Image</button>
        </td>
    </tr>
    <?php
}

add_action('custom_taxonomy_edit_form_fields', 'display_custom_taxonomy_image_field', 10, 2);

// Save the custom category image field value
function save_custom_taxonomy_image_field($term_id) {
    if (isset($_POST['taxonomy-image'])) {
        update_term_meta($term_id, 'taxonomy-image', $_POST['taxonomy-image']);
    }
}

add_action('edited_custom_taxonomy', 'save_custom_taxonomy_image_field', 10, 2);
add_action('create_custom_taxonomy', 'save_custom_taxonomy_image_field', 10, 2);


// Display the custom category image on the custom post type archive page or single post page
function display_custom_taxonomy_image() {
    if (is_tax('job_category')) {
        $term = get_queried_object();
        $image = get_term_meta($term->term_id, 'taxonomy-image', true);
        if ($image) {
            echo '<img src="' . $image . '">';
        }
    }
}

add_action('before_custom_post_type_loop', 'display_custom_taxonomy_image');
add_action('custom_post_type_single', 'display_custom_taxonomy_image');
