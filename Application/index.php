<?php
define('safeGuard', TRUE);
?>
<?php require_once "assets/include/connect.php"; ?>
<?php include "assets/include/header.php"; ?>
        <div class="well card">
            <img id="profile-img" class="img-circle img-responsive center-block" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" width="96"/>
            <form class="form-signin">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
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
<?php include "assets/include/footer.php"; ?>