<?php

//Include for openid third party library
require 'openid.php';

try {

	//Creates openid with anchor in our website
	$openid = new LightOpenID('sexyigit.com');
	
	//Redirects user to login with steam
	if(!$openid->mode) {
		if(isset($_GET['login'])) {
			$openid->identity = 'http://steamcommunity.com/openid';
			header('Location: ' . $openid->authUrl());
		}
	} elseif($openid->mode == 'cancel') {
		echo 'User has canceled authentication!';
	} else {
		echo 'SUCESSFUL LOGIN';
		echo 'User ' . ($openid->validate() ? $openid->identity . ' has ' : 'has not ') . 'logged in.';
		$steamID = $openid->identity;
		$steamID = substr($steamID,-17);
		echo $steamID;
		//Redirects anyone that sucessfully logged in to the next registration page
		//this carries along the steamID for inserting into the database later
		header ('Location: /openid/lightopenid-lightopenid/registration2.php?steamID='.$steamID);
	}
} catch(ErrorException $e) {
	echo $e->getMessage();
}
	


?>

<!-- Creates information and button to redirect to steam log in -->
<form name = "form2" action="?login" method="POST">	
	Now we will validate and get your steam ID once you log in with steam below.<br>
	You will be redirected to the steam login page. Please enter your <i>STEAM</i> Username and Password<br>
	
	
	<button>Login with Steam</button>
</form>

