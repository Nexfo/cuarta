$(window).load(function(){
	$(window).scroll(function () {
		if ($(this).scrollTop() > 176) {
			$('#reserva').css({"position": "fixed", "width": "980px", "top": "100px"});
			$('#cabecera').css("margin-bottom", "160px");
		} else {
			$('#reserva').css({"position": "relative", "width": "100%", "top": ""});
			$('#cabecera').css("margin-bottom", "15px");
		}
	});
});