$(function(){
	var tam =$(window).width();
	var objSize= $(".login").width();
	var posi = tam/2;
	$(".login")
		.css("left","posi"+"px");

	$(".button").click(function(){
		$(this).addClass("invi");
		$(".form").addClass("formv");


	});	
});	