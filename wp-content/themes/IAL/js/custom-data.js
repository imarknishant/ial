jQuery(document).ready(function(){
   
    jQuery(".logged-in-as a:first").attr('href','');
    
    jQuery(".cancel-video").click(function(){
        location.reload();
    })
   
    
    jQuery(".please_login").click(function(){
       toastr.warning('Please login'); 
    });
    
    jQuery('#video').on('ended',function(){
      $('#next-video').modal('show');
      setTimeout(function(){
        var is_video = $("#is_video_play").val();
        if(is_video == 'true'){
            $("#video_1")[0].click(); 
        }
      },5000);
            
    });
    
    jQuery("input[name='custom_radio']").keyup(function(){
        var amount_Val = jQuery(this).val();
        jQuery("#tip_amount").val(amount_Val);
    });
    
    /*** Area of interest ***/
    
    $('input[name="interest[]"]').change(function(){ 
        if ($(".trip_type:checked").length > 0){
            jQuery(".trip_type").each(function(){
               jQuery(this).prop('required',false); 
            });
        }else{
           jQuery(".trip_type").each(function(){
               jQuery(this).prop('required',true); 
            });
        }
    });
    
    /*** Play or cancel next video ***/
    
    jQuery(".play_next").click(function(){
        $("#video_1")[0].click();
        $('#next-video').modal('hide');
    });
    
    jQuery(".not_play_next").click(function(){
        $("#is_video_play").val('false');
        $('#next-video').modal('hide');
    });

    var dialogShown = $.cookie('dialogShown');

        if (dialogShown == 1){
            $('#sign-upp').modal('hide');
        }else{
            $(window).load(function(){
                $('#sign-upp').modal('show');
                jQuery(".close-signup").click(function(){
                    $.cookie('dialogShown', 1);
                });
                
            });
        }
    
//    jQuery(".close-signup").click(function(){
//        var dialogShown = $.cookie('dialogShown');
//
//        if (!dialogShown) {
//        $(window).load(function(){
//            $('#sign-upp').modal('show');
//            $.cookie('dialogShown', 1);
//            // On newer versions of js-cookie, API use:
//             Cookies.set('dialogShown', 1);
//
//            });
//        }else {
//            $('#sign-upp').modal('hide');
//        }
//    });
    
    jQuery('#signup').validate({
        rules: {
            first_name: {
                required: true,
            },
            last_name: {
                required: true,
            },
            date: {
                required: true,
                maxlength:2,
            },
            month: {
                required: true,
                maxlength:2,
            },
            year:{
                required: true,
                maxlength:4,
            },
            email:{
                required: true,
                email: true,
            },
            password:{
                required: true,
                maxlength:15,
            },
            confirm_pass:{
                required: true,
                equalTo : '[name="password"]'
            },
        },
        
        submitHandler: function(form) {
            var signupValue = jQuery('#signup').serialize();
            var ajax_url = jQuery('#admin-ajax-url').val();
            
        if(jQuery('input[name="terms_policy[]"]:checked').length > 0){
            
            jQuery.ajax({
                type: "POST",
                url: ajax_url,
                data: signupValue,
                dataType: 'json',
                success: function( res ){
                    if(res.status == '1'){
                        toastr.error('Username already exists');

                    }else if(res.status == '2'){
                        toastr.error('Email already exists'); 

                    }else if(res.status == '3') {
                        jQuery("form").trigger("reset");
                        toastr.success('Account created successfully. Please activate your account by clicking Activation link.'); 
                    }
                }
            });
            
        }else{

            toastr.error('First Accept terms and conditions');
        }
            
        }
        
    });
    
    
    /***** user login ******/
    jQuery('#login').validate({
        rules: {
            login_email: {
                required: true,
            },
            login_password: {
                required: true,
            },
        },
        
        submitHandler: function(form) {

            var signupValue = jQuery('#login').serialize();
            var ajax_url = jQuery('#admin-ajax-url').val();

            jQuery.ajax({
                type: "POST",
                url: ajax_url,
                data: signupValue,
                dataType: 'json',
                success: function( res ){
                    if(res.type == '1'){
                        
                        toastr.success(res.message);
                        location.href = res.url;
                        
                    }else if(res.type == '2'){
                        toastr.error(res.message); 

                    }else if(res.type == '3') {
                        jQuery("form").trigger("reset");
                        toastr.error(res.message); 
                        
                    }else if(res.type == '4') {
                        jQuery("form").trigger("reset");
                        toastr.error(res.message); 
                    }
                }
            });
  
        }
        
    });
    
    
    /***** Forgot Password ******/
    jQuery('#forgot_password').validate({
        rules: {
            email: {
                required: true,
            },
        },
        
        submitHandler: function(form) {

            var forgotValue = jQuery('#forgot_password').serialize();
            var ajax_url = jQuery('#admin-ajax-url').val();
            
            jQuery.ajax({
                type: "POST",
                url: ajax_url,
                data: forgotValue,
                dataType: 'json',
                success: function(res){
                    if(res.status == 1){
                        toastr.success("New Password sent on registered email");
                    }else if(res.status == 0){
                        toastr.error("Email does not exists");
                    }else{
                        toastr.error("Error");
                    }
                }
            });
            
        }
        
    });
    
    /***** Area of interest *****/
    
    jQuery("#user_area_of_interest").submit(function(e){
        e.preventDefault();
        
        var interestValue = jQuery('#user_area_of_interest').serialize();
        var ajax_url = jQuery('#admin-ajax-url').val();
            
        interestValue += '&action=save_interest';
        
        jQuery.ajax({
            type: "POST",
            url: ajax_url,
            data: interestValue,
            success: function(res){
                if(res == 1){
                    toastr.success("Updated successfully");
                    location.reload();
                }else{
                    toastr.error("Error");
                }
            }
        });
    });
    
    /***** Update Password from profile ******/
    jQuery('#update_password').validate({
        rules: {
            current_password: {
                required: true,
            },
            new_password: {
                required: true,
            },
            confirm_password: {
                required: true,
                equalTo : "#new_password"
            },
        },
        
        submitHandler: function(form) {

            var forgotValue = jQuery('#update_password').serialize();
            var ajax_url = jQuery('#admin-ajax-url').val();
            
            jQuery.ajax({
                type: "POST",
                url: ajax_url,
                data: forgotValue,
                dataType: 'json',
                success: function(res){
                    if(res == 1){
                        toastr.success("Password updates successfully");
                        
                        location.reload();
                    }else{
                        toastr.error("Current password does not match");
                    }
                }
            });
            
        }
        
    });

    /***** upload video to channel ******/

    jQuery('#video_upload').validate({
        
        rules: {
            video_file: {
                required: true,
            },
            video_title: {
                required: true,
            },
            video_desc: {
                required: true,
            },
            video_category: {
                required: true,
            },
        },
        
        submitHandler: function(form) {
            
            jQuery(".video-upload").prop('disabled',true);
            var form = jQuery('#video_upload')[0];
            var formData = new FormData(form);

            var ajax_url = jQuery('#admin-ajax-url').val();

            jQuery.ajax({
                type: "POST",
                url: ajax_url,
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
                beforeSend: function() {
                    jQuery("#loading").show();
                },
                success: function( res ){
                    if(res.status == 1){
                        toastr.success("Video uploaded");
                        location.reload();
                        jQuery(".video-upload").prop('disabled',false);
                        jQuery("#loading").hide();
                    }else if(res.status == 2){
                        toastr.error("Upload limit reached for week");
                        jQuery("#loading").hide();
                    }else{
                        toastr.error("Error");
                    }
                }
            });

        }
        
    });
    
    
    /***** Save personal info ******/
    jQuery('#save-personal-info').validate({
        rules: {
            name: {
                required: true,
            },
            email: {
                required: true,
                email: true,
            },
            phone: {
                required: true,
                maxlength: 10,
            },
            about: {
                required: true,
            },
        },
        
        submitHandler: function(form) {
            
            var form = jQuery('#save-personal-info')[0];
            var formData = new FormData(form);

            var ajax_url = jQuery('#admin-ajax-url').val();

            jQuery.ajax({
                type: "POST",
                url: ajax_url,
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function( res ){
                    if(res == 1){
                        toastr.success("Profile Updated");
                        location.reload();
                    }
                }
            });

        }
        
    });

   /***** Create Channel ******/
    jQuery('#create-channel').validate({
        rules: {
            channel_name: {
                required: true,
            },
            channel_short_desc: {
                required: true,
            },
            channel_image: {
                required: true,
            },
        },
        
        submitHandler: function(form) {

            var form = jQuery('#create-channel')[0];
            var formData = new FormData(form);
            var ajax_url = jQuery('#admin-ajax-url').val();

            jQuery.ajax({
                type: "POST",
                url: ajax_url,
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function( res ){
                    if(res == 1){
                        toastr.success("Channel created");
                        location.reload();
                    }else if(res == 2){
                        toastr.error("Channel limit reached. Please upgrade plan!");
                    }else{
                        toastr.error("Error creating");
                    }
                }
            });

        }
        
    });
    
    jQuery(".edit_btn").click(function(){
       jQuery(".profile_form").hide();
       jQuery(".profile_edit_form").show();
    });
    jQuery("#cancel-update-profile").click(function(e){
        e.preventDefault();
       jQuery(".profile_edit_form").hide();
       jQuery(".profile_form").show();

    });

    jQuery(".edit_btn_pass").click(function(){
       jQuery(".display_password_fields").hide();
       jQuery(".edit_password_form").show();
    });
    jQuery(".cancel-password-update").click(function(e){
        e.preventDefault();
       jQuery(".edit_password_form").hide();
       jQuery(".display_password_fields").show();

    });
    
        /***** upload post to channel ******/

    jQuery('#post_upload').validate({
        
        rules: {
            profile_image: {
                required: true,
            },
            post_title: {
                required: true,
            },
            post_desc: {
                required: true,
            },
            video_category: {
                required: true,
            },
        },
        
        submitHandler: function(form) {
            
            var form = jQuery('#post_upload')[0];
            var formData = new FormData(form);

            var ajax_url = jQuery('#admin-ajax-url').val();

            jQuery.ajax({
                type: "POST",
                url: ajax_url,
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function( res ){
                    if(res.status == 1){
                        toastr.success("post uploaded");
                        location.reload();
                    }
                }
            });

        }
       
    });



    /************ Add a comment **********/

    jQuery('#add_comm_form').validate({

            rules: {
                add_comm: {
                    required: true,
                },
                
            },
        
        submitHandler: function(form) {
            
            var formData = jQuery('#add_comm_form').serialize();
            var ajax_url = jQuery('#admin-ajax-url').val();

            jQuery.ajax({
                type: "POST",
                url: ajax_url,
                data: formData,
                success: function( res ){
                    if(res.status == 1){
                        toastr.success("Comment Added sucessfully");
                    }
                }
            });

        }
        
    });


    /************ Add a comment **********/

    jQuery('#reply_comm_form').validate({

        rules: {
            add_reply: {
                required: true,
            },

        },

    submitHandler: function(form) {

        var formData = jQuery('#reply_comm_form').serialize();
        var ajax_url = jQuery('#admin-ajax-url').val();

        jQuery.ajax({
            type: "POST",
            url: ajax_url,
            data: formData,
            success: function( res ){
                if(res.status == 1){
                    toastr.success("Reply Added sucessfully");
                }
            }
        });

    }

});
    
    /************ Paytip **********/
    
    jQuery("input[name='radio']").change(function(){
        jQuery("input[name='tip_amount']").val(jQuery(this).val());
    });
    
    /************ Request Tip Withdraw ***********/
    
    jQuery('#pay-tip').validate({

        rules: {
            radio:{
                required: true,
            },
        },
        submitHandler: function(form){
            
            var formData = jQuery('#pay-tip').serialize();
            var ajax_url = jQuery('#admin-ajax-url').val();
            
            jQuery.ajax({
                type: "POST",
                url: ajax_url,
                data: formData,
                dataType: 'json',
                success: function( res ){
                    if(res.status == 1){
                        toastr.success("Request submitted");
                        setTimeout(function(){
                            location.reload();
                        },1000);
                    }else{
                        toastr.error("Error");
                    }
                }
            });
        }
    });
    
    /************ Upload Portfolio **********/
    
    jQuery('#upload_portfolio').validate({

        rules: {
            portfolio_image:{
                required: true,
            },
            protfolio_img_title: {
                required: true,
            },
            protfolio_img_desc: {
                required: true,
            },
        },
        submitHandler: function(form){
            
            var form = jQuery('#upload_portfolio')[0];
            var formData = new FormData(form);
            var ajax_url = jQuery('#admin-ajax-url').val();
            
            jQuery.ajax({
                type: "POST",
                url: ajax_url,
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function( res ){
                    if(res.status == 1){
                        toastr.success("Image Uploaded");
                        setTimeout(function(){
                            location.reload();
                        },1000);
                    }else{
                        toastr.error("Error");
                    }
                }
            });
        }
    });
    
    
    /********** Submit Vote **********/
    
    jQuery('#competition-submit').validate({

        rules: {
            radio:{
                required: true,
            },
            
        },
        submitHandler: function(form){
            
            var formData = jQuery('#competition-submit').serialize();
            var ajax_url = jQuery('#admin-ajax-url').val();
            
            jQuery.ajax({
                type: "POST",
                url: ajax_url,
                data: formData,
                success: function( res ){
                    if(res == 1){
                        toastr.success("Success");
                        setTimeout(function(){
                            location.reload();
                        },1500);
                    }else{
                        toastr.error("Error");
                    }
                }
            });
        }
    });
    
    /***** Connect with Stripe *****/

    jQuery('.stripe-connect').click(function(){
    
    var ajax_url = jQuery('#admin-ajax-url').val();
    var email = jQuery('#current_user').val();
    
    jQuery.ajax({
        type: "POST",
        url: ajax_url,
        data: {email:email, action:'connect_with_stripe'},
        dataType:'json',
        success: function( res ){
            if(res.status == 1){
                location.href=res.url;
            }else{
                toastr.error('Error connecting');
            }
        }
    });
});
    
    jQuery(".fm-cancel").click(function(){
        jQuery("#portfolio_preview").attr('src','');
        jQuery("#add_post_modal").modal('hide');
    });
    
    jQuery(".follow_p").click(function(){
        var ajax_url = jQuery('#admin-ajax-url').val();
        var userid = jQuery('#logged_in_user').val();
        var portfolio_user = jQuery('#portfolio_user').val();
    
        jQuery.ajax({
            type: "POST",
            url: ajax_url,
            data: {userid:userid, portfolio_user:portfolio_user, action:'follow_portfolio'},
            dataType:'json',
            success: function( res ){
                if(res.status == 1){
                    toastr.success('Updated');
                    setTimeout(function(){
                        location.reload();
                    },1000);
                }else{
                    toastr.error('Error connecting');
                }
            }
        });
    });
    
    
    
    jQuery(".not_login").click(function(){
       toastr.error("Please login to follow!"); 
    });
    
    setTimeout(function(){
      var video = document.querySelector('#video');
      var playBtn = document.querySelector('.play-btn');
      var volumeBtn = document.querySelector('.volume-btn');
      var volumeSlider = document.querySelector('.volume-slider');
      var volumeFill = document.querySelector('.volume-filled');
  
      lastVolume = video.volume;
      video.volume = 0;
      volumeBtn.classList.add('muted');
      volumeFill.style.width = 0;
      
      playBtn.classList.toggle('paused');
      video.play();

    },5000);
    
    setTimeout(function(){
      var video = document.querySelector('#video-id-0');
      video.play();
    },5000);
    
});


function play_video(id){
    
   jQuery('#video-id-'+id).addClass('not');
   setTimeout(function(){
      jQuery(".video-common").each(function(){
          jQuery(this).get(0).pause();
         if(jQuery(this).hasClass('not')){
            var video = document.querySelector('#video-id-'+id);
            video.play();
         }
      }); 
   });
   
}

/***** Portfolio Image Preview *****/

function readURL_portfolio(input) {
     if (input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
           jQuery("#portfolio_preview").attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
       }
}

jQuery(document).on('change','#portfolio_image',function(){
    readURL_portfolio(this);
});


/***** Image Preview ******/

jQuery("#edit_profile_image").click(function(){
   jQuery('#imgInp').click(); 
});

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#blah').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]);
  }
}

$("#imgInp").change(function() {
  readURL(this);
});



/***** Image Preview Channel******/

function readURL_channel(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
       
      $('#blah-channel').attr('src', e.target.result);
      $('.out').text(input.files[0].name);
    }
    
    reader.readAsDataURL(input.files[0]);
  }
}
$("#channel_image").change(function() {
  readURL_channel(this);
});


/************************* Video like ****************/

function video_like(post_id,user_id){

      
      var post_id = post_id; 
      var user_id = user_id; 
        var ajax_url = jQuery('#admin-ajax-url').val();
        jQuery.ajax({
            type: "POST",
            url: ajax_url,
            data: { action : 'like_dislike' , post_id : post_id , user_id : user_id},
            success: function( res ){
                /**** Get number of likes ****/
                jQuery.ajax({
                    type: "POST",
                    url: ajax_url,
                    data: { action : 'get_likes' , post_id : post_id , user_id : user_id},
                    dataType: 'json',
                    success: function( res ){
                        jQuery("#total_likes").text('('+res.count+')'+'Like');
                    }
                });
            }
        });

}

/***************** facebook like *********/

$(document).ready(function() {
//    $(".action_wrap .ac-btn").click(function () {
//      $(this).toggleClass("active");
//    });
    
    
    jQuery("#comment").addClass("form-control style_2");
    
    
    
});



/**************** Follow Channel ****************/

function channel_follow(post_id,user_id,channel_id){
           
        var ajax_url = jQuery('#admin-ajax-url').val();
        
        jQuery.ajax({
            type: "POST",
            url: ajax_url,
            data: { action : 'follow_channel' , post_id : post_id , user_id : user_id , channel_id : channel_id},
            success: function( res ){
                if(res == 1){
                    toastr.success("Following");
                    setTimeout(function(){
                        location.reload();
                    },2000);
                }else if(res == 2){
                    toastr.success("Unfollowed");
                    setTimeout(function(){
                        location.reload();
                    },2000);
                }
            }
        });

}

/**************** Un-Follow Channel ****************/

function remove_followers(user_id,channel_type,owner_id){
    var ajax_url = jQuery('#admin-ajax-url').val();

    jQuery.ajax({
        type: "POST",
        url: ajax_url,
        data: { action : 'unfollow_channel', user_id : user_id , channel_type : channel_type, owner_id : owner_id},
        success: function( res ){
            if(res == 1){
                toastr.success("Following");
                setTimeout(function(){
                    location.reload();
                },2000);
            }else if(res == 2){
                toastr.success("Unfollowed");
                setTimeout(function(){
                    location.reload();
                },2000);
            }else{
                toastr.error("Error");
            }
        }
    });
}


 if( jQuery('#video_p').length ){
  var vid = document.createElement('video');
  document.querySelector("#video_p").onchange = function(event) {
    
  let file = event.target.files[0];
  let blobURL = URL.createObjectURL(file);
  document.querySelector("#video_here").src = blobURL;
    
  vid.src = blobURL;
    
  var _CANVAS = document.querySelector("#video-canvas"),
	  _CTX = _CANVAS.getContext("2d"),
	  _VIDEO = document.querySelector("#video_here");
    
  	// Load metadata of the video to get video duration and dimensions
    _VIDEO.addEventListener('loadedmetadata', function() { console.log(_VIDEO.duration);
        var video_duration = _VIDEO.duration,
            duration_options_html = '';

        // Set options in dropdown at 4 second interval
        for(var i=0; i<Math.floor(video_duration); i=i+4) {
            duration_options_html += '<option value="' + i + '">' + i + '</option>';
        }
        document.querySelector("#set-video-seconds").innerHTML = duration_options_html;

        // Show the dropdown container
        document.querySelector("#thumbnail-container").style.display = 'block';
                                                          
        // Set canvas dimensions same as video dimensions
        _CANVAS.width = _VIDEO.videoWidth;
        _CANVAS.height = _VIDEO.videoHeight;
    });
    
    // On changing the duration dropdown, seek the video to that duration
document.querySelector("#set-video-seconds").addEventListener('change', function() {
    _VIDEO.currentTime = document.querySelector("#set-video-seconds").value;
    // Seeking might take a few milliseconds, so disable the dropdown and hide download link 
//    document.querySelector("#set-video-seconds").disabled = true;
    
});

// Seeking video to the specified duration is complete 
document.querySelector("#video_here").addEventListener('timeupdate', function() {
	// Re-enable the dropdown and show the Download link
	document.querySelector("#set-video-seconds").disabled = false;
//    document.querySelector("#get-thumbnail").style.display = 'inline';
});

// On clicking the Download button set the video in the canvas and download the base-64 encoded image data
document.querySelector("#get-thumbnail").addEventListener('click', function() {
  var c = document.getElementById("video-canvas");
  var ctx = c.getContext("2d");
  ctx.drawImage(_VIDEO, 10, 10,_VIDEO.videoWidth,_VIDEO.videoHeight);
  document.getElementById("video_actual_thumbnail").src = c.toDataURL();
    jQuery("#video_thumbnail").val(c.toDataURL());
});
    
  // wait for duration to change from NaN to the actual duration
  vid.ondurationchange = function() {
      var duration = this.duration;
	  var duration_in_sec = duration.toFixed(2);
      if(duration_in_sec > 120){
          jQuery(".video-upload").prop('disabled',true);
          toastr.error('Video more then 2 min length not allowed');
      }else{
          jQuery(".video-upload").prop('disabled',false);
      }
  };
    
}
 }

//function get_thumbnail(){
//    alert('g');
//  var c = document.getElementById("video-canvas");
//  var ctx = c.getContext("2d");
//  ctx.drawImage(_VIDEO, 10, 10,_VIDEO.videoWidth,_VIDEO.videoHeight);
//  document.getElementById("video_actual_thumbnail").src = c.toDataURL();
//}

/*** Delete Video ***/

function delete_video(vid,uid){
    if(confirm('Do you want to delete this video')) {
        var ajax_url = jQuery('#admin-ajax-url').val();
        jQuery.ajax({
            type: "POST",
            url: ajax_url,
            data: { action : 'delete_video', post_id : vid, user_id: uid},
            success: function( res ){
                if(res == 1){
                    toastr.success("Video deleted");
                    location.reload();
                }
            }
        });
    }
}
