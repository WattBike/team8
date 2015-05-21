<?php
define('safeGuard', TRUE);
define('__ROOT__', dirname(__FILE__));
//TODO fix register with class
require_once(__ROOT__ . '/assets/include/connect.php');
require_once(__ROOT__ . '/assets/include/header.php');
$connection = new Connect();
if (isset($_POST['email']) && ($_POST['email'] != "")):
    $registration = $connection->register_user(
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
<div class="col-md-12 well">
	<img id="profile-img" class="img-circle img-responsive center-block" src="https://randomuser.me/api/portraits/lego/2.jpg" width="96"/>
	<form  method="post" class="form-horizontal">
		<div class="form-group ">
			<label for="inputEmail" class="col-sm-2 control-label">Email</label>
			<div class="col-sm-10">
				<input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
			</div>
		</div>
		<div class="form-group">
			<label for="inputEmail" class="col-sm-2 control-label">Password</label>

			<div class="col-sm-10">
				<input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
			</div>
		</div>
		<div class="form-group">
			<label for="inputEmail" class="col-sm-2 control-label">Verify password</label>

			<div class="col-sm-10">
				<input type="password" id="inputVerificationPassword" name="verificationPassword" class="form-control" placeholder="Password" required>

			</div>
		</div>
		<div class="form-group">
			<label for="inputEmail" class="col-sm-2 control-label">First name</label>

			<div class="col-sm-10">
				<input type="text" id="inputFirstname" name="firstname" class="form-control" placeholder="First Name">

			</div>
		</div>
		<div class="form-group">
			<label for="inputEmail" class="col-sm-2 control-label">Last name</label>

			<div class="col-sm-10">
				<input type="text" id="inputLastname" name="lastname" class="form-control" placeholder="Last Name">
			</div>
		</div>
		<div class="form-group">
			<label for="inputEmail" class="col-sm-2 control-label">Age</label>

			<div class="col-sm-10">
				<input type="number" min="1" id="inputAge" name="age" class="form-control" placeholder="Age">
			</div>
		</div>
		<div class="form-group">
			<label for="inputEmail" class="col-sm-2 control-label">Gender</label>

			<div class="col-sm-10">
				<label class="radio-inline">
					<input type="radio" name="gender" id="inlineRadio1" value="male">
					Male </label>
				<label class="radio-inline">
					<input type="radio" name="gender" id="inlineRadio2" value="female">
					Female </label>
			</div>
		</div>
		<div class="form-group">
			<label for="inputEmail" class="col-sm-2 control-label">Weight</label>

			<div class="col-sm-5">
				<div class="input-group">
					<input type="number" min="1" id="inputWeight" name="weight" class="form-control" placeholder="Weight">
					<div class="input-group-addon">
						Kilogram
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label for="inputEmail" class="col-sm-2 control-label">Length</label>

			<div class="col-sm-5">
				<div class="input-group">
					<input type="number" min="0" id="inputLength" name="length" class="form-control" placeholder="Length">
					<div class="input-group-addon">
						Centimeters
					</div>
				</div>

			</div>
		</div>

		<button class="btn btn-primary btn-lg btn-block" type="submit">
			Register
		</button>
		<a href="index.php" class="btn btn-default btn-lg btn-block">Terug</a>
	</form><!-- /form -->
</div><!-- /card-container -->
<?php
endif;?>
<?php require_once(__ROOT__ . '/assets/include/footer.php'); ?>

