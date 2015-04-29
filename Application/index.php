<?php
define('safeGuard', TRUE);
define('dbConnected', TRUE);
define('__ROOT__', dirname(__FILE__));
require_once(__ROOT__ . '/assets/include/connect.php');
if (isset($_POST['email']) && ($_POST['email'] != "")):
    if (!verified_login($_POST['email'], $_POST['password'])) {
        header('Location: index.php', 401);
    } else {
        header('Location: display.php', 200);
    }
else:
require_once(__ROOT__ . '/assets/include/header.php');
?>
<div>
  <img id="profile-img" class="img-circle img-responsive center-block" src="https://randomuser.me/api/portraits/lego/1.jpg" width="96"/>
  <form class="form-signin" method="post">
    <span id="reauth-email" class="reauth-email"></span>
    <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
    <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
    <div id="remember" class="checkbox">
      <label>
        <input type="checkbox" value="remember-me"> Remember me
      </label>
    </div>
    <button class="btn btn-primary btn-lg btn-block" type="submit">Sign in</button>
    <a href="register.php" class="btn btn-default btn-lg btn-block pull-right">
    Sign up
    </a>
  </form><!-- /form -->
  <a href="#" class="forgot-password">
    Forgot the password?
  </a>
</div><!-- /card-container -->
<?php
endif;
require_once "assets/include/footer.php";
?>
