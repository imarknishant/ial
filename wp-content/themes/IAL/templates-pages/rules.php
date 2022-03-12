<?php
/* Template Name: rules */
get_header();
global $post;
?>

	<main id="Main">
	    <section class="most__viewed__wrap about-page">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
					    <div class="heading">
						   <h1 class="terms-title"><?php the_title(); ?></h1>
						</div>
					 <?php the_content(); ?>				
					</div>		 
				</div>		
			</div>		
		</div>	
		</section>
	</main>

<?php
get_footer();
?>