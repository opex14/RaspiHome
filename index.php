<!DOCTYPE html>
<html lang="ru">
  <head>
	<title>RaspiHome</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">   
<meta name="mobile-web-app-capable" content="yes">
<link rel="shortcut icon" href="circle.png">
<link rel="apple-touch-icon" href="circle.png"/>
 
 
<link rel="stylesheet" href="frameworks/css/bootstrap.min.css">
<link rel="stylesheet" href="frameworks/css/bootstrap-switch.css">
<link rel="stylesheet" href="frameworks/css/bootstrap-slider.min.css">
<link rel="stylesheet" href="frameworks/css/bootstrap-select.min.css">
<link rel="stylesheet" href="frameworks/css/style.css">

<script src="frameworks/js/jquery-1.11.3.min.js"></script>
<script src="frameworks/js/jquery-migrate-1.2.1.min.js"></script>

<script src="frameworks/js/bootstrap.js"></script>
<script src="frameworks/js/bootstrap-switch.js"></script>
<script src="frameworks/js/bootstrap-slider.min.js"></script>
<script src="frameworks/js/bootstrap-select.min.js"></script>

<div class="loading-ov"></div>
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top" id="navbar">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
       <a class="navbar-brand" href="#"><span id="answersrv" class="label label-default">RaspiHome</span></a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav" id="menuelms">
	  <li id="menu_show_all" class="menu_element"><a href="#show_all">Всё</a></li>
<?php 

$modules = Modules();
echo MakeMenu($modules); 

?>
      <li id="menu_radio" class="menu_element"><a href="settings.php">Настройки</a></li>
    </ul>
	</div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>





<?php 
IncludeHeader($modules);
ModulesInclude($modules);


?>

</body>
	
<script src="frameworks/js/smart.js"></script>
</html>

<?php

function ModulesInclude($modules) {
    foreach ($modules as $mid => $minf) {
		if ($minf['page']) {
			$module = __DIR__ .'/modules/'.$mid;
            $mpage = $module.'/mod.page.php';
			
			include $mpage;
		}
	}
}

function IncludeHeader($modules) {
    foreach ($modules as $mid => $minf) {
        if ($minf['header']) {
			$module = __DIR__ .'/modules/'.$mid;
            $mpage = $module.'/mod.page.php';
			
			include $mpage;
        }
    }
}

function MakeMenu($modules) {
	$out = '';
    foreach ($modules as $mid => $minf) {
		if ($minf['menu']) {
			$out .= '<li id="menu_'.$mid.'" class="menu_element"><a href="#'.$mid.'">'.$minf['title'].'</a></li>';
		}
	}
	return $out;
}

function Modules() {
    $mdir = __DIR__ .'/modules';
    $out = array();
    $files = scandir($mdir);
    foreach ($files as $file) {
        if ($file == '..' || $file == '.') continue;
        $module = $mdir.'/'.$file;
        if (is_dir($module)) {
            $minfo = $module.'/mod.info.php';
            $mpage = $module.'/mod.page.php';
            if (file_exists($minfo)) {
				include $minfo;
				if ( empty($inf) || ($inf['page'] == true && !file_exists($mpage)) || isset($inf['enabled']) && !$inf['enabled']) continue;
				$out[$file] = $inf;
            }
        }
    }
    return $out;
}

?>