<?php
if(!defined('RASPIHOME')) die('USE MAIN SCRIPT!');
include __DIR__ . '/config.php';
$c = (isset($c)) ? intval($c) : false;
$radios = json_decode(file_get_contents(__DIR__ . '/radio_list.json'), true);
$rstatus = json_decode(file_get_contents(__DIR__ . '/radio_status.json'), true);
if ($a == 'play') {
	SendPi('play', $radios[$c]['url']);
	$output = array('status'=>'play', 'title' => $radios[$c]['title'], 'track' => 'Unknown', 'id' => $c);
	file_put_contents(__DIR__ . '/radio_status.json', json_encode($output));
	flush();

} elseif ($a == 'stop') {
	SendPi('stop');
	$output = array('status'=>'stop', 'title' => 'Радио выключено', 'track' => '', 'id' => null);
	file_put_contents(__DIR__ . '/radio_status.json', json_encode($output));
	
} elseif ($a == 'status') {
	
	$output = $rstatus;
	$output['list'] = CleanArr($radios);

} elseif ($a == 'list') {
	$output['list'] = $radios;
	$output['current'] = $rstatus['id'];
} elseif ($a == 'delete') {
	if ($c === false) {header('HTTP/1.0 500 Internal Server Error');die('Specify id');} 
	unset($radios[$c]);
	file_put_contents(__DIR__ . '/radio_list.json', json_encode($radios, JSON_FORCE_OBJECT));
	$output = $radios;

} elseif ($a == 'add') {
	if (empty($_POST['title']) || empty($_POST['url'])) {header('HTTP/1.0 500 Internal Server Error');die('No required data');}
	$newradio = array('title' => $_POST['title'], 'url' => $_POST['url']);
	$radios[] = $newradio;
	file_put_contents(__DIR__ . '/radio_list.json', json_encode($radios, JSON_FORCE_OBJECT));
	$output = $radios;

} elseif ($a == 'url') {
	if (empty($_POST['url'])) {header('HTTP/1.0 500 Internal Server Error');die('No url');}
	PlayUrl($_POST['url']);
	$rtitle = 'URL: '.parse_url($_POST['url'], PHP_URL_HOST);
	$output = array('status'=>'play', 'title' => $rtitle, 'track' => 'Unknown', 'id' => null);
	file_put_contents(__DIR__ . '/radio_status.json', json_encode($output));

} else {
	header('HTTP/1.0 500 Internal Server Error');	
	die('WRONG');
}

function SendPi($a, $url = ''){
    global $cfg;
	$ch = curl_init($cfg['url']."?a=".$a);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_TIMEOUT, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, array("url" => $url));
$response = curl_exec($ch);
curl_close($ch);
if ($response == 'OK') {
	return true;
} else {
	suicide($response);
}
}

function PlayUrl($url) {
	shell_exec('killall mplayer');
	shell_exec('rm /tmp/mplayer-fifo');
	shell_exec('mkfifo /tmp/mplayer-fifo');
	shell_exec(__DIR__ .'/play.sh "' . $url . '" </dev/null >/dev/null 2>&1 &');
}
function CleanArr($data) {
	$output = array();
	foreach ($data as $id => $elm) {
		$output[$id] = $elm['title'];
	}
	return $output;
}
?>