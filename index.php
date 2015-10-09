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


</head>
<body>

<?php include 'html/menu.html'; ?>

<div class="container widthfix">
<div class="panel panel-default">
  <div class="panel-body">
  <div class="row">
  
  <div class="col-xs-6"><center>
  
  <input type="checkbox" data-size="large" data-on-color="danger" class="bs-switch" name="wemo_power">
  <hr><input type="checkbox" data-size="large" data-on-color="warning" class="bs-switch" name="led_power">
  
  </center></div>
  
  <div class="col-xs-6"><center>
  
  <span id="radio_status"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Загрузка...</span>
  <hr>
  <div class="head-snd-info">
  <span id="snd_power" data-m="lirc" data-d="Microlab" data-a="POWER" data-t="1" data-c="" class="glyphicon glyphicon-off sendbtn" aria-hidden="true"></span>
  <span id="snd_input" data-m="lirc" data-d="Microlab" data-a="INPUT" data-t="1" data-c="" class="glyphicon glyphicon-dashboard sendbtn" aria-hidden="true"></span>
  <span id="snd_mute" data-m="lirc" data-d="Microlab" data-a="MUTE" data-t="1" data-c="" class="glyphicon glyphicon-volume-off sendbtn" aria-hidden="true"></span>
  <span id="snd_mode" data-m="lirc" data-d="Microlab" data-a="MODE" data-t="1" data-c="" class="glyphicon glyphicon-sound-5-1 sendbtn" aria-hidden="true"></span>
  </div>
  </center></div>
  
</div>

  </div>
</div>
</div>

<?php include 'html/led.html'; ?>
<?php include 'html/sound.html'; ?>
<?php include 'html/radio.html'; ?>

</body>
	
<script src="frameworks/js/smart.js"></script>
</html>