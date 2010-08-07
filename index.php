<?php
//Include Class
include('./ServerStatus.class.php');
	//Initialise Class
	$ss	=	new	ServerStatus();
//Config
$cfg['host']	=	(empty($_GET['host']) ? 'leefindlow.com' : $_GET['host']);
$cfg['services'][0]	=	array('name' => 'Web Server','port' => 80);
$cfg['services'][1]	=	array('name' => 'SSH','port' => 22);
$cfg['services'][2]	=	array('name' => 'MySQL','port' => 3306);
$cfg['services'][3]	=	array('name' => 'SMTP','port' => 25);
$cfg['services'][4]	=	array('name' => 'FTP','port' => 21);
$cfg['services'][5]	=	array('name' => 'Telnet','port' => 23);
?>
<!DOCTYPE html>
<html>
	<head>
		<title>PHP Server Status</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<style type="text/css" media="screen">@import "./style.css";</style>
	</head>
	<body>
		<div class="wrapper">
		<h1>PHP Server Status</h1>
		<h2>Server:</h2>
		<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="GET">
		Host: <input type="text" name="host" value="<?php echo $cfg['host']; ?>">
		<input type="submit" value="Check">
		</form>
		<p>Checking service status on <?php echo $cfg['host']; ?></p>
		<table class="resultstable">
			<thead>
				<tr>
					<th>Service</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach($cfg['services'] as $service){
					echo '<tr>';
						echo '<td class="description">'.$service['name'].'</td>';
						if($ss->checkServer($cfg['host'], $service['port'])){
							echo '<td class="bg-green">Ok</td>';	
						}else{
							echo '<td class="bg-red">Fail</td>';
						}
					echo '</tr>';
				}
				?>
			</tbody>
		</table>
		</div>
	</body>
</html>
