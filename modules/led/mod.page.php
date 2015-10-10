<?php $mod = basename(__DIR__);?>
<div class="container main_section widthfix" style="display: none;" id="section_<?php echo $mod; ?>">
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#led">LED</a>
    </div>
  </div>
</nav>

  <div class="row">
  <div class="col-xs-12 col-md-4">
<div class="panel panel-primary panels-led">
  <div class="panel-heading">
    <h3 class="panel-title">Цвет</h3>
  </div>
  <div class="panel-body">
<input name="ledcolor" type="color" style="height: 50px;width:100%;" class="btn btn-default btn-lg">
  </div>
  </div>
  </div>
  
  <div class="col-xs-12 col-md-4">
<div class="panel panel-primary panels-led">
  <div class="panel-heading">
    <h3 class="panel-title">Яркость</h3>
  </div>
  <div class="panel-body" style="margin-top: 15px;">
<center><input class="bslider" name="led_bright" type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1"></center>
  </div>
  </div>
  </div>
  
  <div class="col-xs-12 col-md-4">
<div class="panel panel-primary panels-led">
  <div class="panel-heading">
    <h3 class="panel-title">Скорость</h3>
  </div>
  <div class="panel-body" style="margin-top: 15px;">
<center><input name="led_speed" class="bslider" type="text" data-slider-min="1" data-slider-max="126" data-slider-step="1"></center>
  </div>
  </div>
  </div>
  
  <div class="col-xs-12 col-md-4">
<div class="panel panel-primary panels-led">
  <div class="panel-heading">
    <h3 class="panel-title">Режим</h3>
  </div>
  <div class="panel-body">
<center>
	<select class="selectpicker led_mod" title="Режим">
		<option value="1">Скачки</option>
		<option value="2">Переход цвета</option>
		<option value="3">Вспышка</option>
		<option value="4">Нарастание яркости</option>
		<option value="5">Серия вспышек</option>
	</select>
</center>
  </div>
  </div>
  </div>
  
  <div class="col-xs-12 col-md-4">
<div class="panel panel-primary panels-led">
  <div class="panel-heading">
    <h3 class="panel-title">Эффект</h3>
  </div>
  <div class="panel-body">
<center>
	<select class="selectpicker led_eff led_eff_m" title="Эффект">
		<option value="1">К/3</option>
		<option value="2">К/C</option>
		<option value="3">К/З/С</option>
		<option value="4">К/З/С/Ж</option>
		<option value="5">К/З/С/Ж/Ф</option>
		<option value="6">К/З/С/Ж/Ф/Б</option>
		<option value="7">К/З/С/Ж/Ф/Б/Бе</option>
	</select>
	<select class="selectpicker led_eff led_eff_s" title="Эффект">
		<option value="1">Красный</option>
		<option value="2">Зеленый</option>
		<option value="3">Синий</option>
		<option value="4">Желтый</option>
		<option value="5">Фиолетовый</option>
		<option value="6">Бирюзовый</option>
		<option value="7">Белый</option>
	</select>
</center>
  </div>
  </div>
  </div>
  
  
</div>
</div>