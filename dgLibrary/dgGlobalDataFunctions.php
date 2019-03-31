<?php
/*

	dgGlobalDataFunctions  -			Site wide data handling functions. Autoloaded
	by functions.php

*/





/*  
				Most DG forms post back to the same page. This function works out the URL
*/
function getDgFormPostURL() {
	global $wp;

	$current_url = home_url(add_query_arg(array(),$wp->request));

	return $current_url;
}




/* 

IS THIS STILL NEEDED  ???? 


--------- Cookies for tools ----------- 
*/
function tools_cookie() {
	$url = home_url(add_query_arg(array()));
	$id = url_to_postid($url);
	switch ($id) {
		/* There must be a better thing to check than page ids */
		case 47:
		case 136:
		case 183:
		case 199:
		case 203: 
		case 209:
		case 213:
		case 224:
		case 260:
		case 1947:
		case 2013:
			if (isSet($_COOKIE['dd_user_id'])){
			    $user_id = $_COOKIE['dd_user_id'];
		    	setcookie('dd_user_id','');
		    	setcookie('dd_user_id',$user_id, time() + (60*60*24*365), COOKIEPATH, COOKIE_DOMAIN);
			} else {
			    $user_id = "dd" . time();
			    setcookie('dd_user_id',$user_id, time() + (60*60*24*365), COOKIEPATH, COOKIE_DOMAIN);
			    $count_new_x = 1;
			}
			if ($user_id == ""){
				$user_id = "dd" . time();
			    setcookie('dd_user_id',$user_id, time() + (60*60*24*365), COOKIEPATH, COOKIE_DOMAIN);
			    $count_new_x = 1;
			}
		
			/* Special code for login page - Not sure why */
			if (is_page(183)){
				$cookie_error = $_POST['cookie_error'];
			//    echo "here:" . $cookie_error ;
				if (isSet($_COOKIE['dd_user_id'])){
			//    echo "cookie" . $cookie_error;
			    }	else	{
			//    echo "error2:" . $cookie_error;
					if ($cookie_error <> "Y"){
			        	$cookie_error = "Y";
						?>
						<SCRIPT>
						alert ("Error in writing cookies. Please make sure cookies are enabled on your web browser, If you are using Internet Explorer go to internet options (top right cog), select the privacy tab, select sites and enter http:/www.dinglesgames.com/ and click allow. Then refresh screens by pressing F5");
						
						</SCRIPT>
						
						<?php
					}
	    		}
	  		}
		} /* End Switch */
}

