function menu() {
		$('.nav-toggle').click(function() {
			if($(".nav").hasClass("side-fechado")) {
				$('.nav').animate({
				    left: "0px",
				}, 100, function() {
				    $(".nav").removeClass("side-fechado");
				});
				$('.foto').animate({
				    left: "175px",
				}, 100);
			}
			else {
				$('.nav').animate({
				    left: "-175px",
				}, 100, function() {
				    $(".nav").addClass("side-fechado");
				});
				$('.foto').animate({
				    left: "0px",
				}, 100);
			}
		});
	}
	
	//Menu Sidebar
	$(window).resize(function() {
		var tamanhoJanela = $(window).width();
		$(".nav-toggle").remove();
		
		if (tamanhoJanela < 800) { 
			$('.nav').css('left', '-175px').addClass('side-fechado');
			$('.nav').append( "<div class='nav-toggle'>Menu</div>" );
      $('.foto').css("left", 0);
		} else {
			$('.nav').css('left', '0px').addClass('side-fechado');
		}
		
		menu();
	});
	
	$(document).ready(function() {
		var tamanhoJanela = $(window).width();
		$(".nav-toggle").remove();
		
		if (tamanhoJanela < 800) { 
			$('.nav').css('left', '-175px').addClass('side-fechado');;
			$('.nav').append( "<div class='nav-toggle'>Menu</div>" );
		} else {
			$('.nav').css('left', '0px').addClass('side-fechado');
		}
		
		menu();
	});