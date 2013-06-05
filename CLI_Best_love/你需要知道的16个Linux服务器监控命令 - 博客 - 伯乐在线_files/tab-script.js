$(document).ready(function() {

	//Default Action
	$(".post-content").hide(); //Hide all content
	$(".sd-tab ul li:first").addClass("act-sdtab").show(); //Activate first tab
	$(".post-content:first").show(); //Show first tab content
	
	//On Click Event
	$(".sd-tab ul li").click(function() {
		$(".sd-tab ul li").removeClass("act-sdtab"); //Remove any "active" class
		$(this).addClass("act-sdtab"); //Add "active" class to selected tab
		$(".post-content").hide(); //Hide all tab content
		var activeTab = $(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active content
		return false;
	});

});