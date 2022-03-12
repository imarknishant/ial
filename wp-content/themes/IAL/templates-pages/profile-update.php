<?php
if(is_user_logged_in()){
    $userobject = wp_get_current_user();
}else{
    header("Location: ".site_url());
}

/* Template Name: Profile Update */
//require_once ( dirname(__DIR__).'/stripe/init.php' );
get_header();
global $wpdb;

/***** Variables ******/
$username = get_user_meta($userobject->ID,'first_name',true).' '.get_user_meta($userobject->ID,'last_name',true);
$email = $userobject->data->user_email;
$user_id = $userobject->data->ID;
$contact = get_field('contact_number','user_'.$userobject->ID);
$bio = get_field('description','user_'.$userobject->ID);
$profileImage = get_field('profile_image','user_'.$userobject->ID);
$terms = get_terms( 'channel', array('hide_empty' => false) ); 

$number_of_posts = count_user_posts($user_id, 'videos', true );

/**** get subscription plan ****/
$plan = $wpdb->get_results("SELECT * FROM subscriptions WHERE user_id = $user_id");

$area_of_interest = get_field('area_of_interest','user_'.$user_id);

?>

<?php
if($area_of_interest != ''){
?>
<main id="Main" class="other-profile-wrap">
          <section class="opp_main">

                <div class="opp_top_box">
                    <div class="opp_top_left">
                         <figure>
                             <?php if($profileImage != ''){ ?>
                                <img src="<?php echo $profileImage; ?>" alt="avtar-img-3.png" loading="lazy"/>
                             <?php }else{ ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/person-placeholder.png" alt="avtar-img-3.png" loading="lazy" />
                             <?php }?>
                         </figure> 
                        <form id="profile-image" enctype="multipart/form-data" style="display:none;">
                           
                            <input type="submit" value="Save" class="btn-rg btn btn-red">
                        </form>
                        
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
                                 <h2><?php echo $username; ?> <a href="javascript:void(0);" class="edit_btn"></a></h2>
                             </div>
                             <div class="opp_tt_right">
                                 <a href="<?php echo get_the_permalink(14); ?>" class="btn btn-border yellow-color">Create Portfolio</a> 
                                <a href="<?php echo get_the_permalink(22); ?>" class="btn btn-yellow-color ">Create Channel</a>
                             </div>
                        </div>
                            <ul class="opp_top_list">
                            <li><a href="#"><strong><?php echo $number_of_posts; ?></strong>Posts</a></li>
                            <li class="dropdown ctr-title"><a href="#" data-toggle="dropdown"><strong><?php echo $follow_count; ?></strong>Followers</a>
                                <div class="dropdown-menu dropdown-menu-left dark-theme following_list">
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
                                                     <figure class="avtar-sm"><img src="<?php echo $img; ?>" alt="avtar-img-1.png" loading="lazy"></figure>
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
                                <div class="dropdown-menu dropdown-menu-left dark-theme following_list">
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
                                                       <figure class="avtar-sm"><img src="<?php echo $img; ?>" alt="avtar-img-1.png" loading="lazy"></figure>
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
                    </div>
                </div>


                <div class="profile_bottom_blcok">
                    <div class="nav opp_nav">
                        <a class="tab_link active" data-toggle="tab" href="#profile">Profile</a>
                        <a class="tab_link"  data-toggle="tab" href="#subscription">Subscription</a>
                        <a class="tab_link"  data-toggle="tab" href="#tip_given">Tip’s Given</a>
                        <a class="tab_link"  data-toggle="tab" href="#my_channels">My Channels</a>
                      </div>
                    <div class="tab-content" >
                      <div class="tab-pane fade show active" id="profile">
                          <div class="profile-content">
                              <div class="title">
                                  <h5>Personal Information <a href="javascript:void(0);" class="edit_btn" ><i class="fa fa-pencil" aria-hidden="true"></i></a></h5>
                              </div>

                               <form class="profileF profile_form">
                                   
                                   <div class="form-group">
                                        <label class="label_text">Name</label>
                                        <div class="input_field">
                                            <input type="text" class="form-control user_name" value="<?php echo $username; ?>" disabled/>
                                        </div>
                                   </div>
                                   <div class="form-group">
                                        <label class="label_text">Email</label>
                                        <div class="input_field">
                                            <input type="text" class="form-control" value="<?php echo $email; ?>"  disabled />
                                        </div>
                                   </div>

                                   <div class="form-group">
                                        <label class="label_text">Contact Number</label>
                                        <div class="input_field">
                                            <input type="text" class="form-control" value="<?php echo $contact; ?>" disabled />
                                        </div>
                                   </div>

                                   <div class="form-group bio">
                                    <label class="label_text">Bio</label>
                                    <div class="input_field">
                                        <textarea class="form-control" value="" disabled><?php echo $bio; ?></textarea>
                                    </div>
                               </div>

                               </form>

                               <form class="profileF profile_edit_form" id="save-personal-info" style="display: none;" >
                               <div class="upload-group">
                                   <div class="image-uplad">
                                   <input type='file' id="imgInp" name="profile_image"/>
                                   </div>
                                    <figure>
                                         <img src="<?php echo get_template_directory_uri(); ?>/assets/images/person-placeholder.png" alt="profile-image" id="blah" loading="lazy"/>
                                     </figure> 

                               </div>
                                <div class="form-group">
                                    <input type="text" class="form-control user_name" placeholder="First Name" name="fname" value="<?php echo get_user_meta($userobject->ID,'first_name',true); ?>" />
                                </div>
                                   <div class="form-group">
                                    <input type="text" class="form-control user_name" placeholder="Last Name" name="lname" value="<?php echo get_user_meta($userobject->ID,'last_name',true)?>" />
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="natalia.watson@loremipcum.com" name="email" value="<?php echo $email; ?>" />
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="+123 456 7890" name="phone" value="<?php echo $contact; ?>" />
                                </div>

                                <div class="form-group">
                                    <textarea class="form-control" placeholder="" name="about"><?php echo $bio; ?></textarea>
                            </div>

                            <div class="btns-group">
                                <button type="submit" class="btn-rg btn btn-red">Update</button>
                                <button class="btn-rg btn btn-border grey-color" id="cancel-update-profile">Cancel</button>
                                <input type="hidden" name="action" value="update_profile">
                                <input type="hidden" name="user_id" value="<?php echo $userobject->ID; ?>">
                            </div>
                            </form>
                          </div>

                          <div class="profile-content">
                            <div class="title">
                                <h5>Change Password <a href="javascript:void(0);" class="edit_btn_pass" ><i class="fa fa-pencil" aria-hidden="true"></i></a></h5>
                            </div>

                             <form class="profileF display_password_fields">
                                 <div class="form-group">
                                      <label class="label_text">Current Password</label>
                                      <div class="input_field">
                                        <input type="password" class="form-control" disabled value="*************"/>
                                      </div>
                                 </div>
                                 <div class="form-group">
                                      <label class="label_text">New Password</label>
                                      <div class="input_field">
                                        <input type="password" class="form-control" disabled value="*************"/>
                                      </div>
                                 </div>

                                 <div class="form-group">
                                      <label class="label_text">Confirm Password</label>
                                      <div class="input_field">
                                        <input type="password" class="form-control" disabled value="*************"/>
                                      </div>
                                 </div>


                             </form>

                             <form class="profileF edit_password_form " id="update_password" style="display: none;" >
                              <div class="form-group">
                                  <label class="label_text">Current Password</label>
                                  <div class="input_field">
                                  <input type="password" class="form-control user_name" placeholder="*************" name="current_password"/>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="label_text">New Password</label>
                                      <div class="input_field">
                                  <input type="password" class="form-control" placeholder="*************" name="new_password" id="new_password"/>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="label_text">Confirm Password</label>
                                      <div class="input_field">
                                  <input type="password" class="form-control" placeholder="*************" name="confirm_password"/>
                                  </div>
                              </div>


                          <div class="btns-group">
                              <input type="submit" class="btn-rg btn btn-red" value="Update">
                              <input type="hidden" name="action" value="update_password">
                              <input type="hidden" name="user_id" value="<?php echo $userobject->ID;?>">
                              <button class="btn-rg btn btn-border grey-color cancel-password-update">Cancel</button>
                          </div>
                          </form>
                        </div>

                      </div>
                      <div class="tab-pane fade" id="subscription">
                           <div class="subscription_content">
                               
                            <?php
                                $active = get_field('show_plans','options');
                                
                                print_r();
                                if($active == 'yes'){
                                    $args = array(  
                                    'post_type' => 'my-plans',
                                    'post_status' => 'publish',
                                    'posts_per_page' => -1, 
                                );

                                $loop = new WP_Query( $args ); 
                                $i=0;

                                while ( $loop->have_posts() ) : $loop->the_post();
                                $price = get_field('plan_price',get_the_ID());
                                $img = get_field('plan_icon',get_the_ID());
                                $plan_id = get_post_meta(get_the_ID(),'plan_stripe_ids',true);
                           ?>
                               <div class="subscription_list <?php if($plan[0]->subscription_plan == get_the_title(get_the_ID())){ echo 'active'; }?>">
                                   <div class="subscription_list_col ">
                                    <figure><img src="<?php echo $img; ?>" alt="figure-icon-2.png" loading="lazy"></figure>   
                                      <h5><?php echo get_the_title(get_the_ID());?></h5>
                                    </div>
                                   <div class="subscription_list_col">
                                       <h3><sup>$</sup><strong><?php echo $price; ?></strong><sub>/ per month</sub></h3>
                                   </div>
                                   <div class="subscription_list_col">
                                       <?php if($plan[0]->subscription_plan == get_the_title(get_the_ID())){ ?>
                                       <h6 class="green-text">Active since <?php echo date('d M, Y', $plan[0]->date); ?></h6>
                                       <?php }else{ ?>
                                       <a href="<?php echo get_the_permalink(32); ?>" class="btn btn-default">Change Plan</a>
                                       <?php }?>
                                      
                                   </div>
                               </div>
                           <?php
                                endwhile;
                                wp_reset_query();
                                
                                }else{
                           ?>    
                                <h3>Coming Soon!</h3>
                                    
                            <?php } ?> 
                            
                           </div>
                      </div>
                      <div class="tab-pane fade" id="tip_given">
<!--                           <div class="tips_given">-->
<!--                
                               <a href="javascript:void(0);" class="stripe-connect"><span>Connect with</span></a>
                               <input type="hidden" id="current_user" value="<?php echo $email; ?>">
-->
<!--                          </div>-->
                          <!-----------Get Tip Data------------>
                          <a href="#request_withdraw" data-toggle="modal" class="btn btn-yellow-color request_withdraw">Request Withdraw</a>

                          <div class="tips_given">
                              <table class="table">
                                  <thead>
                                      <tr>
                                          <th>Artist Name</th>
                                          <th>Video/File</th>
                                          <th>Date</th>
                                          <th>Amount</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                        <?php
                          $tip_data = $wpdb->get_results("SELECT * FROM tip_payments WHERE tip_given_to = $user_id");
                          $total_withdraw = 0;
                          foreach($tip_data as $t_d){
                              $t_name = get_user_meta($t_d->tip_given_by,'first_name',true).' '.get_user_meta($t_d->tip_given_by,'last_name',true);
                              $t_image = get_field('video_thumbnail_image',$t_d->tip_post_id);
                              $t_link = get_the_permalink($t_d->tip_post_id);
                              $t_date = $t_d->tip_date_time;
                              $t_amount = $t_d->tip_amount_user;
                              
                              $total_withdraw = $total_withdraw + $t_amount;
                          ?>
                              <tr>
                                  <td><?php echo $t_name; ?></td>
                                  <td>
                                      <div class="fig_td">
                                          <figure><img src="<?php echo $t_image; ?>" alt="thumb-items-1.jpg" loading="lazy"/></figure>
                                          <a href="<?php echo $t_link; ?>"><?php echo $t_link; ?></a>
                                      </div>
                                  </td>
                                  <td>
                                    <?php echo $t_date; ?>
                                  </td>
                                  <td>
                                    $ <?php echo $t_amount; ?>
                                  </td>
                              </tr>
                        <?php }?>
                            <input type="hidden" id="tip_total" value="<?php echo $total_withdraw; ?>">
<!--                            <input type="hidden" id="withdraw_user" value="<?php echo $total_withdraw; ?>">-->

                                  </tbody>
                              </table>
                          </div>
                     </div>
                        <div class="tab-pane fade" id="my_channels">
                          <div class="tips_given">
                              <table class="table">
                                  <thead>
                                      <tr>
                                          <th>Channel Name</th>
                                          <th>Channel Image</th>
                                          <th>Created Date</th>
                                          <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                <?php
                                $taxonomies = get_terms( array(
                                  'taxonomy' => 'channel',
                                  'hide_empty' => false
                                 ) );
                                foreach($taxonomies as $taxonomy){
                                    
                                 $term_id = $taxonomy->term_id;
                                    
                                 $ch =  get_field('channel_created_by','channel_'.$term_id);                                      
                                 $ch_email = $ch['user_email'];
                                    
                                    if($ch_email==$email){
                                    $images = get_field('channel_image','channel_'.$term_id);
                                    $ch_date_tsp = strtotime(get_field('channel_created_at','channel_'.$term_id));
                                    $ch_date = date('F d, Y',$ch_date_tsp);
                                ?>
                                  <tr>
                                      <td><?php echo $taxonomy->name; ?></td>
                                      <td>
                                          <div class="fig_td">
                                              <figure><img src="<?php echo $images; ?>" alt="thumb-items-1.jpg" loading="lazy"/></figure>
                                          </div>
                                      </td>
                                      <td><?php echo $ch_date; ?></td>
                                      <td>
                                        <a href="<?php echo get_term_link($term_id,'channel');  ?>" class="btn btn-yellow-color">View</a>
                                      </td>
                                  </tr>
                                  <?php
                                    } }
                                  ?>

                                  </tbody>
                              </table>
                          </div>
                     </div>
                    </div>
                </div>

              
          </section> 
      </main>
<div class="modal fade" id="request_withdraw">
           <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content withdraw">
                     <h4>Request TIP Withdraw</h4>
                    <form id="pay-tip" method="post">
                     <div class="radio-custom">
                       <div class="form-group">
                        <label>
                            <input type="radio" name="radio" value="full_amount" onclick="javascript:yesnoCheck();" id="noCheck"/>
                            <span class="radio-cm">Full Amount - $<?php echo $total_withdraw; ?> </span>
                            <input type="hidden" name="total_tip_amount" value="<?php echo $total_withdraw; ?>">
                        </label>
                       </div>
                       <div class="form-group">
                        <label>
                            <input type="radio" name="radio" value="custom_amount" onclick="javascript:yesnoCheck();" id="yesCheck"/>
                            <span class="radio-cm">Custom Amount</span>                        
                        </label>
                       </div>
                     </div>
                     <!-- Set-value-->
                     <div id="withdraw-grp" style="display:none">
                            <div class="group">
                                <label>Custom Amount</label>
                                <input type="number" class="form-control" placeholder="amount" name="custom_amount">
                            </div>
                        </div> 
                        <div class="row">

                            <div class="col-md-12">
                                <div class="btns-groups">
                                    <input class="btn-rg btn btn-red" type="submit" name="stripe" value="Submit" id="pay_tip">
                                    <input class="cancel-btn btn btn-yellow-color"  data-dismiss="modal" type="reset" value="Cancel">
                                    <input  type="hidden" name="action" value="send_request">
                                    <input  type="hidden" name="userid" value="<?php echo $user_id; ?>" >
<!--
                                    <input  type="hidden" name="post_userid" value="<?php echo $post_author_id; ?>" >
                                    <input  type="hidden" name="post_id" value="<?php echo $post_id; ?>" >
-->
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
           </div>
      </div>
<?php }else{ ?>
<main id="Main" class="subscription-wrap">
 <section class="choose_categories">
    <div class="title yellow text-center">
       <h2>Hey, <?php echo $username; ?></h2>
       <h3 class="white-text">Choose your area of interest</h3>
   </div>

<form id="user_area_of_interest">
   <div class="choose_check">
      
      <?php
      $terms = get_terms([
        'taxonomy' => 'video-category',
        'hide_empty' => false,
    ]);
    
    foreach($terms as $t){
    ?>
      <div class="choose_list">
         <label>
            <input type="checkbox" name="interest[]" class="trip_type" value="<?php echo  $t->term_id; ?>" required />
            <div class="">
               <?php echo $t->name; ?>
            </div>
         </label>
      </div>
      <?php }?>
     
   </div>

   <div class="btnn text-center">
       <input type="submit" class="btn btn-red" value="Let’s start exploring">
       <input type="hidden" value="<?php echo $user_id; ?>" name="userid">
      <!--<a href="#" class="btn btn-red">Let’s start exploring <i class="fa fa-long-arrow-right" aria-hidden="true"></i>-->
      </a>
   </div>
   </form>
 </section>
</main>
<?php 
}
get_footer();
?>