<?php
/*
Template Name: Stripe Products
*/
get_header();
global $wpdb;
$pro_ids = array();

    require_once '/home/customerdevsites/public_html/ial/wp-content/themes/IAL/stripe/init.php'; 

    $stripe = new \Stripe\StripeClient(
      'sk_test_KPpjpp9s8eWPtpqiAq7roPM200ijBnjCDn'
    );

//    $products_list = $stripe->products->all(['limit' => 100]);
//    $count = 1;
//    foreach($products_list as $products){
//        
//        $wpdb->insert("stripe_product_ids",array(
//            "product_id"=>$products->id,
//        ));
//    $count++;
//    }
//
//    echo "count =". $count;


    /*** delete products from stripe ***/
    $database_products = $wpdb->get_results("SELECT * FROM stripe_product_ids");
//print_r($database_products);
    foreach($database_products as $d_p){

        $stripe->products->delete(
          $d_p->product_id,
            []
        );
        
        echo "ok ";
    }
    
get_footer();
?>