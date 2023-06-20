<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
   integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<?php /* Template Name: PageWithoutSidebar */?>
<?php
get_header();
?>
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
            $current_id = get_the_ID();
            if ($i%3==0){
            ?>
            
               <div class="col-4 col-md-12 col-sm-12 col-lg-4">
                  <div class="card-body">
                     <div class="container text-left">
                           <!-- <div class="row">
                           <a href="<?php the_permalink(); ?>" class="file-title" target="_blank"><img style="height: 100%;"
                                 src="wp-content\themes\hello-elementor\assets\images\iStock-875241826.jpg" class=""
                                 alt=""></a>
                           </div> -->
                           <div class="row">
                                 <i class="fa fa-angle-right" aria-hidden="false"></i>
                                <div class="row"> <?php the_post_thumbnail( array( 200, 200 ) );?></div><a href="<?php the_permalink(); ?>"> <h3 class="card-title"><?php echo get_the_title(); ?></h3></a>
                                 
                                 </i> <h6 class="card-title"><?php 
                                         
                                       ?>
                                    </h6>
                                 <?php
                                       // the_post_thumbnail('thumbnail');
                                       $terms = get_the_terms( get_the_ID(), 'job_category' ); // second argument is category slug of custom post-type
                                       if(!empty($terms)){
                                       foreach($terms as $term){ ?>
                                       <?php echo '<a href="'.get_term_link($term).'">'.$term->name.'</a>';
                                       }
                                       }
                                    $content =  get_the_excerpt(); 
                                    $trim = wp_trim_words( $content, 15, ' ...' ); ?>
                                    <p class="card-text">  <?php echo $trim; ?><a href="<?php the_permalink(); ?>">read more</a></p>
                                 </div>
                           </div>
                        </div>
                     </div>
               <?php
            }else{

            ?>
            <div class="col-4 col-md-12 col-sm-12 col-lg-4">
                  <div class="card-body">
                     <div class="container text-left">
                           <div class="row">
                           <div class="row"> <?php the_post_thumbnail( array( 200, 200 ) );?></div><a href="<?php the_permalink(); ?>"> <h3 class="card-title"><?php echo get_the_title(); ?></h3></a>
                           </div>
                           <div class="row">                                
                              <i class="fa fa-angle-right" aria-hidden="false"></i> <a href="<?php the_permalink(); ?>"> </a>
                              <?php
                                    $terms = get_the_terms( get_the_ID(), 'job_category' ); // second argument is category slug of custom post-type
                                    if(!empty($terms)){
                                    foreach($terms as $term){ ?>
                                       <!-- <h5 class="card-title"><?php echo $term->name; ?></h5> -->
                                  <?php echo '<a href="'.get_term_link($term).'">'.$term->name.'</a>';
                                      
                                       
                                    }
                                    } ?>
                              <!-- <h6 class="card-title"><?php echo get_the_category(); ?></h6> -->
                                    <?php $content =  get_the_excerpt(); 
                                    $trim = wp_trim_words( $content, 15, ' ...' ); ?>
                                    <p class="card-text">  <?php echo $trim; ?><a href="<?php the_permalink(); ?>">read more</a></p>

                              
                              
                              
                           </div>
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