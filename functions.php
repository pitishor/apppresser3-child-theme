<?php

// Enqueue Ion parent theme CSS file

add_action( 'wp_enqueue_scripts', 'ap3_ion_enqueue_styles' );
function ap3_ion_enqueue_styles() {

	// parent theme css
	$version = '0.1';
    wp_enqueue_style( 'ap3-ion-style', get_template_directory_uri().'/style.css', null, $version );
    
    // child theme css
    wp_enqueue_style( 'ap3-child-style', get_stylesheet_uri(), null, $version );
}



 $curPage =substr($_SERVER['REQUEST_URI'] ,0, 15 ) ;
 $appRequest =  htmlspecialchars($_GET["page"]) ?htmlspecialchars($_GET["page"]) :0 ;
 $curUser = wp_get_current_user() instanceof WP_User  ?wp_get_current_user()->user_login : 0 ;



	if ($curPage  == "/appredirector?" &&  $curUser && $appRequest) {
	  switch ($appRequest){

		case "profile":
		case "groups":
		case "messages":
		case "settings":
		case "following":
		case "followers":
		case "media":
			header("Location:".site_url("/members/$curUser/$appRequest/"));
			 die() ;
		break;

		case "activity":
			 header("Location:".site_url('/members/' . $curUser));
			 die() ;
		break;		  
		
		case "home":
			header("Location:".site_url('/all-activity-stream/'));
			 die() ;
		break;		  

		case "login":
			header("Location:".	  wp_logout_url( home_url() ));

					  
		echo	"
		<script>
			newwindow=window.open('".wp_logout_url( home_url() )."');
		</script>

			";
		
		
		break;		  
	  }

	 
	}elseif ($appRequest!='login'){
	  		
			header("Location:".site_url('/please-login'));
			 die() ;
	}



add_action('wp_head', 'enqueIONjs_function');

function enqueIONjs_function(){
  if (substr($_SERVER['REQUEST_URI'] ,0, 14 ) =='/please-login'){
	  $JS = echoIONjs();
  	  echo $JS;
  }
}


 function echoIONjs(){
	$JS= "
		<script>
		jQuery(document).on('click', function(event){
			window.location.replace('".site_url('/appredirector?page=home')."');
		});
		</script>

			";
   return $JS;
  }

add_filter('get_avatar_url','bp_avatar_function' , 10);


function bp_avatar_function(){

	return 'https://www.woowclover.com/wp-content/uploads/avatars/1/58aa18c1068c6-bpthumb.jpg';


}



