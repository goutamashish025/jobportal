<?php
/**
 * The template for displaying category archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Hello Elementor
 * @since 1.0
 * @version 2.7.1
 */

get_header(); 


// get the current taxonomy term
$term = get_queried_object();


// vars
$image = get_field('image', $term);
$color = get_field('color', $term);

?>
<style type="text/css">
    
    .entry-title a {
        color: <?php echo $color; ?>;
    }
    
    <?php if( $image ): ?>
    .site-header {
        background-image: url(<?php echo $image['url']; ?>);
    }
    <?php endif; ?>
    
</style>
<div class="wrap">
    
    <?php // Remaining template removed from example ?>
<?php

    function get_the_category( $post_id = false ) {
	$categories = get_the_terms( $post_id, 'category' );
	if ( ! $categories || is_wp_error( $categories ) ) {
		$categories = array();
	}

	$categories = array_values( $categories );

	foreach ( array_keys( $categories ) as $key ) {
		_make_cat_compat( $categories[ $key ] );
	}

	/**
	 * Filters the array of categories to return for a post.
	 *
	 * @since 3.1.0
	 * @since 4.4.0 Added the `$post_id` parameter.
	 *
	 * @param WP_Term[] $categories An array of categories to return for the post.
	 * @param int|false $post_id    The post ID.
	 */
	return apply_filters( 'get_the_categories', $categories, $post_id );
}
?>