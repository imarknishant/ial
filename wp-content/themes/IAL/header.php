<?php
global $post;
?>
<!doctype html>
<html>
   <head>
      <meta charset="utf-8">
      <title>I Appreciate Life | Welcome</title>
      <meta name="viewport"
         content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <!-- Favicon -->
      <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png" sizes="32x32" type="image/x-icon">
      <!-- CSS -->

	  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/dev-ial.css">
      <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/custom-style.css">
       
      <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/main.css">
      <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/ial.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
       
      <link rel='dns-prefetch' href='//fonts.googleapis.com' />
      <link href='https://fonts.gstatic.com' crossorigin rel='preconnect' />
       
    <link href="<?php echo get_template_directory_uri(); ?>/lity/dist/lity.css" rel="stylesheet">
       
       
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://js.stripe.com/v2/"></script>
       
      <?php wp_head(); ?>
   </head>
   <body <?php echo body_class(); ?>  >
       <input type="hidden" id="admin-ajax-url" value="<?php echo admin_url('admin-ajax.php'); ?>">
      <!-- loader -->
      <div class="loades">
         <div class="box">
            <div class="loader-16"></div>
          </div>
      </div>

      <!-- custom sursor -->
      <div id="cursor">
         <div class="cursor__circle"></div>
      </div>
      <!-- custom sursor -->

      <aside id="MenuSidebar"> 
         <nav class="cmScroll">
            <ul class="primary_menu">
               <li>
                  <a href="<?php echo get_site_url(); ?>" class="<?php if($post->ID == 8) echo 'active'; ?>" >
                     <figure><i class="material-icons">home</i></figure>
                     Home
                  </a>
               </li>
               <li>
                  <a href="<?php echo get_the_permalink(34); ?>" class="<?php if($post->ID == 34) echo 'active'; ?>" >
                     <figure><i class="material-icons">whatshot</i></figure>
                     Trending
                  </a>
               </li>
               <li>
                  <a href="<?php echo get_the_permalink(24); ?>" class="<?php if($post->ID == 24) echo 'active'; ?>"  >
                     <figure><i class="material-icons">favorite</i></figure>
                     Most Liked
                  </a>
               </li>
                <li>
                  <a href="<?php echo get_the_permalink(268); ?>" class="<?php if($post->ID == 268) echo 'active'; ?>">
                     <figure><i class="material-icons">favorite</i></figure>
                     Portfolios
                  </a>
               </li>
            </ul>
            <div id="aside_menu">
                <?php if(is_user_logged_in()){ ?> 
                   <div class="card">
                      <div class="card-header">
                         <h6 class="mb-0" data-toggle="collapse" data-target="#collapse1">
                            Account
                         </h6>
                      </div>
                      <div id="collapse1" class="collapse show" data-parent="#aside_menu">
                         <div class="card-body">                      
                            <ul>
                               <li><a href="<?php echo get_the_permalink(22); ?>">Create Channel</a></li>
                            </ul>                          
                         </div>
                      </div>
                   </div>
                 <?php } ?>
               <div class="card">
                  <div class="card-header">
                     <h6 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapse2">
                        <a href="<?php echo get_the_permalink(18); ?>">competitions</a>
                     </h6>
                  </div>
               </div>
               <div class="card">
                  <div class="card-header">
                     <h6 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapse3">
                        Categories
                     </h6>
                  </div>
                  <div id="collapse3" class="collapse show" data-parent="#aside_menu">
                     <div class="card-body">
					<?php
					$args = array('hide_empty' => false);
					$taxonomy = 'video-category';
					$terms = get_terms($taxonomy,$args);
                    $currentTerm = get_queried_object(); 
                         
                    //print_r($currentTerm);
                         
					if ( $terms && !is_wp_error( $terms ) ) :
					?>
						<ul>
							<?php foreach ( $terms as $term ) { ?>
								<li><a href="<?php echo get_term_link($term->slug, $taxonomy); ?>" class="<?php if($term->term_id == $currentTerm->term_id) echo 'active'; ?>" ><?php echo $term->name; ?></a></li>
							<?php } ?>
						</ul>
					<?php endif;?>
                     </div>
                  </div>
               </div>
               <div class="card">
                  <div class="card-header">
                     <h6 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapse4">
                        Quick Links
                     </h6>
                  </div>
                  <div id="collapse4" class="collapse show" data-parent="#aside_menu">
                     <div class="card-body">
                        <?php $args = array(
						  'menu' => 'Footer menu',
											
						); 
						wp_nav_menu($args);
											
						?>
                     </div>
                  </div>
               </div>
            </div>
         </nav>
         <footer id="Footer">
            <p>Copyright © <?php echo date('Y'); ?> IAL</p>
         </footer>
      </aside>

      <header id="Header">
         <div class="elem-start">
            <button type="button" class="toggleBtn"><i class="material-icons">menu</i></button>
            <div class="logo">
               <a href="<?php echo home_url(); ?>"><img src="<?php echo the_field('header_logo','option'); ?>" alt="I Appriciate Life"></a>
            </div>
            <div class="search-bar">		   
               <form id="mobile-hide" role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
                  <input type="search" class="search-field form-control"
                  placeholder="Search"
                  value="<?php echo get_search_query() ?>" name="s"
                  title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" required />
                  <button type="submit" class="search-btn search-submit"><i class="material-icons">search</i></button>
               </form>
               <div id="mobile-show">
                  <button type="submit" class="btn"><i class="material-icons">search</i></button>
                  <form  role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
                     <div class="search-form-main">
                     <input type="search" class="search-field form-control"
                     placeholder="Search"
                     value="<?php echo get_search_query() ?>" name="s"
                     title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" required />
                     <button type="submit" class="search-btn search-submit"><i class="material-icons">search</i></button>
                     </div>
                  </form>
               </div>
               <div id="user-show" class="dropdown">
                    
                  <a class="btn dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="material-icons">people_alt</i></a>
                  <div class="btn-group dropdown-menu" aria-labelledby="dropdownMenuLink">

                        <?php if(is_user_logged_in()){ ?>
                        <a href="https://www.instagram.com/Real_ial "><i class="fa fa-instagram" aria-hidden="true"></i></a>
                        <a href="https://www.twitter.com/Real_ial "><i class="fa fa-twitter" aria-hidden="true"></i></a>
                        <a href="<?php echo get_the_permalink(36); ?>" class="btn btn-sm btn-secondary">Profile</a>
                        <a href="<?php echo wp_logout_url( home_url() ); ?>" class="btn btn-sm btn-secondary">Logout</a>
                        <?php }else{ ?>    
                        <a href="<?php echo get_the_permalink(12); ?>" class="btn btn-sm btn-secondary">Join Now</a>
                        <a href="<?php echo get_the_permalink(10); ?>" class="btn btn-sm btn-default">Login</a>
                        <?php } ?>
                     </div>
               </div>
            </div>
         </div>
         <div id="user-hide" class="elem-end">
            <div class="btn-group">
                <div class="header-social-icons">
                    <a href="https://www.instagram.com/Real_ial"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                    <a href="https://www.twitter.com/Real_ial"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                </div>

                <?php if(is_user_logged_in()){ ?>
                <a href="<?php echo get_the_permalink(36); ?>" class="btn btn-sm btn-secondary">Profile</a>
                <a href="<?php echo wp_logout_url( home_url() ); ?>" class="btn btn-sm btn-secondary">Logout</a>
                <?php }else{ ?>              
                <a href="<?php echo get_the_permalink(12); ?>" class="btn btn-sm btn-secondary">Join Now</a>
                <a href="<?php echo get_the_permalink(10); ?>" class="btn btn-sm btn-default">Login</a>
                <?php } ?>
            </div>
         </div>
      </header>