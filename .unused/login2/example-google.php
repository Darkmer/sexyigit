<?php
# Logging in with Google accounts requires setting special identity, so this example shows how to do it.
require 'openid.php';
try {
    # Change 'localhost' to your domain name.
    $openid = new LightOpenID('sexyigit.com');
    if(!$openid->mode) {
        if(isset($_GET['login'])) {
            $openid->identity = 'http://steamcommunity.com/openid';
            header('Location: ' . $openid->authUrl());
        }
?>
<form action="?login" method="post">
    <button>Login with Steam</button>
</form>
<?php
    } elseif($openid->mode == 'cancel') {
        echo 'User has canceled authentication!';
    } else {
        echo 'User ' . ($openid->validate() ? $openid->identity . ' has ' : 'has not ') . 'logged in.';
		
		var $steamId64 = substr($openid->identity, -17);
		$data_GetPlayerSummaries = file_get_contents('http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=BB1942B65ECC5A5AB33F1F3BEABC2BBF&steamids=' . $steamId64);
    }
} catch(ErrorException $e) {
    echo $e->getMessage();
}
