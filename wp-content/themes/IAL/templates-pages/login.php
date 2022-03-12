<?php

/* Template Name: login */
get_header();

if(is_user_logged_in()){
  ?>
  <script>
     window.location.replace("https://www.ial.video");
  </script>
 <?php
}

?>

    <main id="Main" class="login-wrap">
        <!-- login block -->
        <div class="login-wrapp">
            <div class="title">
                <h2>Login</h2>
            </div>
            <div class="login-form">
                <form id="login">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Email Address" name="login_email" />
                    </div>
                    <div class="form-group mb-5">
                        <input type="password" class="form-control" placeholder="Password" name="login_password" />
                        <a href="<?php echo get_the_permalink(330); ?>" class="forgot_pass">Forgot Password?</a>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-yellow-color">Login</button>
                        <input type="hidden" name="action" value="login">
                    </div>

                    <div class="or"></div>

                    <div class="sm_login">
                        <a class="btn sm-btn fb-btn fa fa-facebook-official" href="https://www.ial.video/letmein/?loginSocial=facebook" data-plugin="nsl" data-action="connect" data-redirect="current" data-provider="facebook" data-popupwidth="600" data-popupheight="679">
                            Facebook
                        </a>

      <!--                  <a class="btn sm-btn fb-btn fa fa-facebook-official" href="https://customerdevsites.com/ial/wp-login.php?loginSocial=facebook" data-plugin="nsl" data-action="connect" data-redirect="current" data-provider="facebook" data-popupwidth="475" data-popupheight="175">-->
						<!--Facebook-->
      <!--                  </a>-->
                        
						<!--<a class="fa fa-google-plus btn sm-btn gg-btn" href="https://customerdevsites.com/ial/wp-login.php?loginSocial=google" data-plugin="nsl" data-action="connect" data-redirect="current" data-provider="google" data-popupwidth="600" data-popupheight="600">-->
	     <!--               Google +-->
      <!--                  </a>-->
    		         	<a class="fa fa-google-plus btn sm-btn gg-btn" href="https://www.ial.video/letmein/?loginSocial=google" data-plugin="nsl" data-action="connect" data-redirect="current" data-provider="google" data-popupwidth="600" data-popupheight="600">
                        	Google
                        </a>
                        
                  </div>

                  <div class="have_accountt">
                     <p>Don’t have an account ? <a href="<?php echo get_the_permalink(12); ?>">Register here</a></p>
                  </div>
                </form>
            </div>
        </div>
    </main>


<?php
get_footer();
?>