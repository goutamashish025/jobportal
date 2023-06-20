<?php 
get_header();

?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
   integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<div class="page-content">
		
			<article class="post">
				
			
			<?php
			if ( has_post_thumbnail() ) {
					printf( '<a href="%s">%s</a>', esc_url( $post_link ), get_the_post_thumbnail( array( 130, 130 )  ) );
				}
				?><div id="myModal" class="modal">
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
												<div class="col-4 col-md-12 col-sm-12 col-lg-4">
													<div class="card-body">
														<div class="container text-left">
															<div class="row">
																<img  id="myImg" style='width : 300px' src="<?php echo $slide_photo['url']; ?>" ;

																   ?>
																
					
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
				
				

				<?php
				// printf( '<h2 class="%s"><a href="%s">%s</a></h2>', 'entry-title', esc_url( $post_link ), wp_kses_post( get_the_title() ) );
				if ( has_post_thumbnail() ) {
					// printf( '<a href="%s">%s</a>', esc_url( $post_link ), get_the_post_thumbnail( $post, 'small' ) );
				}
				// the_excerpt();
				?>
			</article>
		
	</div>
	<div class="col-4 col-md-12 col-sm-12 col-lg-4">
                  				<div class="card-body">
                     				<div class="container text-left">
										<div class="row">
				
				

				<?php
				// printf( '<h2 class="%s"><a href="%s">%s</a></h2>', 'entry-title', esc_url( $post_link ), wp_kses_post( get_the_title() ) );
				if ( has_post_thumbnail() ) {
					// printf( '<a href="%s">%s</a>', esc_url( $post_link ), get_the_post_thumbnail( $post, 'small' ) );
				}
				// the_excerpt();
				?>
			</article>
		
	</div>

	<style>
body {font-family: Arial, Helvetica, sans-serif;}

#myImg {
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
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
.modal-content, #caption {  
  -webkit-animation-name: zoom;
  -webkit-animation-duration: 0.6s;
  animation-name: zoom;
  animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
  from {-webkit-transform:scale(0)} 
  to {-webkit-transform:scale(1)}
}

@keyframes zoom {
  from {transform:scale(0)} 
  to {transform:scale(1)}
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
@media only screen and (max-width: 700px){
  .modal-content {
    width: 100%;
  }
}
</style>
<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
// this img = document.getElementsByClassName("preview");
var img = document.getElementById("myImg");
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
  modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal.style.display = "none";
}
</script>