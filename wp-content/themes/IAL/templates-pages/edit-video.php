<?php
/*
Template Name: Edit Video
*/
get_header();

$videoID = base64_decode($_GET['vid']);


/**** Video Variables ****/
$video = get_field('video_link',$videoID);
$videoLink = $video['url'];

$thumbnailimg = get_field('video_thumbnail_image',$videoID);
$videoTitle = get_the_title($videoID);
$videoDesc = get_post_field('post_content', $videoID);

?>
<main id="Main" class="other-profile-wrap">
    <section class="opp_main">
              <div class="modal-content-inn">
                    <h3>Edit Video</h3>
                    <form class="post-form thumb-nail" id="video_upload" method="post">
                       <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="upload-files">
                                  <label>
                                     <input type="file" name="video_file" class="file_video" id="video_p" accept="video/mp4"/>
                                      <video width="400" controls id="video_here">
                                          <source src="<?php echo $videoLink; ?>" type="video/mp4">
                                      </video>
                                     <span class="btn yellow-color btn-border">Select File</span>
                                  </label>
                                  
                               </div>
                            </div>
                           <div class="col-md-6 col-12">
                               <img src="<?php echo $thumbnailimg; ?>">
                             <canvas id="video-canvas" style="display:none;" loading="lazy"></canvas>
                                
                           </div>
                           <div class="col-md-6 col-12">
                                 <div id="thumbnail-container">
<!--                                     Seek to seconds-->
                                    <select id="set-video-seconds" class="form-control"></select> 
                                </div>
                           </div>
                           <div class="col-md-6 col-12">
                                 <div class="form-group">
                                  <input type="text" class="form-control" placeholder="Video Title" name="video_title" value="<?php echo $videoTitle; ?>" />
                               </div>
                           </div>
                           <div class="col-md-6 col-12">
                                <div class="form-group">
                                  <input type="text" class="form-control" placeholder="Video description" name="video_desc" value="<?php echo $videoDesc; ?>" />
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
                                   <div id="loading" class="loading">
                                        <img id="loading-image" src="<?php echo get_template_directory_uri();?>/assets/images/loader.gif" alt="Loading..." loading="lazy" />
                                    </div>
                                   <input type="submit" class="btn btn-red video-upload" value="Upload Video">
                               </div>
                           </div>
                           <div class="col-md-6 col-12 ml-auto">
                             <div class="btns-group">
                                   <input type="reset" class="btn btn-red cancel-btn" value="Cancel">
                                   <input type="hidden" name="action" value="upload_video">
                                   <input type="hidden" name="cat_id" value="<?php echo $cat_id; ?>">
                                   <input type="hidden" name="cat_slug" value="<?php echo $cat_slug; ?>">
        <!--                           <a href="#" class="cancel-btn">Cancel</a>-->
                               </div>
                           </div>
                        </div>
                        <input type="hidden" id="video_thumbnail" name="video_thumbnail">
                    </form>
 
                 </div>
    </section>
</main>
<?php
get_footer();
?>