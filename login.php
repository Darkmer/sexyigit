<?PHP
require "connect_to_database.php";
$uname = "";
$pword = "";
$errorMessage = "";

//If the login information was entered and the login button pressed
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$uname = $_POST['username'];
	$pword = $_POST['password'];

	//Escapes from dangerous characters
	$uname = htmlspecialchars($uname);
	$pword = htmlspecialchars($pword);

	$SQL = "SELECT * FROM Accounts WHERE userName = '$uname' AND password = '$pword'";
	$result = mysql_query($SQL);
	$num_rows = mysql_num_rows($result);


	if ($result) {
		//If the user was found their session starts with the correct information
		if ($num_rows > 0) {
			session_start();
			$_SESSION['login'] = "1";
			$_SESSION['username'] = $uname;
			header ("Location: userhomepage.php");
		}
		//If that username or password was not found we direct them to registration
		if ($num_rows == 0) {
			session_start();
			$_SESSION['login'] = "";
			header ("Location: /openid/lightopenid-lightopenid/registration.php");
		}	
	}
	else {
		$errorMessage = "Error logging on";
	}

}



?>


<html>
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le styles -->
    <link href="/docs/assets/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <link href="/docs/assets/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
  </head>
<body>

<!-- Text fields and button for user to login with -->
<div class = "container">
<FORM NAME ="form1" METHOD ="POST" ACTION ="login.php">
Username: <INPUT TYPE = "TEXT" Name ="username"  value="<?PHP print $uname;?>" maxlength="20">
Password: <INPUT TYPE = "PASSWORD" Name ="password"  value="<?PHP print $pword;?>" maxlength="16">
<P align = center>
<INPUT TYPE = "Submit" Name = "Submit1"  VALUE = "Login">
</P>
</FORM>

<P>
<?PHP print $errorMessage;?>
</div>

</body>
</html>