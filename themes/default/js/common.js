/****GLOBAL VARIABLES****/
var overlay_obj_width=0;
var overlay_obj_height=0;
var overlay_obj_id='';
var map_status=false;
var address='';
var shoppingBagUrl = "";
var heightEqualizer = function() {};
var layoutViewOption = function() {};
var quickViewMouseEnter = function(){};
var quickViewMouseLeave = function(){};

if (!String.prototype.trim) {
	String.prototype.trim = function() {
		return this.replace(/^\s+|\s+$/g,'');
	}
}

function initCufon() {
	Cufon.replace('h1');
	Cufon.replace('h2');
	Cufon.replace('h3'); //h3 is specially for mainnav links
}

/****INITIALIZATION OF PRODUCT DETAILS PAGE****/
function initCentralizeProductDetailsContainer(){
	jQuery.event.add(window, "load", centralizeProductDetailsContainer);
	jQuery.event.add(window, "resize", centralizeProductDetailsContainer);
	
}

function centralizeProductDetailsContainer(){
	var leftColumnWidth=$('.product-details-column-left').width();
	var rightColumnWidth=$('.product-details-column-right').width();
	var productDetailsContainerWidth=leftColumnWidth+rightColumnWidth;
	$('.product-details-container').css('min-width','750px');
	$('.product-details-container').css('width',productDetailsContainerWidth);
	$('.product-details-container').css('margin','auto');
}

/****INITIALIZATION OF LANDING PAGE****/
function initLanding(){
	jQuery.event.add(window, "load", landing);
	jQuery.event.add(window, "resize", landing);
	
	jQuery(function () {
		$(window).scroll(function () {
			$('#makeMeScrollable').css('position', 'fixed');
			$('#makeMeScrollable').css('top', '0px');
		});
	});
}

function landing(){
	var h = $(window).height();
	var ah=$('#country-box').height();
	var nh = ((h - ah) / 2)-5;
	var w = $(window).width();
	var aw=$('#country-box').width();
	var nw = ((w - aw) / 2)-6;
	$('#country-box').css('position','absolute');
	$('#country-box').css('top',nh);
	$('#country-box').css('left',nw);
	$('#country-box').show();
	
	var mainContentContainerWidth=$(window).width();
	$('#main-content-container').css('width',mainContentContainerWidth-247);
	$('#main-content-container-home').css('width',mainContentContainerWidth-247);

	
	
	var catalogueContainerWidth=$('#main-content-container').width();
	//$('.catalogue-container').css('width',catalogueContainerWidth-50);
	
	var checkoutRightnav=$('#checkout-right-nav').width();
	$('.checkout_itemlist').css('width',checkoutRightnav);
	
	var labelContainerWidth=$('.catalogue-itembox').width();
	$('.label-container').css('width',labelContainerWidth-30);
	
	var quickViewPosition=$('.item-product-img').width();
	$('.quickview-btn').css('left',(quickViewPosition*0.5)-45);
	
	// position my account dropdown list box
	if($(".myaccount-username").length > 0) {
		var positionLeft = $(".myaccount-username").offset().left;
		var positionRight = positionLeft + $(".myaccount-username").outerWidth();
		var ddWidth = $("#myaccount-box").outerWidth();
		$("#myaccount-box").css('left',positionRight - ddWidth +'px');
	}
	
	if(typeof heightEqualizer !== "undefined") {
		heightEqualizer();
	}
	
	if(typeof resizeScrollableContainer !== "undefined") {
		resizeScrollableContainer('makeMeScrollable');
	}
	
	if(typeof adjustFixedElementsPosition !== "undefined") {
		adjustFixedElementsPosition();
	}
	
	//position footer to the bottom of the page
	  var browserHeight = $(window).height();
	  $('#landing-catalogue').css('min-height',browserHeight);
	   $('#main-content-container').css('min-height',browserHeight-120);
	   $('#main-content-container-home').css('min-height',browserHeight-120);
	  
	   
	   
	  var mainContentHeight = $('#main-content-container').height();
	  if ((mainContentHeight + 80) < browserHeight){
			  $('#footer').css('position','absolute');
			  $('#footer').css('bottom','0');
			  $('#footer').css('right','0');
		  }

	  
	  var mainContentHeightHome = $('#main-content-container-home').height();
	  if ((mainContentHeightHome + 80) < browserHeight){
			  $('#footer-home').css('position','relative');
			  $('#footer-home').css('bottom','0');
			  $('#footer-home').css('right','0');
		  }
	  
	  
	  
	  //set jscrollpane to return terms div on MY RETURNS page
	  var returnTermsContainerWidth = $('.return_terms_container').width();
	  var returnTermsDivWidth = (returnTermsContainerWidth * 0.97) - 17;
	  $('.return_terms').css('width',returnTermsDivWidth + 'px');
	  $('.return_terms').css('padding-right','15px');
	  $('.return_terms').jScrollPane();
}
/****INITIALIZATION OF CENTRALIZE OVERLAY OBJECT****/
function initVCentralize(){
	jQuery.event.add(window, "load", vCentralize);
	jQuery.event.add(window, "resize", vCentralize);
	/*jQuery.event.add(window, "scroll", vCentralize);*/
}
function vCentralize(){
	var visibleHeight = document.documentElement.clientHeight;
	var hiddenHeight = $(document).scrollTop();
	var h = hiddenHeight + (visibleHeight / 2);
	var y = h - (overlay_obj_height / 2);
	var halfwidth = document.documentElement.clientWidth/2;
	var x = halfwidth -(overlay_obj_width/2);
	
	$('.overlay_container').css('margin-top', (y < 0 ? 0 : y));
	$('.with_session').css('margin-top',y-133);
	$('.overlay_container').css('margin-left',x);
	$('.btn_close').css('left', x + overlay_obj_width);
	$('.btn_close').css('top', y - 50);
	//$('.overlay').css('top', y - 50);
	$('.overlay').css('height',0);
	$('.overlay').css('height',$(document).height()-4);//minus 4 so that the vertical scrollbar is not triggered in IE8
}

/****BACK TO TOP FADE IN / OUT****/
function initBackToTop(){
	// hide #back-top first
	$("#back-top").hide();
	
	// fade in #back-top
	$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 100) {
				$('#back-top').fadeIn();
			} else {
				$('#back-top').fadeOut();
			}
			
			if ($(this).scrollTop() + $(window).height() >= ($(document).height() - 50)) {
				//loadMore(); Fuandi requested to hide this
			}
			
			adjustFixedElementsPosition();
		});

		// scroll body to 0px on click
		$('#back-top a').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
	});
}

function adjustFixedElementsPosition() {
	// moving the fixed element on horizontal scrolling
	// header-container
	$('#header-container').css('left', ( -1 * $(this).scrollLeft()) + 'px');
	// makeMeScrollable
	$('#makeMeScrollable').css('left', ( -1 * $(this).scrollLeft()) + 'px');
	// viewoption-container
	$('#viewoption-container').css('right', ($(window).width() - $(document).width() + $(this).scrollLeft() + 17) + 'px');
}


/****VIEW OPTION 6 REFRESH****/
function changeViewOption(count) {
	if(count == 6) {
		$('.catalogue-itembox > a').equalHeightsAll();
		$('.item-desc').equalHeightsAll();
				
		$('.catalogue-itembox').fadeOut(function(){
			viewOption_6();
			$('.catalogue-itembox').fadeIn();
		});
	}
	else {
		$('.catalogue-itembox').fadeOut(function(){
			viewOption_3();
			$('.catalogue-itembox').fadeIn();
		});
	}
}

function clearViewClasses(selector) {
	$(selector).removeClass("view3");
	$(selector).removeClass("view6");
}

function viewOption_6(){
	clearViewClasses('.item-product-img');
	$('.item-product-img').addClass("view6");
	
	$('.catalogue-itembox').css('width','12%');
	$('.catalogue-itembox').css('padding-top','2%');
	$('.catalogue-itembox').css('padding-bottom','2%');
	$('.catalogue-itembox').css('padding-left','2%');
	$('.catalogue-itembox').css('padding-right','2%');
	$('.catalogue-itembox').css('position','relative');
	
	$('.item-desc').css('background-color','#ffffff');
	$('.item-desc').css('width','100%');
	$('.item-desc').css('position','absolute');
	$('.item-desc').css('top','0');
	$('.item-desc').css('left','0');
	//$('.item-desc-quickview').css('display','none');
	$('.item-desc-morecolours').css('display','none');
	//$('.item-desc-exclusive').css('display','none');
	$('.item-label').css('display','none');
	$('.label-new').css('display','inline-block');
	if($.browser.msie && parseFloat($.browser.version) < 8){
		$('.label-new').css('display','inline');
	}
	$('.quickview-btn').css('display','none');
	$('.quickview-btn2').css('display','block');
	$('.item-desc').css('display','none');
	
	$('.catalogue-itembox').mouseenter(function(){
		$(this).find('.item-desc').css('display','block');
	});
	$('.catalogue-itembox').mouseleave(function(){
		$(this).find('.item-desc').css('display','none');
	});
	
	equalizeHeight_6();
	
	layoutViewOption = viewOption_6;
	heightEqualizer = equalizeHeight_6;
}

/****VIEW OPTION 3 REFRESH****/
function viewOption_3(){
	clearViewClasses('.item-product-img');
	$('.item-product-img').addClass("view3");
	
	$('.catalogue-itembox').css('width','27.3%');
	$('.catalogue-itembox').css('padding-top','3%');
	$('.catalogue-itembox').css('padding-bottom','3%');
	$('.catalogue-itembox').css('padding-left','3%');
	$('.catalogue-itembox').css('padding-right','3%');
	$('.catalogue-itembox').css('position','');
	
	$('.item-desc').css('background-color','#ffffff');
	$('.item-desc').css('width','100%');
	$('.item-desc').css('position','');
	$('.item-desc').css('top','');
	$('.item-desc').css('left','');
	//$('.item-desc-quickview').css('display','block');
	$('.item-desc-morecolours').show();
	//$('.item-desc-exclusive').css('display','block');
	$('.item-label').css('display','inline-block');
	$('.label-new').css('display','inline-block');
	if($.browser.msie && parseFloat($.browser.version) < 8){
		$('.item-label').css('display','inline');
		$('.label-new').css('display','inline');
	}
	$('.quickview-btn').css('display','none');
	$('.quickview-btn').css('left',(($('.item-product-img').width())*0.5)-45);
	$('.quickview-btn2').css('display','none');
	$('.item-desc').css('display','block');
	
	$('.catalogue-itembox').mouseenter(function(){
		$(this).find('.item-desc').css('display','block');
	});
	$('.catalogue-itembox').mouseleave(function(){
		$(this).find('.item-desc').css('display','block');
	});
	
	equalizeHeight_3();
	
	layoutViewOption = viewOption_3;
	heightEqualizer = equalizeHeight_3;
}

function equalizeHeight_3() {
	$('.equalize').equalHeights();
}

function equalizeHeight_6() {
	$('.item-desc').css('display','block');
	$('.item-product-img').equalHeightsAll();
	$('.item-desc').equalHeightsAll();
	$('.equalize').equalHeights2();
	$('.item-desc').css('display','none');
}

/****EXPAND & COLLAPSE LANDING PAGE INFO BOX WHEN CLICK ON DROPOWN****/
function expandLandingInfo(){
	$('#landing_info_container').css('margin-top','170px');
	$('.landing_legend').css('display','block');
}

function collapseLandingInfo(){
	$('#landing_info_container').css('margin-top','20px');
	$('.landing_legend').css('display','none');
}

/****INITIALIZATION OF HOMEPAGE BANNER****/
function initHomepageBanner(){
		$('#banner-container').masonry({
        columnWidth: 1, 
        itemSelector: '.box'
      });
}

/****DETECTION OF MAINNAV SCROLLABLE HEIGHT****/
function detectScrollableHeight(){
	var mainnavHeight=$('#mainnav-wrapper').height();
	var scrollableHeight=mainnavHeight;
	$('#makeMeScrollable').css('height',scrollableHeight);
}

/****INITIALIZATION OF DROP DOWN OF COUNTRY AND SHOPPING BAG(APPEAR AT EVERYPAGE)****/
function initDropdownOfShoppingBag(shoppingBagSrcUrl){
	shoppingBagUrl = shoppingBagSrcUrl;
	initDropdown();
}
function initDropdown(){
	languageDD();
	countriesDD();
	shoppingbagDD();
}
function languageDD(){
	$(".langlink").mouseenter(function(){
		  $('.drp-lang').show();
	  });
	  $(".langlink").mouseleave(function(){
		  $('.drp-lang').hide();
	  });
	    $(".drp-lang").mouseenter(function(){
		  $('.drp-lang').show();
	  });
	   $(".drp-lang").mouseleave(function(){
		  $('.drp-lang').hide();
	  });
}
function countriesDD(){
	timeout=0;
	$(".destination-link").click(function(){
		clearTimeout(timeout);
		$('#destination-box').show();
	  });
	  $(".destination-link").mouseleave(function(){
		  clearTimeout(timeout);
		timeout=setTimeout(function()
        { 
		  $('#destination-box').hide();
		 }, 3000);
	  });
	  $("#destination-box").mouseenter(function(){
		  clearTimeout(timeout);
		  $('#destination-box').show();
		  
	  });
	   $("#destination-box").mouseleave(function(){
		   clearTimeout(timeout);
		timeout=setTimeout(function()
        { 
		  $('#destination-box').hide();
		 }, 3000);
	  });
	  $(".d-closebtn").click(function(){
	    clearTimeout(timeout);
		$('#destination-box').hide();
	  });
}
function shoppingbagDD(){
	stimeout=0;
	$('#shoppingbag-scrollpane').jScrollPane();
		//to manually set the position of arrows, otherwise they'll be separated from dragbar
		$('.jScrollArrowUp').css('right','-15px');
		$('.jScrollArrowUp').css('top','-4px');
		$('.jScrollArrowDown').css('right','-15px');
		$('.jScrollArrowDown').css('bottom','0px');
		//$('#shoppingbag-box').css('visibility','hidden');
		$('#shoppingbag-box').css('display','none');
	    //$('#shoppingbag-box').hide();
	
	var iever = getInternetExplorerVersion();
	
	if(iever<8&&iever>6)
		$('#shoppingbag-box').css('top','50px');
	else if(iever<7)
		$('#shoppingbag-box').css('top','54px');
	else if(iever>=8)
		$('#shoppingbag-box').css('top','54px');
	
	/*$(".shoppingbag").click(function(){//shopping bag link on everypage
		clearTimeout(stimeout);
		//$('#shoppingbag-box').css('visibility','visible');
		$('#shoppingbag-box').css('display','block');
		//$('#shoppingbag-box').show();
		setTimeout(function() {
				$('.iframe-shoppingbagdd').attr('src', shoppingBagUrl);
			}, 1000);
	  });*/
	  /*$(".shoppingbag").mouseleave(function(){
		  clearTimeout(stimeout);
		stimeout=setTimeout(function()
        { 
		  //$('#shoppingbag-box').css('visibility','hidden');
		  $('#shoppingbag-box').css('display','none');
		  //$('#shoppingbag-box').hide();
		 }, 5000);
	  });*/
	  
	  $(".addtobag").click(function(){//add to bag button on product detail page
		clearTimeout(stimeout);
		$(document).scrollTop(0);
		//$('#shoppingbag-box').css('visibility','visible');
		$('#shoppingbag-box').css('display','block');
		//$('#shoppingbag-box').show();
	  });
	  $(".addtobag").mouseleave(function(){
		  clearTimeout(stimeout);
		stimeout=setTimeout(function()
        { 
		  //$('#shoppingbag-box').css('visibility','hidden');
		  $('#shoppingbag-box').css('display','none');
		  //$('#shoppingbag-box').hide();
		 }, 5000);
	  });
	  
	  $("#shoppingbag-box").mouseenter(function(){
		  clearTimeout(stimeout);
		  //$('#shoppingbag-box').css('visibility','visible');
		  $('#shoppingbag-box').css('display','block');
		  //$('#shoppingbag-box').show();
		  
	  });
	   /*$("#shoppingbag-box").mouseleave(function(){
		   clearTimeout(stimeout);
		stimeout=setTimeout(function()
        { 
		  //$('#shoppingbag-box').css('visibility','hidden');
		  $('#shoppingbag-box').css('display','none');
		  //$('#shoppingbag-box').hide();
		 }, 5000);
	  });*/
	  $(".sb-closebtn").click(function(){
	    clearTimeout(stimeout);
		//$('#shoppingbag-box').css('visibility','hidden');
		$('#shoppingbag-box').css('display','none');
		//$('#shoppingbag-box').hide();
	  });
}
function resizeBannerHeight(h){
		$('#banner-container').css('min-height', h);
}

/****INITIALIZATION SCROLLING NEWS****/
function initScrollingNews(scrollSpeed){
	$('#news').cycle({
		fx:'scrollLeft',
		speed:500,
		timeout:scrollSpeed,
		cleartype:true,
    	cleartypeNoBg:true
		});
}
/****LEFT BANNER MOUSE OVER EFFECT****/
function initSmallBannerEffect() {
	$('.smallbanner a div').css('opacity',0);
	$('.smallbanner a').mouseenter(function(){
		var w = $(this).find('img').width();
		var h = $(this).find('img').height();
		$(this).find('div').css('width',w+"px");
		$(this).find('div').css('height',h+"px");
		$(this).find('div').animate({opacity:0.4});
	});
	$('.smallbanner a').mouseleave(function(){
		$(this).find('div').animate({opacity:0});
	});
}

/***** GENERAL OVERLAY ******/
function initOverlay(){
	$('.overlay_container').children('div').hide();	
	
	if(getInternetExplorerVersion()<7) // screw IE 6!!!
		$('body').append("<div id='overlay' class='overlay'><iframe src=blank.html width=100% height=100% frameborder=0 class=black_iframe></iframe></div><a href='javascript:void(0);' onclick='javascript:hideOverlay();'><div class='btn_close'></div></a>");
	else
		$('body').append("<div id='overlay' class='overlay'></div><a href='javascript:void(0);' onclick='javascript:hideOverlay();'><div class='btn_close'></div></a>");
	
	$('.overlay').css('opacity',0.9);
	
	$('.showoverlay').click(function(){
		overlay_obj_id = $(this).attr('name');
		if(overlay_obj_id=='#map'){ //for google map overlay
			address = $(this).attr('rel');
			map_status=true;
		}
		if(overlay_obj_id=='#youtube_video'){ //for youtube video
			$(overlay_obj_id).html(getYoutubeVideo($(this).attr('rel')));//set the youtube video html in the youtube_video div with the video code
		}
		if(overlay_obj_id=='#mov_video'){ //for mov video
			$(overlay_obj_id).html(getMovVideo($(this).attr('rel')));//set the mov video html in the mov_video div with the video code
		}
		if(overlay_obj_id=='#slideshow_container'){
			initPrdSlideshow($(this).attr('rel')); //initiate product slideshow
		}
		showOverlay();
	});
}
function showOverlay(){ //this showoverlay is customise for CK Shopping site
	$('#destination-box').hide();
	//$('#shoppingbag-box').css('visibility','hidden');
	$('#shoppingbag-box').css('display','none');
	//$('#shoppingbag-box').hide();
	
	$('.overlay').css('height',$(document).height()-4);//minus 4 so that the vertical scrollbar is not triggered in IE8
	$('.overlay').fadeIn("slow",function() {
		
		overlay_obj_height = $(overlay_obj_id).height(); 
		overlay_obj_height  += parseInt($(overlay_obj_id).css("margin-top"), 10) + parseInt($(overlay_obj_id).css("margin-bottom"), 10)+ parseInt($(overlay_obj_id).css("padding-top"), 10)+parseInt($(overlay_obj_id).css("padding-bottom"), 10);
		overlay_obj_width = $(overlay_obj_id).width();
		overlay_obj_width += parseInt($(overlay_obj_id).css("margin-left"), 10) + parseInt($(overlay_obj_id).css("margin-right"), 10)+ parseInt($(overlay_obj_id).css("padding-left"), 10)+parseInt($(overlay_obj_id).css("padding-right"), 10);
		$('.ckform_top_middle, .ckform_bottom_middle').css('width',overlay_obj_width-30);//specially resize for rounded corner object like ckform
		vCentralize();			
		initVCentralize();
		$('.btn_close').show();	
		$(overlay_obj_id).show();
		if(map_status){//if is google map overlay it will call the map out
			codeAddress();
			map_status=false;	
		}
	});
	
	$('.overlay').click(function(){
		$('.btn_close').fadeOut("slow");	
		$('.overlay').fadeOut("slow");
		$(overlay_obj_id).hide();
	});
	
} 
function hideOverlay(){
	$('.btn_close').fadeOut("slow");	
	$('.overlay').fadeOut("slow");
	$(overlay_obj_id).hide();
	//start specially for checkout add new address book overlay
	$(".add_addressbook").hide();
	$("#addressbook").css('width','520px');
	$(".ckform_top_middle").css('width','490px');
	$(".ckform_bottom_middle").css('width','490px');
	$("#addressbook").css('margin-left','');
	$('.btn_close').css('margin-left','');
	$(".add_new_address_btn").show();
	//end specially for checkout add new address book overlay
	if(overlay_obj_id=='#youtube_video')
		$(overlay_obj_id).html('');
}

function initOverlay_new(){
	$('.overlay_container').children('div').hide();	
	
	if(getInternetExplorerVersion()<7) // screw IE 6!!!
		$('body').append("<div id='overlay' class='overlay'><iframe src=blank.html width=100% height=100% frameborder=0 class=black_iframe></iframe></div>");
	else
		$('body').append("<div id='overlay' class='overlay'></div>");
	
	$('.overlay').css('opacity',0.9);
	
	$('.overlay').click(function(){
		$('.overlay').fadeOut("slow");
		$(overlay_obj_id).hide();
		if(overlay_obj_id=='#youtube_video')
		$(overlay_obj_id).html('');
	});
	
/*	$('.showoverlay').click(function(){
		overlay_obj_id = $(this).attr('name');
		if(overlay_obj_id=='#map'){ //for google map overlay
			address = $(this).attr('rel');
			map_status=true;
		}
		if(overlay_obj_id=='#youtube_video'){ //for youtube video
			$(overlay_obj_id).html(getYoutubeVideo($(this).attr('rel')));//set the youtube video html in the youtube_video div with the video code
		}
		if(overlay_obj_id=='#mov_video'){ //for mov video
			$(overlay_obj_id).html(getMovVideo($(this).attr('rel')));//set the mov video html in the mov_video div with the video code
		}
		if(overlay_obj_id=='#slideshow_container'){
			initPrdSlideshow($(this).attr('rel')); //initiate product slideshow
		}
		showOverlay();
	});*/
}
function showOverlay_new(callerObj){ //this showoverlay is customise for CK Shopping site
	overlay_obj_id = $(callerObj).attr('name');
	var iframeUrl = $(callerObj).attr('url');
	if(overlay_obj_id=='#map'){ //for google map overlay
		address = $(callerObj).attr('rel');
		map_status=true;
	}
	if(overlay_obj_id=='#youtube_video'){ //for youtube video
		$(overlay_obj_id).html(getYoutubeVideoNew($(callerObj).attr('rel')));//set the youtube video html in the youtube_video div with the video code
	}
	if(overlay_obj_id=='#mov_video'){ //for mov video
		$(overlay_obj_id).html(getMovVideo($(callerObj).attr('rel')));//set the mov video html in the mov_video div with the video code
	}
	if(overlay_obj_id=='#slideshow_container'){
		initPrdSlideshow($(callerObj).attr('rel')); //initiate product slideshow
	}
		
	$('#destination-box').hide();
	//$('#shoppingbag-box').css('visibility','hidden');
	$('#shoppingbag-box').css('display','none');
	//$('#shoppingbag-box').hide();
	
//	$('#overlay_iframe').attr('src', iframeUrl);
	
	$('.overlay').css('height',$(document).height()-4);//minus 4 so that the vertical scrollbar is not triggered in IE8
	$('.overlay').fadeIn("slow",function() {
		
		overlay_obj_height = $(overlay_obj_id).height(); 
		overlay_obj_height  += parseInt($(overlay_obj_id).css("margin-top"), 10) + parseInt($(overlay_obj_id).css("margin-bottom"), 10)+ parseInt($(overlay_obj_id).css("padding-top"), 10)+parseInt($(overlay_obj_id).css("padding-bottom"), 10);
		overlay_obj_width = $(overlay_obj_id).width();
		overlay_obj_width += parseInt($(overlay_obj_id).css("margin-left"), 10) + parseInt($(overlay_obj_id).css("margin-right"), 10)+ parseInt($(overlay_obj_id).css("padding-left"), 10)+parseInt($(overlay_obj_id).css("padding-right"), 10);
		
//		vCentralize();
		initVCentralize();
		$(overlay_obj_id).show();
		if(map_status){//if is google map overlay it will call the map out
			codeAddress();
			map_status=false;	
		}
		vCentralize();
		
		//$('#overlay_iframe').attr('src', iframeUrl);
		$(overlay_obj_id).find('iframe').attr('src', iframeUrl);
	});
}

function hideOverlay_new(){
	$('.overlay').fadeOut("slow");
	$(overlay_obj_id).hide();
	//$('.btn_close').css('margin-left','');
	if(overlay_obj_id=='#youtube_video')
		$(overlay_obj_id).html('');
} 

function showCKOverlay(htmlcode){ 
	var c="";
	c=htmlcode.replace(/"/g, '\\"')
	$('.overlay_container').append(c);
}

//****FADE IN PRODUCT THUMBNAIL WHEN ON LOAD****/
function fadeInProdImage(start,end) { 
		for(i=start;i<=end;i++)
		{
			imageId = 'prd-cat-img'+i;
			image = document.getElementById(imageId);
			setOpacity(image, 0);
			image.style.visibility = 'visible';
			fadeIn(imageId,0);
		}
}

function setOpacity(obj, opacity) {
  opacity = (opacity == 100)?99.999:opacity;
  
  // IE/Win
  obj.style.filter = "alpha(opacity:"+opacity+")";
  
  // Safari<1.2, Konqueror
  obj.style.KHTMLOpacity = opacity/100;
  
  // Older Mozilla and Firefox
  obj.style.MozOpacity = opacity/100;
  
  // Safari 1.2, newer Firefox and Mozilla, CSS3
  obj.style.opacity = opacity/100;
}

function fadeIn(objId,opacity) {
  if (document.getElementById) {
    obj = document.getElementById(objId);
    if (opacity <= 100) {
      setOpacity(obj, opacity);
      opacity += 10;
      window.setTimeout("fadeIn('"+objId+"',"+opacity+")", 70);
    }
  }
}


/****CHANGE PRODUCT THUMBNAIL FOR PRODUCT CATEGORY PAGE****/
function passThumbnailID(first_img,second_img){
	
	//var original_src = $(first_img).attr('src');
	//var new_src = $(second_img).attr('src');
	
/*		original_src = $(first_img).attr('src');
		new_src = $(second_img).attr('src');
*/		//$(first_img).animate({"opacity": "0"}, "slow");
		$(first_img).hide();
		$(second_img).show();
}

function removeThumbnailID(first_img2,second_img2){
		$(first_img2).show();
			
		//$(first_img2).show();
}


/****CHANGE PRODUCT THUMBNAIL FOR PRODUCT CATEGORY PAGE****/
function initProductThumbnail(){
		
	var original_src='';
	var new_src='';
	//var new_src='';
	
	$('.prd_cat_box1').mouseenter(function(){
		//new_src = $(this).find('.prd-cat-img').attr('name');
		original_src = $(this).find('.prd-cat-img').attr('src');
		var new_src = $(this).find('.prd-cat-img2').attr('src');
		//change to alternate image
		$(this).find('.prd-cat-img').attr('src',original_src).animate({"opacity": "0"}, "slow");
		$(this).find('.prd-cat-img2').attr('src',new_src).show();

		//$(this).stop().animate({"opacity": "0"}, "slow");
		//$(this).find('.prd-cat-img').attr('src',new_src).fadeIn("normal");
	});
	$('.prd_cat_box1').mouseleave(function(){
		//reset to original image
		$(this).find('.prd-cat-img').attr('src',original_src).animate({"opacity": "1"}, "slow");

		//$(this).find('.prd-cat-img').attr('src',original_src).show();
		//$(this).find('.prd-cat-img').attr('src',original_src).fadeIn("normal");
	});
}

/****CHANGE PRODUCT THUMBNAIL FOR PRODUCT CATEGORY PAGE****/
function initProductThumbnailNew(i){
		//for(i=0;i<end;i++)
		//{
			
			var original_src='';
			var new_src='';
			var divId = '';
			var firstAngle = '';
			var secondAngle= '';
			divId = '#prd_cat_box'+i;
			//containerId = '#prd-cat-img-container'+i;
			firstAngle = '#prd-cat-img'+i+'b';
			secondAngle = '#prd-cat-img'+i+'a';
			
	//var new_src='';	
	
	
	$(divId).mouseenter(function(){
		//new_src = $(this).find('.prd-cat-img').attr('name');
		original_src = $(firstAngle).attr('src');
		var new_src = $(secondAngle).attr('src');
		
		//alert(i)
		//change to alternate image
		$(firstAngle).attr('src',original_src).animate({"opacity": "0"}, "slow");
		$(secondAngle).attr('src',new_src).show();
		
	//$(this).find('.prd-cat-img').attr('src',original_src).animate({"opacity": "0"}, "slow");
		//$(this).stop().animate({"opacity": "0"}, "slow");
		//$(this).find('.prd-cat-img').attr('src',new_src).fadeIn("normal");
	});
	$(divId).mouseleave(function(){
		//reset to original image
		$(firstAngle).attr('src',original_src).animate({"opacity": "1"}, "slow");

		//$(this).find('.prd-cat-img').attr('src',original_src).show();
		//$(this).find('.prd-cat-img').attr('src',original_src).fadeIn("normal");
	});
		//}
	
}


/****ADJUST THE MENU IN MAC****/
function adjustMenu(){
	if(BrowserDetect.OS == 'Mac')
		$('#menu ul li').css('margin-right',25);
 
}
/****ADJUST THE IFRAME HEIGHT FOR OTHERDESTINATION FORM IN CHROME****/
function adjustOverlayForm(){
	
	if(BrowserDetect.browser == 'Chrome')
	{
		$('.otherdestination_form').css('height',305);
		
	}else if(BrowserDetect.browser == 'Safari')
	{
		$('.otherdestination_form').css('height',305);
	}
}
/****GET VERSION OF BROSWER****/
function getInternetExplorerVersion()
// Returns the version of Internet Explorer or 8(other broswer)
// (indicating the use of another browser).
{
  var rv = 8; // Return value assumes failure.
  if (navigator.appName == 'Microsoft Internet Explorer')
  {
    var ua = navigator.userAgent;
    var re  = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
    if (re.exec(ua) != null)
      rv = parseFloat( RegExp.$1 );
  }
  return rv;
}

/****CLEAR INPUT FIELD****/
function clearText(field){

    if (field.defaultValue == field.value) field.value = '';
    else if (field.value == '') field.value = field.defaultValue;
}
/****INITIALIZATION OF PRODUCT DETAILS PAGE****/
function initPrductPreviewImage(){
	$('.prd_thumbnail_img a').click(function(){
		$('.prd_preview_img').attr('src',$(this).attr('rel'));
		$('.viewslideshow_link').attr('rel', $(this).attr('href').substr(1)); //set the view full image's default image.
	});
}
function initColor(){
	var selected_color = $('.color_caption').text();
	var color='';
	$("a.color").mouseenter(function() {
		color = $(this).attr('title');
		$('.color_caption').text(color);	
	});
	$("a.color_disabled").mouseenter(function() {
		color = $(this).attr('title');
		$('.color_caption').text(color);	
	});
	$("a.color").mouseleave(function() {
		$('.color_caption').text(selected_color);
	});
	$("a.color_disabled").mouseleave(function() {
		$('.color_caption').text(selected_color);
	});
	$("a.color").click(function() {
		color = $(this).attr('title');
		selected_color = color;
		$('.color_caption').text(color);
		$('.color').removeClass('selected');
		$(this).addClass('selected');	
	});
	$("a.color_disabled").click(function() {
		color = $(this).attr('title');
		selected_color = color;
		$('.color_caption').text(color);
		$('.color').removeClass('selected');
		$(this).addClass('selected');	
	});
}

/****NEW!!! INITIALIZATION YOUTUBE VIDEO****/
function getYoutubeVideoNew(videoCode){
	var videoObj='';
    /*videoObj += "<iframe width=\"560\" height=\"315\" src=\""+videoCode+" frameborder=\"0\" allowfullscreen></iframe>"
	return videoObj;*/
	videoObj += "<object width=\"560\" height=\"315\"><param name=\"movie\" value=\""+videoCode+"></param><param name=\"allowFullScreen\" value=\"true\"></param><param name=\"allowscriptaccess\" value=\"always\"></param><embed src=\""+videoCode+" type=\"application/x-shockwave-flash\" allowscriptaccess=\"always\" allowfullscreen=\"true\" width=\"560\" height=\"315\"></embed></object>"
	return videoObj;
	}	

/****INITIALIZATION YOUTUBE VIDEO****/
function getYoutubeVideo(videoCode){
	var videoObj='';
    videoObj += "<object width=\"641\" height=\"392\"><param name=\"movie\" value=\""+videoCode+"&fs=1&border=1\"></param><param name=\"allowFullScreen\" value=\"true\"></param><param name=\"allowscriptaccess\" value=\"always\"></param><embed src=\""+videoCode+"&fs=1&border=1\" type=\"application/x-shockwave-flash\" allowscriptaccess=\"always\" allowfullscreen=\"true\" width=\"641\" height=\"392\"></embed></object>"
	return videoObj;
	}
/****INITIALIZATION MOV VIDEO****/
function getMovVideo(movCode){
	var movObj='';
   // movObj += "<object width=\"641\" height=\"392\"><param name=\"movie\" value=\"http://ck01.charleskeith.com/ittest/"+movCode+"\"></param><param name=\"allowFullScreen\" value=\"true\"><param name=\"scale\" value=\"tofit\"></param><param name=\"allowscriptaccess\" value=\"always\"></param><embed src=\"http://ck01.charleskeith.com/ittest/"+movCode+"\" type=\"application/x-shockwave-flash\" allowscriptaccess=\"always\" allowfullscreen=\"true\" width=\"641\" height=\"392\" scale=\"tofit\"></embed></object>"
    movObj += "<object classid=\"clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B\" codebase=\"http://www.apple.com/qtactivex/qtplugin.cab\" width=\"641\" height=\"392\"><param name=\"src\" value=\"http://ck01.charleskeith.com/ittest/"+movCode+"\"></param><param name=\"autoplay\" value=\"true\"></param><param name=\"controller\" value=\"true\"></param><param name=\"scale\" value=\"tofit\"></param><embed src=\"http://ck01.charleskeith.com/ittest/"+movCode+"\" width=\"641\" height=\"392\" controller=\"true\" autoplay=\"true\" scale=\"tofit\" pluginspage=\"http://www.apple.com/quicktime/download/\"></embed></object>"
	return movObj;
	}
/****INITIALIZATION PRODUCT SLIDESHOW****/
function initPrdSlideshow(target){
	$('.slideshow').cycle({
		fx:     'fade',
		speed:  'fast',
		timeout: 0,
		startingSlide:target,
		nowrap:true,
		next:   '#next',
		prev:   '#prev',
		after:onAfter
		});
	
	$('#next,#prev').css('top',$(overlay_obj_id).height()/2);
	
}
/** to hide button **/
function onAfter(curr,next,opts) {
	var idx = opts.currSlide + 1;
	if(idx==1){ 
		$('#prev').hide();
	}else{
		$('#prev').show();
	}
	
	var totalSlide = $('.slideshow').children().size();
	if(idx==totalSlide){
		$('#next').hide();
	}else{
		$('#next').show();
	}
}
/****TAB****/
function initTab(){

	//When page loads...
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").find('.tap_top_left,.tap_top_right').addClass("active");//set default active rounded corner for tab
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content
	$('.tab_content:first').jScrollPane();

	//On Click Event
	$("ul.tabs li").click(function() {
	
		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$("ul.tabs li").find('div').removeClass("active");//remove any "active" for rounded corner
		$("ul.tabs li").find('div').removeClass("hover");//remove any "hover" for rounded corner
		$(this).addClass("active"); //Add "active" class to selected tab
		$(this).find('.tap_top_left,.tap_top_right').addClass("active"); //set active to selected rounded corner
		$(".tab_content").jScrollPaneRemove();
		$(".tab_content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).show(); //Fade in the active ID content
		$(activeTab).jScrollPane();
		return false;
	});
	
	//On Click Event
	$("ul.tabs li").mouseenter(function() {
		if(!$(this).hasClass('active'))
			$(this).find('.tap_top_left,.tap_top_right').addClass("hover");//add "hover" for rounded corner tab
	});
	$("ul.tabs li").mouseleave(function() {
		$(this).find('.tap_top_left,.tap_top_right').removeClass("hover");//remove "hover" for rounded corner tab
	});
}

/****** INITIALIZATION OF IMAGE PREVIEW FOR STORE LOCATOR ******/
function initImagePw(){
		$('ul#store-list a').imgPreview({
		containerID: 'imgPreviewContainer',
		/*imgCSS: {
			// Limit preview size:
			height: 200
		},*/
		// When container is shown:
		onShow: function(link){
			// Animate link:
			$(link).stop().animate({opacity:0.4});
			// Reset image:
			$('img', this).css({opacity:0});
		},
		// When image has loaded:
		onLoad: function(){
			// Animate image
			$(this).animate({opacity:1}, 250);
		},
		// When container hides: 
		onHide: function(link){
			// Animate link:
			$(link).stop().animate({opacity:1});
		}
	});
}
/****** INITIALIZATION OF GOOGLE MAP ******/
	var geocoder;
	var map;
	
	function initialize() {
	  geocoder = new google.maps.Geocoder();
	  var latlng = new google.maps.LatLng(-34.397, 150.644);
	  var myOptions = {
		zoom: 16,
		center: latlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	  }
	  map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
	}
	
	function codeAddress() {
		  google.maps.event.trigger(map, 'resize');
	
	  geocoder.geocode( { 'address': address}, function(results, status) {//the address is global variabal on this page
		if (status == google.maps.GeocoderStatus.OK) {
	
		  map.setCenter(results[0].geometry.location);
		  var marker = new google.maps.Marker({
			  map: map, 
			  position: results[0].geometry.location
		  });
		 google.maps.event.trigger(map, 'resize');
		} else {
		  alert("Geocode was not successful for the following reason: " + status);
		}
	  });
	}
	
	function initMap(){
		jQuery.event.add(window, "load", initialize);
	}
	
	
/***** SHOW TOOLTIP EMAIL *****/
function showTooltipEmail(div_id1) {
	$(div_id1).css('display','block');
}

/***** SHOW TOOLTIP SEARCH *****/
function showTooltipSearch(div_id2) {
	$(div_id2).css('display','block');
}

/***** SHOW TOOLTIP EMPTY BAG *****/
function showTooltipEmptyBag(div_id4) {
	$(div_id4).css('display','block');
}

/***** HIDE TOOLTIP *****/
function hideTooltip(div_id3) {
	$(div_id3).css('display','none');
}

//Question Mark Tooltip

this.tooltip_questionmark = function(){	
	/* CONFIG */		
		xOffset = 80;
		yOffset = 140;	
		timeout=0;	
		// these 2 variable determine popup's distance from the cursor
		// you might want to adjust to get the right result		
	/* END CONFIG */		
	$("a.tooltip_questionmark").hover(function(e){											  
	clearTimeout(timeout);
		this.t = this.title;
		this.title = "";									  
		$("body").append("<p id='tooltip_questionmark'>"+ this.t +"</p>");
		$("#tooltip_questionmark")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX - yOffset) + "px")
			.show();		
    },
	function(){
		clearTimeout(timeout);
		this.title = this.t;		
		$("#tooltip_questionmark").remove();
    });	
	$("a.tooltip_questionmark").mousemove(function(e){
		clearTimeout(timeout);
		$("#tooltip_questionmark")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX - yOffset) + "px");
	});	
	 
	$("a.tooltip_questionmark").mousedown(function(e){ 
          clearTimeout(timeout);                                                                                  
          this.title = this.t;                                                                                                                                 
    });

};

//My Order Tooltip

this.tooltip_myorder = function(){	

	$("a.tooltip_myorder").hover(function(e){											  
		$(this).siblings(".tooltip_myorder_box").show();
    },
	function(){
		$(this).siblings(".tooltip_myorder_box").hide();
    });	
	 
};


/***** CHECKOUT *****/
function showMore(discountPrice){
    $(discountPrice).show();
    
    $(function(){
    var pane = $('.checkout_itemlist')
    pane.jScrollPane();
    $('.jScrollPaneDrag').css('right','0');
    var api = pane.data('jsp');
    
    // refresh jscrollpane
    api.reinitialise();

});

}


function hideMore(discountPrice){
    $(discountPrice).hide();
    
    $(function(){
    var pane2 = $('.checkout_itemlist')
    pane2.jScrollPane();
    $('.jScrollPaneDrag').css('right','0');
    var api2 = pane2.data('jsp');
    
    // refresh jscrollpane
    api2.reinitialise();

});

}




function checkoutItemlist(){
	$('.checkout_itemlist').jScrollPane();
	//to manually set the position of arrows, otherwise they'll be separated from dragbar
	$('.jScrollPaneDrag').css('right','0');
	$('#checkout-right-nav .jScrollPaneContainer').css({width: 'auto'});
}

function hideEgiftcard () {
	$(".egiftcard").slideUp();
}

function showEgiftcard_final () {
	$(".egiftcard_final").slideDown();
}

function showShipping_wrapper() {
	$(".shipping_wrapper").slideDown();
	$(".accordion_header_shipping").css('color','#000000');
	$(".accordion_header_giftard").css('color','#757575');
}

function showPromoCode() {
	//$(".checkout_promo_code").css('display','block');
	$(".checkout_promo_code").slideDown();
}

function hidePromoCode() {
	$(".checkout_promo_code").slideUp();
}

function showGiftCard() {
	$(".redemption_giftcard").slideDown();
	$(".redemption_btn").slideUp();
}

function hideGiftCard() {
	$(".redemption_giftcard").slideUp();
	$(".redemption_btn").slideDown();
	$(".select_redemption_mode").slideDown();
}

function showGiftCardSelected() {
	$(".redemption_btn").slideUp();
	$(".select_redemption_mode").slideUp();
	$(".redemption_giftcard_selected").slideDown();
}

function hideGiftCardSelected() {
	$(".add_another_redemption").slideUp();
	$(".select_redemption_mode").slideUp();
	$(".redemption_giftcard_selected").slideUp();
}

function showAddAnotherRedemption() {
	$(".add_another_redemption").slideDown();
}

function showOSC() {
	$(".redemption_OSC").slideDown();
	$(".redemption_btn2").slideUp();
}

function showOSCEdit() {
	$(".redemption_OSC_edit").slideDown();
}

function hideOSC() {
	$(".redemption_OSC").slideUp();
}

function hideOSCEdit() {
	$(".redemption_OSC_edit").slideUp();
}

function showOSCSelected() {
	$(".redemption_OSC_selected").slideDown();
	$(".redemption_btn2").slideDown();
}

function hideOSCSelected() {
	$(".add_another_redemption").slideUp();
	$(".select_redemption_mode").slideUp();
	$(".redemption_OSC_selected").slideUp();
}

function showHrSelected() {
	$(".hr_selected").slideDown();
}

function showBillingAddress() {
	$(".shipping_address").slideDown();
}

function hideBillingAddress() {
	$(".shipping_address").slideUp();
}

function showEditShippingAddress() {
	$(".edit_shipping_address").slideDown();
}

function hideEditShippingAddress() {
	$(".edit_shipping_address").slideUp();
}

function showAddBillingAddress() {
	$(".add_billing_address").slideDown();
}

function hideAddBillingAddress() {
	$(".add_billing_address").slideUp();
}

function showShippingBillingAddressBtn() {
	$(".shipping_billing_address_btn").slideDown();
}

function hideShippingBillingAddressBtn() {
	$(".shipping_billing_address_btn").slideUp();
}

function showBillingAddressNewlyAdded() {
	$(".billing_address_newly_added").slideDown();
}

function hideBillingAddressNewlyAdded() {
	$(".billing_address_newly_added").slideUp();
}

function showAddAddressbook() {
	$("#addressbook").css('width','890px');
	$(".overlaybox_top_wider").css('width','890px');
	$(".overlaybox_top_wider").css('background-image','none');
	$(".overlaybox_mid_wider").css('width','826px');
	$(".overlaybox_mid_wider").css('background-image','none');
	$(".overlaybox_btm_wider").css('width','890px');
	$(".overlaybox_btm_wider").css('background-image','none');
	$(".overlaybox_top_wider").css('background-color','#ffffff');
	$(".overlaybox_mid_wider").css('background-color','#ffffff');
	$(".overlaybox_btm_wider").css('background-color','#ffffff');
	$(".add_addressbook").slideDown();
	//$("#addressbook").css('margin-left','-185px');
	//$('.btn_close_new').css('margin-left','185px');
}

function hideAddAddressbook() {
	$(".add_addressbook").hide();
	$("#addressbook").css('width','724px');
	$(".overlaybox_top_wider").css('width','724px');
	$(".overlaybox_mid_wider").css('width','660px');
	$(".overlaybox_btm_wider").css('width','724px');
	//$("#addressbook").css('margin-left','');
	//$('.btn_close_new').css('margin-left','');
}

function showAddNewAddressBtn() {
	$(".add_new_address_btn").slideDown();
}

function hideAddNewAddressBtn() {
	$(".add_new_address_btn").slideUp();
}

function showNewlyAdded() {
	$(".newly_added").slideDown();
}

function showShippingAddressFinal() {
	$(".shipping_address_final").slideDown();
}

function hideShippingAddressFinal() {
	$(".shipping_address_final").slideUp();
}

function showShippingWrapper() {
	$(".shipping_wrapper").slideDown();
}

function hideShippingWrapper() {
	$(".shipping_wrapper").slideUp();
}

function showPaymentOptionsFinal() {
	$(".payment_options_final").slideDown();
}

function hidePaymentOptionsFinal() {
	$(".payment_options_final").slideUp();
}

function showPaymentWrapper() {
	$(".payment_wrapper").slideDown();
	$(".accordion_header_disabled_payment").css('color','#000000');
	$(".accordion_header_shipping").css('color','#757575');
}

function hidePaymentWrapper() {
	$(".payment_wrapper").slideUp();
}

function showOrderWrapper() {
	$(".order_wrapper").slideDown();
	$(".accordion_header_disabled_order").css('color','#000000');
	$(".accordion_header_disabled_payment").css('color','#757575');
	$(".accordion_header_shipping").css('color','#757575');
}

function hideOrderWrapper() {
	$(".order_wrapper").slideUp();
}

function Set_Cookie( name, value, expires, path, domain, secure )
{
	var today = new Date();
	today.setTime( today.getTime() );

	/*
	if the expires variable is set, make the correct
	expires time, the current script below will set
	it for x number of days, to make it for hours,
	delete * 24, for minutes, delete * 60 * 24
	*/
	if ( expires )
	{
		expires = expires * 1000 * 60 * 60 * 24;
	}
	var expires_date = new Date( today.getTime() + (expires) );

	document.cookie = name + "=" +escape( value ) +
	( ( expires ) ? ";expires=" + expires_date.toUTCString() : "" ) +
	( ( path ) ? ";path=" + path : "" ) +
	( ( domain ) ? ";domain=" + domain : "" ) +
	( ( secure ) ? ";secure" : "" );
}

function Get_Cookie( name ) 
{
	var start = document.cookie.indexOf( name + "=" );
	var len = start + name.length + 1;
	if ( ( !start ) && ( name != document.cookie.substring( 0, name.length ) ) )
	{
		return null;
	}
	if ( start == -1 ) return null;
	
	var end = document.cookie.indexOf( ";", len );
	if ( end == -1 ) end = document.cookie.length;
	
	return unescape( document.cookie.substring( len, end ) );
}

function Delete_Cookie( name, path, domain ) 
{
	if ( Get_Cookie( name ) ) document.cookie = name + "=" +
	( ( path ) ? ";path=" + path : "") +
	( ( domain ) ? ";domain=" + domain : "" ) +
	";expires=Thu, 01-Jan-1970 00:00:01 GMT";
}

//BROWSER DETECT.JS

var BrowserDetect = {
		init: function () {
			this.browser = this.searchString(this.dataBrowser) || "An unknown browser";
			this.version = this.searchVersion(navigator.userAgent)
				|| this.searchVersion(navigator.appVersion)
				|| "an unknown version";
			this.OS = this.searchString(this.dataOS) || "an unknown OS";
		},
		searchString: function (data) {
			for (var i=0;i<data.length;i++)	{
				var dataString = data[i].string;
				var dataProp = data[i].prop;
				this.versionSearchString = data[i].versionSearch || data[i].identity;
				if (dataString) {
					if (dataString.indexOf(data[i].subString) != -1)
						return data[i].identity;
				}
				else if (dataProp)
					return data[i].identity;
			}
		},
		searchVersion: function (dataString) {
			var index = dataString.indexOf(this.versionSearchString);
			if (index == -1) return;
			return parseFloat(dataString.substring(index+this.versionSearchString.length+1));
		},
		dataBrowser: [
			{
				string: navigator.userAgent,
				subString: "Chrome",
				identity: "Chrome"
			},
			{ 	string: navigator.userAgent,
				subString: "OmniWeb",
				versionSearch: "OmniWeb/",
				identity: "OmniWeb"
			},
			{
				string: navigator.vendor,
				subString: "Apple",
				identity: "Safari",
				versionSearch: "Version"
			},
			{
				prop: window.opera,
				identity: "Opera"
			},
			{
				string: navigator.vendor,
				subString: "iCab",
				identity: "iCab"
			},
			{
				string: navigator.vendor,
				subString: "KDE",
				identity: "Konqueror"
			},
			{
				string: navigator.userAgent,
				subString: "Firefox",
				identity: "Firefox"
			},
			{
				string: navigator.vendor,
				subString: "Camino",
				identity: "Camino"
			},
			{		// for newer Netscapes (6+)
				string: navigator.userAgent,
				subString: "Netscape",
				identity: "Netscape"
			},
			{
				string: navigator.userAgent,
				subString: "MSIE",
				identity: "Explorer",
				versionSearch: "MSIE"
			},
			{
				string: navigator.userAgent,
				subString: "Gecko",
				identity: "Mozilla",
				versionSearch: "rv"
			},
			{ 		// for older Netscapes (4-)
				string: navigator.userAgent,
				subString: "Mozilla",
				identity: "Netscape",
				versionSearch: "Mozilla"
			}
		],
		dataOS : [
			{
				string: navigator.platform,
				subString: "Win",
				identity: "Windows"
			},
			{
				string: navigator.platform,
				subString: "Mac",
				identity: "Mac"
			},
			{
				   string: navigator.userAgent,
				   subString: "iPhone",
				   identity: "iPhone/iPod"
		    },
			{
				string: navigator.platform,
				subString: "Linux",
				identity: "Linux"
			}
		]

	};
	BrowserDetect.init();
//END OF BROWSER DETECT
	

	