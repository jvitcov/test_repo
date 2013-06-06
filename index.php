<?php
 session_start(); 
 require("connection.php");
?>
<html>
	<head>
		<title>Sharma.com</title>
		<link rel="icon" href="background.png" type="image/png" sizes="16x16">
		<link rel="stylesheet" type="text/css" href="sharma.css">

	</head>
	<body>
	<div id="background">
	</div>
	<div id="main_content">
		<div id="nav_bar">
			<ul>
				<li><a href="">History</a></li>
				<li><a href="images.php">Images</a></li>			
				<li><a href="">Blog</a></li>
				<li><a href="contact.php">Contact</a></li>
			</ul>
		</div>

		<form id="login" action="process.php" method="post">
			<? if(isset($_SESSION['logged_in'])){
				echo "<span id='log_off'>".$_SESSION['user']['first_name']." ".$_SESSION['user']['last_name']."<br>"."<a href='process.php'>Log Off</a></span><br>";
				}
				else{
					echo
				
			
			"<input type='hidden' name='action' value='login'>
			<input class='input' type='text' name='email' placeholder ='email'>
			<input class='input' type='password' name='password' placeholder='password'>
			<input id='button' type='submit' name='login' value=' '><br>
			<p><a id='reg_here' href='register.php'>Register Here</a></p>"
			;}?>
			<?php
				if(isset($_SESSION['login_errors']))
				{	
					foreach($_SESSION['login_errors'] as $error)
					{
						echo $error."<br />";
					}
				}
				unset($_SESSION['login_errors']);
			?>
			
		</form>
		
		<div id="sponsors">
			<ul>
				<li><a href="http://www.petzl.com/us"><img src="petzl_logo.png"></a></li>
				<li><a href="http://www.evolvsports.com/"><img src="evolv_logo.png"></a></li>
				<li><a href="http://www.prana.com/"><img src="prana_logo.png"></a></li>
				<li><a href="http://www.senderoneclimbing.com/"><img src="senderone_logo.png"></a></li>
			</ul>
		</div>
	</div>
	</body>
</html>