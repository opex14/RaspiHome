<?php
if(!defined('RASPIHOME')) die('USE MAIN SCRIPT!');

class Led
{
	private $ip = "127.0.0.1";
	private $port = 2025;
	
	public $status;
	
	private $socket;
	
	function __construct() {
		$this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
		if (socket_connect($this->socket, $this->ip, $this->port)) {
			$this->StatusUpdate();
			return true;
			} else {return false;}
	}
	
	function __destruct() {
		socket_close($this->socket);
	}
	
	
	public function Send($cmd) {
		if (is_array($cmd)) {
		$sendc = $this->ArrSnd($cmd);} else {$sendc = $cmd."\r\n";}
		if (socket_write($this->socket, $sendc)) {
		$answer = socket_read($this->socket, 200, 1);
		return rtrim($answer, "\r\n");
		} else {return false;}
	}
	
	private function hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = $r . "," . $g . "," . $b;
   return $rgb;
	}
	
	private function rgb2hex($rgb) {
	$rgbar = explode(',', $rgb);
	$r = $rgbar[0];
	$g = $rgbar[1];
	$b = $rgbar[2];
	
	if (is_array($r) && sizeof($r) == 3)
    list($r, $g, $b) = $r;
    $r = intval($r); $g = intval($g);
    $b = intval($b);
    $r = dechex($r<0?0:($r>255?255:$r));
    $g = dechex($g<0?0:($g>255?255:$g));
    $b = dechex($b<0?0:($b>255?255:$b));
    $color = (strlen($r) < 2?'0':'').$r;
    $color .= (strlen($g) < 2?'0':'').$g;
    $color .= (strlen($b) < 2?'0':'').$b;
    return '#'.$color;}
	
	public function Set($cmd) {
		if (!is_array($cmd)) {
				$cmd = $this->StrArr($cmd);
			}
			
				if(!empty($cmd['COLOR'])) {
				if(substr($cmd['COLOR'], 0, 1) == '#') $cmd['COLOR'] = $this->hex2rgb($cmd['COLOR']);
				if(strpos($cmd['COLOR'], ',') == false) $cmd['COLOR'] = $this->hex2rgb('#'.$cmd['COLOR']);}
			if(!empty($cmd['SPEED'])) $cmd['SPEED'] = 127-$cmd['SPEED'];
			
		return $this->Send($cmd);
		
			// $cms = explode(';', $cmd);
			// $send = array();
			// $possible = array('COLOR','BRIGHTNESS','POWER','PAUSE','MASTERMODE','MOD','EFFECT','SPEED');
			// foreach ($cms as $act) {
				// $var = explode('=', $act);
				// if (in_array($var[0], $possible) && isset($var[1])) {
					// if ($var[0] == 'COLOR' && strpos($var[1], ',') == false) {
						// $send[$var[0]] = $this->hex2rgb('#'.$var[1]);
					// } else {$send[$var[0]] = $var[1];}
				// }
			// }
			// if (!empty($send)) {
				// return $this->Send($send);
			// }
	}
	
	private function ArrSnd($arr) {
		$tmp = array();
		foreach ($arr as $var => $val) {
			$tmp[] = $var.'='.$val;
		}
		return implode(';', $tmp)."\r\n";
	}
	
	private function StrArr($str) {
		$tmp = array();
		$split = array_filter(explode(';', $str));
		foreach ($split as $cmd) {
			$var = explode('=', $cmd);
			$tmp[$var[0]] = $var[1];
		}
		return $tmp;
	}
	
	private function StatusUpdate() {
		if ($raw = $this->Send('STATUS')){
		$status = array();
		$exp = explode(';', $raw);
		foreach ($exp as $str) {
			$vals = explode('=', $str);
			$status[$vals[0]] = $vals[1];
		}
		$status['hex'] = $this->rgb2hex($status['COLOR']);
		$status['SPEED'] = 127-$status['SPEED'];
		$this->status = $status;
		return true;
		} else {return false;}
	}
}

?>