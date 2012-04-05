<?php
session_start();
//require "database.php";
$user=$_SESSION['username'];
?>

<form name="message" action="validate_message.php" method="post">
Title: <input type="text" name="title">  <br>
To: <input type="text" name="message_to">  <br>
Message: 
<br>

<textarea rows="20" cols="50" name="message_contents">
</textarea>

<?php
echo '<input type="hidden" name="message_from" value="'.$user.'"><br>';
?>

<input type="submit" value="Submit">
</form>