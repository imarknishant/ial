<?php
/* Template Name: contact us */
get_header();
?>

    <main id="Main" class="signUp-wrap">
        <!-- login block -->
        <div class="login-wrapp">
            <div class="contact_title">
                <h2 id="cont_title">Contact us</h2>
            </div>
            <div class="login-form">
                <?php echo do_shortcode('[contact-form-7 id="113" title="IAL contact form"]'); ?>
            </div>
        </div>
		
      </main>

<?php
get_footer();
?>