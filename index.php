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
       <a class="navbar-brand" href="#"><span id="answersrv" class="label label-default">RaspiHome</span></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav" id="menuelms">
        <li id="menu_show_all" class="menu_element"><a href="#show_all">all</a></li>
        <li id="menu_led" class="menu_element"><a href="#led">LED</a></li>
        <li id="menu_sound" class="menu_element"><a href="#sound">snd</a></li>
        <li id="menu_radio" class="menu_element"><a href="#radio">radio</a></li>
        <li id="menu_radio" class="menu_element"><a href="php/settings.php">setup</a></li>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div class="container widthfix">
<div class="panel panel-default">
  <div class="panel-body">
  <div class="row">
  
  <div class="col-xs-6"><center>
  
  <input type="checkbox" data-size="large" data-on-color="warning" class="bs-switch" name="wemo_power">
  <hr><input type="checkbox" data-size="large" class="bs-switch" name="led_power">
  
  </center></div>
  
  <div class="col-xs-6"><center>
  
  <span id="radio_status"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Загрузка...</span>
  <hr>
  <div class="head-snd-info">
  <span id="snd_power" class="glyphicon glyphicon-off" aria-hidden="true"></span>
  <span id="snd_input" class="glyphicon glyphicon-dashboard" aria-hidden="true"></span>
  <span id="snd_mute" class="glyphicon glyphicon-volume-off" aria-hidden="true"></span>
  <span id="snd_mode" class="glyphicon glyphicon-sound-5-1" aria-hidden="true"></span>
  </div>
  </center></div>
  
</div>

  </div>
</div>
</div>

<div class="container main_section widthfix" id="section_led">
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Управление LED</h3>
  </div>
  <div class="panel-body">
  <div class="row">
  <div class="col-xs-12 col-md-4">
<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Цвет</h3>
  </div>
  <div class="panel-body">
<input name="ledcolor" type="color" style="height: 50px;width:100%;" class="btn btn-default btn-lg">
  </div>
  </div>
  </div>
  
  <div class="col-xs-12 col-md-4">
<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Яркость</h3>
  </div>
  <div class="panel-body">
<center><input class="bslider" name="led_bright" type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1"></center>
  </div>
  </div>
  </div>
  
  <div class="col-xs-12 col-md-4">
<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Скорость</h3>
  </div>
  <div class="panel-body">
<center><input name="led_speed" class="bslider" type="text" data-slider-min="1" data-slider-max="126" data-slider-step="1"></center>
  </div>
  </div>
  </div>
  
  
</div>
</div>
</div>
</div>

<div class="container main_section widthfix" id="section_sound">
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Звук</h3>
  </div>
  <div class="panel-body">
	<div class="row">
	  <div class="col-xs-12 col-md-6">
	  <div class="panel panel-primary">
		  <div class="panel-heading">
			<h3 class="panel-title">Управление
					<span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span></h3>
		  </div>
		  <div class="panel-body">
			<div class="btn-group btn-group-lg btn-group-justified" role="group" aria-label="text">
				<div class="btn-group btn-group-lg" role="group">
					<button type="button" data-d="microlab" data-a="POWER" data-t="1" data-c="" class="btn btn-default sendbtn">
					<span class="glyphicon glyphicon-off" aria-hidden="true"></span><div class="bt-desc">
					Питание</div></button>
				</div>
				<div class="btn-group btn-group-lg" role="group">
					<button type="button" data-d="microlab" data-a="INPUT" data-t="1" data-c="" class="btn btn-default sendbtn">
					<span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span><div class="bt-desc">
					Вход</div></button>
				</div>
				<div class="btn-group btn-group-lg" role="group">
					<button type="button" data-d="microlab" data-a="RESET" data-t="1" data-c="" class="btn btn-default sendbtn">
					<span class="glyphicon glyphicon-repeat" aria-hidden="true"></span><div class="bt-desc">
					Сброс</div></button>
				</div>
				<div class="btn-group btn-group-lg" role="group">
					<button type="button" data-d="microlab" data-a="MODE" data-t="1" data-c="" class="btn btn-default sendbtn">
					<span class="glyphicon glyphicon-sound-5-1" aria-hidden="true"></span><div class="bt-desc">
					5.1/2.1</div></button>
				</div>
			</div>
		  </div>
		  </div>
	  </div>
	  
	  <div class="col-xs-12 col-md-6">
	  <div class="panel panel-primary">
		  <div class="panel-heading">
			<h3 class="panel-title">Громкость
					<span class="glyphicon glyphicon-volume-up sendbtn" aria-hidden="true"></span></h3>
		  </div>
		  <div class="panel-body">
			<div class="btn-group btn-group-lg btn-group-justified" role="group" aria-label="text">
				<div class="btn-group btn-group-lg" role="group">
					<button type="button" data-d="microlab" data-a="VOL_UP" data-t="1" data-c="" class="btn btn-default sendbtn">
					<span class="glyphicon glyphicon-volume-up" aria-hidden="true"></span><div class="bt-desc">
					Звук +</div></button>
				</div>
				<div class="btn-group btn-group-lg" role="group">
					<button type="button" data-d="microlab" data-a="VOL_DOWN" data-t="1" data-c="" class="btn btn-default sendbtn">
					<span class="glyphicon glyphicon-volume-down" aria-hidden="true"></span><div class="bt-desc">
					Звук -</div></button>
				</div>
				<div class="btn-group btn-group-lg" role="group">
					<button type="button" data-d="microlab" data-a="MUTE" data-t="1" data-c="" class="btn btn-default sendbtn">
					<span class="glyphicon glyphicon-volume-off" aria-hidden="true"></span><div class="bt-desc">
					Откл. звук</div></button>
				</div>
			</div>
		  </div>
		  </div>
		  
	   </div>
	  
	  <div class="col-xs-6 col-md-4">
	  <div class="panel panel-primary">
		  <div class="panel-heading">
			<h3 class="panel-title">Surround
					<span class="glyphicon glyphicon-sound-dolby" aria-hidden="true"></span></h3>
		  </div>
		  <div class="panel-body">
			<div class="btn-group btn-group-lg btn-group-justified" role="group" aria-label="text">
				<div class="btn-group btn-group-lg" role="group">
					<button type="button" data-d="microlab" data-a="REAR_UP" data-t="1" data-c="" class="btn btn-default sendbtn">
					<span class="glyphicon glyphicon glyphicon-arrow-up" aria-hidden="true"></span><div class="bt-desc">
					Зад +</div></button>
				</div>
				<div class="btn-group btn-group-lg" role="group">
					<button type="button" data-d="microlab" data-a="REAR_DOWN" data-t="1" data-c="" class="btn btn-default sendbtn">
					<span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span><div class="bt-desc">
					Зад -</div></button>
				</div>
			</div>
		  </div>
		  </div>
		  
	   </div>
	  
	  <div class="col-xs-6 col-md-4">
	  <div class="panel panel-primary">
		  <div class="panel-heading">
			<h3 class="panel-title">Центр
					<span class="glyphicon glyphicon-menu-up" aria-hidden="true"></span></h3>
		  </div>
		  <div class="panel-body">
			<div class="btn-group btn-group-lg btn-group-justified" role="group" aria-label="text">
				<div class="btn-group btn-group-lg" role="group">
					<button type="button" data-d="microlab" data-a="CENTER_UP" data-t="1" data-c="" class="btn btn-default sendbtn">
					<span class="glyphicon glyphicon-menu-up" aria-hidden="true"></span><div class="bt-desc">
					Центр +</div></button>
				</div>
				<div class="btn-group btn-group-lg" role="group">
					<button type="button" data-d="microlab" data-a="CENTER_DOWN" data-t="1" data-c="" class="btn btn-default sendbtn">
					<span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span><div class="bt-desc">
					Центр -</div></button>
				</div>
			</div>
		  </div>
		  </div>
		  
	   </div>
	  
	  <div class="col-xs-6 col-md-4">
	  <div class="panel panel-primary">
		  <div class="panel-heading">
			<h3 class="panel-title">Сабвуфер
					<span class="glyphicon glyphicon-bullhorn" aria-hidden="true"></span></h3>
		  </div>
		  <div class="panel-body">
			<div class="btn-group btn-group-lg btn-group-justified" role="group" aria-label="text">
				<div class="btn-group btn-group-lg" role="group">
					<button type="button" data-d="microlab" data-a="SUB_UP" data-t="1" data-c="" class="btn btn-default sendbtn">
					<span class="glyphicon glyphicon-triangle-top" aria-hidden="true"></span><div class="bt-desc">
					Саб +</div></button>
				</div>
				<div class="btn-group btn-group-lg" role="group">
					<button type="button" data-d="microlab" data-a="SUB_DOWN" data-t="1" data-c="" class="btn btn-default sendbtn">
					<span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span><div class="bt-desc">
					Саб -</div></button>
				</div>
			</div>
		  </div>
		  </div>
		  
	   </div>
	</div>
</div>
</div>
</div>

<div class="container main_section widthfix" id="section_radio">
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Онлайн радио</h3>
  </div>
  <div class="panel-body">
  <div class="row">
  
  
  <div class="col-xs-12 col-md-6">
<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Управление</h3>
  </div>
  <div class="panel-body">
  <center>
	<button type="button" data-d="radio" data-a="stop" data-t="1" data-c="" class="btn btn-default sendbtn">
	<span class="glyphicon glyphicon-stop" aria-hidden="true"></span></button>
	
	<select id="radio_select" name="c" class="selectpicker"><option value="false">Радиостанции</option></select>
	
	<button type="button" data-d="radio" data-a="play" data-t="1" data-c="0" class="btn btn-default sendbtn">
	<span class="glyphicon glyphicon-play" aria-hidden="true"></span></button>
	<hr>
	<button type="button" data-d="microlab" data-a="VOL_UP" data-t="1" data-c="" class="btn btn-default sendbtn">
					<span class="glyphicon glyphicon-volume-up" aria-hidden="true"></span></button>
					<button type="button" data-d="microlab" data-a="VOL_DOWN" data-t="1" data-c="" class="btn btn-default sendbtn">
					<span class="glyphicon glyphicon-volume-down" aria-hidden="true"></span></button>
					<button type="button" data-d="microlab" data-a="MUTE" data-t="1" data-c="" class="btn btn-default sendbtn">
					<span class="glyphicon glyphicon-volume-off" aria-hidden="true"></span></button>
	<button type="button" data-d="microlab" data-a="INPUT" data-t="1" data-c="" class="btn btn-default sendbtn">
					<span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span></button>
  </center>
  </div>
  </div>
  </div>
  
  <div class="col-xs-12 col-md-6">
<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Открыть URL</h3>
  </div>
  <div class="panel-body">
  <center>
  
	<div class="input-group input-group-lg">
	<input type="text" id="radio-open-url" class="form-control" placeholder="Ссылка" aria-describedby="sizing-addon1">
      <span class="input-group-btn">
        <button class="btn btn-default postbtn" data-d="radio" data-a="url" type="button"><span class="glyphicon glyphicon-play" aria-hidden="true"></span></button>
      </span>
	</div>
  </center>
  </div>
  </div>
  </div>
  
  
  <div class="col-xs-12 col-md-6">
<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Добавить радио</h3>
  </div>
  <div class="panel-body">
  <center>
  
	<div class="input-group">
	<input type="text" id="radio-add-title" class="form-control" placeholder="Название" aria-describedby="sizing-addon1">
	</div> <br>
	<div class="input-group">
	<input type="text" id="radio-add-url" class="form-control" placeholder="Ссылка" aria-describedby="sizing-addon1">
	</div> <br>
	
    <button class="btn btn-default btn-lg postbtn" data-d="radio" data-a="add" type="button"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
	
  </center>
  </div>
  </div>
  </div>

  
</div>
</div>
</div>
</div>

</body>
	
<script src="frameworks/js/smart.js"></script>
</html>