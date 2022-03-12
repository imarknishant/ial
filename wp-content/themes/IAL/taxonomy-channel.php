<?php
if(is_user_logged_in()){
    $userobject = wp_get_current_user();
}else{
    header("Location: ".site_url());
}
/* Template Name: Profile Update */
get_header();

/***** Variables ******/
$name = get_user_meta($userobject->ID,'first_name',true).' '.get_user_meta($userobject->ID,'last_name',true);
$email = $userobject->data->user_email;
$user_id = $userobject->data->ID;
$contact = get_field('contact_number','user_'.$userobject->ID);
$bio = get_field('description','user_'.$userobject->ID);
$profileImage = get_field('profile_image','user_'.$userobject->ID);

$category = get_queried_object();
$totalVideo = $category->count;
$cat_id   = $category->term_id;
$cat_slug = $category->slug;

$encode_cat_id = base64_encode($cat_id);
$encode_cat_slug = base64_encode($cat_slug);

?>
<main id="Main" class="other-profile-wrap">
          <section class="opp_main">
                <div class="opp_top_box">
                    <div class="opp_top_left">
                        <a href="<?php echo get_the_permalink(36); ?>">
                         <figure>
                             <?php if($profileImage != ''){ ?>
                                <img src="<?php echo $profileImage; ?>" alt="avtar-img-3.png" />
                             <?php }else{ ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/person-placeholder.png" alt="avtar-img-3.png" />
                             <?php }?>
                         </figure> 
                        </a>
                    </div>
                <?php
                global $wpdb;
                $follow_count = 0;
                $following_count = 0;
                    
                $result_follow = $wpdb->get_results( "SELECT * FROM channel_follow WHERE channel_owner_id = $user_id AND follow_count = 1"); 
                    
                foreach($result_follow as $result_V){                   
                   $follow_count++;
                }
                    
                $result_following = $wpdb->get_results( "SELECT * FROM channel_follow WHERE user_id = $user_id AND follow_count = 1"); 
                    
                foreach($result_following as $result_c){                   
                   $following_count++;
                }
                ?>
                    <div class="opp_top_right">
                        <div class="opp_top_title">
                             <div class="opp_tt_left">
                                 <a href="<?php echo get_the_permalink(36); ?>"><h2><?php echo $name; ?></h2></a>
                             </div>
                            <?php 
                            $addVideoLink = get_the_permalink(224).'?cid='.$encode_cat_id.'&sl='.$encode_cat_slug;
                            ?>
                             <div class="opp_tt_right">
                                <a href="<?php echo $addVideoLink; ?>" class="btn btn-border yellow-color">Add new video</a>
                                <a href="<?php echo get_the_permalink(22); ?>" class="btn btn-yellow-color ">Create Channel</a>
                             </div>
                        </div>
                        <ul class="opp_top_list">
                            <li><a href="#"><strong><?php echo $number_of_posts; ?></strong>Posts</a></li>
                            <li class="dropdown"><a href="#" data-toggle="dropdown"><strong><?php echo $follow_count; ?></strong>Followers</a>
                                <div class="cmScroll dropdown-menu dropdown-menu-left dark-theme following_list">
                                    <button type="button" class="close" data-toggle="dropdown">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <ul class="follow_list">
                                        <?php
                                        foreach($result_follow as $result_V){ 
                                            $img = get_field('profile_image','user_'.$result_V->user_id);
                                            if(empty($img)){
                                                $img = get_template_directory_uri().'/images/avtar-img-1.png';
                                            }
                                            $name = get_user_meta($result_V->user_id,'first_name',true).' '.get_user_meta($result_V->user_id,'last_name',true);
                                            
                                            $channelid = $result_V->channel_id;
                                        ?>
                                        <li>
                                            <div class="follow_list_box">
                                                <div class="follow_list_left">
                                                     <figure class="avtar-sm"><img src="<?php echo $img; ?>" alt="avtar-img-1.png"></figure>
                                                     <p><strong><?php echo $name; ?></strong></p>
                                                </div>
                                                <div class="follow_list_right">
                                                    <a href="javascript:void(0);" class="btn btn-border grey-color btn-sm" onclick="remove_followers(<?php echo $result_V->user_id; ?>,<?php echo $channelid; ?>)">Remove</a>
                                                </div>
                                            </div>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </li>
                            <li class="dropdown"><a href="#" data-toggle="dropdown"><strong><?php echo $following_count; ?></strong> Following</a>
                                <div class="cmScroll dropdown-menu dropdown-menu-left dark-theme following_list">
                                    <button type="button" class="close" data-toggle="dropdown">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                      <ul class="follow_list">
                                          <?php
                                        foreach($result_following as $result_c){ 
                                            $img = get_field('profile_image','user_'.$result_c->channel_owner_id);
                                            if(empty($img)){
                                                $img = get_template_directory_uri().'/images/avtar-img-1.png';
                                            }
                                            $name = get_user_meta($result_c->channel_owner_id,'first_name',true).' '.get_user_meta($result_c->channel_owner_id,'last_name',true);
                                        ?>
                                          <li>
                                              <div class="follow_list_box">
                                                  <div class="follow_list_left">
                                                       <figure class="avtar-sm"><img src="<?php echo $img; ?>" alt="avtar-img-1.png"></figure>
                                                       <p><strong><?php echo $name; ?></strong></p>
                                                  </div>
                                                  <div class="follow_list_right">
                                                      <a href="#" class="btn btn-border grey-color btn-sm">Following</a>
                                                  </div>
                                              </div>
                                          </li>
                                          <?php } ?>
                                     
                                      </ul>
                                </div>
                            </li>
                        </ul>

                        <p><?php echo $current_category->description; ?></p>
                    </div>
                </div>


                <div class="opp_botttom_box">
                    <div class="video_block_list">
                      <?php
                        $channelOwner = get_field('channel_created_by','channel_'.$cat_id);
                        
                        if($channelOwner['ID'] == $user_id){
                            
                            /***** Get All videos of channel *****/
                            
                            $args = array(
                                'post_type' => 'videos',
                                'tax_query' => array(
                                 array(
                                    'taxonomy' => 'channel',
                                    'field' => 'term_id',
                                    'terms' => $cat_id,
                                        )
                                    )                      
                                ); 
                            
                            $loop = new WP_query($args);
                            while($loop->have_posts()) : $loop->the_post();
                            $video_thumbnail = get_field('video_thumbnail_image',$post->ID); 
                            $postViewCount = get_field('post_views_count',$post->ID);
                            
                            if($postViewCount == ''){
                                $postViewCount = 0;
                            }
                       ?>
                        <div class="video_block zoom_effect <?php echo $term_id; ?>">
                           <figure>
                             <p class="figure_title"><?php the_title(); ?></p>
                             <div class="dropdown">
                                 <a href="#" class="v-menu" data-toggle="dropdown"><i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                 </a>
                                 <div class="dropdown-menu dropdown-menu-right">
                                    <a href="<?php echo get_the_permalink(226); ?>?vid=<?php echo base64_encode($post->ID); ?>" class="dropdown-item">Edit</a>
                                    <a href="javascript:void(0);" class="dropdown-item" onclick="delete_video(<?php echo $post->ID; ?>, <?php echo $user_id; ?>);">Delete</a>
                                 </div>
                             </div>
                            <span class="duration"></span>
                            <a href="<?php echo get_the_permalink($post->ID); ?>">
                               <figure>
                                   <img src="<?php echo $video_thumbnail; ?>" alt="thumb-items-1.jpg" class="mCS_img_loaded">
                               </figure>
                            </a>
                              <a href="javascript:void(0);" class="material-icons"></a>
                           </figure>
                           <div class="video_content">
                              <h6><a href="<?php echo get_the_permalink($post->ID); ?>"><?php echo wp_trim_words(get_the_content(),20,'...'); ?></a></h6>
                              <div class="video_content_bottom">
                                 <p class="sub_title"><?php echo $postViewCount; ?> Views</p>
                              </div>
                           </div>
                        </div>
                        <?php
                            endwhile;
                            wp_reset_query();
                            }
                        ?>

                    </div>
              </div>            
          </section> 
      </main>
 

<!--
      <div class="modal fade add_post_modal" id="add_video_modal">
           <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                 <button class="modal-close" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i>
                 </button>
                 <div class="modal-content-inn">
                    <h3>Upload Files</h3>
                    <form class="post-form" id="video_upload" method="post">
                       <div class="upload-files">
                          <label>
                             <input type="file" name="video_file" class="file_video" id="video_p" accept="video/mp4"/>
                              <video width="400" controls id="video_here">
                                  <source type="video/mp4">
                              </video>
                             <span class="btn yellow-color btn-border">Select File</span>
                          </label>
                           <canvas id="video-canvas"></canvas>
                            <div id="thumbnail-container">
                                 Seek to seconds
                                <select id="set-video-seconds" class="form-control"></select> 
                            </div>
                       </div>
                        
                        <input type="hidden" id="video_thumbnail" name="video_thumbnail">
                        
                       <div class="form-group">
                          <input type="text" class="form-control" placeholder="Video Title" name="video_title" />
                       </div>

                       <div class="form-group">
                          <input type="text" class="form-control" placeholder="Video description" name="video_desc" />
                       </div>
                        <div class="form-group">
                          <select class="form-control" name="video_category">
                            <?php 
                              $videoCat = get_terms('video-category',array('hide_empty' => false));
                              ?>
                              <option value="nill">Select category</option> 
                              <?php foreach($videoCat as $c){ ?>   
                             <option value="<?php echo $c->slug; ?>"><?php echo $c->name; ?></option> 
                              <?php }?>
                          </select>  
                        </div>
                        <div class="form-group">  
                        </div>
                        <div id="loading">
                            <img id="loading-image" src="<?php echo get_template_directory_uri();?>/assets/images/loader.gif" alt="Loading..." />
                        </div>
                       <div class="btns-group">
                           <input type="submit" class="btn btn-red video-upload" value="Upload Video">
                           <input type="reset" class="cancel-btn" value="Cancel">
                           <input type="hidden" name="action" value="upload_video">
                           <input type="hidden" name="cat_id" value="<?php echo $cat_id; ?>">
                           <input type="hidden" name="cat_slug" value="<?php echo $cat_slug; ?>">
                           <a href="#" class="cancel-btn">Cancel</a>
                       </div>
                    </form>
                 </div>
              </div>
           </div>
      </div>
-->

<?php 
get_footer();
?>