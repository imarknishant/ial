<?php
/*
Template Name: Forgot Password
*/
get_header();
?>
    <main id="Main" class="login-wrap">
        <!-- login block -->
        <div class="login-wrapp">
            <div class="title">
                <h2>Forgot Password</h2>
            </div>
            <div class="login-form">
                <form id="forgot_password">
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Email Address" name="email" />
                    </div>
                    <div class="form-group">
                        <button class="btn btn-yellow-color">Submit</button>
                        <input type="hidden" name="action" value="forgot_password">
                    </div>
                </form>
            </div>
        </div>
        <!-- login block -->
    </main>
<?php
get_footer();
?>