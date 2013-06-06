<?php

session_start();


require("connection.php");

if(isset($_POST['action']) and $_POST['action'] == 'create_message')
{
	$query = "INSERT INTO messages (user_id, content, message_type, created_at) VALUES ('".mysql_real_escape_string($_SESSION['user']['id'])."','".mysql_real_escape_string($_POST['message_content'])."','".mysql_real_escape_string($_POST['message_type'])."', NOW())";
	mysql_query($query);
	// echo $query;
	header("Location: contact.php");
}
// else{
// 	echo "Fail";
// }
?>