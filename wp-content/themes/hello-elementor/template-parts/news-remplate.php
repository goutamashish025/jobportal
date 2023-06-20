<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
   integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<?php /* Template Name: PageWithoutSidebar */?>
<?php
get_header();
?>
<?php
$args = array(

   'taxonomy' => 'job_category',
   'orderby' => 'name',
   'order' => 'ASC'
);



   ?>
   <div class="card" style="width: device width;">
      <div class="card-body">
         <div class="container text-center">
            <div class="row">
               <?php
            $cats = get_categories($args);
            $i = 1;
            foreach ($cats as $cat) {
               ?>
               <div class="col">
                  <div class="card-body">
                     <div class="container text-left">
                        <div class="row">
                           <div class="row">
                              <img style="height: 100%;"
                                 src="wp-content\themes\hello-elementor\assets\images\iStock-875241826.jpg" class=""
                                 alt="">
                           </div>
                           <div class="row">
                              <h5 class="card-title"><a href="<?php echo get_category_link($cat->term_id) ?>">
                                    <?php echo $cat->name; ?>
                                 </a></h5>
                              <p class="card-text">
                                 <?php echo mb_strimwidth($cat->description, 0, 150); ?>
                              </p>
                              <a class="btn btn-primary btn-sm" href="<?php echo get_category_link($cat->term_id) ?>"
                                 role="button">View more</a>
                           </div>

                        </div>
                     </div>
                  </div>
               </div>
               <?php
               }
               ?>
               <!-- <div class="col">
                  <div class="card-body">
                     <div class="container text-left">
                        <div class="row">
                           <div class="row">
                              <img style="height: 100%;"
                                 src="wp-content\themes\hello-elementor\assets\images\iStock-875241826.jpg" class=""
                                 alt="">
                           </div>
                           <div class="row">
                              <h5 class="card-title"><a href="<?php echo get_category_link($cat->term_id) ?>">
                                    <?php echo $cat->name; ?>
                                 </a></h5>
                              <p class="card-text">
                                 <?php echo mb_strimwidth($cat->description, 0, 150); ?>
                              </p>
                              <a class="btn btn-primary btn-sm" href="<?php echo get_category_link($cat->term_id) ?>"
                                 role="button">View more</a>
                           </div>

                        </div>
                     </div>
                  </div>
               </div> -->
               <!-- <div class="col">
                  <div class="card-body">
                     <div class="container text-left">
                        <div class="row">
                           <div class="row">
                              <img style="height: 100%;"
                                 src="wp-content\themes\hello-elementor\assets\images\iStock-875241826.jpg" class=""
                                 alt="">
                           </div>
                           <div class="row">
                              <h5 class="card-title"><a href="<?php echo get_category_link($cat->term_id) ?>">
                                    <?php echo $cat->name; ?>
                                 </a></h5>
                              <p class="card-text">
                                 <?php echo mb_strimwidth($cat->description, 0, 150); ?>
                              </p>
                              <a class="btn btn-primary btn-sm" href="<?php echo get_category_link($cat->term_id) ?>"
                                 role="button">View more</a>
                           </div>

                        </div>
                     </div>
                  </div>
               </div> -->
            </div>
         </div>
      </div>

   <?php
   get_footer();

   ?>