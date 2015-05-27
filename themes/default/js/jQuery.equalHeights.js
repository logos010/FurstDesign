/*-------------------------------------------------------------------- 
 * JQuery Plugin: "EqualHeights"
 * by:	Scott Jehl, Todd Parker, Maggie Costello Wachs (http://www.filamentgroup.com)
 *
 * Copyright (c) 2008 Filament Group
 * Licensed under GPL (http://www.opensource.org/licenses/gpl-license.php)
 *
 * Description: Compares the heights or widths of the top-level children of a provided element 
 		and sets their min-height to the tallest height (or width to widest width). Sets in em units 
 		by default if pxToEm() method is available.
 * Dependencies: jQuery library, pxToEm method	(article: 
		http://www.filamentgroup.com/lab/retaining_scalable_interfaces_with_pixel_to_em_conversion/)							  
 * Usage Example: $(element).equalHeights();
  		Optional: to set min-height in px, pass a true argument: $(element).equalHeights(true);
 * Version: 2.0, 08.01.2008
--------------------------------------------------------------------*/

$.fn.equalHeights = function(px) {
	$(this).each(function(){
//		$(this).children().css('min-height', '0px');
		$(this).children().css('height', 'auto');
		var currentTallest = 0;
		$(this).children().each(function(i){
			if ($(this).height() > currentTallest) { currentTallest = $(this).height(); }
		});
		//if (!px || !Number.prototype.pxToEm) currentTallest = currentTallest.pxToEm(); //use ems unless px is specified
		currentTallest = Math.ceil(currentTallest);
		// for ie6, set height since min-height isn't supported
/*		if ($.browser.msie && $.browser.version == 6.0) { $(this).children().css({'height': currentTallest}); }
		$(this).children().css({'min-height': currentTallest});*/
		$(this).children().css({'height': currentTallest + 'px'});
	});
	
	return this;
};


$.fn.equalHeights2 = function(px) {
	var currentTallest1 = 0;
	$('.item-desc').each(function(){
		if ($(this).height() > currentTallest1) { currentTallest1 = $(this).height(); }
	});
	
	var currentTallest2 = 0;
	$('.item-product-img').each(function(){
		if ($(this).height() > currentTallest2) { currentTallest2 = $(this).height(); }
	});
	
	var currentTallest = currentTallest1;
	if(currentTallest1 < currentTallest2) currentTallest = currentTallest2;
	
	currentTallest = Math.ceil(currentTallest);
	
	$(this).each(function(){
/*		if ($.browser.msie && $.browser.version == 6.0) { $(this).children().css({'height': currentTallest}); }
		$(this).children().css({'min-height': currentTallest});*/
		$(this).children().css({'height': currentTallest + 'px'});
	});
	
	$('.item-desc').each(function(){
			$(this).css('min-height', '0px');
		});
		
	$('.item-product-img').each(function(){
			$(this).css('min-height', '0px');
		});
	
	return this;
};

$.fn.equalHeightsAll = function(px) {
	var currentTallest = 0;
	$(this).each(function(){
		$(this).css('min-height', '0px');
		if ($(this).height() > currentTallest) { currentTallest = $(this).height(); }
	});
	
	if ($.browser.msie && $.browser.version == 6.0) { $(this).children().css({'height': currentTallest}); }
		$(this).each(function(){
			$(this).css({'min-height': currentTallest});
		});
	
	return this;
};


