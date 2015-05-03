$(document).ready(function()
{
	//var about_width = $('#about').innerWidth();
	$("#about_under").css("width", $('#about').innerWidth());
	$("#school_under").css("width", $('#school').innerWidth());
	$("#news_under").css("width", $('#news').innerWidth());
	$("#articles_under").css("width", $('#articles').innerWidth());
	$("#calendar_under").css("width", $('#calendar').innerWidth());
	$("#events_under").css("width", $('#events').innerWidth());
	$("#documents_under").css("width", $('#documents').innerWidth());
	$("#contacts_under").css("width", $('#contacts').innerWidth());
	
	$("#about").hover(
	function () {
		$("#about_under").append(
		'<div class="left"></div>',
		'<div class="middle"></div>',
		'<div class="arrow"></div>',
		'<div class="middle"></div>',
		'<div class="right"></div>'
		);
		$(".middle").css("width", ($('#about').innerWidth()-$('.left').width()-$('.arrow').width()-$('.right').width())/2);
		
	},
	function () {
		$(".left").remove();
		$(".middle").remove();
		$(".right").remove();
		$(".arrow").remove();
	}	
	);
	
	
	
	$("#school").hover(
	function () {
		$("#school_under").append(
		'<div class="left"></div>',
		'<div class="middle"></div>',
		'<div class="arrow"></div>',
		'<div class="middle"></div>',
		'<div class="right"></div>'
		);
		$(".middle").css("width", ($('#school').innerWidth()-$('.left').width()-$('.arrow').width()-$('.right').width())/2);
		//alert($(".middle").width());
		
	},
	function () {
		$(".left").remove();
		$(".middle").remove();
		$(".right").remove();
		$(".arrow").remove();
	}	
	);
	
	$("#news").hover(
	function () {
		$("#news_under").append(
		'<div class="left"></div>',
		'<div class="middle"></div>',
		'<div class="arrow"></div>',
		'<div class="middle"></div>',
		'<div class="right"></div>'
		);
		$(".middle").css("width", ($('#news').innerWidth()-$('.left').width()-$('.arrow').width()-$('.right').width())/2);
		//alert($(".middle").width());
		
	},
	function () {
		$(".left").remove();
		$(".middle").remove();
		$(".right").remove();
		$(".arrow").remove();
	}	
	);
	$("#articles").hover(
	function () {
		$("#articles_under").append(
		'<div class="left"></div>',
		'<div class="middle"></div>',
		'<div class="arrow"></div>',
		'<div class="middle"></div>',
		'<div class="right"></div>'
		);
		$(".middle").css("width", ($('#articles').innerWidth()-$('.left').width()-$('.arrow').width()-$('.right').width())/2);
		//alert($(".middle").width());
		
	},
	function () {
		$(".left").remove();
		$(".middle").remove();
		$(".right").remove();
		$(".arrow").remove();
	}	
	);
	
	
	$("#calendar").hover(
	function () {
		$("#calendar_under").append(
		'<div class="left"></div>',
		'<div class="middle"></div>',
		'<div class="arrow"></div>',
		'<div class="middle"></div>',
		'<div class="right"></div>'
		);
		$(".middle").css("width", ($('#calendar').innerWidth()-$('.left').width()-$('.arrow').width()-$('.right').width())/2);
		//alert($(".middle").width());
		
	},
	function () {
		$(".left").remove();
		$(".middle").remove();
		$(".right").remove();
		$(".arrow").remove();
	}	
	);
	
	$("#events").hover(
	function () {
		$("#events_under").append(
		'<div class="left"></div>',
		'<div class="middle"></div>',
		'<div class="arrow"></div>',
		'<div class="middle"></div>',
		'<div class="right"></div>'
		);
		$(".middle").css("width", ($('#events').innerWidth()-$('.left').width()-$('.arrow').width()-$('.right').width())/2);
		//alert($(".middle").width());
		
	},
	function () {
		$(".left").remove();
		$(".middle").remove();
		$(".right").remove();
		$(".arrow").remove();
	}	
	);
	
	
	$("#documents").hover(
	function () {
		$("#documents_under").append(
		'<div class="left"></div>',
		'<div class="middle"></div>',
		'<div class="arrow"></div>',
		'<div class="middle"></div>',
		'<div class="right"></div>'
		);
		$(".middle").css("width", ($('#documents').innerWidth()-$('.left').width()-$('.arrow').width()-$('.right').width())/2);
		//alert($(".middle").width());
		
	},
	function () {
		$(".left").remove();
		$(".middle").remove();
		$(".right").remove();
		$(".arrow").remove();
	}	
	);
	
	$("#contacts").hover(
	function () {
		$("#contacts_under").append(
		'<div class="left"></div>',
		'<div class="middle"></div>',
		'<div class="arrow"></div>',
		'<div class="middle"></div>',
		'<div class="right"></div>'
		);
		$(".middle").css("width", ($('#contacts').innerWidth()-$('.left').width()-$('.arrow').width()-$('.right').width())/2);
		//alert($(".middle").width());
		
	},
	function () {
		$(".left").remove();
		$(".middle").remove();
		$(".right").remove();
		$(".arrow").remove();
	}	
	);
});

