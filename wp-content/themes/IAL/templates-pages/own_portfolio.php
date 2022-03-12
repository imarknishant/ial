<?php
if(is_user_logged_in()){
    $userobject = wp_get_current_user();
}else{
    header("Location: ".site_url());
}
/* Template Name: portfolio */
get_header();

/***** Variables ******/
$user_ID = get_current_user_ID();
$name = get_user_meta($userobject->ID,'first_name',true).' '.get_user_meta($userobject->ID,'last_name',true);
$email = $userobject->data->user_email;
$user_id = $userobject->data->ID;
$contact = get_field('contact_number','user_'.$userobject->ID);
$bio = get_field('description','user_'.$userobject->ID);
$profileImage = get_field('profile_image','user_'.$userobject->ID);

$number_of_posts = count_user_posts($user_id, 'videos', true );

?>
 <main id="Main" class="other-profile-wrap fgfgfgdfdffd">
          <section class="opp_main">
                <div class="opp_top_box">
                    <div class="opp_top_left">
                        <a href="#">
                         <figure>
                             <?php if($profileImage != ''){ ?>
                                <img src="<?php echo $profileImage; ?>" alt="avtar-img-3.png"  loading="lazy"/>
                             <?php }else{ ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/person-placeholder.png" alt="avtar-img-3.png" loading="lazy"/>
                             <?php }?>
                         </figure>
                            </a>
                    </div>
                <?php
                    $follow_count = 0;
                $following_count = 0;
                    
                $result_follow = $wpdb->get_results( "SELECT * FROM channel_follow WHERE channel_owner_id = $user_id AND follow_count = 1"); 
                    
                $result_follow_portfolio = $wpdb->get_results( "SELECT * FROM portfolio_follow WHERE portfolio_user_id = $user_id AND follow_count = 1"); 
                
                $follow = array();
                    
                foreach($result_follow as $result_V){                   
                   $follow_count++;
                   $follow[] = array("followed_by"=>$result_V->user_id,"type"=>"channel","owner_id"=>$result_V->channel_id);
//                   $follow[] = 
                }
                    
                foreach($result_follow_portfolio as $result_V){                   
                   $follow_count++;
                    $follow[] = array("followed_by"=>$result_V->followed_by,"type"=>"portfolio","owner_id"=>$result_V->portfolio_user_id);
                }
                
                $result_following = $wpdb->get_results( "SELECT * FROM channel_follow WHERE user_id = $user_id AND follow_count = 1"); 
                    
                $result_following_portfolio = $wpdb->get_results( "SELECT * FROM portfolio_follow WHERE followed_by = $user_id AND follow_count = 1"); 
                    
                $following = array();
                    
                foreach($result_following as $result_c){                   
                   $following_count++;
                    $following[] = $result_c->channel_owner_id;
//                    $following[] = $result_c
                }
                    
                foreach($result_following_portfolio as $result_c){                   
                   $following_count++;
                    $following[] = $result_c->portfolio_user_id;
                }
                ?>
                    <div class="opp_top_right">
                        <div class="opp_top_title">
                             <div class="opp_tt_left">
                                 <h2><?php echo $name; ?> <a href="javascript:void(0);" class="edit_btn"></a></h2>
                             </div>
                            <?php 
                            if(is_user_logged_in() && $user_ID == $user_id){
                            ?>
                             <div class="opp_tt_right">
                                  <a href="#add_post_modal" data-toggle="modal" class="btn btn-border yellow-color">Add new post</a>
                                <a href="<?php echo get_the_permalink(22); ?>" class="btn btn-yellow-color ">Create Channel</a>
                             </div>
                            <?php }?>
                        </div>
                        <ul class="opp_top_list">
                            <li><a href="#"><strong><?php echo $number_of_posts; ?></strong>Posts</a></li>
                            <li class="dropdown ctr-title"><a href="#" data-toggle="dropdown"><strong><?php echo $follow_count; ?></strong>Followers</a>
                                <div class="cmScroll dropdown-menu dropdown-menu-left dark-theme following_list">
                                    <button type="button" class="close" data-toggle="dropdown">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <ul class="follow_list">
                                        <?php
                                        foreach($follow as $result_V){ 
                                            $img = get_field('profile_image','user_'.$result_V['followed_by']);
                                            if(empty($img)){
                                                $img = get_template_directory_uri().'/images/avtar-img-1.png';
                                            }
                                            $name = get_user_meta($result_V['followed_by'],'first_name',true).' '.get_user_meta($result_V['followed_by'],'last_name',true);
                                            
//                                            $channelid = $result_V/->channel_id;
                                        ?>
                                        <li>
                                            <div class="follow_list_box">
                                                <div class="follow_list_left">
                                                     <figure class="avtar-sm"><img src="<?php echo $img; ?>" alt="avtar-img-1.png"></figure>
                                                     <p><strong><?php echo $name; ?></strong></p>
                                                </div>
                                                <div class="follow_list_right">
                                                    <a href="javascript:void(0);" class="btn btn-border grey-color btn-sm" onclick="remove_followers(<?php echo $result_V['followed_by']; ?>,'<?php echo $result_V['type']; ?>',<?php echo $result_V['owner_id']; ?>)">Remove</a>
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
                                        foreach($following as $result_c){ 
                                            $img = get_field('profile_image','user_'.$result_c);
                                            if(empty($img)){
                                                $img = get_template_directory_uri().'/images/avtar-img-1.png';
                                            }
                                            $name = get_user_meta($result_c,'first_name',true).' '.get_user_meta($result_c,'last_name',true);
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

<!--                        <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum <br />is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.<br /> Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text.</p>-->
                    </div>
                </div>


                <div class="opp_botttom_box">
                    <div class="video_block_list">
                        <?php
                        $args = array(
                                 'post_type' => 'portfolio',
                                 'post_status' => 'publish',
                                'author'   => $user_ID,
                        
                             );
                        
                        $loop = new wp_query($args);
                        if($loop->have_posts()):
                        while($loop->have_posts()):
                        $loop->the_post();

                        $img = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
                           
                        ?>
                        
                        <div class="video_block zoom_effect">
                           <p class="figure_title"><?php the_title(); ?></p>
                            <figure>
                            <img src="<?php echo $img; ?>" alt="post_image">
                            </figure>
                           <div class="video_content">
                              <h6><a href="javascript:void(0);"><?php echo wp_trim_words(get_the_content(),5,'...'); ?></a></h6>
                           </div>
                        </div>
                        <?php
                        endwhile;
                        wp_reset_query();
                        endif;                      
                        ?>
                     </div>
                </div>           
          </section> 
      </main>

      <div class="modal fade add_post_modal" id="add_video_modal">
           <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                 <button class="modal-close" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i>
                 </button>
                 <div class="modal-content-inn">
                    <h3>Upload Files</h3>
                    
                    <form class="post-form" id="post_upload" method="post">
                       <div class="upload-files">
                          <label>
                             <input type="file" name="profile_image" class="file_video" id="video_p" accept="video/*"/>
                             <span class="btn yellow-color btn-border">Select File</span>
                          </label>
                       </div>

                       <div class="form-group">
                          <input type="text" class="form-control" placeholder="Post Title" name="post_title" />
                       </div>

                       <div class="form-group">
                          <input type="text" class="form-control" placeholder="Post description" name="post_desc" />
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

                       <div class="btns-group">
                           <input type="submit" class="btn btn-red" value="Upload Post">
                           <input type="reset" class="cancel-btn" value="Cancel">
                           <input type="hidden" name="action" value="upload_post"> 
                       </div>
                    </form>
                 </div>
              </div>
           </div>
      </div>

<?php
get_footer();
?>

      <div class="modal fade add_post_modal" id="add_post_modal">
           <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                 <button class="modal-close" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i>
                 </button>
                 <div class="modal-content-inn">
                    <h3>Upload Files</h3>
                    <form id="upload_portfolio" class="post-form" method="post" enctype="multipart/form-data">
                       <div class="upload-files">
                          <label>
                             <input type="file" id="portfolio_image" name="portfolio_image" accept="image/*" />
                             <figure>
                                 <img id="portfolio_preview" src="">
                                 <i class="fa fa-upload" aria-hidden="true"></i>
                              </figure>
                             <p>Drag and drop files to upload</p>
                             <span class="btn yellow-color btn-border">Select File</span>
                          </label>
                       </div>
                       <div class="form-group">
                          <input type="text" class="form-control" placeholder="Title" name="protfolio_img_title" />
                       </div>
                       <div class="form-group">
                          <input type="text" class="form-control" placeholder="Short description" name="protfolio_img_desc" />
                       </div>
                       <div class="btns-group">
                           <input type="submit" class="btn btn-red" value="Upload Post" >
                           <input type="hidden" name="action" value="upload_portfolio_img">
                           <input type="reset" class="cancel-btn fm-cancel" value="Cancel">
<!--                          <a href="#" class="cancel-btn" data-dismiss="modal">Cancel</a>-->
                       </div>
                    </form>
                 </div>
              </div>
           </div>
      </div>
