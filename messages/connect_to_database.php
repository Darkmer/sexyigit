<?PHP
$user_name = "rondaa";
$pass_word = "taunufiji";
$database = "rondaa";
$server = "mysql.writir.com";
//connect to database
mysql_connect($server, $user_name, $pass_word) or die ('Database Connection Failure: ' . mysql_error());
$db_found = mysql_select_db($database);
?>