<?php
get_header();
global $wpdb;

/***** Variables ******/
$author = get_user_by( 'slug', get_query_var( 'author_name' ) );

$currentLoggediUser = get_current_user_id();
$userid = $author->ID;

$name = get_user_meta($userid,'first_name',true).' '.get_user_meta($userid,'last_name',true);
$contact = get_field('contact_number','user_'.$userid);
$bio = get_field('description','user_'.$userid);
$profileImage = get_field('profile_image','user_'.$userid);
$terms = get_terms( 'channel', array('hide_empty' => false) ); 

$number_of_posts = count_user_posts($user_id, 'videos', true );

$current_user_id = get_current_user_id();

/***** Get total number of followers *****/

$followers = $wpdb->get_results("SELECT COUNT(portfolio_user_id) as follower FROM portfolio_follow WHERE follow_count = 1 AND portfolio_user_id = $userid");


if(empty($followers)){
    $followers_count = 0;
}else{
    $followers_count = $followers[0]->follower;
}
?>
      <main id="Main" class="other-profile-wrap">
          <section class="opp_main">
                <div class="opp_top_box">
                    <div class="opp_top_left">
                         <figure>
                             <?php if($profileImage != ''){ ?>
                                <img src="<?php echo $profileImage; ?>" alt="avtar-img-3.png" />
                             <?php }else{ ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/person-placeholder.png" alt="avtar-img-3.png" />
                             <?php }?>
                         </figure> 
                    </div>
                    <div class="opp_top_right">
                        <div class="opp_top_title">
                             <div class="opp_tt_left">
                                 <h2><?php echo $name; ?></h2>
                             </div>
                            <?php
                            if(is_user_logged_in()){
                            /*** Check if user already follow portfolio ***/
                            $port_follow_data = $wpdb->get_results("SELECT * FROM portfolio_follow WHERE followed_by = $currentLoggediUser AND portfolio_user_id = $userid");
                       
                            if($port_follow_data[0]->followed_by == $currentLoggediUser && $port_follow_data[0]->follow_count == 1){
                                ?>
                            <div class="opp_tt_right">
                                <a href="javascript:void(0);" class="btn btn-red ml-auto follow_p">UnFollow</a>
                             </div>
                            <input type="hidden" id="logged_in_user" value="<?php echo $current_user_id; ?>">
                            <input type="hidden" id="portfolio_user" value="<?php echo $userid; ?>">
                            <input type="hidden" id="portfolio_id" value="<?php echo $userid; ?>">
<!--                            <input type="hidden" id="follow_value" value="0">-->
                            <?php
                            }else{
                                ?>
                            <div class="opp_tt_right">
                                <a href="javascript:void(0);" class="btn btn-red ml-auto follow_p">Follow</a>
                             </div>
                            <input type="hidden" id="logged_in_user" value="<?php echo $current_user_id; ?>">
                            <input type="hidden" id="portfolio_user" value="<?php echo $userid; ?>">
                            <input type="hidden" id="portfolio_id" value="<?php echo $userid; ?>">
<!--                            <input type="hidden" id="follow_value" value="1">-->
                            <?php
                                
                            }
                            ?>
                             
                            <?php }else{?>
                             <div class="opp_tt_right">
                                <a href="javascript:void(0);" class="btn btn-red ml-auto not_login">Follow</a>
                             </div>
                            <?php }?>
                        </div>
                        <ul class="opp_top_list">
                            <li><strong><?php echo $followers_count; ?></strong> Followers </li>
                        </ul>
                    </div>
                </div>

                <div class="opp_bottom_wrp"> 
                        <div class="nav opp_nav">
                          <a class="tab_link active" data-toggle="tab" href="#posts">Posts</a>
                          <a class="tab_link"  data-toggle="tab" href="#about">About</a>
                        </div>
                      <div class="tab-content" >
                        <div class="tab-pane fade show active" id="posts">
                            <div class="navTab_content">
                                <div class="video_block_list">
                                    <?php
                                    $args = array(
                                        'post_type' => 'portfolio',
                                        'author' => $userid,
                                        ); 

                                    $loop_p = new WP_query($args);
                                    
                                    if ($loop_p->have_posts()) : 
                                    while ($loop_p->have_posts()) : $loop_p->the_post();
                                    
                                    $thumbnail_image = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
                                    $author_id = base64_encode($post->post_author); 
                                ?>
                                    <div class="video_block zoom_effect">
                                    <a href="<?php echo $thumbnail_image; ?>" data-lity data-lity-target="<?php echo $thumbnail_image; ?>">
                                      <figure>
                                          <p class="figure_title"><?php echo get_the_title(get_the_ID()); ?></p>
                                           <img src="<?php echo $thumbnail_image; ?>" alt="category-img-1.jpg" />
<!--                                          <a href="javascript:void(0);" class="material-icons">play_circle_filled</a>-->
                                          
                                      </figure>
                                        </a>
                                       <div class="video_content">
                                         <h6><a href="<?php echo get_the_permalink(get_the_ID()).'?id='.$author_id; ?>"><?php echo wp_trim_words(get_the_content(get_the_ID()),10,'...'); ?></a></h6>
                                         <p class="sub_title"><?php //echo $total_views; ?> Views  |  4 days ago</p>
                                      </div>
                                    </div>
                                  <?php
                                    endwhile;
                                    endif;
                                    wp_reset_query();
                                  ?>

                                 </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="about">
                           <div class="navTab_content">
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