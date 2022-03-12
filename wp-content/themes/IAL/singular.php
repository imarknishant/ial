<?php
/**
 * The template for displaying single posts and pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
global $post;
$post->ID;
$featured_img = get_the_post_thumbnail_url($post->ID,'full');
?>

	<main id="Main">		
	    <section class="category_block">
			<div class="title">
			   <h6><?php echo the_title(); ?></h6>
			</div>
			<div class="container">
				<div class="row">
				<div class="col-lg-12">
					<div class="single_img">
					<img src="<?php echo $featured_img; ?>">					
					</div>
                    <div class="single_content">
					<p><?php the_content(); ?></p>
                    </div>					
				</div>			
				</div>
			</div>
		</section>
    </main>		

<?php 
get_footer(); 
?>
