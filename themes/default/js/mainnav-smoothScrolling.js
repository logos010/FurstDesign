// Auto-scrolling
var scrollIntervalHandler;
var scrollingInterval = 10;
var scrollingStep = 2;
var scrollStep = 0;
var scrollDirection = 0;

function makeScrollable(wrapperId) {
	$('#' + wrapperId).bind("mousemove", function (e) {
/*			var y = 0;
			var mouseY = e.pageY - this.offsetTop;
			if(mouseY > 250) {
				y = e.pageY - this.offsetTop; //+ el.data("scrollerOffset").top);
				scrollDirection = 1; // down
			}
			else if(mouseY < 150) {
				y = this.offsetTop + /*el.data("scrollerOffset").top +* / this.offsetHeight - e.pageY;
				scrollDirection = -1; // up
			}
			else {
				scrollDirection = 0; // stay
			}

			scrollStep = Math.round((y / this.offsetHeight) * scrollingStep);*/

		    if($(this).css('position') == 'fixed') {
		    	var p = $(window).scrollTop();
				$(this).css('position', 'absolute');
				$(this).css('top', p + 'px');
		    }
			
			var mouseY = e.pageY - this.offsetTop;
			
			if(mouseY < Math.floor(0.1 * this.offsetHeight)) {
				y = e.pageY - this.offsetTop;
				scrollDirection = -5; // up
				scrollStep = scrollingStep;
			}
			else if(mouseY < Math.floor(0.3 * this.offsetHeight)) {
				y = e.pageY - this.offsetTop;
				scrollDirection = -1; // up
				scrollStep = scrollingStep;
			}
			else if(mouseY > Math.floor(0.9 * this.offsetHeight)) {
				y = e.pageY - this.offsetTop;
				scrollDirection = 5; // down
				scrollStep = scrollingStep;
			}
			else if(mouseY > Math.floor(0.7 * this.offsetHeight)) {
				y = e.pageY - this.offsetTop;
				scrollDirection = 1; // down
				scrollStep = scrollingStep;
			}
			else {
				scrollDirection = 0; // stay
				scrollStep = 0;
			}
		});

	$('#' + wrapperId).mouseenter(function () {
			scrollIntervalHandler = setInterval(function(){
					if(scrollStep != 0) {
						var scrollWrapper = document.getElementById(wrapperId);
						scrollWrapper.scrollTop = scrollWrapper.scrollTop + (scrollDirection * scrollStep);
					}
					
				}, scrollingInterval);
			
			var p = $(window).scrollTop();
			$(this).css('position', 'absolute');
			$(this).css('top', p + 'px');
		});
		
	$('#' + wrapperId).mouseleave(function () {
			clearInterval(scrollIntervalHandler);
			
			$(this).css('position', 'fixed');
			$(this).css('top', '0px');
		});
		
	/*if(wrapperId == undefined) return;
	var wrapper = document.getElementById(wrapperId);
	if(wrapper == undefined) return;
	var newHeight = $(window).height() - wrapper.offsetTop - 80;//initially was 40
	
	var mainnavHeight = $('#mainnav-wrapper').height();
	if ( mainnavHeight > newHeight){
		$('.mainnav_arr').css('top',newHeight + wrapper.offsetTop + 15 + 'px');
		$('.mainnav_arr').fadeIn();
	}
	else{
		$('.mainnav_arr').css('top',newHeight + wrapper.offsetTop + 15 + 'px');
		$('.mainnav_arr').fadeOut();
	}*/
	resizeScrollableContainer(wrapperId);
}

function resizeScrollableContainer(wrapperId) {
	if(wrapperId == undefined) return;
	var wrapper = document.getElementById(wrapperId);
	if(wrapper == undefined) return;
	var newHeight = $(window).height() - 80 - 80;//initially was 40
	
	var mainnavHeight = $('#mainnav-wrapper').height();
	if ( mainnavHeight > newHeight){
		$('.mainnav_arr').css('top',newHeight + 80 + 15 + 'px');
		$('.mainnav_arr').fadeIn("fast");
	}
	else{
		$('.mainnav_arr').css('top',newHeight + 80 + 15 + 'px');
		$('.mainnav_arr').fadeOut("fast");
	}
	
	//
	$('#' + wrapperId).css('height', newHeight + 'px');
	$('.mainnav_arr').css('top',newHeight + 80 + 15 + 'px');
}