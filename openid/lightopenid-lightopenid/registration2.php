<?php
require "connect_to_database.php";

//Runs this code is the form was filled out and submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$uname = $_POST['username'];
	$pword = $_POST['password'];
	$steamID = $_POST['sID'];
	$email = $_POST['email'];
	$location = $_POST['location'];

	$SQL = "SELECT * FROM Accounts WHERE userName = '$uname'";
	$result = mysql_query($SQL);
	$num_rows = mysql_num_rows($result);

	if ($num_rows > 0) {
		$errorMessage = "Username already taken";
	}
	else {

		//Inserts user into the database
		$SQL = "INSERT INTO Accounts VALUES ('$email','$uname','$location',timestamp(NOW()),'$pword',$steamID)";

		$result = mysql_query($SQL);
		
		//Creates the user's session and sets them to logged in and set their username in the session cookie
		session_start();
		$_SESSION['login'] = "1";
		$_SESSION['username'] = $uname;

		//Redirects to the user's homepage
		header ("Location: /../../userhomepage.php");
	}
}
?>

<!-- The form which takes the user's information when they register -->
<FORM NAME ="form1" METHOD ="POST" ACTION ="registration2.php">
    Username: <INPUT TYPE = "TEXT" Name ="username"  value="<?PHP print $uname;?>" maxlength="20"><br>
	Password: <INPUT TYPE = "PASSWORD" Name ="password"  value="<?PHP print $pword;?>" maxlength="16"><br>
	E-Mail: <INPUT TYPE = "TEXT" Name ="email"  value="<?PHP print $email;?>" maxlength="254"><br>
	Location: <INPUT TYPE = "TEXT" Name ="location"  value="<?PHP print $location;?>" maxlength="200"><br>
	<INPUT TYPE = "HIDDEN" Name = "sID" value ="<?PHP print $_GET['steamID'];?>">
	<br>
	<INPUT TYPE = "Submit" Name = "Submit1"  VALUE = "Register">
</form>