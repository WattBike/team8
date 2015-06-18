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
        <a class="btn btn-default" href="index.php">&larr; Back</a>
        <h1 align="center"> Settings </h1>
    </div>
    
    <div class="col-xs-12 col-md-8 col-md-offset-2">
        <img id="profile-img" class="img-circle img-responsive center-block" src="https://randomuser.me/api/portraits/lego/2.jpg" width="120"/>
        <br>
        <div class="col-xs-12 col-md-6 col-md-offset-3">
            <form  method="post" class="form-horizontal">
                <div class="form-group ">
                    <label for="inputEmail" class="col-sm-3 control-label">Email</label>
                    <div class="col-sm-9">
                        <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="col-sm-3 control-label">Password</label>

                    <div class="col-sm-9">
                        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="col-sm-3 control-label">Verify password</label>

                    <div class="col-sm-9">
                        <input type="password" id="inputVerificationPassword" name="verificationPassword" class="form-control" placeholder="Password" required>

                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="col-sm-3 control-label">First name</label>

                    <div class="col-sm-9">
                        <input type="text" id="inputFirstname" name="firstname" class="form-control" placeholder="First Name">

                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="col-sm-3 control-label">Last name</label>

                    <div class="col-sm-9">
                        <input type="text" id="inputLastname" name="lastname" class="form-control" placeholder="Last Name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="col-sm-3 control-label">Age</label>

                    <div class="col-sm-9">
                        <input type="number" min="1" id="inputAge" name="age" class="form-control" placeholder="Age">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="col-sm-3 control-label">Gender</label>

                    <div class="col-sm-9">
                        <label class="radio-inline">
                            <input type="radio" name="gender" id="inlineRadio1" value="male">
                            Male </label>
                        <label class="radio-inline">
                            <input type="radio" name="gender" id="inlineRadio2" value="female">
                            Female </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="col-sm-3 control-label">Weight</label>

                    <div class="col-sm-4">
                        <div class="input-group">
                            <input type="number" min="1" id="inputWeight" name="weight" class="form-control" placeholder="Weight">
                            <div class="input-group-addon">
                                Kilogram
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="col-sm-3 control-label">Length</label>

                    <div class="col-sm-4">
                        <div class="input-group">
                            <input type="number" min="0" id="inputLength" name="length" class="form-control" placeholder="Length">
                            <div class="input-group-addon">
                                Centimeters
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-sm-12 col-md-11 col-md-offset-1">
                <button class="btn btn-primary btn-lg btn-block" type="submit">
                    Update
                </button>
                <a href="index.php" class="btn btn-default btn-lg btn-block">Back</a>
            </form><!-- /form -->
        </div>
    </div>


<?php
require_once (__ROOT__ . '/assets/include/header.php');
endif;
?>