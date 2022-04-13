/*
  Template Name: adbob - Admin Dashboard Based On Bootstrap
  Template Version: 1.0
  Author: HyperClass team
  Note:  In this file there are functions that by calling them you can do many things without coding. It was explained at the top of each function.

*/


/*
 This function check the switch option's switch and regard to their states change the items on screen.
*/
function Option_switches() {
	/* fixed top bar */
    if($('#topfix').prop("checked")) {
		$('.top-navbar').css({'position':'fixed'});
    }
    else {
		$('.top-navbar').css({'position':'absolute'});
    };

	/* sticky side bar */
    if($('#sidefix').prop("checked")) {
		$('#sidebar').removeClass('no-sticky');
    }
    else {
		$('#sidebar').addClass('no-sticky'); 
    };

	/* Boxet layout */
    if($('#box_option').prop("checked")) {
		$('body').removeClass('container-fluid').addClass('container');
    }
    else {
		$('body').removeClass('container').addClass('container-fluid');
    };

	/* night mode colors */
    if($('#nightmode').prop("checked")) {
    	$('body').addClass('night-mode');
    }
    else {
    	$('body').removeClass('night-mode');
    };
};



/*
 By calling this function you can set distance header padding and sidebars in any situation.
*/
function SetPaddings(){
	var W = $(window).width();
	var S = $('#sidebar');
	var Sw = $('#sidebar').width();
	var T = $('#topfix');
	var SId = $('.theiaStickySidebar').attr('id');

	if(T.prop('checked') && S.hasClass("is-open") && SId=='menu_hor') {
		$('#content').css({'padding-top':'43px'});
		$('#menu_hor').css({'padding-top':'38px'});
	}
	else {
		$('#content, #menu_hor').css({'padding-top':'0px'});
	};

	if (SId == 'menu_ver' && S.hasClass("is-open") && W>992) {
    	$('.main_content').css({'padding-right': Sw+15});
	}
	else {
    	$('.main_content').css({'padding-right':'15px'});
	};

	if (!T.prop('checked') && S.hasClass("is-open") && SId=='menu_hor' && W>992) {
		$('header.top-navbar').css({'top':'42px','z-index':'90'});
		$('#side_panel').css({'top':'80px'});
		$('#content').css({'padding-top':'35px'});
	}
	else {
		$('header.top-navbar').css({'top':'0px','z-index':'93'});
		$('#side_panel').css({'top':'40px'});
	};

	if ($('body').hasClass('container')) {
		var s = ($('html').width() - $('body').width()) / 2 - 7.5;
		$('#sidebar, .theiaStickySidebar').css({'right' : s});
	};

	if(!$('#box_option').prop("checked")) {
		$('#sidebar, .theiaStickySidebar').css({'right' : '0px'});
	};

	if (W > 970) {
		$('#menu_hor ul').removeAttr('style');
	}
};



/*
 This function scroll to the last chat message box at the right Thus,
 after loading each message must call this function.
*/
function ChatScroller() {
	var height = 0;
	$('#user_message>div').each(function(i, value) {
	    height += parseInt($(this).height());
	});
	height += '';
	$('.tower-body').animate({scrollTop: height});
};



/*
 The function according to the type of Progress Bar and filling percentage 
 give appropriate color to the bootstrap progressbars.
*/
function ProgressBars() {
	/* progress bar auto coloring */
	$( ".pr-good .progress-bar" ).each(function() {
		$(this).removeClass (function (index, css) {
			return (css.match (/(^|\s)progress-bar\S+/g) || []).join(' ');
		});
		var P = $(this).width() / $(this).parent().width() * 100;
		if (P <= 25) {
			$(this).addClass('progress-bar progress-bar-danger');
		};
		if (P > 25 && P <= 50) {
			$(this).addClass('progress-bar progress-bar-warning');
		};
		if (P > 50 && P <= 75) {
			$(this).addClass('progress-bar progress-bar-info');
		};
		if (P > 75) {
			$(this).addClass('progress-bar progress-bar-success');
		};
	});

	$( ".pr-bad .progress-bar" ).each(function() {
		var P = $(this).width() / $(this).parent().width() * 100;
		$(this).removeClass (function (index, css) {
			return (css.match (/(^|\s)progress-bar\S+/g) || []).join(' ');
		});
		if (P <= 25) {
			$(this).addClass('progress-bar progress-bar-success');
		};
		if (P > 25 && P <= 50) {
			$(this).addClass('progress-bar progress-bar-info');
		};
		if (P > 50 && P <= 75) {
			$(this).addClass('progress-bar progress-bar-warning');
		};
		if (P > 75) {
			$(this).addClass('progress-bar progress-bar-danger');
		};
	});

	/* progress bar auto active on hover */
	$('.pr-ac').mouseover(function() {
		$(this).addClass('active');
	});

	$('.pr-ac').mouseout(function() {
		$(this).removeClass('active');
	});
};
	