<?php
/**
 * Plugin Name: Record Video
 * Plugin URI: https://www.siyabonga-majola.co.za
 * Description: Display Video content using [webrtc-video] shortcode to insert in a page or post
 * Version: 0.1
 * Text Domain: Record Video
 * Author: Siyabonga Majola
 * Author URI: https://www.siyabonga-majola.co.za
 */

function webrtc_enqueue_script()
{   

    wp_enqueue_style( 'videojs-style', 'https://cdnjs.cloudflare.com/ajax/libs/video.js/7.5.5/video-js.min.css' );

    wp_enqueue_style( 'videojs-record-style', 'https://cdnjs.cloudflare.com/ajax/libs/videojs-record/3.8.0/css/videojs.record.min.css' );

    wp_enqueue_style( 'fonts-style', plugins_url('fonts/fonts.css', __FILE__ ), array(), '1.0.0', true );

    wp_enqueue_script( 'webrtc_script', 'https://cdn.WebRTC-Experiment.com/RecordRTC.js', array(), '1.0.0', false );

    wp_enqueue_script( 'videojs_script', 'https://cdnjs.cloudflare.com/ajax/libs/video.js/7.5.5/video.min.js', array(), '1.0.0', false );

    wp_enqueue_script( 'adapter_script', 'https://webrtc.github.io/adapter/adapter-latest.js', array(), '1.0.0', false );

    wp_enqueue_script( 'webrtc-adapter_script', 'https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/6.1.1/adapter.min.js', array(), '1.0.0', false );

    wp_enqueue_script( 'videojs-record_script', 'https://cdnjs.cloudflare.com/ajax/libs/videojs-record/3.8.0/videojs.record.js', array(), '1.0.0', false );

    wp_enqueue_script( 'my_custom_script', plugins_url('js/main.js', __FILE__ ), array(), '1.0.0', true );
}
add_action('wp_enqueue_scripts', 'webrtc_enqueue_script');

function webrtc_wordpress_plugin($atts) {
	$Content = "<style>\r\n";
	$Content .= "#myVideo {\r\n";
	$Content .= " background-color: #F02D38;\r\n";
	$Content .= "}\r\n";
	$Content .= "</style>\r\n";
    $Content .= '<video id="myVideo" class="video-js vjs-default-skin"></video>';
	 
    return $Content;
}

add_shortcode('webrtc-video', 'webrtc_wordpress_plugin');

