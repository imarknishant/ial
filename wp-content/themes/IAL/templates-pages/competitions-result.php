<?php

/* Template Name: Competetion result */
get_header();
global $post,$wpdb;

$postid = base64_decode($_GET['id']);
$userid = get_current_user_id();

$currentDateTime = strtotime(date('Y-m-d H:i:s'));
$Date_js = get_field('end_date_time',$postid);

/**** check if user voted ****/
$votedata = $wpdb->get_results("SELECT * FROM competition_vote WHERE user_id = $userid AND compe_post_id = $postid");
?>

<main id="Main" class="competition-result-wrap">
    <div class="competition-result-block">
         <div class="title title-underline yellow">
            <h6><a href="<?php echo get_the_permalink(18); ?>">All Competitions</a></h6>
         </div>

            <div class="title-bar orange-bar">
               <div class="title">
                  <h6>Sports</h6>
               </div>
               <div class="timer">
<!--               <span class="time">03:34:50:28</span>-->
                Voting ends in - 
                <div id="countdown"></div>
               </div>
           </div>

           <div class="competition-list-wrap">
               <form id="competition-submit" method="post">
               <?php
                 //********** Get videos of competition **************//
                 $videosids = get_field('select_videos',$postid);
                 $votedids = array();
                 foreach($videosids as $ids){
                    $total_views = get_post_meta($ids,'post_views_count',true);
                    if($total_views == ''){
                        $total_views = 0;
                    }
                    $thumbnail_image = get_field('video_thumbnail_image',$ids); 
                     
                    $voteData = $wpdb->get_results("SELECT COUNT(ID) as votes FROM competition_vote WHERE compe_post_id = $postid AND video_id = $ids");
                     
                    $votes = $voteData[0]->votes;
                    $barPer = ($votes/100)*100;
                     
                     $v_d = $wpdb->get_results("SELECT * FROM competition_vote WHERE compe_post_id = $postid AND video_id = $ids");
                     foreach($v_d as $v){
                         $votedids[] = $v->video_id;
                     }

                 ?>
                <div class="competition-list-box">
                   <label class="custom-radio">
                      <input type="radio" name="radio" value="<?php echo $ids; ?>" required <?php if(in_array($ids,$votedids)){ echo 'checked'; }?> />
                      <span class="radio-custom"></span>
                   </label>

                   <div class="competition-list-content">
                       <figure><img src="<?php echo $thumbnail_image; ?>" alt="category-img-1.jpg" loading="lazy" /></figure>
                       <div class="competition-list-detail">
                           <h6><?php echo get_the_title($ids); ?></h6>
                           <p><?php echo wp_trim_words(get_the_content($ids),10,'...'); ?></p>

                           <div class="progress_votes">
                              <div class="progress">
                                 <div class="progress-bar" role="progressbar" style="width: <?php echo $barPer; ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                               </div>
                               <div class="votes">
                                  <span class="vote-text"><?php echo $votes; ?> Votes</span>
                               </div>
                           </div>
                       </div>
                   </div>
                </div>
               <?php }?>
                   
               <div class="have_voted">
                   <?php
                
                   if(empty($votedata)){
                   ?>
                   <input type="submit" class="btn btn-xs btn-border yellow-color" value="VOTE">
                   <input type="hidden" name="user_id" value="<?php echo $userid; ?>">  
                   <input type="hidden" name="competition_id" value="<?php echo $postid; ?>">  
                   <input type="hidden" name="action" value="submit_competition">
                   
                   <?php }else{ ?>
                   
                   <div class="hv_box">You’ve Voted :)</div>
                   
                   <?php }?>
                   <p>The competition will ends on <?php echo date('d M, Y',strtotime($Date_js)); ?></p>
               </div>
                
             </form>
           </div>
    </div>
</main>
    <script>
        // Set the date we're counting down to
        var countDownDate = new Date("<?php echo $Date_js; ?>").getTime();
           

        // Update the count down every 1 second
        var x = setInterval(function() {

          // Get today's date and time
          var now = new Date().getTime();

          // Find the distance between now and the count down date
          var distance = countDownDate - now;
            
          // Time calculations for days, hours, minutes and seconds
          var days = Math.floor(distance / (1000 * 60 * 60 * 24));
          var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
          var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
          var seconds = Math.floor((distance % (1000 * 60)) / 1000);

          // Display the result in the element with id="demo"
          document.getElementById("countdown").innerHTML = days + "d " + hours + "h "
          + minutes + "m " + seconds + "s ";

          // If the count down is finished, write some text
          if (distance < 0) {
            clearInterval(x);
            document.getElementById("countdown").innerHTML = "EXPIRED";
          }
        }, 1000);
        
    </script>
<?php
get_footer();
?>