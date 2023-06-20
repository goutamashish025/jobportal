<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
   integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<?php /* Template Name: copyWithoutSidebar */?>
<?php
get_header();
?>
<?php
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$args = array(
   'post_type' => 'jobs',
   'posts_per_page' => 3,
   'paged' => $paged
);
   ?>
   <div class="card" style="width: device width;">
      <div class="card-body">
         <div class="container text-center">
            <div class="row">
               <?php
            
            $i = 1;
            $loop = new WP_Query( $args );
            while ( $loop->have_posts() ) : $loop->the_post();
            $i++;
            if ($i%3==0){
            ?>
            
               <div class="col-4 col-md-4 col-sm-4 col-lg-4">
                  <div class="card-body">
                     <div class="container text-left">
                        <!-- <div class="row"> -->
                           <div class="row">
                              <img style="height: 100%;"
                                 src="wp-content\themes\hello-elementor\assets\images\iStock-875241826.jpg" class=""
                                 alt="">
                           </div>
                           <div class="row">
                              <!-- <h5 class="card-title"> -->
                                 <a href="<?php the_permalink(); ?>" class="file-title" target="_blank">
                                    <i class="fa fa-angle-right" aria-hidden="false"></i> <h3 class="card-title"><?php echo get_the_title(); ?></h3>
                                    <p class="card-text"><?php echo the_excerpt(); ?></p>
                                 </a>
                              <!-- </h5> -->
                              
                              
                           </div>

                        <!-- </div> -->
                     </div>
                  </div>
               </div>
               <?php
            }else{

            ?>
            <div class="col-4 col-md-4 col-sm-4 col-lg-4">
                  <div class="card-body">
                     <div class="container text-left">
                        <!-- <div class="row"> -->
                           <div class="row">
                              <img style="height: 100%;"
                                 src="wp-content\themes\hello-elementor\assets\images\iStock-875241826.jpg" class=""
                                 alt="">
                           </div>
                           <div class="row">
                              <!-- <h5 class="card-title"> -->
                                 <a href="<?php the_permalink(); ?>" class="file-title" target="_blank">
                                    <i class="fa fa-angle-right" aria-hidden="true"></i> <h3 class="card-title"><?php echo get_the_title(); ?></h3>
                                    <p class="card-text"><?php echo the_excerpt(); ?></p>

                                 </a>
                              <!-- </h5> -->
                              
                              
                           </div>

                        <!-- </div> -->
                     </div>
                  </div>
               </div>
               <?php
            }
            endwhile;
            
               ?>
               <div class="pagination">
                  <?php
                     $big = 999999999;
                     echo paginate_links( array(
                           'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
                           'format' => '?paged=%#%',
                           'current' => max( 1, get_query_var('paged') ),
                           'total' => $loop->max_num_pages,
                           'prev_text' => '&laquo;',
                           'next_text' => '&raquo;'
                     ) );
                  ?>
               </div>
               <?php wp_reset_postdata(); ?>
         
               
            </div>
         </div>
      </div>
      </div>

   <?php
   get_footer();

   ?>