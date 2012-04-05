<?php
require "connect_to_database.php";
session_start();
$user=$_SESSION['username'];

class readMessage {
	private $id;
	private $message;
	
	//Displays the selected message 
	function showMessage() {
		$id = $_GET['id'];

		//query DB to set messages to read, then select messages
		$message = mysql_query("UPDATE Messages SET isRead = 1 WHERE id =$id");
		$message = mysql_query("SELECT * FROM Messages WHERE id = $id");
		$message = mysql_fetch_assoc($message);

		echo "<h1>Title: ".$message['title']."</h1><br>";
		echo "<h3>From: ".$message['from_user']."<br><br></h3>";
		echo "<h3>Message: <br><br>".$message['contents']."<br></h3>";


		echo '<form name="deleteform" method="post" action="delete.php">';
		echo '<input type="submit" value="Delete Message">';
		echo '<input type="hidden" name = "id" value = "'.$id.'"><br>';
		echo '</form>';


		echo '<form name="backform" method="post" action="inbox.php">';
		echo '<input type="submit" value="Back to Inbox">';
		echo '</form>';
	}
}

$readMessage = new readMessage();
$readMessage->showMessage();
?>