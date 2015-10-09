<?php
if(!defined('RASPIHOME')) die('USE MAIN SCRIPT!');


class Lirc
{
	private $remote;
	private $mode;
	
	function __construct($remote) {
		$this->remote = $remote;
	}
	
	public function Send($cmd, $mode = 'SEND_ONCE', $times = 1) {
		$avar = 4;
		if ($mode == 'SEND_ONCE' && $times > 1) {
			$cmd = $this->Multiply($cmd, $times);
		}
		exec('irsend '.$mode.' '.$this->remote.' '.$cmd, $answer, $avar);
		if ($avar == 0) {
			return 'OK';
		} else {
			return $answer;
		}
	}
	
	public function SwitchSave($c) {
		if ($c == 'POWER' || $c == 'MODE' || $c == 'INPUT' || $c == 'MUTE') {
			$status = json_decode(file_get_contents(__DIR__ .'/sound_status.json'), true);
			
			if($c == 'INPUT') {$status['input'] = !$status['input'];}
			if($c == 'POWER') {$status['power'] = !$status['power'];}
			if($c == 'MUTE') {$status['mute'] = !$status['mute'];}
			if($c == 'MODE') {$status['mode'] = !$status['mode'];}
			
			file_put_contents(__DIR__ .'/sound_status.json', json_encode($status));
		}
	}
	
	private function Multiply($cmd, $times = 1) {
	$arr = array();
	for ($i = 1;$i <= $times;$i++) {
	$arr[] = $cmd;}
	return implode(' ', $arr);
	}
}


?>