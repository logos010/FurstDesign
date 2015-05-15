$(document).ready(function () {
    authentication();
    initCufon();
    initLanding();
    initDropdownOfShoppingBag('/INTLStore/CK/iframeshoppingbaghome');
    initOverlay_new();
    adjustOverlayForm();
    $("#country_dd2").msDropDown();
    $("#language_dd2").msDropDown();

    $(window).scroll(function () {
        adjustFixedElementsPosition();
    }
    );

    //accordion menu settings
    $('#accordion-1').dcAccordion({
        eventType: 'click',
        autoClose: true,
        saveState: true,
        disableLink: true,
        menuClose: false,
        speed: 'slow',
        showCount: false

    }
    );

    /*** Default menu to close and unbold it */
    $('li.dcjq-parent-li ul', $('#accordion-1')).hide();
    $('#accordion-1 a').css('font-weight', 'normal');

    // make me scrollable settings
    makeScrollable('makeMeScrollable');

    // make active mainnav link bold
    var mainnav_bold_identifier = "";


    // make active mainnav link bold
    $('#accordion-1 a').click(function () {
        if ($(this).css('font-weight') == 'bold') {
            $(this).parent().parent().find('a').css('font-weight', 'normal');
        }
        else if ($(this).css('font-weight') == '700') {
            $(this).parent().parent().find('a').css('font-weight', 'normal');
        }
        else {
            $(this).parent().parent().find('a').css('font-weight', 'normal');
            $(this).css('font-weight', 'bold');
            $(this).css('margin-bottom', '3px');
        }
    }
    );

    // show & hide search box
    var search_dd_identifier = "";

    $("#init-search-dd").click(function () {
        if (search_dd_identifier != "") {
            $('#search-box').fadeOut("fast");
            search_dd_identifier = "";
        }
        else {
            $('#shoppingbag-box').hide();
            sb_dd_identifier = "";
            $('#myaccount-box').hide();
            myaccount_dd_identifier = "";
            $('#search-box').fadeIn("fast");
            search_dd_identifier = "on";
        }
    }
    );

    // show & hide my account box
    var myaccount_dd_identifier = "";

    $("#signInName").click(function () {
        if (myaccount_dd_identifier != "") {
            $('#myaccount-box').fadeOut("fast");
            myaccount_dd_identifier = "";
        }
        else {
            $('#shoppingbag-box').hide();
            sb_dd_identifier = "";
            $('#search-box').hide();
            search_dd_identifier = "";
            $('#myaccount-box').fadeIn("fast");
            myaccount_dd_identifier = "on";
        }

        if ($(".myaccount-username").length > 0) {
            var positionLeft = $(".myaccount-username").offset().left;
            var positionRight = positionLeft + $(".myaccount-username").outerWidth();
            var ddWidth = $("#myaccount-box").outerWidth();
            $("#myaccount-box").css('left', positionRight - ddWidth + 'px');
        }
    }
    );

    // show & hide shoppingbag box
    var sb_dd_identifier = "";
    $("#smallshoppingItems").click(function () {
        if ($(this).attr("href") != "javascript:showTooltipEmptyBag('#emptybag');") {
            if (sb_dd_identifier != "") {
                $('#shoppingbag-box').fadeOut("fast");
                sb_dd_identifier = "";
            }
            else {
                $('#search-box').hide();
                search_dd_identifier = "";
                $('#myaccount-box').hide();
                myaccount_dd_identifier = "";
                $('#shoppingbag-box').fadeIn("fast");
                setTimeout(function () {
                    $('.iframe-shoppingbagdd').attr('src', shoppingBagUrl);
                }
                , 1000);
                sb_dd_identifier = "on";
            }
        }
    }
    );

    if (!true)
    {
        $("#smallshoppingItems").css("display", "none");
        $("#shoppingBagSpan").css("display", "none");
        $("#lOnlineCreditBalance").css("display", "none");
        $("#lOnlineCreditBalanceSpan").css("display", "none");
    }


    //show & hide quick view link
    $('.item-product-img').live("mouseenter", function () {
        if (this.className.indexOf("view3") >= 0) {
            $(this).find('.product-img').animate({
                opacity: 0.1}
            );
            $(this).find('.quickview-btn').css('display', 'block');
            $(this).find('.quickview-btn').css('left', '98.5px');
        }
    }
    );

    $('.item-product-img').live("mouseleave", function () {
        if (this.className.indexOf("view3") >= 0) {
            $(this).find('.product-img').animate({
                opacity: 1.0}
            );
            $(this).find('.quickview-btn').css('display', 'none');
        }
    }
    );

    /*
     // this script is for product catalog
     $(window).scroll(function () {
     if($(window).scrollTop() == $(document).height() - $(window).height()){
     if($("#additionalContentLoading").css("display") == "none" && $("#total").html() >= 15
     && $("#total").html()%15 == 0 && flagMore) {
     $("#additionalContentLoading").css("display", "");
     scroll++;
     submit(true, "/INTLStore/CK/product-category-accessories/scroll/"+scroll);
     }
     }
     }
     );
     */
    checkItemDiv();
}
);

function checkItemDiv() {
    $("#total").html($(".catalogue-itembox").length);
    if ($("#total").html() == 0) {
        $('#footer').css("display", "none");
        $('#footer2').css("display", "");
        $('#empty_catalogue').css("display", "");
    }
    else {
        $('#footer').css("display", "");
        $('#footer2').css("display", "none");
        $('#empty_catalogue').css("display", "none");
    }
}



function searchCaller(e, lang) {
    e = e ? e : window.event;
    var k = e.keyCode ? e.keyCode : e.which ? e.which : null;
    if (k == 13 || k == null || k == 1) {
        if (e.preventDefault)
        {
            e.preventDefault();
        }
        redirectSearchImageBtn(lang);
        return false;
    }
    return true;
}



function redirectSearchImageBtn(lang)
{
    var keyword = "";

    keyword = document.getElementById("search").value;
    if (keyword != "SEARCH.." && keyword != "")
    {
        var jsdest = "";
        var url = window.location.href;
        var regex = new RegExp("#\\/([A-Z]{3})\\/");
        var match = regex.exec(url);
        if (match != null) {
            jsdest = match[1];
        }
        else {
            regex = new RegExp("[\\?&]dest=([A-Z]{3})");
            match = regex.exec(url);
            if (match != null) {
                jsdest = match[1];
            }
        }
        ref = window.location.href;
        ref = ref.substring(0, (ref.indexOf("http://www.charleskeith.com/CK/")));
        window.location = ref + "/CK/search?keyword=" + encodeURIComponent(keyword) + "&lang=" + lang + "&dest=" + jsdest;

        return true;
    }
    else
    {
        showTooltipSearch('#cSearch');
        return false;
    }
    return false;
}

//Fullpage Background Image Settings
jQuery(function ($) {

    $.supersized({
        // Functionality
        slide_interval: 3000, // Length between transitions
        transition: 1, // 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
        transition_speed: 700, // Speed of transition

        // Components
        slide_links: 'false', // Individual links for each slide (Options: false, 'num', 'name', 'blank')
        slides: [// Slideshow Images
            {
                image: 'http://www.charleskeith.com/media/CharlesKeithOnline/landing/homepage-background.jpg', title: 'Charles & Keith'}
        ]

    }
    );
}
);


function redirectCHN(param1, param2)
{

    if (param2 == 'CHN')
    {
        window.location.href = param1;
    }

}

function authentication()
{

    if ($.cookie("CKAuthenticationID") != null) {
        if ($.cookie("CKAuthenticationFN") != null) {
            if ($.cookie("CKAuthenticationLN") != null) {
                SmallShoppingBagController.decodeInputName($.cookie("CKAuthenticationFN"), $.cookie("CKEncode_FN"), $.cookie("CKAuthenticationLN"), $.cookie("CKEncode_LN"), {
                    callback: function (dataFromServer) {
                        signinname = dataFromServer;
                        signinname = signinname.replace(/"/g, "");
                        document.getElementById("signInName").innerHTML = signinname;

                    }
                });

            }

            else {
                SmallShoppingBagController.decodeInputName($.cookie("CKAuthenticationFN"), $.cookie("CKEncode_FN"), $.cookie("CKAuthenticationLN"), '0', {
                    callback: function (dataFromServer) {
                        signinname = dataFromServer;
                        signinname = signinname.replace(/"/g, "");
                        document.getElementById("signInName").innerHTML = signinname;


                    }
                }
                );
            }
        }

    }

    if ($.cookie("CKAuthenticationID") != null) {
        if ($.cookie("CKAuthenticationFN") != null) {
            if ($.cookie("CKAuthenticationLN") != null) {
                $("#signIn").css("display", "none");
                $("#signInSpan").css("display", "none");
            }

            else {
                $("#signIn").css("display", "none");
                $("#signInSpan").css("display", "none");
            }
        }

        var PB = "0";
        var currPB = "";

        SmallShoppingBagController.getOSC({
            callback: function (dataFromServer) {

                var splits = dataFromServer.split(' ');
                currPB = splits[0];
                PB = splits[1];

                if (currPB != "")
                {
                    if (currPB == "USD")
                        currPB = "US$";
                    else if (currPB == "JPY")
                        currPB = "¥";
                    else if (currPB == "GBP")
                        currPB = "£";
                    else if (currPB == "SGD")
                        currPB = "S$";
                    else if (currPB == "TWD")
                        currPB = "NT$";
                    else if (currPB == "AUD")
                        currPB = "AU$";
                    else if (currPB == "NZD")
                        currPB = "NZ$";
                    else if (currPB == "INR")
                        currPB = "\u20B9";
                    else if (currPB == "MYR")
                        currPB = "RM";
                    else if (currPB == "HKD")
                        currPB = "HK$";
                    else if (currPB == "THB")
                        currPB = "\u0E3F";
                    else if (currPB == "KRW")
                        currPB = "\u20A9";
                    else if (currPB == "ZAR")
                        currPB = "R";

                    else if (currPB == "LKR")
                        currPB = "Rs";

                    else if (currPB == "IDR")
                        currPB = " <font style='text-transform:none !important;'>Rp.</font>";
                }

                if (PB == "")
                {
                    PB = "0";
                }

                if (PB == "0" || PB == "0.00")
                {
                    $("#lOnlineCreditBalance").css("display", "none");
                    $("#lOnlineCreditBalanceSpan").css("display", "none");
                }
                else
                {
                    $("#lOnlineCreditBalance").css("display", "inline");
                    $("#lOnlineCreditBalanceSpan").css("display", "inline");
                    document.getElementById("lOnlineCreditBalance").innerHTML = "Online Store Credits :" + currPB + PB;
                }
            }
        }
        );
    }
    else
    {
        $("#signOut").css("display", "none");
        $("#signOutSpan").css("display", "none");
        $("#signInName").css("display", "none");
        $("#signInNameSpan").css("display", "none");
        $("#lOnlineCreditBalance").css("display", "none");
        $("#lOnlineCreditBalanceSpan").css("display", "none");
    }

    smallshoppingbagitems();
}

function smallshoppingbagitems() {
    $.cookie("testCookie", null);
    if ($.cookie("CKAuthenticationID") != null && $.cookie("CKAuthenticationFN") != null && $.cookie("CKAuthenticationLN") != null) {

        SmallShoppingBagController.getSmallBagSize({
            callback: function (dataFromServer) {
                $.cookie("testCookie", dataFromServer);
                var temp = document.getElementById("smallshoppingItems").innerHTML;
                document.getElementById("smallshoppingItems").innerHTML = temp + $.cookie("testCookie") + ")";
                //$("#smallshoppingItems").css("padding", "3px 3px");
                if (dataFromServer == '0') {
                    document.getElementById("smallshoppingItems").href = "javascript:showTooltipEmptyBag('#emptybag');";
                }
            }
        }
        );
    }
    else {
        SmallShoppingBagController.getItemQuantity({
            callback: function (dataFromServer) {
                $.cookie("testCookie", dataFromServer);
                var temp = document.getElementById("smallshoppingItems").innerHTML;
                document.getElementById("smallshoppingItems").innerHTML = temp + dataFromServer + ")";
                //$("#smallshoppingItems").css("padding", "3px 3px");
                if (dataFromServer == '0') {
                    document.getElementById("smallshoppingItems").href = "javascript:showTooltipEmptyBag('#emptybag');";
                }
            }
        }
        );
    }

    setInterval(function () {
        $(".topright-menu").css("display", "inline");
    }
    , 900);


}

function checkOutSubmit(dest) {
    SmallShoppingBagController.checkOutValidation
            ({
                callback: function (dataFromServer) {
                    if (dataFromServer == 'true') {
                        goTo('/INTLStore/CK/checkout' + dest);
                    }

                    else if (dataFromServer == 'quantity') {
                        goTo('/INTLStore/CK/shopping-bag' + dest);
                    }

                    else if (dataFromServer == 'NoLogin') {
                        location.href = '/INTLStore/CK/sign in ' + dest;
                    }

                    else if (dataFromServer == 'SystemFailure') {
                        alert('Checkout is Under-Maintenance. Please Try Again Later.');
                    }

                    else if (dataFromServer == 'checkoutBlackListed') {

                        //document.getElementById('checkoutBlackListedError').style.display = "block";
                        var url = document.location.href;

                        //alert(url);
                        if (url.indexOf('INTLStore') > 0) {
                            //alert ('Your account has been blocked for security reason. Please contact us at customer@charleskeith.com');
                            //checkoutBlackListedError
                            //	document.getElementById('SGcheckoutBlackListedError').style.display = "none";
                            //alert(document.getElementById('checkoutBlackListedError').value);
                            document.getElementById("checkoutBlackListedError").innerHTML = "Your purchase has been blocked for security reasons.<br/>Please contact us at customer@charleskeith.com";
                        }

                        if (url.indexOf('SGStore') > 0) {
                            //	document.getElementById('INTLcheckoutBlackListedError').style.display = "none";
                            //	document.getElementById('SGcheckoutBlackListedError').style.display = "block";
                            //	document.getElementById('checkoutBlackListedError').value = 'Your account has been blocked for security reason. Please contact us at +65 6488 2688 or customer@charleskeith.com';
                            document.getElementById("checkoutBlackListedError").innerHTML = "Your purchase has been blocked for security reasons.<br/>Please contact us at +65 6488 2688 or customer@charleskeith.com";
                        }
                        if (url.indexOf('JPStore') > 0) {
                            //	document.getElementById('INTLcheckoutBlackListedError').style.display = "none";
                            //	document.getElementById('SGcheckoutBlackListedError').style.display = "block";
                            //	document.getElementById('checkoutBlackListedError').value = 'Your account has been blocked for security reason. Please contact us at +65 6488 2688 or customer@charleskeith.com';
                            document.getElementById("checkoutBlackListedError").innerHTML = "Your purchase has been blocked for security reasons.<br/>Please contact us at customer@charleskeith.com";
                        }
                    }

                    else {
                        alert('Please complete your previous checkout.');
                    }
                }
            });

}

function goTo(url) {
    var a = document.createElement("a");
    var isSafari = /safari/i.test(navigator.userAgent);
    var isChrome = /chrome/i.test(navigator.userAgent);

    if (navigator.appName == 'Microsoft Internet Explorer') {
        //only IE has this (at the moment);
        a.setAttribute("href", url);

        a.style.display = "none";
        document.body.appendChild(a);
        //prototype shortcut
        a.click();
    }

    else if (isSafari || isChrome) {
        window.location = url;
        return;

    }

    else {
        location.href = url;
    }
}