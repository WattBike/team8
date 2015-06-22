<?php
    global $base_url;
    define('safeGuard', TRUE);
    define('dbConnected', TRUE);
    define('__ROOT__', dirname(__FILE__));
    require_once(__ROOT__ . '/assets/classes/class.connect.php');
	$connection = new Connect;

    if(isset($_POST['firstname'])):
        $update = $connection->update_user(
            $_POST['firstname'],
            $_POST['lastname'],
            $_POST['age'],
            $_POST['gender'],
            $_POST['length'],
            $_POST['weight'],
            $_POST['password'],
            $_POST['passwordNew'],
            $_POST['verificationPassword']
        );
        if (!$update) {
            $connection->redirect("settings.php", 401);
        } else {
            $_SESSION['status'] .= "Update Succeeded!";
            $connection->redirect("index.php", 302);
        }
    else:
        require_once(__ROOT__ . '/assets/include/header.php');
        $user= $connection -> user();
?>

    <div class="col-xs-12 col-md-8 col-md-offset-2">
        <a class="btn btn-default" href="index.php">&larr; Back</a>
        <?php if(isset($_SESSION['status'])):?>
            <div class="alert alert-danger">
                <?php echo $_SESSION['status'];?>
            </div>
        <?php unset($_SESSION['status']); endif;?>
        <h1 align="center"> Settings </h1>
    </div>
    
    <div class="col-xs-12 col-md-8 col-md-offset-2">
        <img id="profile-img" class="img-circle img-responsive center-block" src="https://randomuser.me/api/portraits/lego/2.jpg" width="120"/>
        <br>
        <div class="col-xs-12 col-md-6 col-md-offset-3">
            <form method="post" class="form-horizontal">
                <div class="form-group">
                    <label for="inputEmail" class="col-md-3 control-label">First name</label>

                    <div class="col-md-8">
                        <input  value="<?php echo $user['firstname'];?>" type="text" id="inputFirstname" name="firstname" class="form-control" placeholder="First Name">

                    </div>
                </div>
</br>
                <div class="form-group">
                    <label for="inputEmail" class="col-sm-3 control-label">Last name</label>

                    <div class="col-sm-8">
                        <input value="<?php echo $user['lastname'];?>" type="text" id="inputLastname" name="lastname" class="form-control" placeholder="Last Name">
                    </div>
                </div>
</br>
                <div class="form-group">
                    <label for="inputEmail" class="col-sm-3 control-label">Age</label>

                    <div class="col-sm-8">
                        <input value="<?php echo $user['age'];?>" type="number" min="1" id="inputAge" name="age" class="form-control" placeholder="Age">
                    </div>
                </div>
</br>
                <div class="form-group">
                    <label for="inputEmail" class="col-sm-3 control-label">Gender</label>

                    <div class="col-sm-8">
                        <label class="radio-inline">
                            <input type="radio" name="gender" id="inlineRadio1" value="male" <?php echo ($user['gender']=="male")?"checked":"";?>>
                            Male </label>
                        <label class="radio-inline">
                            <input type="radio" name="gender" id="inlineRadio2" value="female" <?php echo ($user['gender']=="female")?"checked":"";?>>
                            Female </label>
                    </div>
                </div>
</br>
                <div class="form-group">
                    <label for="inputEmail" class="col-sm-3 control-label">Weight</label>

                    <div class="col-sm-8">
                        <div class="input-group">
                            <input  value="<?php echo $user['weight'];?>" type="number" min="1" id="inputWeight" name="weight" class="form-control" placeholder="Weight">
                            <div class="input-group-addon">
                                Kilogram
                            </div>
                        </div>
                    </div>
                </div>
</br>
                <div class="form-group">
                    <label for="inputEmail" class="col-sm-3 control-label">Length</label>

                    <div class="col-sm-8">
                        <div class="input-group">
                            <input  value="<?php echo $user['length'];?>" type="number" min="0" id="inputLength" name="length" class="form-control" placeholder="Length">
                            <div class="input-group-addon">
                                Centimeters
                            </div>
                        </div>

                    </div>
                </div>
</br>
                <center><h3 class="text-danger">Change your password</h3></center>
                <div class="form-group">
                    

                    <label for="inputEmail" class="col-md-3 control-label">Password</label>
                    <div class="col-md-8">
                        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password"/>
                    </div></br></br>

                    <label for="inputEmail" class="col-md-3 control-label">New password</label>
                    <div class="col-md-8">
                        <input type="password" id="inputnewPassword" name="passwordNew" class="form-control" placeholder="New Password"/ >
                    </div></br></br>
                
                    <label for="inputEmail" class="col-md-3 control-label">Verify password</label>
                    <div class="col-md-8">
                        <input type="password" id="inputVerificationPassword" name="verificationPassword" class="form-control" placeholder="New Password" />

                    </div>

                </div>
                <button type="submit" class="btn btn-success btn-lg btn-block">Update</button>
            </form>
        </br>
        </div>
    </div>


<?php
require_once (__ROOT__ . '/assets/include/footer.php');
endif;
?>