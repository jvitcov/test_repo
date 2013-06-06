<?php
 session_start(); 
 require("connection.php");

 if(isset($_SESSION['logged_in']))
 { 
	header("location:index.php");
	exit;
 }
 ?>
<head>
	<title>Sharma.com</title>
	<link rel="icon" href="background.png" type="image/png" sizes="16x16">
	<link rel="stylesheet" type="text/css" href="register.css">
</head>
<body>
	<div id="info">
		<h1>Register</h1>
		<p>Why Register? Chris' site is full of awesome images, links, videos, and other media from his climbing career. We give everyone access to most of it, but register if you want to see it all. Additionally, registered users can send personal messages to Chris. Although we cannot gaurantee a personal reply to every message (he replies to many), Chris uses all the questions and requests in user submited messages to generate blog ideas and articles. Which brings us to the final reason you should register: to see the blog!</p>
		<p>Who can register? In most countries, you must be at least 13 years of age to register.  Do not register with our site if you are not allowed by local law.</p>
	</div>

	<form id="register" action="process.php" method="post">
		<input type="hidden" name="action" value="register">
		<input class="input" type="text" name="first_name" placeholder="First Name"><br>
		<input class="input" type="text" name="last_name" placeholder="Last Name"><br>
		<input class="input" type="text" name="email" placeholder="Email"><br>
		<input class="input" type="text" name="confirm_email" placeholder="Confirm Email"><br>
		<input class="input" type="password" name="password" placeholder="Password"><br>
		<input class="input" type="password" name="confirm_password" placeholder="Confirm Password"><br>
		<input id="reg_button" type="submit" name="register" value="register"><br>
	</form>	
	<div id="footer">
		<?php
			if(isset($_SESSION['registration_errors']))
			{	
				foreach($_SESSION['registration_errors'] as $error)
				{
					echo $error."<br />";
				}
			}
		?>
	</div>
	<?php
	unset($_SESSION['registration_errors']);
	?>
</body>