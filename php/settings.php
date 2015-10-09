<?php
//print_r($_POST);
$snd = json_decode(file_get_contents('sound_status.json'), true);
$radios = json_decode(file_get_contents('radio_list.json'), true);
if (isset($_POST['action'])) {
	if ($_POST['action'] == 'sound') {
		$snd['power'] = ($_POST['power'] == 1) ? true : false;
		$snd['input'] = ($_POST['input'] == 1) ? true : false;
		$snd['mute'] = ($_POST['mute'] == 1) ? true : false;
		$snd['mode'] = ($_POST['mode'] == 1) ? true : false;
		file_put_contents('sound_status.json', json_encode($snd));
	} elseif ($_POST['action'] == 'radio') {
		if (isset($_POST['radio_del'])) {
			unset($radios[$_POST['radio_del']]);
		} else {
			foreach ($radios as $id => $data) {
				$t2 = $_POST['title-'.$id];
				$u2 = $_POST['url-'.$id];
				
				if ($data['title'] != $t2) {$radios[$id]['title'] = $t2;}
				if ($data['url'] != $u2) {$radios[$id]['url'] = $u2;}
			}
		}
		file_put_contents('radio_list.json', json_encode($radios, JSON_FORCE_OBJECT));
	}
}
//print_r($radios);
$sndse = array(
	'power' => ($snd['power']) ? ' selected="selected"' : '',
	'input' => ($snd['input']) ? ' selected="selected"' : '',
	'mute' => ($snd['mute']) ? ' selected="selected"' : '',
	'mode' => ($snd['mode']) ? ' selected="selected"' : '', 
);
$radioecho = '';
foreach ($radios as $id => $data) {
	$radioecho .= '
	<div class="row">
	<div class="col-xs-5">
	<input type="text" class="form-control" name="title-'.$id.'" value="'.$data['title'].'" aria-describedby="sizing-addon1">
	</div>
	<div class="col-xs-5">
	<input type="text" class="form-control" name="url-'.$id.'" value="'.$data['url'].'" aria-describedby="sizing-addon1">
	</div>
	<div class="col-xs-2">
	<button type="submit" class="btn btn-default" name="radio_del" value="'.$id.'"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
	</div>
	</div>
	';
}
?>




<!DOCTYPE html>
<html lang="ru">
  <head>
	<title>RaspiSettings</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">   
<meta name="mobile-web-app-capable" content="yes">
<link rel="shortcut icon" href="../circle.png">
<link rel="apple-touch-icon" href="../circle.png"/>
 
 
<link rel="stylesheet" href="../frameworks/css/bootstrap.min.css">
<link rel="stylesheet" href="../frameworks/css/bootstrap-switch.css">
<link rel="stylesheet" href="../frameworks/css/bootstrap-slider.min.css">
<link rel="stylesheet" href="../frameworks/css/style.css">

<script src="../frameworks/js/jquery-1.11.3.min.js"></script>
<script src="../frameworks/js/jquery-migrate-1.2.1.min.js"></script>

<script src="../frameworks/js/bootstrap.js"></script>
<script src="../frameworks/js/bootstrap-switch.js"></script>
<script src="../frameworks/js/bootstrap-slider.min.js"></script>


</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top" id="navbar">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
       <a class="navbar-brand" href="#"><span id="answersrv" class="label label-warning">RaspiHome</span></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav" id="menuelms">
        <li id="menu_home" class="menu_element"><a href="/smart/#show_all">Главная</a></li>
        <li id="menu_led" class="menu_element"><a href="/smart/#led">LED</a></li>
        <li id="menu_sound" class="menu_element"><a href="/smart/#sound">Звук</a></li>
        <li id="menu_radio" class="menu_element"><a href="/smart/#radio">Радио</a></li>
        <li id="menu_settings" class="menu_element active"><a href="settings.php">Настройки</a></li>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="container widthfix">
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Настройки</h3>
  </div>
  <div class="panel-body">
  <div class="row">
  <div class="col-xs-12"><center>
  <h3>Отображение настроек звука</h3><hr>
  <form name="snd" method="post">
  <div class="row">
	<div class="col-xs-3"><center><span class="glyphicon glyphicon-off" aria-hidden="true"></span><hr><select name="power" class="btn btn-default"><option value="0">O</option><option value="1"<?php echo $sndse['power'];?>>I</option></select>
	</center></div><div class="col-xs-3"><center><span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span><hr><select name="input" class="btn btn-default"><option value="0">O</option><option value="1"<?php echo $sndse['input'];?>>I</option></select>
	</center></div><div class="col-xs-3"><center><span class="glyphicon glyphicon-volume-off" aria-hidden="true"></span><hr><select name="mute" class="btn btn-default"><option value="0">O</option><option value="1"<?php echo $sndse['mute'];?>>I</option></select>
	</center></div><div class="col-xs-3"><center><span class="glyphicon glyphicon-sound-5-1" aria-hidden="true"></span><hr><select name="mode" class="btn btn-default"><option value="0">O</option><option value="1"<?php echo $sndse['mode'];?>>I</option></select>
	</center></div>
	</div>
	<br>
	<br>
  <button type="submit" class="btn btn-default" name="action" value="sound">Отправить</button>
  
  </form>
  
  <hr>
  <h3>Список радио</h3><hr>
  <form name="radios" method="post">
  <input type="hidden" name="action" value="radio">
  <?php echo $radioecho; ?><br>
  <button type="submit" class="btn btn-default">Отправить</button>
  </form>
  </center>
  </div>
  </div>
  </div>
  </div>
  </div>

</body>
</html>
<style>

.glyphicon {
	font-size: 22pt;
}

</style>