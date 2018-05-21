<?PHP
/*
*
*		Logon Screen
*/
?>


	<h1>Logon to Dingles Games</h1>

	<div id="monsterGenerator" >

<?php
	if ($msg != ""){
	  echo "<div class=\"error\">$msg</div>" ;
	}
	if ($gg_error != ""){
          echo '<label><H4> <font color=#DA3030>'  . $gg_error . '</font></H4></label>';
//	  echo "<div class=\"error\">$gg_error</div>" ;
	}
?>
	<FORM METHOD="post" ACTION="<?php echo $baseDomain.$urlPATH; ?>">
	<div>
              <h3>Login as a Current User</h3>
	      <label for="user_name_wp" >Login<INPUT TYPE="text" NAME="user_name_wp" size="20" VALUE="<? echo $user_name_wp ?>"/></label>
              <label for="password_wp">Password<INPUT TYPE="password" NAME="password_wp" size="20" VALUE="<? echo $password_wp ?>"/></label>
              <label for="rememberme"><input name="rememberme" id="rememberme" type="checkbox" checked="checked" value="forever" /> Remember me</label>
              <a href="<?php echo get_option('home'); ?>/wp-login.php?action=lostpassword">Recover password</a>
         </div>
         <div>
            <INPUT class="button" id="Logon" TYPE="submit" VALUE="Login" tabindex=8 />
         </div>
         <div>
              <BR></BR>
              <h3> or Register a New User</h3>
                <label for="n_user_name_wp">Login <INPUT TYPE="text" NAME="n_user_name_wp" size="20" VALUE="<? echo $n_user_name_wp ?>"/></label>
                <label for="n_password_wp">Password <INPUT TYPE="password" NAME="n_password_wp" size="20" VALUE="<? echo $n_password_wp ?>"/></label>
                <label for="n_password_wp_2"> Re-enter Password <INPUT TYPE="password" NAME="n_password_wp_2" size="20" VALUE="<? echo $n_password_wp_2 ?>"/></label>
                <label for="n_user_email">E-mail Address <INPUT TYPE="text" NAME="n_user_email" size="40" VALUE="<? echo $n_user_email ?>"/></label>
                <label for="rememberme"><input name="n_rememberme" id="rememberme" type="checkbox" checked="checked" value="forever" /> Remember me</label>
         </div>



        <div>
		<INPUT class="button" id="Logon" TYPE="submit" VALUE="Register" tabindex=8 />
		<?
		     echo  '<input type="hidden" name="gg_reg" value="' . $gg_reg . '" />';
		     echo  '<input type="hidden" name="gg_key" value="' . $gg_key . '" />';
                ?>
                <INPUT TYPE="hidden" NAME="cookie_error", VALUE="<?echo $cookie_error?>"/>

	</div>
	</FORM>
      </div>
<?
//require($workingPath."/ddgoogle.php");

include ($workingPath."/paypal7.php");

?>


