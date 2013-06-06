<?php
session_start();
require_once("connection.php");
if(isset($_POST['action']) and $_POST['action'] =="login")
{
	loginAction();
}
elseif(isset($_POST['action']) and $_POST['action'] =="register")
{
	registerAction();
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
		header('Location: index.php');
		exit;
	}
	else
	{
		//check if email and password given are valid to user
		$query = "SELECT * FROM users WHERE email='{$_POST['email']}' AND password='".md5($_POST['password'])."'";
		$users = fetch_all($query);
		if(count($users)>0)
		{
			$_SESSION['logged_in'] = true;
            $_SESSION['user']['first_name'] = $users[0]['first_name'];
            $_SESSION['user']['last_name'] = $users[0]['last_name'];
            $_SESSION['user']['email'] = $users[0]['email'];
            $_SESSION['user']['id'] = $users[0]['id'];
            header("location: index.php");
			exit;
		}
		else
		{
			$errors[]="Invalid login information";
			$_SESSION['login_errors'] = $errors;
			header('Location: index.php');
			exit;
		}
	}
}

function registerAction()
{
	$errors = array();
	if(!(isset($_POST['first_name']) and ctype_alpha($_POST['first_name'])))
	{
		$errors[] = "first name is invalid";
	}
	if(!(isset($_POST['last_name']) and ctype_alpha($_POST['last_name'])))
	{
		$errors[] = "last name is invalid";
	}
	if(!(isset($_POST['email']) and filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)))
	{
		$errors[] = "email is invalid";
	}
	if(!(isset($_POST['password']) and strlen($_POST['password']) > 6))
	{
		$errors[] = "password must be greater than 6 characters";
	}
	if(isset($_POST['confirm_password']) and $_POST['password'] !== $_POST['confirm_password'])
	{
		$errors[] = "password does not match";
	}
	// if(isset($_POST['birthday']) and !preg_match('/^[0-1][0-9]\/[0-3][0-9]\/[1-2][0-9]{3}/', $_POST['birthday']))
	// {
	// 	$errors[] = "Brithday must be in MMDDYYYY Format";
	// }
	if(count($errors)>0)
	{	
		$_SESSION['registration_errors'] = $errors;
		header("Location: register.php");
		exit; 
	}
	else
	{
		//see if email is already taken
		$query = "SELECT * FROM users WHERE email = '{$_POST['email']}'";
		$users=fetch_all($query);
		if(count($users)>0)
		{
			$errors[]="This email is already registered.";
			$_SESSION['registration_errors'] = $errors;
			header("Location: register.php");
			exit; 
		}
		else
		{
			$query = "INSERT INTO users (first_name, last_name, email, password, created_at) VALUES ('".mysql_real_escape_string($_POST['first_name'])."','".mysql_real_escape_string($_POST['last_name'])."','".mysql_real_escape_string($_POST['email'])."','".mysql_real_escape_string(md5($_POST['password']))."', NOW())";
			mysql_query($query);
			// $_SESSION['message']="User was succefully created";
			loginAction();
			header("Location: index.php");
		}
	}	
}
?>