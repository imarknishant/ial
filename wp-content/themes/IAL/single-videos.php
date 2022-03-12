<?php
get_header();
global $post,$wpdb;

$userobject = wp_get_current_user();

$user_id = $userobject->data->ID;

$fname   = get_user_meta($user_id,'first_name',true);
$lname   = get_user_meta($user_id,'last_name',true);
//$current_user = $fname.' '.$lname;   
$post_id   = $post->ID;

//$author_id     = $post->post_author;
//$channelUname  = get_user_meta($author_id,'first_name',true).' '.get_user_meta($author_id,'last_name',true);
$postTerm = get_the_terms( $post_id, 'channel' );
$channel_id = $postTerm[0]->term_taxonomy_id;

$featured_img = get_the_post_thumbnail_url($post->ID,'full');
$video        = get_field('video_link',$post_id); 

$cat          = get_the_terms( $post->ID, 'video-category' ); 
$fName        = get_user_meta($user_id,'first_name',true);
$lName        = get_user_meta($user_id,'last_name',true);
$fullName     = $fName.' '.$lName; 

foreach($cat as $cat_v){  
     $cat_name = $cat_v->name;
     $cat_id   = $cat_v->term_id;
}

/**** Increase Post View Count ****/
wps_set_post_views($post_id);

/**** get Post Views ****/
$views = get_post_meta($post_id,'post_views_count',true);

$post_author_id = get_post_field( 'post_author', $post_id );
$post_author_name = get_user_meta($post_author_id,'first_name',true).' '.get_user_meta($post_author_id,'last_name',true);

$author_id = base64_encode($post_author_id); 
$video_author_img = get_field('profile_image','user_'.$post_author_id);

if($video_author_img == ''){
    $video_author_img = get_template_directory_uri().'/assets/images/avtar-img-1.png';
}

$voteData = $wpdb->get_results("SELECT COUNT(ID) as votes FROM competition_vote WHERE AND video_id = $post_id");
                     
$votes = $voteData[0]->votes;
if($votes == ''){
    $votes = 0;
}
?>
<input type="hidden" id="is_video_play" value="true">
     <main id="Main" class="sigle-video-wrap add_class">
           <section class="single-video-wrap">
                <div class="single-video-left">
                    <div class='player-container'>
                        <div class='player'>
                           <video id='video' src='<?php echo $video['url']; ?>' playsinline></video>
                           <div class='play-btn-big'></div>
                           <div class='controls'>
                              <div class="time"><span class="time-current"></span><span class="time-total"></span></div>
                              <div class='progress'>
                                 <div class='progress-filled'></div>
                              </div>
                              <div class='controls-main'>
                                 <div class='controls-left'>
                                    <div class='volume'>
                                       <div class='volume-btn loud'>
                                          <svg width="26" height="24" viewBox="0 0 26 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                             <path d="M6.75497 17.6928H2C0.89543 17.6928 0 16.7973 0 15.6928V8.30611C0 7.20152 0.895431 6.30611 2 6.30611H6.75504L13.9555 0.237289C14.6058 -0.310807 15.6 0.151473 15.6 1.00191V22.997C15.6 23.8475 14.6058 24.3098 13.9555 23.7617L6.75497 17.6928Z" transform="translate(0 0.000518799)" fill="white"/>
                                             <path id="volume-low" d="M0 9.87787C2.87188 9.87787 5.2 7.66663 5.2 4.93893C5.2 2.21124 2.87188 0 0 0V2C1.86563 2 3.2 3.41162 3.2 4.93893C3.2 6.46625 1.86563 7.87787 0 7.87787V9.87787Z" transform="translate(17.3333 7.44955)" fill="white"/>
                                             <path id="volume-high" d="M0 16.4631C4.78647 16.4631 8.66667 12.7777 8.66667 8.23157C8.66667 3.68539 4.78647 0 0 0V2C3.78022 2 6.66667 4.88577 6.66667 8.23157C6.66667 11.5773 3.78022 14.4631 0 14.4631V16.4631Z" transform="translate(17.3333 4.15689)" fill="white"/>
                                             <path id="volume-off" d="M1.22565 0L0 1.16412L3.06413 4.0744L0 6.98471L1.22565 8.14883L4.28978 5.23853L7.35391 8.14883L8.57956 6.98471L5.51544 4.0744L8.57956 1.16412L7.35391 0L4.28978 2.91031L1.22565 0Z" transform="translate(17.3769 8.31403)" fill="white"/>
                                          </svg>
                                       </div>
                                       <div class='volume-slider'>
                                          <div class='volume-filled'></div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class='play-btn paused'></div>
                                 <div class="controls-right">
                                    <div class='speed'>
                                       <ul class='speed-list'>
                                          <li class='speed-item' data-speed='0.5'>0.5x</li>
                                          <li class='speed-item' data-speed='0.75'>0.75x</li>
                                          <li class='speed-item' data-speed='1' class='active'>1x</li>
                                          <li class='speed-item' data-speed='1.5'>1.5x</li>
                                          <li class='speed-item' data-speed='2'>2x</li>
                                       </ul>
                                    </div>
                                    <div class='fullscreen'>
                                       <svg width="30" height="22" viewBox="0 0 30 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <path d="M0 0V-1.5H-1.5V0H0ZM0 18H-1.5V19.5H0V18ZM26 18V19.5H27.5V18H26ZM26 0H27.5V-1.5H26V0ZM1.5 6.54545V0H-1.5V6.54545H1.5ZM0 1.5H10.1111V-1.5H0V1.5ZM-1.5 11.4545V18H1.5V11.4545H-1.5ZM0 19.5H10.1111V16.5H0V19.5ZM24.5 11.4545V18H27.5V11.4545H24.5ZM26 16.5H15.8889V19.5H26V16.5ZM27.5 6.54545V0H24.5V6.54545H27.5ZM26 -1.5H15.8889V1.5H26V-1.5Z" transform="translate(2 2)" fill="white"/>
                                       </svg>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="video-title-action">
                         <h6><?php the_title(); ?>
                            <em><?php echo $views; ?> Views  | <?php echo $votes; ?> Votes  | <?php echo get_the_date('j F, Y'); ?></em>
                         </h6>
                        <?php
                            $result = $wpdb->get_results( 'SELECT COUNT(like_count) as total_like FROM like_dislike where Post_id="'.$post->ID.'" AND like_count=1 ' );     
                            foreach($result as $res){                   
                                $like_count =  $res->total_like;
                            }

                            if($user_id != ''){
                                $result_follow = $wpdb->get_results( "SELECT * FROM channel_follow WHERE user_id = $user_id AND channel_id = $channel_id");
                         
                                if($result_follow[0]->follow_count == 1){
                                    $fllowText = 'Following';
                                }else{
                                    $fllowText = 'Follow';
                                }      
                            }else{
                                $fllowText = 'Follow';
                            }
                                 
                        ?>             
                         <div class="action_wrap">
                              <div class="action_left">
                                 
                                  <?php if(is_user_logged_in()){?>
                                  
                                   <a href="javascript:void(0);" class="ac-btn link-btn <?php if($like_count>0){ echo 'active';}?>" onclick="video_like(<?php echo $post->ID; ?>,<?php echo $user_id; ?>)"><i class="fa fa-thumbs-up" aria-hidden="true" id="like_count_<?php echo $like_count; ?>"></i><span id="total_likes">(<?php echo $like_count; ?>)Like</span></a>
                                  
                                  <?php }else{?>
                                  
                                  <a href="javascript:void(0);" class="ac-btn link-btn <?php if($like_count>0){ echo 'active';}?>" ><i class="fa fa-thumbs-up" aria-hidden="true" ></i><span id="total_likes">(<?php echo $like_count; ?>)Like</span></a>
                                  <?php }?>
                                  
                                   <div class="drop-share">
                                    <a href="#" href="javascript:void(0);" class="ac-btn share-btn"><i class="fa fa-share" aria-hidden="true"></i> Share</a>
                                    <ol class="social-icon">
                                            <li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_the_permalink(); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                            <li><a href="http://twitter.com/share?text=<?php echo get_the_title($post_id); ?>&url=<?php echo get_the_permalink(); ?>"><i class="fa fa-twitter"></i></a></li>
                                            <!--<li><a href="http://instagram.com/share?text=<?php echo get_the_title($post_id); ?>&url=<?php echo get_the_permalink(); ?>"><i class="fa fa-instagram"></i></a></li>-->
                                        </ol>
                                   </div>
                              </div>
                              <div class="action_right">
                                <?php if(is_user_logged_in()){ ?>
                                <a href="javascript:void(0);" class="vote-btn btn btn-default btn-sm ">VOTE</a>
                                <a href="#tip_modal" data-toggle="modal" class="tip-btn btn red-color btn-border btn-sm ">TIP</a>
                                  <?php }else{ ?>
                                <a href="javascript:void(0);" class="vote-btn btn btn-default btn-sm please_login">VOTE</a>
                                <a href="javascript:void(0);" class="tip-btn btn red-color btn-border btn-sm please_login">TIP</a>
                                  <?php }?>
                              </div>
                         </div>
                     </div>


                     <div class="channel_pro_box fvvvvv">
                         <figure><img src="<?php echo $video_author_img; ?>" alt="avtar-img-1.png" /></figure>
                         <div class="channel_pro_content">
                             <h6><?php echo $post_author_name; ?>
                                
                                <a href="<?php echo get_author_posts_url($post_author_id); ?>" class="text-yellow">View Portfolio</a>
                                  <?php if(is_user_logged_in()){ ?>
                                <a href="javascript:void(0);" class="btn btn-red btn-sm" id="follow" onclick="channel_follow(<?php echo $post->ID; ?>,<?php echo $user_id; ?>,<?php echo $channel_id; ?>)";><?php echo $fllowText; ?></a>
                                 <?php }else{?>
                                 <a href="javascript:void(0);" class="btn btn-red btn-sm please_login" >Follow</a>
                                 <?php }?>
                             </h6>

                             <p><?php echo get_the_content($post->ID); ?></p>
                         </div>
                     </div>
                    
                    <div class="channel_comments">
                         <div class="channel_comments_form">
                             <?php 
                             if(is_single () && is_user_logged_in()){
                                    comment_form();
                              }else{
                                 echo '<p>Please login to leave comment</p>';
                              }  
                             ?>
<ol class="commentlist rrrr">
    <?php
        //Gather comments for a specific page/post 
//        $comments = get_comments(array(
//            'post_id' => $post_id,
//            'status' => 'approve' //Change this to the type of comments to be displayed
//        ));
 
        //Display the list of comments
        wp_list_comments(array(
            'per_page' => 10, //Allow comment pagination
            'reverse_top_level' => false //Show the oldest comments at the top of the list
        ), $comments);
    ?>
</ol>
                         </div>

                     </div>
                </div>

                <div class="single-video-right">
                    <div class="title">
                        <h6>Next Video</h6>
                        <div class="single-video-list">
                        <?php
                            $cat = get_the_terms( $post->ID, 'channel' ); 
                            $videos = array();
                                foreach($cat as $cat_v){  
                                     $cat_name = $cat_v->name;
                                     $cat_id   = $cat_v->term_id;
                                }
                            
                                $args = array(
                                     'post_type'   => 'videos',
                                     'hide_empty'  => false,
                                     'post__not_in' => array($post->ID),
                                     'tax_query'   => array(
                                        array(
                                            'taxonomy' => 'channel',
                                            'field'    => 'term_id',
                                            'terms'    =>  $cat_id,
                                        ),
                                    ),
                                );
                               
                           $loop = new wp_query($args);
                            
                           $v_count = 1;
                            
                           if($loop->have_posts()):
                           while($loop->have_posts()): $loop->the_post();
                           $video      = get_post_meta($post->ID,'video_link',true); 
                           $video_url  = wp_get_attachment_url($video);

                           $img = wp_get_attachment_thumb_url($post->ID);
                            $videos[] = $post->ID;

                           $thumbnail_img = get_field('video_thumbnail_image',$post->ID);
                           $content = get_the_content($post->ID);

                            /**** get Post Views ****/
                            $views = get_post_meta($post->ID,'post_views_count',true);

                            $publishDate = get_the_date('Y-m-d');
                        ?>
                        <div class="single-video-box video_block ">
                              
                                  <figure><img src="<?php echo $thumbnail_img; ?>" alt="video-list-1.png" class="mCS_img_loaded">
                                  <a href="<?php echo get_the_permalink($post->ID); ?>" class="material-icons">play_circle_filled</a>
                                  </figure>
                                  <div class="single-video-content">
                                      <p><?php echo get_the_title(); ?></p>

                                      <div class="single-video-sub-con">
                                          <p><?php echo $cat_name; ?></p>
                                          <em><?php echo $views; ?> Views  |  <?php echo time_elapsed_string($publishDate);?></em>
                                      </div>
                                  </div>
                              
                          </div>
                           
                            <?php
                            
                            $v_count++;
                            
                            endwhile;
                            wp_reset_query();
                            endif;
                            
                            ?>
                        </div>
                    </div>
                    
                    <br>
                    <div class="title">
                        <h6>Related Videos</h6>
                        <div class="single-video-list">
                            <?php
                            $cat = get_terms([
                                    'taxonomy' => $taxonomy,
                                    'hide_empty' => false,
                                ]);
                            
                                foreach($cat as $cat_v){  
                                     $cat_name = $cat_v->name;
                                     $cat_id   = $cat_v->term_id;
                            
                                $args = array(
                                     'post_type'   => 'videos',
                                     'hide_empty'  => false,
                                     'post__not_in' => $videos,
                                     'tax_query'   => array(
                                        array(
                                            'taxonomy' => 'channel',
                                            'field'    => 'term_id',
                                            'terms'    =>  $cat_id,
                                        ),
                                    ),
                                );
                               
                           $loop = new wp_query($args);
                            
                           $v_count = 1;
                            
                           if($loop->have_posts()):
                           while($loop->have_posts()): $loop->the_post();
                           $video      = get_post_meta($post->ID,'video_link',true); 
                           $video_url  = wp_get_attachment_url($video);

                           $img = wp_get_attachment_thumb_url($post->ID);

                           $thumbnail_img = get_field('video_thumbnail_image',$post->ID);
                           $content = get_the_content($post->ID);

                            /**** get Post Views ****/
                            $views = get_post_meta($post->ID,'post_views_count',true);

                            $publishDate = get_the_date('Y-m-d');
                               ?>
                        <div class="single-video-box video_block ">
                                  <figure><img src="<?php echo $thumbnail_img; ?>" alt="video-list-1.png" class="mCS_img_loaded">
                                  <a href="<?php echo get_the_permalink($post->ID); ?>" class="material-icons">play_circle_filled</a>
                                  </figure>
                                  <div class="single-video-content">
                                      <p><?php echo get_the_title(); ?></p>

                                      <div class="single-video-sub-con">
                                          <p><?php echo $cat_name; ?></p>
                                          <em><?php echo $views; ?> Views  |  <?php echo time_elapsed_string($publishDate);?></em>
                                      </div>
                                  </div>
                          </div>
                           
                            <?php
                            
                            $v_count++;
                            
                            endwhile;
                            wp_reset_query();
                            endif;
                            }
                            ?>
                        </div>
                    </div>
                </div>
           </section>
      </main>

      <div class="modal fade tip_modal" id="tip_modal">
           <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                     <h4>Send TIP support your favourite ones</h4>
                    <form id="pay-tip" method="post">
                     <div class="radio-custom boxes">
                        <label>
                            <input type="radio" name="radio" value="2"/>
                            <span class="radio-cm">$2</span>                            
                        </label>

                        <label>
                            <input type="radio" name="radio" value="5"/>
                            <span class="radio-cm">$5</span>                            
                        </label>


                        <label>
                            <input type="radio" name="radio" value="10"/>
                            <span class="radio-cm">$10</span>                           
                        </label>

                        <label>
                            <div class="cus_price">
                            <span class="radio-cm">$</span>
                            <input type="number" name="custom_radio" class="form-control">
                            </div>
                        </label>

                     </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>CARD NUMBER</label>
                                    <input type="number" name="card_number" id="card_number" class="st_card_number form-control" placeholder="Card Number">
                                    <div id="card_number" class="field"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>EXPIRY DATE</label>
                                        <input type="number" name="year" id="ex_year" placeholder="YYYY" class="st_ex_year form-control"  required="">
                                        <div id="card_expiry" class="field"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>EXPIRY MONTH</label>
                                        <input type="number" name="month" placeholder="MM" id="exp_month" class="st_ex_month form-control"  required="">
                                        <div id="card_expiry" class="field"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>CVC CODE</label>
                                    <input type="number" name="cv_code" placeholder="CVC Code" id="cv_code" class="st_card_cvv form-control" required="">
                                    <div id="card_cvc" class="field"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group radio-custom">
                                     <label>
                                        <input type="checkbox" name="stripe_terms" class="stripe_terms_<?php echo get_the_ID(); ?> checkbox-btn traveller-check">
                                        <span class="checkmark">
                                            I agree to the
                                            <a href="<?php echo get_the_permalink(79); ?>">Terms and Conditions</a>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="btns-groups">
                                    <input class="btn-rg btn btn-red" type="submit" name="stripe" value="Pay Tip" id="pay_tip">
                                    <input class="cancel-btn btn-rg btn btn-red"  data-dismiss="modal" type="reset" value="Cancel">
                                    <input  type="hidden" name="action" value="pay_tip_with_stripe">
                                    <input  type="hidden" name="tip_amount" value="" id="tip_amount">
                                    <input  type="hidden" name="userid" value="<?php echo $user_id; ?>" >
                                    <input  type="hidden" name="post_userid" value="<?php echo $post_author_id; ?>" >
                                    <input  type="hidden" name="post_id" value="<?php echo $post_id; ?>" >
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
           </div>
      </div>

<?php 
get_footer(); 
?>

<script>
//    $('#Main').addClass('open');
    
    jQuery('#pay-tip').validate({
        rules: {
            radio:{
                required: true,
            },
            card_number: {
                required: true,
                minlength: 16,
            },
            exp_month: {
                required: true,
            },
            exp_year: {
                required: true,
            },
            cv_code: {
                required: true,
            },
        },
        submitHandler: function(form){
            submitForm();
            jQuery("#pay_tip").prop( "disabled", true );
        }
    });
    
    /*** Stripe Card validation Function full payment ****/
    function submitForm(){
           Stripe.createToken({

           number: jQuery('.st_card_number').val(),

           cvc: jQuery('.st_card_cvv').val(),

           exp_month: jQuery('.st_ex_month').val(),

           exp_year: jQuery('.st_ex_year').val()

           }, stripeResponseHandler);      
    }
    
    // Set your publishable key
    Stripe.setPublishableKey('pk_test_f0K9ipIEGynaiIN4g9yXhlgA000S0Z6X0P');
    
    function stripeResponseHandler(status, response){
        
    if (response.error) {
       // Display the errors on the form
        console.log(response.error.message);
    } else {
       var form$ = jQuery("#pay-tip");
       // Get token id
       var token = response.id;
       // Insert the token into the form
       form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
       // Submit form to the server

           var price = jQuery("#tip_amount").val();

           if(price != ''){
           var stripeValues = jQuery("#pay-tip").serialize();
           var ajax_url = jQuery('#admin-ajax-url').val();
           var dataString = "token="+token+"&"+stripeValues;
           if(jQuery("input[name='stripe_terms']").is(":checked")){
               jQuery.ajax({
               type: "POST",
               url: ajax_url,
               data: dataString,
               dataType: 'json',
               success: function(res){
                   if(res.status == 1){
                       toastr.success("Payment complete.");
                       
                       location.reload();
                       
                   }else{
                       toastr.error("Error");
                       jQuery("#pay_tip").prop( "disabled", false );
                   }
               }
           });
           }else{
               toastr.error("Please accept terms");
               jQuery("#pay_tip").prop( "disabled", false );
           }
           }else{
               toastr.error("Please select tip amount");
               jQuery("#pay_tip").prop( "disabled", false );
           }

       }
    }
    
    
</script>