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
    <h1>Welcome to wattbike <small><?php echo $_SESSION['first_name'];?></small></h1>
    <h2>A new session is started</h2>
    <a class="btn btn-primary" href="display.php">Back</a>
    <a class="btn btn-warning" href="index.php">Logout</a>
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
                $row = $rows[$i]; ?>
                <tr>
                    <td><?php echo $row['session_nr'];?></td>
                    <td><?php echo $row['bpm'];?></td>
                    <td><?php echo $row['time'];?></td>
                </tr>
            <?php endfor; ?>
	    </tbody>
	</table>
</div><!-- /card-container -->
<script>

        jQuery(document).ready(function () {
            refresh();
            function refresh(){
                jQuery.ajax({
                    url: "<?php echo $base_url;?>/list.php",
                    context: document.body
                }).done(function (data) {
                    jQuery('tbody').html('');
                    for (var i = 0; i < data.length; i++) {
                        var oldData = jQuery('tbody').html();
                        jQuery('tbody').html(
                            oldData
                            + "<tr>"
                            + "<td><input type=\"checkbox\" name=\"" + data[i] + "\" value=\"" + data[i] + "\"/></td>"
                            + "<td>" + data[i] + "</td>"
                            + "<td>" + data[i] + "</td>"
                            + "<td>" + data[i] + "</td>"
                            + "<td>" + data[i] + "</td>"
                            + "</tr>"
                        );
                    }
                });
                setTimeout(refresh, 5000);
            }
        });

</script>
<?php
endif;
require_once "assets/include/footer.php";
?>
