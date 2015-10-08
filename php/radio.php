<?php
if(!defined('RASPIHOME')) die('USE MAIN SCRIPT!');
$c = (isset($c)) ? intval($c) : false;
$radios = json_decode(file_get_contents('radio_list.json'), true);
$rstatus = json_decode(file_get_contents('radio_status.json'), true);
if ($a == 'play') {
	PlayUrl($radios[$c]['url']);
	$output = array('status'=>'play', 'title' => $radios[$c]['title'], 'track' => 'Unknown', 'id' => $c);
	file_put_contents('radio_status.json', json_encode($output));
	flush();

} elseif ($a == 'stop') {
	shell_exec('killall mplayer');
	$output = array('status'=>'stop', 'title' => 'Радио выключено', 'track' => '', 'id' => null);
	file_put_contents('radio_status.json', json_encode($output));
	
} elseif ($a == 'status') {
	
	$output = $rstatus;
	$output['list'] = CleanArr($radios);

} elseif ($a == 'list') {
	$output['list'] = $radios;
	$output['current'] = $rstatus['id'];
} elseif ($a == 'delete') {
	if ($c === false) {header('HTTP/1.0 500 Internal Server Error');die('Specify id');} 
	unset($radios[$c]);
	file_put_contents('radio_list.json', json_encode($radios, JSON_FORCE_OBJECT));
	$output = $radios;

} elseif ($a == 'add') {
	if (empty($_POST['title']) || empty($_POST['url'])) {header('HTTP/1.0 500 Internal Server Error');die('No required data');}
	$newradio = array('title' => $_POST['title'], 'url' => $_POST['url']);
	$radios[] = $newradio;
	file_put_contents('radio_list.json', json_encode($radios, JSON_FORCE_OBJECT));
	$output = $radios;

} elseif ($a == 'url') {
	if (empty($_POST['url'])) {header('HTTP/1.0 500 Internal Server Error');die('No url');}
	PlayUrl($_POST['url']);
	$rtitle = 'URL: '.parse_url($_POST['url'], PHP_URL_HOST);
	$output = array('status'=>'play', 'title' => $rtitle, 'track' => 'Unknown', 'id' => null);
	file_put_contents('radio_status.json', json_encode($output));

} else {
	header('HTTP/1.0 500 Internal Server Error');	
	die('WRONG');
}

function PlayUrl($url) {
	shell_exec('killall mplayer');
	shell_exec('rm /tmp/mplayer-fifo');
	shell_exec('mkfifo /tmp/mplayer-fifo');
	shell_exec('./play.sh "' . $url . '" </dev/null >/dev/null 2>&1 &');
}
function CleanArr($data) {
	$output = array();
	foreach ($data as $id => $elm) {
		$output[$id] = $elm['title'];
	}
	return $output;
}
?>