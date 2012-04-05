<?PHP
session_start();

//If a user tries to enter this page and is not logged in
//it redirects them to the login page
if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
	header ("Location: login.php");
}
?>

<html>

<head>
<title>Basic Login Script</title>
</head>

<!-- Lists the options for the user now that they are logged in-->
<body>
User Logged in <br>
<a href="/messages/inbox.php">Check Private Messages</a> <br>
<a href="/backpack/index.php">Backpack Lookup Tool</a><br><br>
<A HREF = logout.php>Log out</A>
</body>

</html>
