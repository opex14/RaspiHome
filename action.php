<?php
define('RASPIHOME', true);
$module_dir = 'modules/';
$output = array();
header("content-type: text/javascript");

function suicide($txt) {
    header('HTTP/1.0 500 Internal Server Error');	
	die($txt);
}

if (!empty($_GET['m']) && !empty($_GET['a'])) {
	$m = $_GET['m'];
	$a = $_GET['a'];
} else {
	suicide('No required data');
}
if (isset($_GET['c'])) {
	$c = $_GET['c'];
} else {
    $c = null;
}

$module = $module_dir.$m.'/'.$m.'.php';

if (file_exists($module)) {
    include $module;
} else {
	suicide('Module not exists');
}

    if(isset($_GET['callback']))
    {
        echo $_GET['callback']. '(' . json_encode($output, JSON_FORCE_OBJECT) . ');';
    } else {
		echo json_encode($output);
	}

?>