<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();
$search = $_GET['s'];
?>

	<main id="Main">		
	    <section class="category_block">
			<div class="title">
			   <h6>You have searched for "<?php echo $search; ?>"</h6>
			</div>
            <br>
			<div class="video_block_list">
                
		<?php
		   $args = array(
				  'post_type' => 'videos',
				  'post_status' => 'publish',
				  'posts_per_page' => -1,
				  's' => $search,

		  );
			$loop = new Wp_query($args);
			if($loop->have_posts()){
			while($loop->have_posts()): $loop->the_post();
			global $product;
                
            $total_views = get_post_meta(get_the_ID(),'post_views_count',true);
            if($total_views == ''){
                $total_views = 0;
            }
                
			$thumbnail_image = get_field('video_thumbnail_image',get_the_ID());
		?>            
				<div class="video_block zoom_effect">
                <figure>
                  <p class="figure_title"><?php echo get_the_title(get_the_ID()); ?></p>
                   <img src="<?php echo $thumbnail_image; ?>" alt="category-img-1.jpg" />
                    <a href="<?php echo get_the_permalink(get_the_ID()); ?>" class="material-icons">play_circle_filled</a>
                </figure>
                <div class="video_content">
                   <h6><a href="<?php echo get_the_permalink(get_the_ID()); ?>"><?php echo wp_trim_words(get_the_content(get_the_ID()),10,'...'); ?></a></h6>
                   <p class="sub_title"><?php echo $total_views; ?> Views  | <?php echo get_the_date(); ?></p>
                </div>
             </div>
				
			<?php
				endwhile;
				wp_reset_query();
				}else{
					
				echo '<h2>Ooops ! No matched found :( </h2>';
					
				}
			?>

			</div>
		</section>		
	</main>

<?php
get_footer();
