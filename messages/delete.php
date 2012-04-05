<?php

require "connect_to_database.php";

session_start();

//pulls message ID from inbox
$message_to_delete = $_POST['id'];

//queries database for delete
$result = mysql_query("DELETE FROM Messages WHERE id = '$message_to_delete'") OR die("Could not delete the message: <br>".mysql_error());

echo 'Message deleted';

echo '<form name="backfrm" method="post" action="inbox.php">';
echo '<input type="submit" value="Back to Inbox">';
echo '</form>';
?>

