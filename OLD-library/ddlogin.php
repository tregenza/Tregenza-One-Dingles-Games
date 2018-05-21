<h3>Login</h3>
<form action="<?php echo get_option('home'); ?>/wp-login.php" method="post">

    <p><label for="log">User</label><input type="text" name="log" id="log" value="<?php echo wp_specialchars(stripslashes($user_login), 1) ?>" size="20" /> </p>

    <p><label for="pwd">Password</label><input type="password" name="pwd" id="pwd" size="20" /></p>

    <p><input type="submit" name="submit" value="Send" class="button" /></p>

    <p>
       <label for="rememberme"><input name="rememberme" id="rememberme" type="checkbox" checked="checked" value="forever" /> Remember me</label>
       <input type="hidden" name="redirect_to" value="/" />
       <?php echo $_SERVER['REQUEST_URI']; ?>
    </p>
</form>
&s
<a href="<?php echo get_option('home'); ?>/wp-register.php">Register</a>
<a href="<?php echo get_option('home'); ?>/wp-login.php?action=lostpassword">Recover password</a>