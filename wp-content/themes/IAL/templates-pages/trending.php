<?php

/* Template Name: trending */
get_header();
?>

 <main id="Main" class="competition-wrap">
          <!-- category scetion -->
          <section class="category_block">
            <div class="category_list_wrap">
                <?php
				$args = array(
                    'hide_empty' => false,
				);
				$taxonomy = 'video-category';
				
				$terms = get_terms($taxonomy,$args);

				if ( $terms && !is_wp_error( $terms ) ) :
				foreach ( $terms as $term ){ 
				$term_id = $term->term_id;
				$cat_img = get_field('category_image', 'video-category_'.$term_id);
				?>
               <div class="category_box">
                  <a href="<?php echo get_term_link($term->slug, $taxonomy); ?>">
                     <figure>
                        <img src="<?php echo $cat_img; ?>" alt="category-img-1.jpg" />
                     </figure>
                     <span class="over_title"><?php echo $term->name; ?></span>
                  </a>
               </div>
                <?php 
                }
                endif;
                ?>

            </div>
<!--
            <div class="ads__wrap double_ads">
               <img src="<?php echo get_template_directory_uri(); ?>/assets/images/ads-1.jpg" alt="ads-1.jpg" />
               <img src="<?php echo get_template_directory_uri(); ?>/assets/images/ads-2.jpg" alt="ads-2.jpg" />
            </div>
-->
         </section>

<!--
         <div class="title">
             <h6>Sports</h6>
         </div>
-->
          <section class="most_like_wrap">
          
            <div class="video_block_list">
                <?php
                $args = array(
                    'post_type' => 'videos',
                    'meta_query' => array(
                     array(
                        'meta_key' => 'post_views_count',
                        'orderby' => 'meta_value_num',
                        'order' => 'DESC',
                            )
                        )                      
                    ); 

                $loop = new WP_query($args);
                if ($loop->have_posts()) : 
                while ($loop->have_posts()) : $loop->the_post();
                
                $total_views = get_post_meta(get_the_ID(),'post_views_count',true);
                if($total_views == ''){
                    $total_views = 0;
                }
                $thumbnail_image = get_field('video_thumbnail_image',get_the_ID()); 
                ?>
                <div class="video_block zoom_effect">
                    <figure>
                      <p class="figure_title"><?php echo get_the_title(get_the_ID()); ?></p>
                       <img src="<?php echo $thumbnail_image; ?>" alt="category-img-1.jpg" loading="lazy"/>
                      <a href="<?php echo get_the_permalink(get_the_ID()); ?>" class="material-icons">play_circle_filled</a>
                    </figure>
                   <div class="video_content">
                      <h6><a href="<?php echo get_the_permalink(get_the_ID()); ?>"><?php echo wp_trim_words(get_the_content(get_the_ID()),10,'...'); ?></a></h6>
                      <p class="sub_title"><?php echo $total_views; ?> Views  |  4 days ago</p>
                   </div>
                </div>
                <?php 
                endwhile;
                endif;
                wp_reset_query();
                ?>
             </div>
          </section>


      </main>

<?php
get_footer();
?>