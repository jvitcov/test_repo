<?
 session_start(); 
 require("connection.php");
?>
<html>
<head>
</head>
<body>

		<form id="login" action="admin_login_process.php" method="post">
					<? echo
					"<input type='hidden' name='action' value='login'>
					<input class='input' type='text' name='email' placeholder ='email'>
					<input class='input' type='password' name='password' placeholder='password'>
					<input id='button' type='submit' name='login' value='admin login'><br>";
					?>
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
</body>
</html>