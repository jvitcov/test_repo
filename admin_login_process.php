<?
session_start();
require_once("connection.php");

if(isset($_POST['action']) and $_POST['action'] =="login")
{
	loginAction();
}
else
{
	//assume that the user wants to log off
	session_destroy();
	header("location: index.php");
}

function loginAction()
{
	$errors=array();
	if(!(isset($_POST['email']) and filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)))
	{
		$errors[] = "email is invalid";
	}
	if(!(isset($_POST['password']) and strlen($_POST['password']) > 6))
	{
		$errors[] = "password does not match user email";
	}
	if(count($errors) > 0)
	{
		$_SESSION['login_errors'] = $errors;
		header('Location: admin_login.php');
		exit;
	}
	else
	{
		//check if email and password given are valid to user
		$query = "SELECT * FROM admins WHERE email='{$_POST['email']}' AND password='".md5($_POST['password'])."'";
		$admins = fetch_all($query);
		if(count($admins)>0)
		{
			$_SESSION['logged_in'] = true;
            $_SESSION['admin']['email'] = $admins[0]['email'];
            $_SESSION['admin']['id'] = $admins[0]['id'];
            header("location: admin.php");
			exit;
		}
		else
		{
			$errors[]="Invalid login information";
			$_SESSION['login_errors'] = $errors;
			header('Location: admin_login.php');
			exit;
		}
	}
}
?>