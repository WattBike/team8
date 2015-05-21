<?php
if (!defined('safeGuard')) {
	die('Direct access not permitted');
}
?>
<div class="container">
    <h1>Welcome to wattbike <small><?php echo $_SESSION['first_name']; ?></small></h1>
    <a class="btn btn-success" href="session.php?<?php echo htmlspecialchars(SID); ?>">Open last training session</a>
    <a class="btn btn-default" href="new.php?<?php echo htmlspecialchars(SID); ?>">Start new training</a>
</div><!-- /card-container -->

