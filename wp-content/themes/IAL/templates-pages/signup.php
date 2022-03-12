<?php
/* Template Name: Signup */
get_header();
?>
    <main id="Main" class="signUp-wrap">
        <!-- login block -->
        <div class="login-wrapp">
            <div class="title">
                <h2>Sign Up</h2>
            </div>
            <br>
            <div class="login-form">
                <form id="signup">
                    <div class="form-group row">
                        <div class="col-6">
                            <input type="text" class="form-control" placeholder="First Name" name="first_name" />
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control" placeholder="Last Name" name="last_name" />
                        </div>
                    </div>
                    <div class="form-group date_wrp">
                        <div class="col-date-left">
                            <p class="">Date of Birth</p>
                        </div>
                        <div class="col-date-right">
                            <input type="number" class="form-control" placeholder="DD" name="date" />
                            <input type="number" class="form-control" placeholder="MM"  name="month" />
                            <input type="number" class="form-control" placeholder="YYYY" name="year" />
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Email Address" name="email" />
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="username" placeholder="Username" name="username" />
                    </div>
                    <div class="form-group ">
                        <input type="password" class="form-control" placeholder="Password" name="password" />
                    </div>

                    <div class="form-group mb-5">
                        <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_pass" />
                    </div>
                    
                    <div class="form-group mb-5">
                       <label class="checkbox_lebel">
                           <input type="checkbox" name="terms_policy[]">
                            <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">I agree to the </font></font><a href="<?php echo get_the_permalink(87); ?>"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">terms of use</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> and </font></font><a href="<?php echo get_the_permalink(79); ?>"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">privacy policy</font></font></a></p>
                      </label> 
                    </div>    

                    <div class="form-group">
                        <button class="btn btn-red">Sign Up</button>
                    </div>
                    <input type="hidden" name="action" value="user_signup">
                  <div class="have_accountt">
                     <p>Already have an account ? <a href="<?php echo get_the_permalink(10); ?>">Login here</a></p>
                  </div>
                </form>
            </div>
        </div>
      </main>
<?php
get_footer();
?>