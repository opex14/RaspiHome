var hash = window.location.hash.substr(1);
var wemo;
var led;
var radiols;
var radio = "";
var snd_status = "";
if (hash.length == 0) {
	hash = 'show_all';
}


$(document).ready(function(){
		$(".bs-switch").bootstrapSwitch('labelWidth', 50);
		$(".bslider").slider();
		$("input[name='wemo_power']").bootstrapSwitch('labelText', 'WeMo');
		$("input[name='led_power']").bootstrapSwitch('labelText', 'LED');
		$('.selectpicker').selectpicker();
		$('.led_eff').selectpicker('hide');
		if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) { $('.selectpicker').selectpicker('mobile');}
		UpdateData();
		setInterval("UpdateData()", 10000);
		$("#menu_"+hash).addClass("active");
		
	if (hash == 'show_all') {
	$(".main_section").show();
	} else {
	$("#section_"+hash).show();
	}
	
	
        $.ajax({
            url: '/smart/php/index.php',
            data: {d: 'radio', a: 'list'},
            dataType: 'json',
			success: MakeRadio
        });
	
    });
	
$(window).on('hashchange', function() {
  hash = window.location.hash.substr(1);
	if (hash.length == 0) {
		hash = 'home';
	}
	$(".navbar-collapse").collapse('hide');
  	$(".menu_element").removeClass("active");
  	$("#menu_"+hash).addClass("active");
	if (hash == 'show_all') {
	$(".main_section").show();
	} else {
	$(".main_section").hide();
	$("#section_"+hash).show();
	}
});

function UpdateData() {
        $.ajax({
            url: '/smart/php/index.php',
            data: {d: 'led', a: 'status'},
            dataType: 'json',
			success: UpdLed
        });
        $.ajax({
            url: '/smart/php/index.php',
            data: {d: 'wemo', a: 'status'},
            dataType: 'json',
			success: UpdWemo
        });
        $.ajax({
            url: '/smart/php/index.php',
            data: {d: 'radio', a: 'status'},
            dataType: 'json',
			success: UpdRadio
        });
        $.ajax({
            url: '/smart/php/index.php',
            data: {d: 'microlab', a: 'status'},
            dataType: 'json',
			success: UpdSound
        });
}



function MakeRadio(data)	{
	radiols = data;
	for (var key in data['list']) {
		var selected = '';
		if(data['current'] == key) {selected = ' selected="selected"'}
		var toappend = '<option value="'+key+'"'+selected+'>'+data['list'][key]['title']+'</option>';
		$("#radio_select").append(toappend);
	}
	   $('#radio_select').selectpicker('refresh');
	if($("#radio_select").val().length < 1) {
		$(".radlsch").hide();
	}
}

$("#radio_select").change(function() {
		$(".radlsch").show();
});

// $("#radio_select").change(function() {
	// var radi = $(this).val();
	// if(radi != 'false') {
	// $.ajax({
            // url: '/smart/php/index.php',
            // data: {d: 'radio', a: 'play', c: radi},
            // dataType: 'json',
			// success: GoodAnswer,
			// error: BadAnswer,
        // });
	// }
// });

$(".led_mod").change(function() {
	Send('led', 'send', 'POWER=1;MASTERMODE=2;MOD='+$(this).val()+";");
});
$(".led_eff").change(function() {
	Send('led', 'send', 'POWER=1;MASTERMODE=2;EFFECT='+$(this).val()+";");
});
	
$("input[name='ledcolor']").change(function() {
	var color = $(this).val().substr(1);
    Send('led', 'send', 'POWER=1;MASTERMODE=1;COLOR='+color+";");
	$("input[name='led_power']").bootstrapSwitch('state', true);
});

$("input[name='led_bright']").on("slide", function(slideEvt) {
    slSend('led', 'send', 'POWER=1;MASTERMODE=1;BRIGHTNESS='+slideEvt.value+";");
	$("input[name='led_power']").bootstrapSwitch('state', true);
});	

$("input[name='led_speed']").on("slide", function(slideEvt) {
    slSend('led', 'send', 'POWER=1;MASTERMODE=2;SPEED='+slideEvt.value+";");
	$("input[name='led_power']").bootstrapSwitch('state', true);
});	

		$(".bs-switch").on('switchChange.bootstrapSwitch', function(event, state) {
			if (this.name == 'wemo_power' && wemo != state) {
				if (state) {
					Send('wemo', 'on', '');
				} else {
					Send('wemo', 'off', '');
				}
					wemo = state;
			}
			
			if (this.name == 'led_power' && led['POWER'] != state) {
				if (state) {
					Send('led', 'send', 'POWER=1');
					led['POWER'] = 1;
				} else {
					Send('led', 'send', 'POWER=0');
					led['POWER'] = 0;
				}
					led = state;
			}
			
		});
		
$( ".sendbtn" ).click(function() {
    var thisbtn = $(this);
	var a = thisbtn.attr("data-a");
	var d = thisbtn.attr("data-d");
	var t = thisbtn.attr("data-t");
	var c = thisbtn.attr("data-c");
	if(!a || !d || !t) {
	BadAnswer();
	} else {
	if (!c) {
	Send(d, a, 'SEND_ONCE', t);
	} else {
		if (d == 'radio' && a == 'play') {
			c = $("#radio_select").val();
		}
		Send(d, a, c, t);
	}
	
	}
});

$( ".radiobtn" ).click(function() {
    var thisbtn = $(this);
	var a = thisbtn.attr("data-a");
	var c = $("#radio_select").val();
	var wintx = "<body style='background-color: black;'><div class='container'><center><title>Radio: "+radiols['list'][c]['title']+"</title><audio src='"+radiols['list'][c]['url']+"' autoplay controls></audio></center></div></body><style>.container {position: absolute;top: 50%;left: 50%;transform: translateX(-50%) translateY(-50%);}</style>";
	var newWin = window.open("about:blank", "Radio", "width=400,height=60");
	newWin.document.write(wintx);
});

$( ".postbtn" ).click(function() {
    var thisbtn = $(this);
	var a = thisbtn.attr("data-a");
	var d = thisbtn.attr("data-d");
	if(!a || !d) {
	BadAnswer();
	} else {
		if (a == 'url') {
			var rurl = $("#radio-open-url").val();
			
			$.ajax({
				url: '/smart/php/index.php?d='+d+'&a='+a,
				type: 'POST',
				data: {url: rurl},
				dataType: 'json',
				success: GoodAnswer,
				error: BadAnswer,
			});
	} else if (a == 'add') {
			var addtitle = $("#radio-add-title").val();
			var addurl = $("#radio-add-url").val();
			$.ajax({
				url: '/smart/php/index.php?d='+d+'&a='+a,
				type: 'POST',
				data: {title: addtitle, url: addurl},
				dataType: 'json',
				success: Refresh,
				error: BadAnswer,
			});
	}
	}
});
	function slSend(dev, act, dat, time) {
		time = typeof time !== 'undefined' ? time : null;
		
		    $.ajax({
            url: '/smart/php/index.php',
            data: {d: dev, a: act, c: dat, t: time},
            dataType: 'json',
			error: BadAnswer,
        });
	}
	function Send(dev, act, dat, time) {
		time = typeof time !== 'undefined' ? time : null;
		
		    $.ajax({
            url: '/smart/php/index.php',
            data: {d: dev, a: act, c: dat, t: time},
            dataType: 'json',
			success: GoodAnswer,
			error: BadAnswer,
        });
	}
	
	function GoodAnswer() {
	$('#answersrv').addClass('label-primary');
	setTimeout(GoodBack, 200);
	UpdateData();
	};
	function GoodBack() {
		$('#answersrv').removeClass('label-primary');
	}
		
	function BadAnswer() {
	$('#answersrv').addClass('label-danger');
	setTimeout(BadBack, 200);
	};
	function BadBack() {
		$('#answersrv').removeClass('label-danger');
	}
	
	function UpdLed(data){
	led = data;
	if (data['POWER'] == 1) {
		$("input[name='led_power']").bootstrapSwitch('state', true);
	} else {
		$("input[name='led_power']").bootstrapSwitch('state', false);
	}
	$("input[name='ledcolor']").val(data['hex']);
	$("input[name='led_bright']").slider('setValue', parseInt(data['BRIGHTNESS']));
	$("input[name='led_speed']").slider('setValue', parseInt(data['SPEED']));
	
	 $('.led_mod').selectpicker('val', data['MOD']);
	 $('.led_eff').selectpicker('val', data['EFFECT']);
	 
	if (data['MOD'] == 1 || data['MOD'] == 2) {
		$('.led_eff_s').selectpicker('hide');
		$('.led_eff_m').selectpicker('show');
	} else {
		$('.led_eff_m').selectpicker('hide');
		$('.led_eff_s').selectpicker('show');
	}
	}
	
	function UpdRadio(data){
		if (radio != data['title']) {
	if (data['status'] == 'play') {
		$("#radio_status").html('<h4><span class="glyphicon glyphicon-play" aria-hidden="true"></span> '+data['title']+'</h4>');
	} else {
		$("#radio_status").html('<h4><span class="glyphicon glyphicon-stop" aria-hidden="true"></span> '+data['title']+'</h4>');
	}
	radio = data['title']; 
	}}
	
	function Refresh() {
		location.reload();
	}
	
	function UpdWemo(data){
	if (data == '1') {
		wemo = true;
		$("input[name='wemo_power']").bootstrapSwitch('state', true);
	} else {
		$("input[name='wemo_power']").bootstrapSwitch('state', false);
		wemo = false;
	}
	}
	
	function UpdSound(data){
			var is_changed = false;
			if (typeof snd_status == 'string') {
				snd_status = data;
				is_changed = true;
			}
			while (!is_changed) {
				if (data['power'] != snd_status['power']) {is_changed = true; break;}
				if (data['input'] != snd_status['input']) {is_changed = true; break;}
				if (data['mute'] != snd_status['mute']) {is_changed = true; break;}
				if (data['mode'] != snd_status['mode']) {is_changed = true; break;}
				break;
			}
			if (is_changed) {
			$(".head-snd-info span").removeClass("enabled");
			if (data['power']) $("#snd_power").addClass("enabled");
			if (data['input']) $("#snd_input").addClass("enabled");
			if (data['mute']) $("#snd_mute").addClass("enabled");
			if (data['mode']) $("#snd_mode").addClass("enabled");
			snd_status = data;
			}
	}