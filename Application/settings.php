<?php
    global $base_url;
    define('safeGuard', TRUE);
    define('dbConnected', TRUE);
    define('__ROOT__', dirname(__FILE__));
    require_once(__ROOT__ . '/assets/classes/class.connect.php');
    
	$connection = new Connect;
    if (!isset($_SESSION['mail']) && ($_SESSION['mail'] == "")):
        header('Location: index.php', 401);
    else:
require_once(__ROOT__ . '/assets/include/header.php');
?>

    <div class="col-xs-12 col-md-8 col-md-offset-2">
        <h1 align="center"> Settings </h1>
    </div>
    
    <div class="col-xs-12 col-md-8 col-md-offset-2">
        <img id="profile-img" class="img-circle img-responsive center-block" src="https://randomuser.me/api/portraits/lego/2.jpg" width="120"/>
        <br>
        <form>
        <div class="col-xs-12 col-md-4 col-md-offset-4">
            <div class="col-xs-6 col-md-5 col-md-offset-1">
                <label>Name:</label>
            </div>
            <div class="col-xs-6 col-md-6">
                <input type="text" placeholder="Naomi Nazar">
<!--                <label class="font">Naomi Nazar</label>-->
            </div>
            <br><br>
            
            <div class="col-xs-6 col-md-5 col-md-offset-1">
                <label>Age:</label>
            </div>
            <div class="col-xs-6 col-md-6">
                <input type="number" placeholder="20">
<!--                <label class="font">20</label>-->
            </div>
            <br><br>
            
            <div class="col-xs-6 col-md-5 col-md-offset-1">
                <label>Gender:</label>
            </div>
            <div class="col-xs-6 col-md-6">
                <input type="checkbox" checked name="Female">F
                <input type="checkbox" name="male">M
<!--                <label class="font">Female</label>-->
            </div>
            <br><br>
            
            <div class="col-xs-6 col-md-5 col-md-offset-1">
                <label>Weight:</label>
            </div>
            <div class="col-xs-6 col-md-6">
                <input type="number" placeholder="60">
<!--                <label class="font">60 kg</label>-->
            </div>
            <br><br>
            
            <div class="col-xs-6  col-md-5 col-md-offset-1">
                <label>Length:</label>
            </div>
            <div class="col-xs-6 col-md-6">
                <input type="number" placeholder="164">
<!--                <label class="font">164 cm</label>-->
            </div>
            <br><br>
        </div>
        </form>
    </div>


<?php
require_once (__ROOT__ . '/assets/include/header.php');
endif;
?>