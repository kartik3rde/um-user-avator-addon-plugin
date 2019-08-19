<?php
/*
 * Plugin Name: um user avatar
 * Description: ultimate member addon plugin for show default user avatar by name .
 * Version: 1.0.0
 * Author: Dheeraj Tiwari
 */

// Do not access file directly!
if ( ! defined( 'ABSPATH' ) ) {
	die;
}
define('WP_DEBUG', true);
define( 'ABOI_BASE_DIR', plugin_dir_path( __FILE__ ) );
define( 'ABOI_BASE_URL', plugin_dir_url(__FILE__) );



// calling function for chack url and change url 
add_filter( 'um_user_avatar_url_filter', 'my_user_avatar_url', 10, 2 );
function my_user_avatar_url( $avatar_uri , $userId ) {
  $arrayUrl=explode("/",$avatar_uri);
  $size=sizeof($arrayUrl)-1;
  $fileName=$arrayUrl[$size];

   if("default_avatar.jpg" == $fileName || "default_avatar.jpg?" == $fileName){
   	  $user_info = get_userdata($userId);
      $avatar_uri=getColorString($user_info,$avatar_uri);
      
   }
return $avatar_uri ;
}

// custom funcion for get first and last name with email string
function getColorString($user_info,$avatar_uri){
      $nameArray=explode(" ",$user_info->display_name);
      $email=$user_info->user_email;
      if(sizeof($nameArray)>1){
      	   $avatar_uri="https://ui-avatars.com/api/?name=".$nameArray[0]."+".$nameArray[1].getFirstLettarColor($nameArray[0])."&rounded=true";
      }else{
         $firstLatter= substr($email,0,1);
         $emailArray = explode("@",$email);
         $secondLatter = $emailArray[1];
         $avatar_uri="https://ui-avatars.com/api/?name=".$firstLatter."+".$secondLatter.getFirstLettarColor($firstLatter)."&rounded=true";
      }
      return  $avatar_uri;
}


// custom code for get color by first latter.
function getFirstLettarColor($str){
        
		$firstString=array('A','C','E','G','I','a','c','e','g','i');
		$secondString=array( 'B','D','F','H','b','d','f','h');
		if(in_array(substr($str,0,1), $firstString)){
           $colorCode="&background=FFCFBF&color=D90000";
		}
		else{
           if(in_array(substr($str,0,1), $secondString)){
              $colorCode="&background=BFDFFF&color=1753FF";
           }else{
              $colorCode="&background=CFFFBF&color=2DB200";
           }
		}
		return $colorCode;
}


