<?php
get_header();
$category = get_queried_object();
$catID = $category->term_id;
$cat_name = $category->name;
$catSlug = $catID = $category->slug;
?>

	<main id="Main">		
	    <section class="category_block">
            <div class="title">
             <h6><?php echo $cat_name; ?></h6>
            </div>
            <div class="ads__wrap double_ads">
                <img src="<?php the_field('adds_one','option'); ?>" alt="ads-1.jpg" />
                <img src="<?php the_field('adds_two','option'); ?>" alt="ads-2.jpg" />
             </div>
			<div class="video_block_list">
		<?php
		    $args = array(
		        'post_type' => 'videos',
				'post_status' => 'publish',
				'tax_query' => array(
						array(
							'taxonomy' => 'video-category',
							'field'    => 'slug',
							'terms'    => $catSlug,
						),
                    ),		
		        );
			$loop = new Wp_query($args);
			if($loop->have_posts()){
			while($loop->have_posts()): $loop->the_post();
			global $product;
                
            $thumbnail_image = get_field('video_thumbnail_image',$item_v->post);
  
		?>            
               <div class="video_block zoom_effect">
                   <figure>
                      <p class="figure_title"><?php echo get_the_title($post->ID); ?></p>
                       <img src="<?php echo $thumbnail_image; ?>" alt="category-img-1.jpg" loading="lazy"/>
                        <a href="<?php echo get_the_permalink($post->ID); ?>" class="material-icons">play_circle_filled</a>
                    </figure>
                  
                  <div class="video_content">
                     <h6><a href="<?php echo get_the_permalink(get_the_ID()); ?>"><?php the_title(); ?></a></h6>
                     <p class="sub_title">109 Views  | <?php echo get_the_date( 'j F, Y' ); ?></p>
                  </div>
               </div>
				
			<?php
				endwhile;
				wp_reset_query();
				}else{
					
				echo '<h2>Ooops ! No matched found :( </h2>';
					
				}
			?>

			</div>
		</section>		
	</main>

<?php
get_footer();
?>

<script>
//var vid = document.createElement('video');
//document.querySelector("#video_p").onchange = function(event) {
//    
//  let file = event.target.files[0];
//  let blobURL = URL.createObjectURL(file);
//  document.querySelector("#video_here").src = blobURL;
//    
//  vid.src = blobURL;
//    
//  var _CANVAS = document.querySelector("#video-canvas"),
//	  _CTX = _CANVAS.getContext("2d"),
//	  _VIDEO = document.querySelector("#video_here");
//    
//  	// Load metadata of the video to get video duration and dimensions
//    _VIDEO.addEventListener('loadedmetadata', function() { console.log(_VIDEO.duration);
//        var video_duration = _VIDEO.duration,
//            duration_options_html = '';
//
//        // Set options in dropdown at 4 second interval
//        for(var i=0; i<Math.floor(video_duration); i=i+4) {
//            duration_options_html += '<option value="' + i + '">' + i + '</option>';
//        }
//        document.querySelector("#set-video-seconds").innerHTML = duration_options_html;
//
//        // Show the dropdown container
//        document.querySelector("#thumbnail-container").style.display = 'block';
//
//        // Set canvas dimensions same as video dimensions
//        _CANVAS.width = _VIDEO.videoWidth;
//        _CANVAS.height = _VIDEO.videoHeight;
//    });
//    
//    // On changing the duration dropdown, seek the video to that duration
//document.querySelector("#set-video-seconds").addEventListener('change', function() {
//    _VIDEO.currentTime = document.querySelector("#set-video-seconds").value;
//    
//    // Seeking might take a few milliseconds, so disable the dropdown and hide download link 
//    document.querySelector("#set-video-seconds").disabled = true;
//    document.querySelector("#get-thumbnail").style.display = 'none';
//    _CTX.drawImage(_VIDEO, 0, 0, _VIDEO.videoWidth, _VIDEO.videoHeight);
//    jQuery("#video_thumbnail").val(_CANVAS.toDataURL());
//});
//
//// Seeking video to the specified duration is complete 
//document.querySelector("#video_here").addEventListener('timeupdate', function() {
//	// Re-enable the dropdown and show the Download link
//	document.querySelector("#set-video-seconds").disabled = false;
//    document.querySelector("#get-thumbnail").style.display = 'inline';
//});
//
//// On clicking the Download button set the video in the canvas and download the base-64 encoded image data
//document.querySelector("#get-thumbnail").addEventListener('click', function() {
//    _CTX.drawImage(_VIDEO, 0, 0, _VIDEO.videoWidth, _VIDEO.videoHeight);
//
//	document.querySelector("#get-thumbnail").setAttribute('href', _CANVAS.toDataURL());
//	document.querySelector("#get-thumbnail").setAttribute('download', 'thumbnail.png');
//});
//    
//  // wait for duration to change from NaN to the actual duration
//  vid.ondurationchange = function() {
//      var duration = this.duration;
//	  var duration_in_sec = duration.toFixed(2);
//      if(duration_in_sec > 120){
//          jQuery(".video-upload").prop('disabled',true);
//          toastr.error('Video more then 2 min length not allowed');
//      }else{
//          jQuery(".video-upload").prop('disabled',false);
//      }
//  };
//    
//}
</script>