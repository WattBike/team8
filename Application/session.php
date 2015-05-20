<?php
    global $base_url;
	define('safeGuard', TRUE);
	define('dbConnected', TRUE);
	define('__ROOT__', dirname(__FILE__));
	require_once(__ROOT__ . '/assets/include/connect.php');
	require_once(__ROOT__ . '/assets/include/header.php');
	require_once(__ROOT__ . '/assets/include/config.php');
	if (!isset($_SESSION['mail']) && ($_SESSION['mail'] == "")):
	    header('Location: $base_url/index.php', 401);
	else:
?>
<div class="container">
	<a class="btn btn-default" href="display.php">&larr; Back</a>
    <h1>Welcome to wattbike <small><?php echo $_SESSION['first_name']; ?></small></h1>
    <form method="post" id="session" class="form-inline">
      <b>Viewing session:</b>
			<select name="session" class="form-control" id="sessionSelector">
            <option value="-1">Choose a session</option>
            <?php $rows = get_total_session();
                $session_nr=0;
                for($i = 0; $i < count($rows); ++$i):
                    $row = $rows[$i]; 
                    $session_nr++; ?>
                    <option value="<?php echo $row['session_nr']; ?>"><?php echo $session_nr ?></option>
            <?php endfor; ?>
        </select>    </form>
    
    <?php 
        if(isset($_POST['submit'])){
            $session=$_POST['session'];
            echo "You have selected :" .$session; // Displaying Selected Value
        }
    ?>
	<table class="table">
		<thead>
		    <tr>
		    	<th>#</th>
                <th>bpm</th>
		      	<th>time</th>
	    	</tr>
	  	</thead>
	  	<tbody>
           <?php $rows = get_user_session();
            
                for($i = 0; $i < count($rows); ++$i):
                    $row = $rows[$i];
            ?>
                <tr>
                    <td><?php echo $row['new_session_nr']; ?></td>
                    <td><?php echo $row['bpm']; ?></td>
                    <td><?php echo $row['time']; ?></td>
                </tr>
            <?php endfor; ?>
	    </tbody>
	</table>
</div><!-- /card-container -->
<?php
	require_once "assets/include/footer-tags.php";
?>
<script type="text/javascript">
	jQuery(document).ready(function () {
		refresh();

		$("#sessionSelector").change(function () {
			refresh();
		});

		function refresh(){
			var newsession = $("#sessionSelector option:selected").val();
			jQuery.ajax({
				url: "<?php echo $base_url; ?>/rest.php?session=" +newsession+ "",
				context: document.body,
				dataType: "json"
			}).done(function (data) {
				jQuery('tbody').html('');
				for (var i = 0; i < data.length; i++) {
					var oldData = jQuery('tbody').html();
					jQuery('tbody').html(
						oldData
						+ "<tr>"
						+ "		<td>" + data[i].new_session_nr + "</td>"
						+ "		<td>" + data[i].bpm + "</td>"
						+ "		<td>" + data[i].time + "</td>"
						+ "</tr>"
					);
				}
			});
			setTimeout(refresh, 15000);
		}
	});
</script>
<?php
	require_once "assets/include/end-tags.php";
?>
<?php endif; ?>
