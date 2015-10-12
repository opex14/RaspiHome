<?php

if (isset($_GET['a'])) {
$a = $_GET['a'];    
} else {
	header('HTTP/1.0 500 Internal Server Error');	
	die('NO ACTION');
}


if ($a == 'play') {

    if (isset($_POST['url']) && !filter_var($_POST['url'], FILTER_VALIDATE_URL) === false) {
		PlayUrl($_POST['url']);
	} else {
	header('HTTP/1.0 500 Internal Server Error');	
	die('WRONG URL');
	}
    
} elseif ($a == 'stop') {
    Stop();
} else {
	header('HTTP/1.0 500 Internal Server Error');	
	die('WRONG ACTION');
}

function Stop() {
    exec('killall mplayer');
}

function PlayUrl($url) {
	exec(__DIR__ .'/play.sh "' . $url . '" </dev/null >/dev/null 2>&1 &');
}

echo 'OK';
?>