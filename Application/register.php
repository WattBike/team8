<?php
define('safeGuard', TRUE);
define('dbConnected', TRUE);
define('__ROOT__', dirname(__FILE__));
require_once(__ROOT__ . '/assets/include/connect.php');
require_once(__ROOT__ . '/assets/include/header.php');
if (isset($_POST['email']) && ($_POST['email'] != "")):
    $registration = register_user(
        $_POST['email'],
        $_POST['password'],
        $_POST['verificationPassword'],
        $_POST['firstname'],
        $_POST['lastname'],
        $_POST['age'],
        $_POST['gender'],
        $_POST['length'],
        $_POST['weight']
    );
    if (!$registration["success"]) {
        echo "Registration Failed <a href='register.php'>back</a>";
    } else {
        echo "Registration Succeeded! <a href='display.php'>continue</a>";
    }
    echo $registration["statuscode"];
else:
?>
<div>
  <img id="profile-img" class="img-circle img-responsive center-block" src="https://randomuser.me/api/portraits/lego/2.jpg" width="96"/>
  <form class="form-horizontal" method="post">
    <div class="form-group ">
        <div class="col-sm-10">
            <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-10">
            <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-10">
            <input type="password" id="inputVerificationPassword" name="verificationPassword" class="form-control" placeholder="Password" required>
    
    </div>
    <div class="form-group">
        
            <input type="text" id="inputFirstname" name="firstname" class="form-control" placeholder="First Name">
        
    </div>
    <div class="form-group">
        
            <input type="text" id="inputLastname" name="lastname" class="form-control" placeholder="Last Name">
        
    </div>
    <div class="form-group">  
        
            <input type="number" min="1" id="inputAge" name="age" class="form-control" placeholder="Age">
        
     </div>
    <div class="form-group">
            
            <label class="radio-inline">
                <input type="radio" name="gender" id="inlineRadio1" value="male"> Male
            </label>
            <label class="radio-inline">  
                <input type="radio" name="gender" id="inlineRadio2" value="female"> Female
            </label>
        
    </div>
    <div class="form-group">
        
            <label class="sr-only" for="exampleInputAmount">Weight (in kg)</label>
            <div class="input-group">
                <input type="number" min="1" id="inputWeight" name="weight" class="form-control" placeholder="Weight (kg)">
                <div class="input-group-addon">Kilogram</div>
            </div>
        
    </div>
    <div class="form-group">
        
            <label class="sr-only" for="exampleInputAmount">Length (in cm)</label>
            <div class="input-group">
                <input type="number" min="0" id="inputLength" name="length" class="form-control" placeholder="Length (cm)">
                <div class="input-group-addon">Centimeters</div>
            </div>
        
    </div>  
    <button class="btn btn-primary btn-lg btn-block" type="submit">Register</button>
  </form><!-- /form -->
</div><!-- /card-container -->
<?php
endif;
require_once "assets/include/footer.php";
?>
