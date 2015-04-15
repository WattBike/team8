<?php
define('safeGuard', TRUE);
define('dbConnected', TRUE);
define('__ROOT__', dirname(__FILE__));
require_once(__ROOT__ . '/assets/include/connect.php');
require_once(__ROOT__ . '/assets/include/header.php');
if (!isset($_SESSION['mail']) && ($_SESSION['mail'] == "")):
    header('Location: /team8/Application/index.php', 401);
else:
?>
<div class="container">
    <h1>Welcome to wattbike <small><?php echo $_SESSION['first_name'];?></small></h1>
    <a href="index.php">Logout</a>
</div><!-- /card-container -->
<?php
endif;
require_once "assets/include/footer.php";
?>
