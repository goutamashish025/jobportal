<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous"> -->
<?php
/**
 * The template for displaying archive pages.
 *
 * @package HelloElementor
 */
get_header();
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<main id="content" class="site-main">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
   integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
	<?php if ( apply_filters( 'hello_elementor_page_title', true ) ) : ?>
		<header class="page-header">
			<?php
			
			// the_archive_description( '<p class="archive-description">', '</p>' );
			?>
		</header>
	<?php endif; ?>
	<div class="page-content">
			<article class="post">
				
			
			<?php
			if ( has_post_thumbnail() ) {
					printf( '<a href="%s">%s</a>', esc_url( $post_link ), get_the_post_thumbnail( array( 130, 130 )  ) );
				}
				?>
				 
					  
			<div class="card" style="width: device-width;">
				<div class="card-body">
					<div class="container text-center">
 					 	<div class="row">
						  <?php
					while ( have_posts() ) {
					the_post();
					$post_link = get_permalink();
					?>
					  		<div class="col-3 col-md-12 col-sm-12 col-lg-">
                  				<div class="card-body">
                     				<div class="container text-left">
										<div class="row">
										<h5 class="card-title"><?php
										if ( has_post_thumbnail() ) {
											printf( '<a href="%s">%s</a>', esc_url( $post_link ), get_the_post_thumbnail( $post, 'small' ) );
									   }
											printf('<h2 class="%s"><a href="%s">%s</a></h2>', 'entry-title', esc_url($post_link), wp_kses_post(get_the_title())); ?>
										</h5>
										<p class="card-text">
											<?php $content = get_the_excerpt();
											$trim = wp_trim_words( $content, 25, ' ...' ); ?> 
											 <p class="card-text">  <?php echo $trim; ?><a href="<?php the_permalink(); ?>">read more</a></p>
											<?php ; ?>
										</p>
											</div>
									</div>
								</div>
								
							</div>
							<?php } ?>
						</div>
						
					</div>
				</div>
				
				

				<?php
				// printf( '<h2 class="%s"><a href="%s">%s</a></h2>', 'entry-title', esc_url( $post_link ), wp_kses_post( get_the_title() ) );
				if ( has_post_thumbnail() ) {
					// printf( '<a href="%s">%s</a>', esc_url( $post_link ), get_the_post_thumbnail( $post, 'small' ) );
				}
				// the_excerpt();
				?>
			</article>
		
	</div>
	<?php wp_link_pages(); ?>

	<?php
	global $wp_query;
	if ( $wp_query->max_num_pages > 1 ) :
		?>
		<nav class="pagination">
			<?php /* Translators: HTML arrow */ ?>
			<div class="nav-previous"><?php next_posts_link( sprintf( __( '%s older', 'hello-elementor' ), '<span class="meta-nav">&larr;</span>' ) ); ?></div>
			<?php /* Translators: HTML arrow */ ?>
			<div class="nav-next"><?php previous_posts_link( sprintf( __( 'newer %s', 'hello-elementor' ), '<span class="meta-nav">&rarr;</span>' ) ); ?></div>
		</nav>
	<?php endif; ?>
</main>
