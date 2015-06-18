<?php
	define('safeGuard', TRUE);
	define('__ROOT__', dirname(__FILE__));
	require_once(__ROOT__ . '/assets/classes/class.connect.php');
	$connection = new Connect;
	if (!key_exists("mail", $_SESSION) || $_SESSION['mail']==""):
	 	$connection->redirect("index.php", 401);
  	else:
		if(isset($_POST['type'])){
			if($connection->new_training($_POST['type'])){
				$connection->redirect("index.php", 200);
				$_SESSION['status']="New trainingssession started.";
			}else{
				$_SESSION['status']="New training failed to start;";
			}
		}
		require_once(__ROOT__ . '/assets/include/header.php');
?>
<div class="container">
	<a class="btn btn-default" href="index.php">&larr; Back</a>
    <h1>Welcome to wattbike <small><?php echo $_SESSION['first_name']; ?></small></h1>
    <h2>Your new training</h2>
    <?php if(isset($_SESSION['status'])):?>
	    <div class="alert alert-danger">
	    	<?php echo $_SESSION['status'];?>
	    </div>
    <?php unset($_SESSION['status']); endif;?>
    <form method="post" class="">
    	<div class="form-group">
	    	<?php $types = $connection->read_trainings_types();
			for ($i=0; $i < count($types); $i++):?>
				<div class="radio">
					<label>
						<input type="radio" name="type" value="<?php echo $types[$i]['type_nr'];?>" <?php echo ($i==0)?" checked":"";?>/>
						<?php echo $types[$i]['name'];?>: <?php echo $types[$i]['description'];?>
					</label>
				</div>
			<?php endfor;?>
		</div>
		<div class="form-group">
	    	<button type="submit" class="btn btn-success">Start</button>
	    	<a class="btn btn-danger" href="index.php">Cancel</a>
	    </div>
    </form>
</div>

<?php
	require_once (__ROOT__ . '/assets/include/footer.php');
	endif;
?>
