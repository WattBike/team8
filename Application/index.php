<?php
global $base_url;
define('safeGuard', TRUE);
define('dbConnected', TRUE);
define('__ROOT__', dirname(__FILE__));
require_once(__ROOT__ . '/assets/include/connect.php');
require_once(__ROOT__ . '/assets/include/config.php');
if (isset($_POST['email']) && ($_POST['email'] != "")):
    if (!verified_login($_POST['email'], $_POST['password'])) {
        header("Location: $base_url/index.php", 401);
    } else {
        header("Location: $base_url/display.php", 200);
    }
else:
require_once(__ROOT__ . '/assets/include/header.php');
?>
<div class="col-md-12 well">
  <form class="form-signin" method="post">
    <img class="img-circle img-responsive center-block form-group" src="https://randomuser.me/api/portraits/lego/1.jpg" width="96"/>
    <div class="form-group">
      <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
    </div>
    <div class="form-group">
      <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
    </div>
    <div class="form-group checkbox">
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
