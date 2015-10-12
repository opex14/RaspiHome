<?php
if(!defined('RASPIHOME')) die('USE MAIN SCRIPT!');
include __DIR__ . '/config.php';

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
	$a = escapeshellcmd($a);
    
    $output = SendPi($a, $d, $c, $t);

	$snd_switched = false;
	if ($t > 0) {if ($t % 2 != 0) {$snd_switched = true;}}
	if ($snd_switched) {
		SwitchSave($a);
	}
	
	}
    
function SendPi($c, $r, $m, $t){
    global $cfg;
$ch = curl_init($cfg['url']."?c=$c&r=$r&m=$m&t=$t");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_TIMEOUT, 1);
$response = curl_exec($ch);
curl_close($ch);
if ($response == 'OK') {
	return true;
} else {
	suicide($response);
}
}
    
function SwitchSave($c) {
		if ($c == 'POWER' || $c == 'MODE' || $c == 'INPUT' || $c == 'MUTE') {
			$status = json_decode(file_get_contents(__DIR__ .'/sound_status.json'), true);
			
			if($c == 'INPUT') {$status['input'] = !$status['input'];}
			if($c == 'POWER') {$status['power'] = !$status['power'];}
			if($c == 'MUTE') {$status['mute'] = !$status['mute'];}
			if($c == 'MODE') {$status['mode'] = !$status['mode'];}
			
			file_put_contents(__DIR__ .'/sound_status.json', json_encode($status));
		}
	}
?>