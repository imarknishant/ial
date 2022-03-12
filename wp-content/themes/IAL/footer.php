
 <!-- Modal -->
<?php if(!is_user_logged_in()){?>
 <div class="modal fade" id="sign-upp" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
     <div class="modal-content">
        <button type="button" class="closes close-signup" data-dismiss="modal" aria-label="Close">
           X
        </button>

        <div class="content_box">
           <h2>Hey !!!</h2>
           <p>Seems like you havn’t join us yet</p>
           <h3>Sign in to make your opinion count</h3>

           <a href="<?php echo get_the_permalink(12); ?>" class="sign_inn material-icons">
            person_add_alt
            </a>
        </div>
     </div>
   </div>
 </div>
<?php }?>

<!-- Next Video Play -->
<div class="modal fade" id="next-video" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
     <div class="modal-content">
        <div class="content_box">
           <p>Next Video Playes in <span>5</span>s</p>
            <a href="#" class="play_next btn btn-sm btn-secondary">Play</a>
            <a href="#" class="not_play_next btn btn-sm btn-default">Cancel</a>
           
        </div>
     </div>
   </div>
 </div>

      <!-- jQuery first, then Bootstrap JS. -->
      <script src="<?php echo get_template_directory_uri(); ?>/assets/js/bundle.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://code.jquery.com/jquery-migrate-1.4.1.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

      <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.slick/1.3.15/slick.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/latest/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/latest/respond.min.js"></script>
      <![endif]-->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
      <script src="<?php echo get_template_directory_uri(); ?>/lity/dist/lity.js"></script>
      <script src="<?php echo get_template_directory_uri(); ?>/js/custom-data.js"></script>
      <script src="<?php echo get_template_directory_uri(); ?>/assets/js/ial.js"></script>
      <?php wp_footer(); ?>

   </body>
</html>