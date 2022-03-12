<?php
include('../../../../wp-config.php');

global $wpdb;

$currentDate = date('Y-m-d');
$args = array(
    'role'    => 'subscriber',
    'orderby' => 'user_nicename',
    'order'   => 'ASC'
);
$users = get_users( $args );

foreach($users as $user){
    $user_id = $user->data->ID;
    
    $subs_data = $wpdb->get_results("SELECT * FROM subscriptions WHERE user_id = $user_id");

    if(!empty($subs_data)){
        
        $video_end_date = date('Y-m-d',strtotime($subs_data[0]->subscription_start.' + 7 days'));
        
        $wpdb->query("UPDATE check_video_upload_date SET end_date = $video_end_date WHERE user_id = $user_id");
        
    }
    
}

?>