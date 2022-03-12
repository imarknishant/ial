<?php 
if(is_user_logged_in()){
    $userObject = wp_get_current_user();
}else{
    header("Location: ".site_url());
}
/*
Template Name: Add Video
*/
get_header();

$cat_id = base64_decode($_GET['cid']);
$cat_slug = base64_decode($_GET['sl']);
$userid = $userObject->ID;

?>
<main id="Main" class="other-profile-wrap">
    <section class="opp_main">
        <div class="container">
              <div class="modal-content-inn">
                    <h3>Add Video</h3>
                    <form class="post-form thumb-nail" id="video_upload" method="post">
                       <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="upload-files">
                                  <label>
                                     <input type="file" name="video_file" class="file_video" id="video_p" accept="video/mp4"/>
                                      <video width="400" controls id="video_here">
                                          <source type="video/mp4">
                                      </video>
                                     <span class="btn yellow-color btn-border">Select File</span>
                                  </label>
                                  
                               </div>
                            </div>
                           <div class="col-md-6 col-12">
                             <canvas id="video-canvas" style="display:none;" ></canvas>
                            <img src="" id="video_actual_thumbnail" loading="lazy">
                           </div>
                           
                           <div class="col-md-6 col-12 iiiii">
                                 <div id="thumbnail-container">
                                     <h6 id="thumbnail-trim">Thumbnail Trim</p>
                                    <select id="set-video-seconds" class="form-control">
                                        <option>Trim Video seconds</option>
                                    </select> 
                                </div>
                           </div>
                           <div class="col-md-6 col-12 iiiii">
                                 <div id="thumbnail-container">
<!--
                                     <img id="create-thumbnail" src="https://ialvideo.s3.us-east-2.amazonaws.com/ial/wp-content/uploads/2021/12/09055450/thumbnail.jpg" />
                                     <h6 id="create-thumbnail">Click here to create thumbnail</h6>
-->
                                     <a id="get-thumbnail" href="#" class="btn">Create Thumbnail</a>
                                </div>
                           </div>
                           <div class="col-md-6 col-12">
                                 <div class="form-group">
                                  <input type="text" class="form-control" placeholder="Video Title" name="video_title" />
                               </div>
                           </div>
                           <div class="col-md-6 col-12">
                                <div class="form-group">
                                  <input type="text" class="form-control" placeholder="Video description" name="video_desc" />
                               </div>
                           </div>
                           <div class="col-md-6 col-12">
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
                           </div>
                           <div class="col-md-6 col-12 ml-auto">
                             <div class="btns-group">
                                   <div id="loading" class="loading" style="display:none;">
                                        <img id="loading-image" src="<?php echo get_template_directory_uri();?>/assets/images/loader.gif" alt="Loading..." / loading="lazy">
                                    </div>
                                   <input type="submit" class="btn btn-red video-upload" value="Upload Video">
                               </div>
                           </div>
                           <div class="col-md-6 col-12 ml-auto">
                             <div class="btns-group">
                                   <input type="reset" class="btn btn-red cancel-btn cancel-video" value="Cancel">
                                   <input type="hidden" name="action" value="upload_video">
                                   <input type="hidden" name="cat_id" value="<?php echo $cat_id; ?>">
                                   <input type="hidden" name="cat_slug" value="<?php echo $cat_slug; ?>">
                                   <input type="hidden" name="user_id" value="<?php echo $userid; ?>">
        <!--                           <a href="#" class="cancel-btn">Cancel</a>-->
                               </div>
                           </div>
                        </div>
                        <input type="hidden" id="video_thumbnail" name="video_thumbnail">
                    </form>
                 </div>
        </div>
    </section>
</main>
<?php
get_footer();
?>