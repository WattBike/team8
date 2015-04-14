<?php
define('safeGuard', TRUE);
define('dbConnected', TRUE);
define('__ROOT__', dirname(__FILE__));
require_once(__ROOT__ . '/assets/include/connect.php');
require_once(__ROOT__ . '/assets/include/header.php');
if (!isset($_SESSION['mail']) && ($_SESSION['mail'] == "")):
    header('Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]/index.php', 401);
else:
?>
<div class="container">
    <h1>Welcome to wattbike</h1>
</div><!-- /card-container -->
<?php
endif;
require_once "assets/include/footer.php";
?>
