<?php
define('safeGuard', TRUE);
?>
<?php require_once "assets/include/connect.php"; ?>
<?php require_once "assets/include/header.php"; ?>
<?php if(!dbConnected):?>
    <div class="alert">
        No connection to the database available.
        <?php echo mysqli_connect_error();
        echo $mysqli->error;?>
    </div>
<?php else:
    if(isset($_POST['email'])&&($_POST['email']!="")){
        $mail = $mysqli->real_escape_string($_POST['email']);
        $pass = $mysqli->real_escape_string($_POST['password']);;
        echo hash_pass($mail, $pass);
    }
    endif;?>
        <div class="well card">
            <img id="profile-img" class="img-circle img-responsive center-block" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" width="96"/>
            <form class="form-signin" method="post">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
                <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
                <div id="remember" class="checkbox">
                    <label>
                        <input type="checkbox" value="remember-me"> Remember me
                    </label>
                </div>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Sign in</button>
            </form><!-- /form -->
            <a href="#" class="forgot-password">
                Forgot the password?
            </a>
        </div><!-- /card-container -->
<?php require_once "assets/include/footer.php"; ?>