<?php
if(!defined('RASPIHOME')) die('USE MAIN SCRIPT!');

include_once __DIR__ .'/models/Device.php';
include_once __DIR__ .'/models/Outlet.php';

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

?>