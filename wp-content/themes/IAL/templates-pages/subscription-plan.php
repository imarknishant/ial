<?php
if(!is_user_logged_in()){
    header("Location:".site_url());
}
/* Template Name: Subscription plan */
get_header();
$userid = get_current_user_id();

$st_plan = get_field('standard_package','option'); 
$fl_plan = get_field('flex_package','option'); 
$pr_plan = get_field('premium_package','option'); 

/**** get subscription plan ****/
$plan = $wpdb->get_results("SELECT * FROM subscriptions WHERE user_id = $userid");

?>

<main id="Main" class="subscription-wrap">
          <div class="subscription___wrap">
                <div class="title yellow">
                    <h2>Flexible Plans</h2>
                    <h3>Choose the plan that works best for you</h3>
                </div>

                <div class="plan_wrap">
                    <?php
                    $args = array(  
                        'post_type' => 'my-plans',
                        'post_status' => 'publish',
                        'posts_per_page' => -1, 
                    );

                    $loop = new WP_Query( $args ); 
                    $i=0;

                    while ( $loop->have_posts() ) : $loop->the_post();
                    $price = get_field('plan_price',get_the_ID());
                    $img = get_field('plan_icon',get_the_ID());
                    $plan_id = get_post_meta(get_the_ID(),'plan_id',true);
                    ?>
                    <div class="s_plan <?php if($i==1) echo 'active'; ?>">
                        <div class="s_plan_title">
                            <figure><img src="<?php echo $img; ?>" alt="figure-icon-1.png" /></figure>
                            <div class="s_plan_figure_detail">
                                <h5><?php echo get_the_title(get_the_ID()); ?></h5>
                                  <h6><sup>$</sup><?php echo $price; ?> <sub>/ per month</sub></h6>
                            </div>
                        </div>

                        <div class="s_plan_list">
                            <?php the_content(); ?>
                            
                            <?php if($plan[0]->subscription_plan == get_the_title(get_the_ID())){ ?>
                            <a href="#subscription" class="btn w-100 btn-green" >Current Plan</a>
                            <?php }else{ ?>
                            <a href="#subscription_<?php echo get_the_ID(); ?>" class="btn <?php if($i==1){echo 'btn-red';}else{ echo 'btn-yellow-color'; }  ?> w-100" data-toggle="modal" >Choose Plan <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                            </a>
                            <?php } ?>
                        </div>
                    </div>
                    
                    
        <div class="modal fade tip_modal" id="subscription_<?php echo get_the_ID(); ?>">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                     <h4> <?php echo get_the_title(get_the_ID()); ?> </h4>

                    <form id="subs_<?php echo get_the_ID(); ?>" method="post">
                        <input type="hidden" id="form_id" value="<?php echo get_the_ID(); ?>">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>CARD NUMBER</label>
                                    <input type="number" name="card_number" id="card_number" class="st_card_number_<?php echo get_the_ID(); ?> form-control" placeholder="Card Number">
                                    <div id="card_number" class="field"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>EXPIRY YEAR</label>
                                        <input type="number" name="year" id="ex_year" placeholder="YYYY" class="st_ex_year_<?php echo get_the_ID(); ?> form-control"  required="">
                                        <div id="card_expiry" class="field"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>EXPIRY MONTH</label>
                                        <input type="number" name="month" placeholder="MM" id="exp_month" class="st_ex_month_<?php echo get_the_ID(); ?> form-control"  required="">
                                        <div id="card_expiry" class="field"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>CVC CODE</label>
                                    <input type="number" name="cv_code" placeholder="CVC Code" id="cv_code" class="st_card_cvv_<?php echo get_the_ID(); ?> form-control" required="">
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
                                    <input class="btn btn-sm btn-secondary" type="submit" name="stripe" value="Pay With Stripe">
                                    <input class="btn btn-sm btn-secondary" type="hidden" name="action" value="stripe_payment_func">
                                    <input class="btn btn-sm btn-secondary" type="hidden" name="plan_type" value="<?php echo get_the_title(get_the_ID()); ?>" id="plan_type" >
                                    <input class="btn btn-sm btn-secondary" type="hidden" name="plan_amount" value="<?php echo $price; ?>" id="plan_type" >
                                    <input class="btn btn-sm btn-secondary" type="hidden" name="userid" value="<?php echo $userid; ?>" >
                                    <input class="btn btn-sm btn-secondary" type="hidden" name="plan_id" value="<?php echo $plan_id; ?>" >
                                    
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="stripe_error_msg">                                    
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
           </div>
      </div> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>        
<script>
    
/*********************** Stripe payment ********************/

    jQuery("#subs_<?php echo get_the_ID(); ?>").validate({
         rules: {
            card_number: {
                required: true,
                maxlength: 16,
            },
            month: {
                required: true,
                maxlength:2
            },
            year: {
                required: true,
                maxlength:4
            },
            cv_code: {
                required: true,
            },
         },
         submitHandler : function(form){
            submitForm_<?php echo get_the_ID(); ?>();
         }
    });

    /*** Stripe Card validation Function full payment ****/
    function submitForm_<?php echo get_the_ID(); ?>(){
        
           Stripe.createToken({

           number: jQuery('.st_card_number_<?php echo get_the_ID(); ?>').val(),

           cvc: jQuery('.st_card_cvv_<?php echo get_the_ID(); ?>').val(),

           exp_month: jQuery('.st_ex_month_<?php echo get_the_ID(); ?>').val(),

           exp_year: jQuery('.st_ex_year_<?php echo get_the_ID(); ?>').val()

           }, stripeResponseHandler_<?php echo get_the_ID(); ?>);   
        
        
    }

    // Set your publishable key
    Stripe.setPublishableKey('pk_live_51JDTtIBoP4pOPWX96maW75IWiyleTxHCT8YWOGiv7FElLVcSS1N5QKuO3bp8U8cbHDJr756GyRn5sNgfUWyoMJKN00xyK3VGB2');
    // Callback to handle the response from stripe

    function stripeResponseHandler_<?php echo get_the_ID(); ?>(status, response) {

    if (response.error) {
       // Display the errors on the form
        console.log(response.error.message);
        console.log(response.error);
        jQuery(".stripe_error_msg").html(response.error.message);
    } else {
       var form$ = jQuery("#subs_<?php echo get_the_ID(); ?>");
       // Get token id
       var token = response.id;
       // Insert the token into the form
       form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
       // Submit form to the server

           var price = jQuery("#amount").val();

           if(price != ''){
           var stripeValues = jQuery('#subs_<?php echo get_the_ID(); ?>').serialize();
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
                       
                       location.href = res.url;
                       
                   }else if(res.status == 2){
                       
                        toastr.success("Plan updated.");
                       
                       location.href = res.url;
                       
                    }else{
                       toastr.error("Error");
                   }
               }
           });
           }else{
               toastr.error("Please accept terms");
           }
           }else{
               toastr.error("Please select plan");
           }

       }
    }
                    </script>
                    <?php
                    $i++;
                    endwhile;
                    wp_reset_query();
                    ?>

                </div>
          </div>
      </main>
<?php
get_footer();
?>