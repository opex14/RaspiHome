<?php
if(!defined('RASPIHOME')) die('USE MAIN SCRIPT!');

include_once __DIR__ . '/led.class.php';

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

?>