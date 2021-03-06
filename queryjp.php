<?php
//The following script is tested only with servers running on pmmp1.6.
$SERVER_IP="127.0.0.1"; //ipアドレス
$port = 19132; //ポート
$url = "http://minecraft-api.com/api/query/";
$ipp = ".php?ip=".$SERVER_IP."&port=".$port;
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
				<h3>サーバー情報</h3>
				<table class="table table-striped">
					<tbody>
					<tr>
					<td><b>サーバー名</b></td>
					<td><?php echo file_get_contents($url."motd".$ipp); ?></td>
					</tr>
					<tr>
					<td><b>IP</b></td>
					<td><?php echo $SERVER_IP.":".$port; ?></td>
					</tr>
					<tr>
					<td><b>バージョン</b></td>
					<td><?php echo file_get_contents($url."version".$ipp); ?></td>
					</tr>
					<tr>
					<td><b>プレイヤー数</b></td>
					<td><?php echo "".file_get_contents($url."playeronline".$ipp)." / ".file_get_contents($url."maxplayer".$ipp)."";?></td>
					</tr>
					<tr>
					<td><b>ステータス</b></td>
					<td><? if(file_get_contents($url."statut".$ipp) == 'En ligne') { echo "<i class=\"icon-ok-sign\"></i>オンライン"; } else { echo "<i class=\"icon-remove-sign\"></i>オフライン";}?></td>
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
				<h3>プレイヤーリスト</h3>
				<?php
				$list = file_get_contents($url."playerlist".$ipp);
				if($list != null) {
					echo $list;
					}
				//何も表示されなければ
				else { 
					echo "<div class=\"alert\"> プレイヤーがいないようです。</div>";
					}				
				?>
			</div>
		</div>
	</div>
	</body>
</html>
