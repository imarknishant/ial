<?php

/* Template Name: Create channel */
get_header();
?>

<main id="Main" class="subscription-wrap">     
        <section class="create_chhanel_wrap">
             <h6>Create Channel</h6>

             <form id="create-channel" enctype="multipart/form-data">
                 <figure class="avtarck">
                     <img src="<?php echo get_template_directory_uri(); ?>/assets/images/avtar-img-1.png" alt="avtar-img-1.png" id="blah-channel" loading="lazy">
                 </figure>

                 <div class="form-group">
                     <input type="text" class="form-control" placeholder="Name" name="channel_name" />
                 </div>

                 <div class="form-group">
                    <input type="text" class="form-control" placeholder="Short description" name="channel_short_desc" />
                </div>

                <div class="form-group">
                    <label class="attch form-control">
                        <input type="file" id="channel_image" accept="image/*" name="channel_image" />
                        <span class="out">Attach File</span>
                        <i class="fa fa-paperclip" aria-hidden="true"></i>
                    </label>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-red w-100" value="Create">
                    <input type="hidden" name="userid" value="<?php echo get_current_user_id(); ?>">
                    <input type="hidden" name="action" value="create_channel">
                </div>

             </form>
        </section>
      </main>

<?php
get_footer();
?>