<?php

if (isset($_GET['c']) && isset($_GET['r'])) {
$c = escapeshellcmd($_GET['c']);    
$r = $_GET['r'];    
} else {
	header('HTTP/1.0 500 Internal Server Error');	
	die('NO ACTION');
}

$m = (isset($_GET['m'])) ? $_GET['m'] : 'SEND_ONCE';

if (!($m == 'SEND_ONCE')) {
	header('HTTP/1.0 500 Internal Server Error');	
	die('WRONG MODE');
}

if (isset($_GET['t'])) {
    $t = (intval($_GET['t']) > 0) ? intval($_GET['t']) : 1;
} else {
    $t = 1;
}
$output = Send($c, $r, $m, $t);
if ($output == 'OK') {
    echo 'OK';
} else {
	header('HTTP/1.0 500 Internal Server Error');	
	die($output);
}

function Multiply($cmd, $times = 1) {
	$arr = array();
	for ($i = 1;$i <= $times;$i++) {
	$arr[] = $cmd;}
	return implode(' ', $arr);
	}
    
function Send($cmd, $remote, $mode = 'SEND_ONCE', $times = 1) {
	$avar = 4;
	if ($mode == 'SEND_ONCE' && $times > 1) {
		$cmd = Multiply($cmd, $times);
	}
	exec('irsend '.$mode.' '.$remote.' '.$cmd, $answer, $avar);
	if ($avar == 0) {
		return 'OK';
	} else {
		return $answer;
	}
}
?>