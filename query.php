<?php
//The following script is tested only with servers running on Minecraft 1.7.
$SERVER_IP="127.0.0.1"; //Insert the IP of the server you want to query. Query must be enabled in your server.properties file!
$port = 19132;
//You can either insert the DNS (eg. play.hivemc.com) OR the IP itself (eg. 187.23.123.21). 
$url = "http://minecraft-api.com/api/query/";
$ipp = ".php?ip=".$SERVER_IP."&port=".$port;
//Put the collected player information into an array for later use.
$array_list = explode(',', $data_list['players']);
?>
<!DOCTYPE html>
<html>
	<head>
        <meta charset="utf-8">
        <title>MC PHP Query</title>
        <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css">
    	<link href='http://fonts.googleapis.com/css?family=Lato:300,400' rel='stylesheet' type='text/css'>
    	<link href="https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    	<script type="text/javascript" src="https://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
    	<script>
    	jQuery(function ($) {
        	$("a").tooltip()
    	}); 
    	</script>
    	<style>
    	/*Custom CSS Overrides*/
    	body {
      		font-family: 'Lato', sans-serif !important;
    	}
    	</style>
    </head>
    <body>
	<div class="container">
        <h1>MC PHP Query</h1><hr>       
		<div class="row">
			<div class="span4">
				<h3>General Information</h3>
				<table class="table table-striped">
					<tbody>
					<tr>
					<td><b>Server Name</b></td>
					<td><?php echo file_get_contents($url."motd".$ipp); ?></td>
					</tr>
					<tr>
					<td><b>IP</b></td>
					<td><?php echo $SERVER_IP.":".$port; ?></td>
					</tr>
					<tr>
					<td><b>Version</b></td>
					<td><?php echo file_get_contents($url."version".$ipp); ?></td>
					</tr>
					<tr>
					<td><b>Players</b></td>
					<td><?php echo "".file_get_contents($url."playeronline".$ipp)." / ".file_get_contents($url."maxplayer".$ipp)."";?></td>
					</tr>
					<tr>
					<td><b>Status</b></td>
					<td><? if(file_get_contents($url."statut".$ipp) == 'En ligne') { echo "<i class=\"icon-ok-sign\"></i> Server is online"; } else { echo "<i class=\"icon-remove-sign\"></i> Server is offline";}?></td>
					</tr>

<!-- not working!
					<tr>
					<td><b>Latency</b></td>
					<td><?php echo "".file_get_contents('http://minecraft-api.com/api/ping/ping.php?ip='.$SERVER_IP.'&port='.$port)."ms"; ?></td>
					</tr>	
-->
					</tbody>
				</table>
			</div>
			<div class="span8">
				<h3>Players</h3>
				<?php
				$list = file_get_contents($url."playerlist".$ipp);
				if($list != null) {
					echo $list;
					}
				//If no avatars can be shown, display an error.
				else { 
					echo "<div class=\"alert\"> There are no players online at the moment!</div>";
					}				
				?>
			</div>
		</div>
	</div>
	</body>
</html>
