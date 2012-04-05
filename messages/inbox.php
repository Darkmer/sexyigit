<?php

class Inbox {
	private $user;
	private $user_name;
	private $pass_word;
	private $database;
	private $server;
	private $db_handle;
	private $db_found;
	private $get_messages;
	private $get_messages2;
	private $num_messages;
	private $row;
	private $count;
	
	public function __construct($username) {
		$this->user = $username;

		//Connects to database
		$this->user_name = "rondaa";
		$this->pass_word = "taunufiji";
		$this->database = "rondaa";
		$this->server = "mysql.writir.com";
		$this->db_handle = mysql_connect($this->server, $this->user_name, $this->pass_word);
		$this->db_found = mysql_select_db($this->database, $this->db_handle);
	}
	
	function displayMessages() {

		//get the messages sent to the user that constructed this inbox
		$this->get_messages = mysql_query("SELECT id FROM Messages WHERE to_user='$this->user' ORDER BY date_sent ASC") or die(mysql_error());
		$this->get_messages2 = mysql_query("SELECT * FROM Messages WHERE to_user='$this->user' ORDER BY date_sent ASC") or die(mysql_error());
		$this->num_messages = mysql_num_rows($this->get_messages);
		
		// display each message title with a link to their contents
		echo '<ol>';
		for($this->count = 1; $this->count <= $this->num_messages; $this->count++)
		{
			echo '<li>';
			$this->row = mysql_fetch_array($this->get_messages2);
			//if the message is not read, show "(new)" after the title
			//if the message was read already just show the title.
			if($this->row['isRead'])
			{
				echo '<a href="read_message.php?id=' . $this->row['id'] . '">' . $this->row['title'] . '</a>';
			}
			if(!($this->row['isRead']))
			{
				echo '<a href="read_message.php?id=' . $this->row['id'] . '">' . $this->row['title'] . '(NEW)' . '</a>';
			}
			echo '</li>';
		}
	}

	//Constructs the buttons to send a new message or return to the user homepage
	function displayButtons() {
		echo '</ol>';

		echo '<form name="newmsgfrm" method="post" action="send_message.php">';
		echo '<input type="submit" value="Send a New Message">';
		echo '</form>';

		echo '<form name="backfrm" method="post" action="../userhomepage.php">';
		echo '<input type="submit" value="Back to Home">';
		echo '</form>';
	}
}

//Constructs and uses the inbox based on the user that arrived
session_start();
$inbox = new Inbox($_SESSION['username']);
$inbox->displayMessages();
$inbox->displayButtons();

?>