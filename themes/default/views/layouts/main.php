<!DOCTYPE html>
<html>
    <head>
        <title>Online Shoes | Women's Shoes | Footwear for Women - CHARLES & KEITH</title>
        <meta charset="utf-8" />
        <meta name="description" content="Shop women’s shoes at CHARLES & KEITH. View the latest collection of women's shoes, bags and accessories.">
        <meta name="keywords" content="Online Shoes, Women Shoes, Footwear Shoes, CHARLES & KEITH" />
        <meta name="robots" content="index,follow" />

        <link href="<?php echo App()->theme->baseUrl; ?>/css/landing-new.css" rel="stylesheet" type="text/css" media="screen" />
        <link href="<?php echo App()->theme->baseUrl; ?>/css/supersized.css" rel="stylesheet" type="text/css" media="screen" />
        <link href="<?php echo App()->theme->baseUrl; ?>/css/dd.css" rel="stylesheet" type="text/css" media="screen" />
        <link href="<?php echo App()->theme->baseUrl; ?>/css/skin2.css" rel="stylesheet" type="text/css" media="screen" />
        <link href="<?php echo App()->theme->baseUrl; ?>/css/jScrollPane-new.css" rel="stylesheet" type="text/css" media="screen" />
        <link href="<?php echo App()->theme->baseUrl; ?>/css/jquery-ui-1.10.3.custom.css" rel="stylesheet" type="text/css" media="screen" />
        <link href="<?php echo App()->theme->baseUrl; ?>/css/bootstrap.css" rel="stylesheet" type="text/css" media="screen" />
        <link href="<?php echo App()->theme->baseUrl; ?>/css/bootstrap-toggle.min.css" rel="stylesheet" type="text/css" media="screen" />
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">


        <!--<script type="text/javascript" src="<?php echo App()->theme->baseUrl; ?>/js/cufon-yui.js"></script>-->
        <!--<script type="text/javascript" src="<?php echo App()->theme->baseUrl; ?>/js/Century_Gothic_700.font.js"></script>-->
        <script type="text/javascript" src="<?php echo App()->theme->baseUrl; ?>/js/common.js"></script>
        <script type="text/javascript" src="<?php echo App()->theme->baseUrl; ?>/js/jquery.js"></script>
        <script type="text/javascript" src="<?php echo App()->theme->baseUrl; ?>/js/jquery.easing.min.js"></script>
        <script type="text/javascript" src="<?php echo App()->theme->baseUrl; ?>/js/supersized.3.2.7.js"></script>
        <script type="text/javascript" src="<?php echo App()->theme->baseUrl; ?>/js/jScrollPane.js"></script>
        <script type="text/javascript" src="<?php echo App()->theme->baseUrl; ?>/js/browserDetect.js"></script>
        <script type='text/javascript' src='<?php echo App()->theme->baseUrl; ?>/js/js.cookie.js'></script>
        <script type='text/javascript' src='<?php echo App()->theme->baseUrl; ?>/js/jquery.dcjqaccordion.2.7.js'></script>
        <script type="text/javascript" src="<?php echo App()->theme->baseUrl; ?>/js/jquery.dd.js"></script>
        <script type="text/javascript" src="<?php echo App()->theme->baseUrl; ?>/js/bootstrap.js"></script>
        <!-- jQuery UI Widget and Effects Core (custom download). You can make your own at: http://jqueryui.com/download -->
        <script src="<?php echo App()->theme->baseUrl; ?>/js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>
        <!-- alert box-->
        <script type="text/javascript" src="<?php echo App()->theme->baseUrl; ?>/js/bootbox.min.js"></script>
        <script type="text/javascript" src="<?php echo App()->theme->baseUrl; ?>/js/bootstrap-toggle.min.js"></script>

        <!-- Smooth Div Scroll 1.3 minified-->
        <script src="<?php echo App()->theme->baseUrl; ?>/js/mainnav-smoothScrolling.js" type="text/javascript"></script>

    <!--<script type="text/javascript" src="<?php echo App()->theme->baseUrl; ?>/js/ProductController.js"></script>-->
    <!--<script type="text/javascript" src="<?php echo App()->theme->baseUrl; ?>/js/SmallShoppingBagController.js"></script>-->
    <!--<script type="text/javascript" src="<?php echo App()->theme->baseUrl; ?>/js/engine.js"></script>-->
        <script type="text/javascript" src="<?php echo App()->theme->baseUrl; ?>/js/util.js"></script>

        <script type="text/javascript" src="<?php echo App()->theme->baseUrl; ?>/js/jquery-ui.min.js"></script>
        <!--<script type="text/javascript" src="<?php echo App()->theme->baseUrl; ?>/js/jquery.multiselect-product.js"></script>-->
        <script type="text/javascript" src="<?php echo App()->theme->baseUrl; ?>/js/jQuery.equalHeights.js"></script>    
    </head>

    <body id="top">        
    <div id="landing-catalogue">
        <!-- START OF HEADER -->
        <div id="header-container">
            <!-- START OF LOGO -->
            <a href="<?php echo App()->homeUrl; ?>" class="logo-landing">
                <div id="logo-landing"></div>
            </a>
            <!-- END OF LOGO -->
            <!-- START OF TOP RIGHT MENU -->
            <div class="topright-menu">
                <a class="shoppingbag" href="<?php echo App()->controller->createUrl('/order/viewCart'); ?>" id="smallshoppingItems">
                    <img src="<?php echo App()->theme->baseUrl; ?>/images/shop-mini.png" width="7" height="7" border="0" /> SHOPPING BAG <span id="shopping-item">(<?php echo App()->shoppingCart->getCount(); ?>)</span>
                </a>                                

                <?php if (App()->user->isGuest): ?>
                    <a href="<?php echo App()->controller->createUrl('/user/login'); ?>" id="signIn">Sign In</a>
                <?php else: ?>  
                    <a href="<?php echo App()->controller->createUrl('/user/logout'); ?>" id="signIn">LOG OUT</a>
                    <span id="signInSpan">|</span>
                    <a href="">Đơn hàng của bạn</a>
                    <span id="signInSpan">|</span>
                    <a href="" >Tài khoản</a>     
                    <span id="signInSpan">|</span>
                <?php endif; ?>
                <a href="javascript:void(0);" id="init-search-dd">Search</a>
                <div class="clear"></div>
                <!--Start of search-ddbox -->
                <!--                <div id="search-box" style="display:none;">
                                    <div class="search-menu">
                                        <div class="spacer"></div>
                                        <input id="search" name="search" type="text" value="" class="searchtxt" onfocus="clearText(this)" onblur="clearText(this)" onkeydown="searchCaller(event, 'en');" /><a href="#" onclick="searchCaller(event, 'en');">></a>
                                        <div class="spacer"></div>
                                    </div>
                                </div>-->
                <!--End of search-ddbox -->
            </div>
            <!-- END OF TOP RIGHT MENU -->
        </div>
        <!-- END OF HEADER -->
        <div class="clear"></div>

        <!-- START OF MAIN MENU -->
        <div id="makeMeScrollable">
            <div id="mainnav-wrapper">
                <div>
                    <input type="checkbox" id="menu-type" checked 
                           data-on="<i class='fa fa-mars'></i> Nam" 
                           data-off="<i class='fa fa-venus'></i> Nữ" 
                           data-toggle="toggle" 
                           data-onstyle="primary" 
                           data-offstyle="danger"
                           data-size="mini">
                </div>

                <div id="menu-category">
                    <img src="<?php echo App()->theme->baseUrl; ?>/images/loading.gif" class="hidden" id="loading" alt="loading" />
                    <ul class="accordion" id="accordion-1">
                        <?php $this->widget('application.components.MenuFrontPage'); ?>
                    </ul>
                </div>
                <div class="spacer"></div>
                <!--<div class="search-menu">
                <input name="" type="text" value="SEARCH..." onFocus="clearText(this)" onBlur="clearText(this)"> <a href="#">></a>
        </div>-->
            </div>
        </div>
        <div class="mainnav_arr"><img src="<?php echo App()->theme->baseUrl ?>/images/icon-mainnav-arr-indicator.png" border="0"></div>
        <div class="clear"></div>
        <!-- END OF MAIN MENU -->


        <!--   START OF MAIN CONTENT AREA -->
        <div style="padding-top: 80px; margin-left: 230px;">            
            <div id="main-content-container">
                <!-- BREADCRUMS NAV-->
                <div class="breadcrmbs-nav">
                    <?php
                    $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
                        'homeLink' => CHtml::link(UTranslate::t('Trang Chủ'), BASE_URL),
                        'links' => $this->breadcrumbs
                    ));
                    ?>
                </div>
                <?php echo $content; ?>
                <!--End of static-content -->
            </div>

        </div>
        <!-- END OF MAIN CONTENT AREA -->

        <div id="footer-home">
            <div class="copyright">
                <a href="" target="_blank" class="socialmedia">Facebook</a>
                <a href="" target="_blank" class="socialmedia">Instagram</a>

            </div>
        </div>

        <script type="text/javascript" language="JavaScript">
            $(document).ready(function () {
                authentication();
//                    initCufon();
                initLanding();
//                    initDropdownOfShoppingBag('/INTLStore/CK/iframeshoppingbaghome');
//                    initOverlay_new();
                initBackToTop();
                adjustOverlayForm();
                //            $("#country_dd2").msDropDown();
                //            $("#language_dd2").msDropDown();

                $(window).scroll(function () {
                    adjustFixedElementsPosition();
                });

                //accordion menu settings
                $('#accordion-1').dcAccordion({
                    eventType: 'click',
                    autoClose: true,
                    saveState: true,
                    disableLink: true,
                    menuClose: false,
                    speed: 'slow',
                    showCount: false

                });

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
                    } else if ($(this).css('font-weight') == '700') {
                        $(this).parent().parent().find('a').css('font-weight', 'normal');
                    } else {
                        $(this).parent().parent().find('a').css('font-weight', 'normal');
                        $(this).css('font-weight', 'bold');
                        $(this).css('margin-bottom', '3px');
                    }
                });

                // show & hide search box
                var search_dd_identifier = "";

                $("#init-search-dd").click(function () {
                    if (search_dd_identifier != "") {
                        $('#search-box').fadeOut("fast");
                        search_dd_identifier = "";
                    } else {
                        $('#shoppingbag-box').hide();
                        sb_dd_identifier = "";
                        $('#myaccount-box').hide();
                        myaccount_dd_identifier = "";
                        $('#search-box').fadeIn("fast");
                        search_dd_identifier = "on";
                    }
                });

                // show & hide my account box
                var myaccount_dd_identifier = "";

                $("#signInName").click(function () {
                    if (myaccount_dd_identifier != "") {
                        $('#myaccount-box').fadeOut("fast");
                        myaccount_dd_identifier = "";
                    } else {
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
                });




                // show & hide shoppingbag box
                var sb_dd_identifier = "";

                $("#smallshoppingItems").click(function () {
                    if ($(this).attr("href") != "javascript:showTooltipEmptyBag('#emptybag');") {
                        if (sb_dd_identifier != "") {
                            $('#shoppingbag-box').fadeOut("fast");
                            sb_dd_identifier = "";
                        } else {
                            $('#search-box').hide();
                            search_dd_identifier = "";
                            $('#myaccount-box').hide();
                            myaccount_dd_identifier = "";
                            $('#shoppingbag-box').fadeIn("fast");
                            setTimeout(function () {
                                $('.iframe-shoppingbagdd').attr('src', shoppingBagUrl);
                            }, 1000);
                            sb_dd_identifier = "on";
                        }
                    }
                });

                if (!true) {
                    $("#smallshoppingItems").css("display", "none");
                    $("#shoppingBagSpan").css("display", "none");
                    $("#lOnlineCreditBalance").css("display", "none");
                    $("#lOnlineCreditBalanceSpan").css("display", "none");
                }


                //show & hide quick view link
                $('.item-product-img').on("mouseenter", function () {
                    if (this.className.indexOf("view3") >= 0) {
                        $(this).find('.product-img').animate({
                            opacity: 0.1
                        });
                        $(this).find('.quickview-btn').css('display', 'block');
                        $(this).find('.quickview-btn').css('left', '98.5px');
                    }
                });
                $('.item-product-img').on("mouseleave", function () {
                    if (this.className.indexOf("view3") >= 0) {
                        $(this).find('.product-img').animate({
                            opacity: 1.0
                        });
                        $(this).find('.quickview-btn').css('display', 'none');
                    }
                });

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
                 });
                 */
                checkItemDiv();


            });

            function checkItemDiv() {
                $("#total").html($(".catalogue-itembox").length);
                if ($("#total").html() == 0) {
                    $('#footer').css("display", "none");
                    $('#footer2').css("display", "");
                    $('#empty_catalogue').css("display", "");
                } else {
                    $('#footer').css("display", "");
                    $('#footer2').css("display", "none");
                    $('#empty_catalogue').css("display", "none");
                }
            }

            function searchCaller(e, lang) {
                e = e ? e : window.event;
                var k = e.keyCode ? e.keyCode : e.which ? e.which : null;
                if (k == 13 || k == null || k == 1) {
                    if (e.preventDefault) {
                        e.preventDefault();
                    }
                    redirectSearchImageBtn(lang);
                    return false;
                }
                return true;
            }

            function redirectSearchImageBtn(lang) {
                var keyword = "";

                keyword = document.getElementById("search").value;
                if (keyword != "SEARCH.." && keyword != "") {
                    var jsdest = "";
                    var url = window.location.href;
                    var regex = new RegExp("#\\/([A-Z]{3})\\/");
                    var match = regex.exec(url);
                    if (match != null) {
                        jsdest = match[1];
                    } else {
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
                } else {
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
                            image: 'http://www.charleskeith.com/media/CharlesKeithOnline/landing/homepage-background.jpg',
                            title: 'Charles & Keith'
                        }
                    ]

                });
            });


            function redirectCHN(param1, param2) {

                if (param2 == 'CHN') {
                    window.location.href = param1;
                }
            }

            function authentication() {
//                if (Cookies.get("CKAuthenticationID") != null) {
//                    if ($.cookie("CKAuthenticationFN") != null) {
//                        if ($.cookie("CKAuthenticationLN") != null) {
//                            SmallShoppingBagController.decodeInputName($.cookie("CKAuthenticationFN"), $.cookie("CKEncode_FN"), $.cookie("CKAuthenticationLN"), $.cookie("CKEncode_LN"), {
//                                callback: function (dataFromServer) {
//                                    signinname = dataFromServer;
//                                    signinname = signinname.replace(/"/g, "");
//                                    document.getElementById("signInName").innerHTML = signinname;
//
//                                }
//                            });
//
//                        } else {
//                            SmallShoppingBagController.decodeInputName($.cookie("CKAuthenticationFN"), $.cookie("CKEncode_FN"), $.cookie("CKAuthenticationLN"), '0', {
//                                callback: function (dataFromServer) {
//                                    signinname = dataFromServer;
//                                    signinname = signinname.replace(/"/g, "");
//                                    document.getElementById("signInName").innerHTML = signinname;
//
//                                }
//                            });
//                        }
//                    }
//
//                }
//
//                if ($.cookie("CKAuthenticationID") != null) {
//                    if ($.cookie("CKAuthenticationFN") != null) {
//                        if ($.cookie("CKAuthenticationLN") != null) {
//                            $("#signIn").css("display", "none");
//                            $("#signInSpan").css("display", "none");
//                        } else {
//                            $("#signIn").css("display", "none");
//                            $("#signInSpan").css("display", "none");
//                        }
//                    }
//
//                    var PB = "0";
//                    var currPB = "";
//
//                    SmallShoppingBagController.getOSC({
//                        callback: function (dataFromServer) {
//                            var splits = dataFromServer.split(' ');
//                            currPB = splits[0];
//                            PB = splits[1];
//
//                            if (currPB != "") {
//                                if (currPB == "USD")
//                                    currPB = "US$";
//                                else if (currPB == "JPY")
//                                    currPB = "¥";
//                                else if (currPB == "GBP")
//                                    currPB = "£";
//                                else if (currPB == "SGD")
//                                    currPB = "S$";
//                                else if (currPB == "TWD")
//                                    currPB = "NT$";
//                                else if (currPB == "AUD")
//                                    currPB = "AU$";
//                                else if (currPB == "NZD")
//                                    currPB = "NZ$";
//                                else if (currPB == "INR")
//                                    currPB = "\u20B9";
//                                else if (currPB == "MYR")
//                                    currPB = "RM";
//                                else if (currPB == "HKD")
//                                    currPB = "HK$";
//                                else if (currPB == "THB")
//                                    currPB = "\u0E3F";
//                                else if (currPB == "KRW")
//                                    currPB = "\u20A9";
//                                else if (currPB == "ZAR")
//                                    currPB = "R";
//                                else if (currPB == "LKR")
//                                    currPB = "Rs";
//                                else if (currPB == "IDR")
//                                    currPB = " <font style='text-transform:none !important;'>Rp.</font>";
//                            }
//
//                            if (PB == "") {
//                                PB = "0";
//                            }
//
//                            if (PB == "0" || PB == "0.00") {
//                                $("#lOnlineCreditBalance").css("display", "none");
//                                $("#lOnlineCreditBalanceSpan").css("display", "none");
//                            } else {
//                                $("#lOnlineCreditBalance").css("display", "inline");
//                                $("#lOnlineCreditBalanceSpan").css("display", "inline");
//                                document.getElementById("lOnlineCreditBalance").innerHTML = "Online Store Credits :" + currPB + PB;
//                            }
//                        }
//                    });
//                } else {
//                    $("#signOut").css("display", "none");
//                    $("#signOutSpan").css("display", "none");
//                    $("#signInName").css("display", "none");
//                    $("#signInNameSpan").css("display", "none");
//                    $("#lOnlineCreditBalance").css("display", "none");
//                    $("#lOnlineCreditBalanceSpan").css("display", "none");
//                }
//
//                //smallshoppingbagitems();
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
                    });
                } else {
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
                    });
                }

                setInterval(function () {
                    $(".topright-menu").css("display", "inline");
                }, 900);

            }

            //load menu by category
            $("#menu-type").change(function () {
                var menuType = ($(this).prop('checked') === 1) ? '31' : '32';  //in menu table, Nam stands for 31 and Nu stands for 32
                console.log(menuType);
                var url = "<?php echo App()->controller->createUrl('menu/generateMenu/'); ?>/mid/" + menuType;
                $.ajax({
                    url: url,
                    type: 'post',
                    beforeSend: function () {
                        $('img#loading').removeClass('hidden');
                    },
                    success: function (data) {
                        $("#accordion-1").html(data);
                    },
                    complete: function () {
                        $('img#loading').addClass('hidden');

                        //menu dropdown effect
                        $('#accordion-1').dcAccordion({
                            eventType: 'click',
                            autoClose: true,
                            saveState: true,
                            disableLink: true,
                            menuClose: false,
                            speed: 'slow',
                            showCount: false
                        });
                    }
                });
            });

            //search
            $("#init-search-dd").click(function () {
                $('#keywords').keypress(function (event) {
                    if (event.which == 13) {
                        event.preventDefault();
                    }
                });

                bootbox.dialog({
                    title: "Bạn muốn tìm ...",
                    message: '<div class="row">  ' +
                            '<div class="col-md-12"> ' +
                            '<div class="form-group"> ' +
                            '<div class="col-md-12"> ' +
                            '<input id="keywords" name="keywords" type="text" placeholder="Từ khóa .... " class="form-control input-md"> ' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>',
                    buttons: {
                        success: {
                            label: "Tìm",
                            className: "btn-success",
                            callback: function () {
                                var kw = $('#keywords').val();
                                var url = "<?php echo App()->controller->createUrl('/search/searchInBasic'); ?>/keyword/" + kw;
                                $(location).attr('href', url);
                            }
                        }
                    }
                });
            });

            function goTo(url) {
                var a = document.createElement("a");
                var isSafari = /safari/i.test(navigator.userAgent);
                var isChrome = /chrome/i.test(navigator.userAgent);

                if (navigator.appName == 'Microsoft Internet Explorer') { //only IE has this (at the moment);
                    a.setAttribute("href", url);
                    a.style.display = "none";
                    document.body.appendChild(a); //prototype shortcut
                    a.click();
                } else if (isSafari || isChrome) {
                    window.location = url;
                    return;
                } else {
                    location.href = url;
                }
            }

            //landing load
            landing();
        </script>

        <!-- START OF BACK TO TOP -->
        <p id="back-top">
            <a href="#top"><span></span></a>
        </p>
        <!-- END OF BACK TO TOP -->

    </div>
</body>
</html>