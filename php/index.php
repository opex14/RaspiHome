<?php
require 'wemo/models/Device.php';
require 'wemo/models/Outlet.php';
require 'Smart.class.php';
define('RASPIHOME', true);
$output = array();
header("content-type: text/javascript");

if (!empty($_GET['d']) && !empty($_GET['a'])) {
	$d = $_GET['d'];
	$a = $_GET['a'];
} else {
	header('HTTP/1.0 500 Internal Server Error');	
	die('WRONG');
}
if (isset($_GET['c'])) {
	$c = $_GET['c'];
}
if ($d == 'led') {
		
	$led = new Led();
	
	if ($a == 'send') {
		if (!empty($_GET['c'])) {
		$output = $led->Set($_GET['c']);
		} else {
			header('HTTP/1.0 500 Internal Server Error');	
			die('WRONG');
		}
	} elseif ($a == 'status') {
		$output = $led->status;
	} elseif ($a == 'switch') {
		if ($led->status['POWER'] == 1) {
			$output = $led->Set('POWER=0');
		} else {
			$output = $led->Set('POWER=1');
		}
	}
} elseif ($d == 'wemo') {

$outlet = new \wemo\models\Outlet('192.168.1.235');

	if($a == 'switch') {
		if($outlet->getIsOn()) {
			if($outlet->setIsOn(false)) $output = 'OK'; else $output = 'FAIL';
		} else {
			if($outlet->setIsOn(true)) $output = 'OK'; else $output = 'FAIL';
		}
	} elseif($a == 'on') {
			if($outlet->setIsOn(true)) $output = 'OK'; else $output = 'FAIL';
	}
 elseif($a == 'off') {
			if($outlet->setIsOn(false)) $output = 'OK'; else $output = 'FAIL';
	}
 elseif($a == 'status') {
			if($outlet->getIsOn()) $output = '1'; else $output = '0';
	}	
	if ($output == 'FAIL'){
	header('HTTP/1.0 500 Internal Server Error');	
	}
} elseif($d == 'microlab') {
	if ($a == 'status') {
		$output = json_decode(file_get_contents('sound_status.json'), true);
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
	$lirc = new Lirc('Microlab');
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
	
} elseif($d == 'radio') {
	include 'radio.php';
} else {
	header('HTTP/1.0 500 Internal Server Error');	
	die('WRONG Device');
}

    if(isset($_GET['callback']))
    {
        echo $_GET['callback']. '(' . json_encode($output, JSON_FORCE_OBJECT) . ');';
    } else {
		echo json_encode($output);
	}

?>