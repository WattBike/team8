<?php
    global $base_url;
    define('safeGuard', TRUE);
    define('dbConnected', TRUE);
    define('__ROOT__', dirname(__FILE__));
    require_once(__ROOT__ . '/assets/classes/class.connect.php');
    require_once(__ROOT__ . '/assets/include/header.php');
	$connection = new Connect;

    // if (isset($_POST['email']!="")) {
    //     $update = $connection->update_user($_POST['email'], "email_id" );
    // }
    // if (isset($_POST['password']!="")&&isset($_POST['verificationPassword']!="")) {
    //     $update = $connection->update_user($_POST['password'], "password" );
    // }
    // if (isset($_POST['firstname']!="")) {
    //     $update = $connection->update_user($_POST['firstname'], "firstname" );
    // }
    // if (isset($_POST['lastname']!="")) {
    //     $update = $connection->update_user($_POST['lastname'], "lastname" );
    // }
    // if (isset($_POST['age']!="")) {
    //     $update = $connection->update_user($_POST['age'], "age" );
    // }
    // if (isset($_POST['gender']!="")) {
    //     $update = $connection->update_user($_POST['gender'], "gender" );
    // }if (isset($_POST['length']!="")) {
    //     $update = $connection->update_user($_POST['gender'], "gender" );
    // }if (isset($_POST['weight']!="")) {
    //     $update = $connection->update_user($_POST['weight'], "weight" );
    // }

// if (isset($_POST['email']) && ($_POST['email'] != "")):
//     $update = $connection->update_user(
//         $_POST['email'],
//         $_POST['password'],
//         $_POST['verificationPassword'],
//         $_POST['firstname'],
//         $_POST['lastname'],
//         $_POST['age'],
//         $_POST['gender'],
//         $_POST['length'],
//         $_POST['weight']
//     );
    // if (!$update) {
    //     echo "Update Failed <a href='settings.php'>back</a>";
    // } else {
    //     echo "Update Succeeded! <a href='settings.php'>continue</a>";
    // }
// else:
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
                    <label for="inputEmail" class="col-md-3 control-label">Email</label>
                    <div class="col-md-6">
                        <input value="admin@hva.nl" type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-primary btn-lg btn-block" type="submit">
                            Update
                        </button>
                    </div>
                </div>
            </form>
</br>

            <form  method="post" class="form-horizontal">
                <div class="form-group">
                    <label for="inputEmail" class="col-md-3 control-label">Password</label>

                    <div class="col-md-6">
                        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
                    </div>
                    <!-- <div class="col-md-3"></div> --></br></br>


                
                    <label for="inputEmail" class="col-md-3 control-label">Verify password</label>

                    <div class="col-md-6">
                        <input type="password" id="inputVerificationPassword" name="verificationPassword" class="form-control" placeholder="Password" required>

                    </div>
            
                    <div class="col-md-3">
                        <button class="btn btn-primary btn-lg btn-block" type="submit">
                            Update
                        </button>
                    </div>
                </div>
            </form>
</br>

            <form  method="post" class="form-horizontal">
                <div class="form-group">
                    <label for="inputEmail" class="col-md-3 control-label">First name</label>

                    <div class="col-md-6">
                        <input  value"Admin" type="text" id="inputFirstname" name="firstname" class="form-control" placeholder="First Name">

                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-primary btn-lg btn-block" type="submit">
                            Update
                        </button>
                    </div>
                </div>
            </form>
</br>

            <form  method="post" class="form-horizontal">                
                <div class="form-group">
                    <label for="inputEmail" class="col-sm-3 control-label">Last name</label>

                    <div class="col-sm-6">
                        <input value"Hva" type="text" id="inputLastname" name="lastname" class="form-control" placeholder="Last Name">
                    </div>
                    <div class="col-sm-3">
                        <button class="btn btn-primary btn-lg btn-block" type="submit">
                            Update
                        </button>
                    </div>
                </div>
            </form>
</br>

            <form  method="post" class="form-horizontal">
                <div class="form-group">
                    <label for="inputEmail" class="col-sm-3 control-label">Age</label>

                    <div class="col-sm-6">
                        <input value"101" type="number" min="1" id="inputAge" name="age" class="form-control" placeholder="Age">
                    </div>
                    <div class="col-sm-3">
                        <button class="btn btn-primary btn-lg btn-block" type="submit">
                            Update
                        </button>
                    </div>
                </div>
            </form>
</br>

            <form  method="post" class="form-horizontal">
                <div class="form-group">
                    <label for="inputEmail" class="col-sm-3 control-label">Gender</label>

                    <div class="col-sm-6">
                        <label class="radio-inline">
                            <input type="radio" name="gender" id="inlineRadio1" value="male">
                            Male </label>
                        <label class="radio-inline">
                            <input type="radio" name="gender" id="inlineRadio2" value="female">
                            Female </label>
                    </div>
                    <div class="col-sm-3">
                        <button class="btn btn-primary btn-lg btn-block" type="submit">
                            Update
                        </button>
                    </div>
                </div>
            </form>
</br>

            <form  method="post" class="form-horizontal">
                <div class="form-group">
                    <label for="inputEmail" class="col-sm-3 control-label">Weight</label>

                    <div class="col-sm-6">
                        <div class="input-group">
                            <input  value"100" type="number" min="1" id="inputWeight" name="weight" class="form-control" placeholder="Weight">
                            <div class="input-group-addon">
                                Kilogram
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <button class="btn btn-primary btn-lg btn-block" type="submit">
                            Update
                        </button>
                    </div>
                </div>
            </form>
</br>

            <form  method="post" class="form-horizontal">
                <div class="form-group">
                    <label for="inputEmail" class="col-sm-3 control-label">Length</label>

                    <div class="col-sm-6">
                        <div class="input-group">
                            <input  value"100" type="number" min="0" id="inputLength" name="length" class="form-control" placeholder="Length">
                            <div class="input-group-addon">
                                Centimeters
                            </div>
                        </div>

                    </div>
                    <div class="col-sm-3">
                        <button class="btn btn-primary btn-lg btn-block" type="submit">
                            Update
                        </button>
                    </div>
                </div>
            </form>
            <a href="index.php" class="btn btn-default btn-lg btn-block">Back</a>
        </br>
        </div>
    </div>


<?php
require_once (__ROOT__ . '/assets/include/header.php');
// endif;
?>