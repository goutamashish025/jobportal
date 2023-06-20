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
                                    $args = array(
                                                'taxonomy' => 'job_category',
                                                'orderby' => 'name',
                                                'order'   => 'ASC',
                                                'hide_empty' => false
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
                            <h4 class="widgettitle">Recent Post</h4>
                            <ul>

                            </ul>
                        </section>
                        


                    </aside>
                </div>
            </div>
        </div>
    </div>
    <?php
endwhile;
?>