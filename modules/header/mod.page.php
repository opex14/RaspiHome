<?php $mod = basename(__DIR__);?>
<div class="container widthfix">
<div class="panel panel-default">
  <div class="panel-body">
  <div class="row">
  
  <div class="col-xs-6"><center>
  <?php if (isset($modules['wemo'])) { ?>
  <input type="checkbox" data-size="large" data-on-color="danger" class="bs-switch" name="wemo_power">
  <?php } ?>
  <?php if (isset($modules['led'])) { ?>
  <hr><input type="checkbox" data-size="large" data-on-color="warning" class="bs-switch" name="led_power">
  <?php } ?>
  </center></div>
  
  <div class="col-xs-6"><center>
  
  <?php if (isset($modules['radio'])) { ?>
  <span id="radio_status"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Загрузка...</span>
  <?php } ?>
  
  <?php if (isset($modules['lirc'])) { ?>
  <hr>
  <div class="head-snd-info">
  <span id="snd_power" data-m="lirc" data-d="Microlab" data-a="POWER" data-t="1" data-c="" class="glyphicon glyphicon-off sendbtn" aria-hidden="true"></span>
  <span id="snd_input" data-m="lirc" data-d="Microlab" data-a="INPUT" data-t="1" data-c="" class="glyphicon glyphicon-dashboard sendbtn" aria-hidden="true"></span>
  <span id="snd_mute" data-m="lirc" data-d="Microlab" data-a="MUTE" data-t="1" data-c="" class="glyphicon glyphicon-volume-off sendbtn" aria-hidden="true"></span>
  <span id="snd_mode" data-m="lirc" data-d="Microlab" data-a="MODE" data-t="1" data-c="" class="glyphicon glyphicon-sound-5-1 sendbtn" aria-hidden="true"></span>
  </div>
  <?php } ?>
  </center></div>
  
</div>

  </div>
</div>
</div>