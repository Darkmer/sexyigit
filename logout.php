<?PHP
	//Destroys the current session deleting the session cookie
	session_start();
	session_destroy();
?>

<html>

<head>
<title>Basic Login Script</title>
</head>

<body>
User Logged Out<br><br>
<a href="/login.php">Log in</a> <br>
<a href="/">Go home</a>
</body>

</html>
