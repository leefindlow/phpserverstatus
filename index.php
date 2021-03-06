<?php
/**
 * Example code for PHP Server Status
 * @author  Lee Findlow <hello@leefindlow.com>
 */

//Include Class
include('./ServerStatus.class.php');
	//Initialise Class
	$ss	=	new	ServerStatus();
//Config
$cfg['host']	=	(empty($_GET['host']) ? 'leefindlow.com' : $_GET['host']);
$cfg['services'][0]	=	array('name' => 'Web Server','port' => 80, 'description' => 'Checking if a web server, such as Apache is running.');
$cfg['services'][1]	=	array('name' => 'SSH','port' => 22, 'description' => 'Checking if a Secure SHell servcie is running for remote access.');
$cfg['services'][2]	=	array('name' => 'MySQL','port' => 3306, 'description' => 'Checking if there is a MySQL database server running.');
$cfg['services'][3]	=	array('name' => 'SMTP','port' => 25, 'description' => 'Checking if there is an SMTP server running.');
$cfg['services'][4]	=	array('name' => 'FTP','port' => 21, 'description' => 'Checking if there is an FTP server running to allow file transfers.');
$cfg['services'][5]	=	array('name' => 'Telnet','port' => 23, 'description' => 'Checking if there is a Telnet server running to allow (unsecure) remote access.');
?>
<!DOCTYPE html>
<html>
	<head>
		<title>PHP Server Status</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<style type="text/css" media="screen">@import "./style.css";</style>
		<meta name="author" content="Lee Findlow <projects@leefindlow.com>">
		<meta name="keywords" content="server,status,ping,server status,status checker,server checker">
		<meta name="description" content="PHP Script to allow the checking of the status of a Server.">
		<script type="text/javascript">
		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-7364000-1']);
		  _gaq.push(['_trackPageview']);
		
		  (function() {
		    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();
		</script>
	</head>
	<body>
		<div class="wrapper">
		<h1>PHP Server Status</h1>
		<p>This script allows the checking of any given services on a network connected server. Enter a server's hostname below to see an example of this in action.</p>
        <p>To download and see more information please see <a href="http://www.leefindlow.com/projects/server-status/">the project</a> page on <a href="http://www.leefindlow.com/">my website</a>.</p>
		<h2>Host</h2>
		<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="GET">
		Host: <input type="text" name="host" value="<?php echo $cfg['host']; ?>">
		<input type="submit" value="Check">
		</form>
		<p>Checking service status on <strong><?php echo $cfg['host']; ?></strong>.</p>
		<h2>Results</h2>
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
						echo '<td class="name">'.$service['name'].'</td>';
						if($ss->checkServer($cfg['host'], $service['port'])){
							echo '<td class="bg-green">Ok</td>';	
						}else{
							echo '<td class="bg-red">Fail</td>';
						}
						echo '<td class="description">'.$service['description'].'</td>';
					echo '</tr>';
				}
				?>
			</tbody>
		</table>
		</div>
		<div class="footer">
			<p><a rel="license" href="http://creativecommons.org/licenses/by-sa/3.0/"><img alt="Creative Commons License" style="border-width:0" src="http://i.creativecommons.org/l/by-sa/3.0/80x15.png" /></a> This work is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-sa/3.0/">Creative Commons Attribution-ShareAlike 3.0 Unported License</a>.</p>
			<p>Script by <a href="http://www.leefindlow.com/">Lee Findlow</a>, <a href="http://www.leefindlow.com/projects/server-status/">more information</a>.</p>
		</div>
	</body>
</html>
