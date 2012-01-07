$(document).ready(function(){

	$("ul.top-nav-2").parent().append("<span></span>"); //Only shows drop down trigger when js is enabled (Adds empty span tag after ul.top-nav-2*)

	$("ul.top-nav-1 li span").click(function() { //When trigger is clicked...

		//Following events are applied to the top-nav-2 itself (moving top-nav-2 up and down)
		$(this).parent().find("ul.top-nav-2").slideDown('fast').show(); //Drop down the top-nav-2 on click

		$(this).parent().hoverIntent(function() {
		}, function(){
			$(this).parent().find("ul.top-nav-2").slideUp('slow'); //When the mouse hovers out of the top-nav-2, move it back up
		});

		//Following events are applied to the trigger (Hover events for the trigger)
		}).hoverIntent(function() {
			$(this).addClass("subhover"); //On hover over, add class "subhover"
		}, function(){	//On Hover Out
			$(this).removeClass("subhover"); //On hover out, remove class "subhover"
	});

});
