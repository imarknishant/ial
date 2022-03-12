<?php

/* Template Name: Most likes */
get_header();
?>

<main id="Main" class="competition-wrap">
         <div class="title">
             <h6>Most Liked</h6>
         </div>
          <section class="most_like_wrap">
            <div class="video_block_list">
                <?php 
                $totalLikes = $wpdb->get_results("SELECT Post_id as post, COUNT(Post_id) AS total_like FROM like_dislike WHERE like_count=1 GROUP BY post ORDER BY total_like DESC LIMIT 20");
                
			    foreach($totalLikes as $item_v){
                    if(get_post_type($item_v->post)){
                    $total_views = get_post_meta($item_v->post,'post_views_count',true);
                    if($total_views == ''){
                        $total_views = 0;
                    }
                    $thumbnail_image = get_field('video_thumbnail_image',$item_v->post); 
                
                ?>
                <div class="video_block zoom_effect">
                    <figure>
                      <p class="figure_title"><?php echo get_the_title($item_v->post); ?></p>
                       <img src="<?php echo $thumbnail_image; ?>" alt="category-img-1.jpg" loading="lazy"/>
                        <a href="<?php echo get_the_permalink($item_v->post); ?>" class="material-icons">play_circle_filled</a>
                    </figure>
                   <div class="video_content">
                      <h6><a href="<?php echo get_the_permalink($item_v->post); ?>"><?php echo wp_trim_words(get_the_content($item_v->post),10,'...'); ?></a></h6>
                      <p class="sub_title"><?php echo $total_views; ?> Views  |  4 days ago</p>
                   </div>
                </div>
                <?php 
                    }
                }
                ?>
             </div>
          </section>
      </main>
<?php
get_footer();
?>