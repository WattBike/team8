<?php
define('safeGuard', TRUE);
define('dbConnected', TRUE);
define('__ROOT__', dirname(__FILE__));
require_once(__ROOT__ . '/assets/include/connect.php');
require_once(__ROOT__ . '/assets/include/header.php');
if (isset($_POST['email']) && ($_POST['email'] != "")):
    if (!verified_login($_POST['email'], $_POST['password'])) {
        echo "Registration Failed";
    } else {
        echo "Registration Succeeded!";
    }
header('Location: /index.php');
else:
?>
<div class="well card">
  <img id="profile-img" class="img-circle img-responsive center-block" src="https://randomuser.me/api/portraits/lego/2.jpg" width="96"/>
  <form class="" method="post">
    <span id="reauth-email" class="reauth-email"></span>
    <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
    <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
    <input type="text" id="inputFirstname" name="firstname" class="form-control" placeholder="First Name">
    <input type="text" id="inputLastname" name="lastname" class="form-control" placeholder="Last Name">
    <input type="number" min="1" id="inputAge" name="age" class="form-control" placeholder="Age">
    <input type="text" id="inputGender" name="gender" class="form-control" placeholder="Gender">
    <input type="number" min="0" id="inputLength" name="length" class="form-control" placeholder="Length">
    <input type="number" min="1" id="inputWeight" name="weight" class="form-control" placeholder="Weight">
    <button class="btn btn-primary btn-lg btn-block" type="submit">Register</button>
  </form><!-- /form -->
</div><!-- /card-container -->
<?php
endif;
require_once "assets/include/footer.php";
?>
