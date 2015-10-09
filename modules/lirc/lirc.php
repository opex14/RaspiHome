<?php
if(!defined('RASPIHOME')) die('USE MAIN SCRIPT!');

if (!empty($_GET['d'])) {
	$d = $_GET['d'];
} else {	
	suicide('No device entry');
}

include_once __DIR__ . '/lirc.class.php';

	if ($a == 'status') {
		$output = json_decode(file_get_contents(__DIR__ .'/sound_status.json'), true);
	} else {
		
	if (!empty($_GET['c'])) {
		$c = escapeshellcmd($_GET['c']);
	} else {
		$c = 'SEND_ONCE';
	}
	if (!empty($_GET['t'])) {
		$t = intval($_GET['t']);
	} else {
		$t = 1;
	}
	$lirc = new Lirc(escapeshellcmd($d));
	$snd_switched = false;
	if ($t > 0) {if ($t % 2 != 0) {$snd_switched = true;}}
	if ($snd_switched) {
		$lirc->SwitchSave($a);
	}
	$a = escapeshellcmd($a);
	$output = $lirc->Send($a, $c, $t);	
	
	if ($output != 'OK'){
	header('HTTP/1.0 500 Internal Server Error');	
	}
	}

?>