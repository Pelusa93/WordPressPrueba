<?php


if (!defined('WP_UNISTALL_PLUGIN    ')){

    exit();
}
    global  $wpdb;
    $wpdb->query("DROP TABLE IF EXIST {$wpdb->prefix} mitabla");
    
    
    

?>