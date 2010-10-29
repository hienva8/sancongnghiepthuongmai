$(document).ready(function(){

	$('#navigationMenu li .normalMenu').each(function(){

		$(this).before($(this).clone().removeClass().addClass('hoverMenu'));

	});
	
	$('#navigationMenu li').hover(function(){
	
		$(this).find('.hoverMenu').stop().animate({marginTop:'1px'},200);

	},
	
	function(){
	
		$(this).find('.hoverMenu').stop().animate({marginTop:'-28px'},200);

	});
	
});
