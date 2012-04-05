<?php
session_start();

//performs a series of checks to see if message is suitable for sending
class validateMessage {
	private $user_name;
	private $pass_word;
	private $database;
	private $server;
	private $db_handle;
	private $db_found;
	private $title;
	private $to;
	private $content;
	private $from;
	private $userthere;
	
	function __construct() {
		$user_name = "rondaa";
		$pass_word = "taunufiji";
		$database = "rondaa";
		$server = "mysql.writir.com";

		//connect to DB
		$db_handle = mysql_connect($server, $user_name, $pass_word);
		$db_found = mysql_select_db($database, $db_handle);
	}
	
	function validate() {
		$title=$_POST['title'];
		$to=$_POST['message_to'];
		$content=$_POST['message_contents'];
		$from=$_POST['message_from'];

		$userthere = "SELECT userName FROM Accounts WHERE userName = '".$to."'";

		//check to see if designated user exists in DB
		if( mysql_num_rows( mysql_query( $userthere ) ) == 0 ){
			die("The user the message is being sent to does not exist. Try again please.<br>
			<form name=\"back\" action=\"send_message.php\" method=\"post\">
			<input type=\"submit\" value=\"Try Again\">
			</form> ");
		}
		
		//checks for empty body
		elseif(strlen($content) < 1){
			die("Your message contains no characters so is invalid. Try again please.<br>
			<form name=\"back\" action=\"send_message.php\" method=\"post\">
			<input type=\"submit\" value=\"Try Again\">
			</form> ");
		}
		
		//if no title, add (no subject)
		elseif(strlen($title) < 1){
			mysql_query("INSERT INTO Messages (from_user, to_user, title, contents,date_sent, isRead) VALUES ('$from','$to','(No Subject)','$content',timestamp(NOW()),0)") OR die("Could not send the message: <br>".mysql_error());
			echo "The Message Was Successfully Sent!";
		}
		
		//send message
		else {
			mysql_query("INSERT INTO Messages (from_user, to_user, title, contents,date_sent, isRead) VALUES ('$from','$to','$title','$content',timestamp(NOW()),0)") OR die("Could not send the message: <br>".mysql_error());
			echo "The Message Was Successfully Sent!";
		}
	}
}

$validate_message = new validateMessage();
$validate_message->__construct();
$validate_message->validate();
?>

<form name="back" action="inbox.php" method="post">
<input type="submit" value="Back to The Inbox">
</form>
