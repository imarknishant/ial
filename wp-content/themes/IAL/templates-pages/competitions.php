<?php

/* Template Name: Competetion */
get_header();
global $post;
$currentDateTime = strtotime(date('Y-m-d H:i:s'));
$user_id = get_current_user_id();
$competition_ids = array();
?>

<main id="Main" class="competition-wrap">
<!--
          <div class="sort_block">
              <form>
                  <select  class="form-control w-auto style-2">
                      <option value="">sort by</option>
                      <option value="">1</option>
                      <option value="">2</option>
                  </select>
              </form>
          </div>
-->
          <?php
            $args = array(
                'post_type' => 'competition',
                'order'=>'DESC',                    
                ); 

            $loop = new WP_query($args);
            if ($loop->have_posts()) : 
            while ($loop->have_posts()) : $loop->the_post();
    
            $startTime = strtotime(get_field('start_date_time',$post->ID)); 
            $endTime = strtotime(get_field('end_date_time',$post->ID));
    
            // Formulate the Difference between two dates
            $diff = abs($endTime - $currentDateTime); 
            $years = floor($diff / (365*60*60*24)); 
            $months = floor(($diff - $years * 365*60*60*24)/ (30*60*60*24)); 
            $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
            $hours = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24) / (60*60)); 
    
            ?>
          <section class="competition_sport">
             <div class="title-bar orange-bar">
                 <div class="title">
                     <h6><?php echo get_the_title();?></h6>
                 </div>
                 <div class="timer">
                     <?php if($currentDateTime >= $startTime){
                     $Date_js = get_field('end_date_time',$post->ID);
                     ?>
                     
                     Voting ends in - <div id="countdown_<?php echo $post->ID; ?>"></div>
                     <a href="<?php echo get_the_permalink(20); ?>'?id='<?php echo base64_encode($post->ID); ?>" class="join_us">View Result</a>
                     
                     <?php }else{ 
                     $Date_js = get_field('start_date_time',$post->ID);
                     ?>
                     
                     Voting start in - <div id="countdown_<?php echo $post->ID; ?>"></div>
                     
                     <?php } ?>
                 </div>
             </div>

             <div class="video_block_list">
                 <?php
                 /****** Check if user has already voted for competition ******/
                 
                 $c_id = $wpdb->get_results("SELECT * FROM competition_vote WHERE compe_post_id = $post->ID AND user_id = $user_id");
                 foreach($c_id as $c){
                     $competition_ids[] = $c->compe_post_id;
                 }
                 
                 print_r();
                 //********** Get videos of competition **************//
                 $videosids = get_field('select_videos',$post->ID);
                 foreach($videosids as $ids){
                    $total_views = get_post_meta($ids,'post_views_count',true);
                    if($total_views == ''){
                        $total_views = 0;
                    }
                    $thumbnail_image = get_field('video_thumbnail_image',$ids); 
                     
                 ?>
                  <div class="video_block zoom_effect">  
                    <figure>
                      <p class="figure_title"><?php echo get_the_title($ids); ?></p>
                       <img src="<?php echo $thumbnail_image; ?>" alt="category-img-1.jpg" />
                      <a href="<?php echo get_the_permalink($ids); ?>" class="material-icons" loading="lazy">play_circle_filled</a>
                    </figure>

                      <div class="video_content">
                         <h6><a href="<?php echo get_the_permalink($ids); ?>"><?php echo wp_trim_words(get_the_content($ids),10,'...'); ?></a></h6>
                         <p class="sub_title"><?php echo $total_views; ?> Views  |  4 days ago</p>
                          
                          <?php 
                     if($currentDateTime >= $startTime){
                          if(in_array($post->ID,$competition_ids)){
                              ?>
                          <a href="#" class="btn btn-xs btn-border yellow-color votebtn_<?php echo $post->ID; ?>">VOTED</a>
                          <?php  
                          }else{
                         ?>
                              <a href="<?php echo get_the_permalink(20); ?>?id=<?php echo base64_encode($post->ID); ?>" class="btn btn-xs btn-border yellow-color votebtn_<?php echo $post->ID; ?>">VOTE</a>
                          <?php
                                }
                           } 
                          ?>
                      </div>
                   </div>
                 <?php }?>
            </div>
          </section>
    
    <script>
        // Set the date we're counting down to
        var countDownDate_<?php echo $post->ID; ?> = new Date("<?php echo $Date_js; ?>").getTime();
           

        // Update the count down every 1 second
        var x_<?php echo $post->ID; ?> = setInterval(function() {

          // Get today's date and time
          var now = new Date().getTime();

          // Find the distance between now and the count down date
          var distance = countDownDate_<?php echo $post->ID; ?> - now;
            
          // Time calculations for days, hours, minutes and seconds
          var days = Math.floor(distance / (1000 * 60 * 60 * 24));
          var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
          var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
          var seconds = Math.floor((distance % (1000 * 60)) / 1000);

          // Display the result in the element with id="demo"
          document.getElementById("countdown_<?php echo $post->ID; ?>").innerHTML = days + "d " + hours + "h "
          + minutes + "m " + seconds + "s ";

          // If the count down is finished, write some text
          if (distance < 0) {
            clearInterval(x_<?php echo $post->ID; ?>);
            document.getElementById("countdown_<?php echo $post->ID; ?>").innerHTML = "EXPIRED";
            var divsToHide = document.getElementsByClassName("votebtn_<?php echo $post->ID; ?>");
              for(var i = 0; i < divsToHide.length; i++){
                divsToHide[i].style.visibility = "hidden"; // or
                divsToHide[i].style.display = "none"; // depending on what you're doing
              }
          }
        }, 1000);
        
    </script>
            <?php 
                endwhile;
                wp_reset_query();
                endif;
            ?>

      </main>

<?php
get_footer();
?>
