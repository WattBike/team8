<?php
global $base_url;
define('safeGuard', TRUE);
define('dbConnected', TRUE);
define('__ROOT__', dirname(__FILE__));
require_once(__ROOT__ . '/assets/include/connect.php');
require_once(__ROOT__ . '/assets/include/config.php');
require_once(__ROOT__ . '/assets/include/header.php');
if (!isset($_SESSION['mail']) && ($_SESSION['mail'] == "")):
    header('Location: $base_url/index.php', 401);
else:
?>
<div class="container">
    <h1>Welcome to wattbike <small><?php echo $_SESSION['first_name'];?></small></h1>
    <a class="btn btn-success" href="session.php">Start new training session</a>
    <br>
    <a class="btn btn-warning" href="index.php">Logout</a>
</div><!-- /card-container -->
<?php
endif;
require_once "assets/include/footer.php";
?>
