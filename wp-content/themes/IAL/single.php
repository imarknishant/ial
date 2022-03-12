<?php
get_header();
?>
 <main id="Main" class="sigle-video-wrap open">
       <section class="single-video-wrap">
        <h6><?php the_title(); ?></h6>
        <div class="channel_comments">
             <div class="channel_comments_form">
                 <p>Please login to leave comment</p>
    

                 <?php echo comments_template(); ?>
            </div>
        </div>
     </section>
</main>

<?php
get_footer();
?>