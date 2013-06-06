<?php
session_start();
require("connection.php");
if(!(isset($_SESSION['logged_in']))){
 	header('Location:index.php');
 	exit;
 }
	$query = "SELECT messages.*, users.first_name, users.last_name, users.email FROM messages LEFT JOIN users ON users.id = messages.user_id WHERE messages.message_type = 'fan_mail' ORDER BY id DESC;";
	$fan_messages= fetch_all($query);

	$query = "SELECT messages.*, users.first_name, users.last_name, users.email FROM messages LEFT JOIN users ON users.id = messages.user_id WHERE messages.message_type = 'climb_with' ORDER BY id DESC;";
	$climb_with_messages = fetch_all($query);

	$query = "SELECT messages.*, users.first_name, users.last_name, users.email FROM messages LEFT JOIN users ON users.id = messages.user_id WHERE messages.message_type = 'schedule_slideshow' ORDER BY id DESC;";
	$slideshow_messages = fetch_all($query);

	$query = "SELECT messages.*, users.first_name, users.last_name, users.email FROM messages LEFT JOIN users ON users.id = messages.user_id WHERE messages.message_type = 'blog' ORDER BY id DESC;";
	$blog_messages = fetch_all($query);

?>
<html>
<head>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
	<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/ui-lightness/jquery-ui.css" type="text/css" media="all" />
	<link rel="stylesheet" type="text/css" href="admin.css">
	<script>
	 $(function() {
	   $( "#subjects" ).tabs();
	});
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.mess_div').hide();
			$('.message_info tr').click(function(){
				var mess_id = parseInt($(this).attr('class').substring(3));
				var mess_info = null;
				console.log(mess_id);
				var div_to_show = "div"+mess_id;
				console.log(div_to_show);
				$('.mess_div').hide();
				$('.'+div_to_show).show();
				// $('.fan_message').text();
				// $('.displayed_message').append("Test Message")
			});
		});
	</script>
</head>
<body>
<div id="log_off">
<?
	if(isset($_SESSION['logged_in'])){
					echo $_SESSION['admin']['email']."<br>"."<a href='admin_login_process.php'>Log Off</a><br>";
	}
	// else{
	// 	header('location: index.php');
	// 	exit;
	// }
?>
</div>
	<div id="subjects">
	  <ul>
	    <li><a href="#subjects-1">Fan Mail</a></li>
	    <li><a href="#subjects-2">Climb w/ Request</a></li>
	    <li><a href="#subjects-3">Slide Show Request</a></li>
	    <li><a href="#subjects-4">Blog Question</a></li>
	  </ul>
	  <div id="subjects-1">

		  	 <div class="message_body">
		  	 	<div class="fan_message" style="border:1px solid black; width:100%; height:300px">
		  			<?php
		  				foreach($fan_messages as $message)
		  				{
		  					echo "<div class='mess_div div{$message["id"]}'>"
		  							."From: ".$message['first_name']." ".$message['last_name']."<br>"."Sent at: ".$message['created_at']."<br>"."Message:<br>".$message['content']."</div>";
		  				}
		  			?>
		  		</div>
		  		<form action="MAILTO:someone@example.com" method="post" enctype="text/plain">
				<textarea class="response_content">This is the sample message that Chris will send.</textarea>
				<input type="submit" value="respond">
				</form>
			</div>
	    <table class="message_info">
	    	<thead>
	    		<th>User Name</th>
	    		<th>Email</th>
	    		<th>Date Received</th>
	    		<th>Response Sent</th>
	    		<th>Delete</th>
	    	</thead>
	    	<tbody>

<?php
	foreach($fan_messages as $message)
	{
?>
	    		<tr class=<?php echo ('row'.$message['id'])?>>
	    			<td><? echo $message['first_name']." ".$message['last_name'];?></td>
	    			<td><? echo $message['email'];?></td>
	    			<td><? echo $message['created_at']?></td>
	    			<td><input type="checkbox"></td>
	    			<td><img src="delete_icon.png"></td>
	    		</tr>
<?}?>
	    	</tbody>

	    </table>
	  </div>
	  <div id="subjects-2">
		  	<div class="message_body">
		  				  	 	<div class="fan_message" style="border:1px solid black; width:100%; height:300px">
		  			<?php
		  				foreach($climb_with_messages as $message)
		  				{
		  					echo "<div class='mess_div div{$message["id"]}'>"
		  							."From: ".$message['first_name']." ".$message['last_name']."<br>"."Sent at: ".$message['created_at']."<br>"."Message:<br>".$message['content']."</div>";
		  				}
		  		
		  			?>
		  		</div>
				<textarea class="response_content"></textarea>
				<input type="submit" value="respond">
			</div>
	    <table class="message_info">
	    	<thead>
	    		<th>User Name</th>
	    		<th>Email</th>
	    		<th>Date Received</th>
	    		<th>Response Sent</th>
	    		<th>Delete</th>
	    	</thead>
	    	<tbody>
<?php
	// $query = "SELECT messages.*, users.first_name, users.last_name, users.email FROM messages LEFT JOIN users ON users.id = messages.user_id WHERE messages.message_type = 'climb_with' ORDER BY id DESC;";
	// $messages = fetch_all($query);
	foreach($climb_with_messages as $message)
	{
?>
	    		<tr class=<?php echo ('row'.$message['id'])?>>
	    			<td><? echo $message['first_name']." ".$message['last_name'];?></td>
	    			<td><?echo $message['email'];?></td>
	    			<td><?echo $message['created_at']?></td>
	    			<td><input type="checkbox"></td>
	    			<td><img src="delete_icon.png"></td>
	    		</tr>
<?}?>
	    	</tbody>

	    </table>
	  </div>
		  	<div id="subjects-3">
				  	<div class="message_body">
						<div class="fan_message" style="border:1px solid black; width:100%; height:300px">
		  			<?php
		  				foreach($slideshow_messages as $message)
		  				{
		  					echo "<div class='mess_div div{$message["id"]}'>"
		  							."From: ".$message['first_name']." ".$message['last_name']."<br>"."Sent at: ".$message['created_at']."<br>"."Message:<br>".$message['content']."</div>";
		  				}
		  		
		  			?>
							<textarea class="response_content"></textarea>
							<input type="submit" value="respond">
						</div>
		    	<table class="message_info">
			    	<thead>
			    		<th>User Name</th>
			    		<th>Email</th>
			    		<th>Date Received</th>
			    		<th>Response Sent</th>
			    		<th>Delete</th>
			    	</thead>
		    		<tbody>
	  <?php
	// $query = "SELECT messages.*, users.first_name, users.last_name, users.email FROM messages LEFT JOIN users ON users.id = messages.user_id WHERE messages.message_type = 'schedule_slideshow' ORDER BY id DESC;";
	// $messages = fetch_all($query);
	foreach($slideshow_messages as $message)
	{
?>
		    		<tr class=<?php echo ('row'.$message['id'])?>>
		    			<td><? echo $message['first_name']." ".$message['last_name'];?></td>
		    			<td><?echo $message['email'];?></td>
		    			<td><?echo $message['created_at']?></td>
		    			<td><input type="checkbox"></td>
		    			<td><img src="delete_icon.png"></td>
		    		</tr>
<?}?>
			    	</tbody>

			    </table>
		    
		  	</div>
		  </div>
	  <div id="subjects-4">
	    <div class="message_body">
	    	<div class="fan_message" style="border:1px solid black; width:100%; height:300px">
		  			<?php
		  				foreach($blog_messages as $message)
		  				{
		  					echo "<div class='mess_div div{$message["id"]}'>"
		  							."From: ".$message['first_name']." ".$message['last_name']."<br>"."Sent at: ".$message['created_at']."<br>"."Message:<br>".$message['content']."</div>";
		  				}
		  		
		  			?>
							<textarea class="response_content"></textarea>
							<input type="submit" value="respond">
						</div>
		
		</div>
	    <table class="message_info">
	    	<thead>
	    		<th>User Name</th>
	    		<th>Email</th>
	    		<th>Date Received</th>
	    		<th>Response Sent</th>
	    		<th>Delete</th>
	    	</thead>
	    	<tbody>
	  <?php
	// $query = "SELECT messages.*, users.first_name, users.last_name, users.email FROM messages LEFT JOIN users ON users.id = messages.user_id WHERE messages.message_type = 'blog' ORDER BY id DESC;";
	// $messages = fetch_all($query);
	foreach($blog_messages as $message)
	{
?>
	    		<tr class=<?php echo ('row'.$message['id'])?>>
	    			<td><? echo $message['first_name']." ".$message['last_name'];?></td>
	    			<td><?echo $message['email'];?></td>
	    			<td><?echo $message['created_at']?></td>
	    			<td><input type="checkbox"></td>
	    			<td><img src="delete_icon.png"></td>
	    		</tr>
<?}?>
	    	</tbody>
	  </div>
	</div>
</body>
</html>