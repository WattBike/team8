<?php
    global $base_url;
    define('safeGuard', TRUE);
    define('dbConnected', TRUE);
    define('__ROOT__', dirname(__FILE__));
    require_once(__ROOT__ . '/include/connect.php');
    require_once(__ROOT__ . '/include/config.php');
    require_once(__ROOT__ . '/include/header.php');
//    if (!isset($_SESSION['mail']) && ($_SESSION['mail'] == "")):
//        header('Location: $base_url/index.php', 401);
//    else:
?>
<div class="col-xs-12 col-md-8 col-md-offset-2">
    <h1 align="center"> Welcome </h1>
</div>
<div class="col-xs-12 col-md-6 col-md-offset-3">
<!--    <div id="btn-spacing" class="row">-->
        <div id="nBgr" class="col-md-12"> 
            <center><a href="results.html"><img src="images/grBtn.jpg" width="90%"></a></center>
        </div>
        <div id="nBgr" class="col-md-12"> 
            <a href="#" class="btn btn-primary btn-lg btn-block" role="button">Start</a>
            <a href="#" class="btn btn-primary btn-lg btn-block" role="button">Results</a>
            <a href="#" class="btn btn-primary btn-lg btn-block" role="button">Profile</a>
            <a href="index.php" class="btn btn-primary btn-lg btn-block" role="button">Log out</a>
        </div>

        <div id="nBgr" class="col-md-2"> 
            
        </div>
<!--    </div>-->

<!--

        <h1>Welcome to wattbike <small><?php echo "Test"; ?></small></h1>
        <a class="btn btn-success" href="session.php">Open last training session</a>
        <br>
        <a class="btn btn-default" href="new.php">Start new training</a>
        <a class="btn btn-warning" href="index.php">Logout</a>
-->
</div><!-- /card-container -->
<?php
//endif;
require_once "include/footer.php";
?>
