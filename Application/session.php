<?php
	define('safeGuard', TRUE);
	define('dbConnected', TRUE);
	define('__ROOT__', dirname(__FILE__));
	require_once(__ROOT__ . '/assets/include/connect.php');
	require_once(__ROOT__ . '/assets/include/header.php');
	require_once(__ROOT__ . '/assets/include/config.php');
    $mysqli = new mysqli($mysqliHost, $mysqliUsername, $mysqliPassword, $mysqliDatabase);
	if (!isset($_SESSION['mail']) && ($_SESSION['mail'] == "")):
	    header('Location: /team8/Application/index.php', 401);
	else:
		
		
?>
<div class="container">
    <h1>Welcome to wattbike <small><?php echo $_SESSION['first_name'];?></small></h1>
    <h2>A new session is started</h2>
	<table class="table">
		<thead>
		    <tr>
		    	<th>bpm</th>
		      	<th>time</th>
	    	</tr>
	  	</thead>
	  	<tbody>
	    <?php
	    	$member_id=$_SESSION['member_id'];
	    	$sql="SELECT * FROM Heartrate WHERE member_id='$member_id'ORDER BY time";
	        // $query 	= 	"SELECT * FROM member ORDER BY  DESC";
	      	$results=mysqli_query($mysqli,$sql);
	        $num_rows = mysqli_num_rows($results);
	        while($row = mysqli_fetch_assoc($results)){
	    ?>
		        <tr class="rowCentering">
		        	<td id="firstColum"><?php echo $row['bpm'];?></td>
		            <td id="firstColum"><?php echo date('h:i:s');?></td>
		        </tr>
	   	<?php
	   		sleep(5);
	        }
	    ?>
	    </tbody>
	</table>
    <a href="index.php">Logout</a>
    <a href="display.php">Back</a>
</div><!-- /card-container -->
<?php
endif;
require_once "assets/include/footer.php";
?>
