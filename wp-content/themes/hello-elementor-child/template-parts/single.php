<?php /* Template Name: Job Details 
Template Post Type: post, page, jobs*/
?>

<?php
get_header();
?>


<main id="content" <?php post_class( 'site-main' ); ?>>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <?php if (apply_filters('hello_elementor_page_title', true)): ?>
    <header class="page-header">

    </header>
    <?php endif; ?>
    <div class="container">
        <div class="container text-left">
            <div class="row">
                <div class="container col-8">
                    <div class="page-content">
                                <?php while (have_posts()):
                        the_post(); ?>
                                <!-- <?php the_post_thumbnail('thumbnail'); ?> -->
                                <!-- <h2><?php echo get_the_title(); ?></h2> -->
                                <?php the_post_thumbnail(array(200, 200)) ?>
                                <?php
                        if (has_post_thumbnail()) {
                            printf('<a href="%s">%s</a>', esc_url($post_link), get_the_post_thumbnail(array(130, 130)));
                        }
                        ?>

                        <?php the_content(); ?>
                        <div class="post-tags">
                            <?php the_tags('<span class="tag-links">' . esc_html__('Tagged ', 'hello-elementor'), null, '</span>'); ?>
                        </div>
                        <?php wp_link_pages(); ?>
                        <br><br>
                        <div id="myModal" class="modal">
                            <span class="close">&times;</span>
                            <img class="modal-content" id="img01">
                        </div>
                        <div class="card" style="width: device-width;">
                            <div class="card-body">
                                <div class="container text-center">
                                    <div class="row">
                                        <?php
								if (have_rows('multiuserimage')) {
									while (have_rows('multiuserimage')) {
										the_row();
										$slide_photo = get_sub_field('photoacf');
										$slideName = get_sub_field('name');
										if (!empty($slide_photo)) {
											?>
                                        <div class="col-3 col-md-12 col-sm-12 col-lg-3">
                                            <div class="card-body">
                                                <div class="container text-left">
                                                    <div class="row">
                                                        <img id="myImg" class="myImg" style='width : 300px'
                                                            src="<?php echo $slide_photo['url']; ?>" ; ?>


                                                        <p>
                                                            <?php echo $slideName; ?>
                                                        </p>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <?php }
									}
								} ?>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>




                <div class="container col-4">
                    <aside id="sidebar">

                        <section class="widget">
                            <h4 class="widgettitle">Categories</h4>
                            <ul>
                                <?php
                                   $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
								   $args = array(
									  'taxonomy' => 'job_category',
									  'post_type' => 'jobs',
									  'field' => 'slug',
									  'post_status' => 'publish',
									  'posts_per_page' => 6,
									  'paged' => $paged
								   );
                                    $cats = get_categories($args);

                                    foreach($cats as $cat) {
                                    ?>
                                <a class="recentlist" href="<?php echo get_category_link( $cat->term_id ) ?>">
                                    <h5>
                                        <div> <?php echo $cat->name; ?></div>
                                    </h5>
                                </a>
                                <?php
                                    }
                                    ?>
                            </ul>
                        </section>
                      


                    </aside>




                    <aside id="sidebar">

                        <section class="widget">
                            <h4 class="widgettitle">Recent Job Post</h4>
                            <ul>
							<?php
							$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
							$args = array(
							'taxonomy' => 'job_category',
							'post_type' => 'jobs',
							'field' => 'slug',
							'post_status' => 'publish',
							'posts_per_page' => 6,
							'paged' => $paged
							);
							$loop = new WP_Query( $args );
							while ( $loop->have_posts() ) : $loop->the_post();
							$i++;
							$current_id = get_the_ID();
							?>
							
							<ul>
							
								<a class="recentlist" href="<?php the_permalink(); ?>"><p><?php the_post_thumbnail(array(50, 50)) ?>  &nbsp; <?php echo get_the_title(); ?></p></a>
								
							</ul>

							<?php endwhile; ?>
							
                        </section>
                        


                    </aside>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
endwhile;
?>
<style>
body {
    font-family: Arial, Helvetica, sans-serif;
}

#myImg {
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
}

#myImg:hover {
    opacity: 0.7;
}

/* The Modal (background) */
.modal {
    display: none;
    /* Hidden by default */
    position: fixed;
    /* Stay in place */
    z-index: 1;
    /* Sit on top */
    padding-top: 100px;
    /* Location of the box */
    left: 0;
    top: 0;
    width: 100%;
    /* Full width */
    height: 100%;
    /* Full height */
    overflow: auto;
    /* Enable scroll if needed */
    background-color: rgb(0, 0, 0);
    /* Fallback color */
    background-color: rgba(0, 0, 0, 0.9);
    /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
}

/* Caption of Modal Image */
#caption {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
    text-align: center;
    color: #ccc;
    padding: 10px 0;
    height: 150px;
}

/* Add Animation */
.modal-content,
#caption {
    -webkit-animation-name: zoom;
    -webkit-animation-duration: 0.6s;
    animation-name: zoom;
    animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
    from {
        -webkit-transform: scale(0)
    }

    to {
        -webkit-transform: scale(1)
    }
}

@keyframes zoom {
    from {
        transform: scale(0)
    }

    to {
        transform: scale(1)
    }
}

/* The Close Button */
.close {
    position: absolute;
    top: 15px;
    right: 35px;
    color: #f1f1f1;
    font-size: 40px;
    font-weight: bold;
    transition: 0.3s;
}

.close:hover,
.close:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px) {
    .modal-content {
        width: 100%;
    }
}

.widget {
    padding: 20px;
    border-radius: 5px;
    margin-bottom: 30px;
    box-shadow: #63636333 0 2px 8px;
}

.recentlist {
    border-bottom: 1px solid #e3e3e3;
    padding: 20px 0;
    color: black;
    text-decoration: none;
    display: block;

}
</style>
<script>
// Get the modal
var modal = document.getElementById("myModal");
var img = document.getElementsByClassName("myImg");
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");

jQuery(".myImg").click(function() {
    modal.style.display = "block";
    modalImg.src = this.src;
});

var span = document.getElementsByClassName("close")[0];
span.onclick = function() {
    modal.style.display = "none";
}
</script>