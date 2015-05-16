<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:c="http://java.sun.com/jsp/jstl/core">    
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />    
        <title>
            Online Shoes | Women's Shoes | Footwear for Women - FURST DESIGN
        </title>
        <meta name="description" content="" /> 
        <meta name="keywords" content="" />    
        <meta name="robots" content="index,follow" />
        <link href="<?php echo App()->theme->baseUrl; ?>/css/landing-new.css" rel="stylesheet" type="text/css" media="screen" />
        <link href="<?php echo App()->theme->baseUrl; ?>/css/supersized.css" rel="stylesheet" type="text/css" media="screen" />    
        <link href="<?php echo App()->theme->baseUrl; ?>/css/dd.css" rel="stylesheet" type="text/css" media="screen" />
        <link href="<?php echo App()->theme->baseUrl; ?>/skin2.css" rel="stylesheet" type="text/css" media="screen" />
        <link href="<?php echo App()->theme->baseUrl; ?>/css/jScrollPane-new.css" rel="stylesheet" type="text/css" media="screen" />
        <link href="<?php echo App()->theme->baseUrl; ?>/css/bootstrap.css" rel="stylesheet" type="text/css" media="screen" />
        <link href="<?php echo App()->theme->baseUrl; ?>/css/furstdesign.css" rel="stylesheet" type="text/css" media="screen" />        

        <script type="text/javascript" src="<?php echo App()->theme->baseUrl; ?>/js/jquery.js"></script>
        <script type="text/javascript" src="<?php echo App()->theme->baseUrl; ?>/js/bootstrap.js"></script>
    </head>
    <body>        
        <style type="text/css">    
        #shoppingbag-box{
            float:right;
            /*position:absolute;
            top:0px;
            right:15px;
            */
            width:288px;
            height:416px;
            min-height:416px;
            margin-top:10px;
            background:#ffffff;
            border:1px solid #000000;
            /*z-index:899;
            */
            /*z-index:1003;
            -moz-box-shadow: 0 0 5px black;
            -webkit-box-shadow: 0 0 5px black;
            box-shadow: 0 0 5px black;
            */
        }
        #shoppingbag-box p{
            color:#000000;
            margin:10px 3px 0 13px;
            /*initially was: 10px 13px 0 13px*/
            height:26px;
        }
    </style>
    <div class="overlay_container">
        <div id="backtobranding" class="overlay_style">
            <div class="ckform_top">
                <div class="ckform_top_left">
                </div>
                <div class="ckform_top_middle">
                </div>
                <div class="ckform_top_right">
                </div>
            </div>
            <div class="ckform_middle clear">
                You are about to leave Charleskeith.com online shopping site and will be redirecting to Charleskeith.com branding site.
                <br/>
                <br/>
                <input type="image" src="<?php echo App()->theme->baseUrl; ?>/images/buttons/continue.gif" onclick="javascript:window.location = 'http://www.charleskeith.com/';" /> &nbsp;&nbsp;&nbsp;
                <input type="image" src="<?php echo App()->theme->baseUrl; ?>/images/buttons/cancel.gif" onclick="javascript:hideOverlay();" />
                <br/>
                <br/>
            </div>
            <div class="ckform_bottom">
                <div class="ckform_bottom_left">
                </div>
                <div class="ckform_bottom_middle">
                </div>
                <div class="ckform_bottom_right">
                </div>
            </div>
        </div>
        <!--end of ckform-->

        <!-- start NEW changecountry overlay design -->
        <div id="changecountry" class="overlay_style_new_country">
            <div class="overlaybox_top_country">
                <a href='javascript:void(0);' onclick='javascript:hideOverlay_new();'>
                    <div class='btn_close_new' style="margin-right:-20px;">
                    </div>
                </a>
            </div>
            <div class="overlaybox_mid_country">
                <h2>
                        Change Country
                    </h2> You will lose the contents of your shopping bag when changing sites.
                <br/>
                <br/>
                <br/>
                <input name="" type="image" value="SUBMIT" src="<?php echo App()->theme->baseUrl; ?>/images/buttons/yes_white_EN.gif" onclick="javascript:window.location = 'http://www.charleskeith.com/INTLStore/CK/landingpage?cid=true';" /> &nbsp;&nbsp;
                <input name="" type="image" value="CANCEL" src="<?php echo App()->theme->baseUrl; ?>/images/buttons/no_white_EN.gif" onclick="javascript:hideOverlay_new();" />
            </div>
            <div class="overlaybox_btm_country">
            </div>
        </div>
        <!-- end NEW changecountry overlay design -->
    </div>
    <!--end of overlay_container-->
    <div id="landing-catalogue">
        <!-- START OF HEADER -->
        <div id="header-container">
            <!-- START OF LOGO -->
            <a href="#" class="logo-landing">
                <div id="logo-landing">
                </div>
            </a>
            <!-- END OF LOGO -->
            
            <!-- START OF TOP RIGHT MENU -->
            <div class="topright-menu">
                <a class="shoppingbag" href="javascript:void(0);" id="smallshoppingItems">
                    <img src="<?php echo App()->theme->baseUrl; ?>/images/shop-mini.png" width="7" height="7" border="0" alt="" /> SHOPPING BAG (0)
                </a>

                <a style="padding:3px 0;" href="javascript:hideTooltip('#emptybag');">
                    <div id="emptybag" class="tooltip_emptybag_new">
                        There's no item in your shopping bag.
                    </div>
                </a>
                <span id="shoppingBagSpan">|</span>       
                <a href="<?php echo App()->createUrl('user/login'); ?>" id="signIn"> Sign In </a>
                <span id="signInSpan">| </span>
                <a href="#" id="signInName" class="myaccount-username"></a>
                <span id="signInNameSpan"> | </span>                
                <a href="javascript:void(0);" id="init-search-dd">Search</a>
                <div class="clear"></div>
                
                <!--Start of search-ddbox -->
                <div id="search-box" style="display:none;">
                    <div class="search-menu">
                        <div class="spacer">
                        </div>
                        <input id="search" name="search" type="text" value="" class="searchtxt" onfocus="clearText(this)" onblur="clearText(this)" onkeydown="searchCaller(event, 'en');" />
                        <a href="#" onclick="searchCaller(event, 'en');"> ></a>
                        <div class="spacer"></div>
                    </div>
                </div>
                
                <!--End of search-ddbox -->
                <!--Start of shoppingbag-ddbox -->
                <div id="shoppingbag-box">
                    <!--Start of iFrame sb-innerbox -->
                    <iframe frameborder="0" width="100%" height="365px" class="iframe-shoppingbagdd">
                    </iframe>
                    <!--End of iFrame sb-innerbox -->
                    <div id="checkoutBlackListedError" class="right" style="color: red; text-align: right; padding-right: 10px;">
                    </div>
                    <div id="sh-btn" align="right" class="right">
                        <a href="#" onclick="checkOutSubmit('?dest=ASM')" class="btn">
                                                        checkout
                                                    </a>
                        <a href="#" onclick="location.href = 'http://www.charleskeith.com/INTLStore/CK/shopping-bag?dest=ASM'" class="btn">
                                                        view shopping bag
                                                    </a>
                    </div>
                </div>
                <!--End of shoppingbag-ddbox -->

                <!--Start of myaccount-ddbox -->
                <div id="myaccount-box" style="display:none;">
                    <div class="myaccount-menu">
                        <a href="http://www.charleskeith.com/INTLStore/CK/account details?dest=ASM" class="myaccount-ddlink">
                                                        Account Details
                                                    </a>

                        <a href="http://www.charleskeith.com/INTLStore/CK/addressbook?dest=ASM" class="myaccount-ddlink">
                                                        Address Book
                                                    </a>
                        <a href="http://www.charleskeith.com/INTLStore/CK/my-orders?dest=ASM" class="myaccount-ddlink">
                                                        My Orders
                                                    </a>
                        <a href="http://www.charleskeith.com/INTLStore/CK/credit-balance?dest=ASM" class="myaccount-ddlink">
                                                        Credit Balance
                                                    </a>


                        <a href="http://www.charleskeith.com/INTLStore/CK/logout?dest=ASM" id="signOut" class="myaccount-ddlink">
                                                        Sign Out
                                                    </a>
                        <span id="signOutSpan">
                                                    </span>
                    </div>
                </div>
                <!--End of myaccount-ddbox -->


            </div>
            <!-- END OF TOP RIGHT MENU -->
        </div>
        <!-- END OF HEADER -->
        
        <div class="clear"></div>
        
        <!-- START OF MAIN MENU -->

        <div id="makeMeScrollable">
            <div id="mainnav-wrapper">
                <ul class="accordion" id="accordion-1">
                    <li>
                        <a href="#" class="primary">New Arrivals</a>
                        <ul>
                            <li> <a href="New-Arrivals.html">View All</a> </li> 
                            <li> <a href="New-Arrivals/Shoes.html">Shoes</a> </li> 
                            <li> <a href="New-Arrivals/Bags.html">Bags</a> </li> 
                            <li> 
                                <a href="#"> Accessories </a> 
                                <ul> 
                                    <li> <a href="New-Arrivals/Sunglasses.html"> Sunglasses </a> </li> 
                                    <li> <a href="New-Arrivals/Belts.html"> Belts </a> </li> 
                                    <li> <a href="New-Arrivals/Bracelets.html"> Bracelets </a> </li> 
                                    <li> <a href="New-Arrivals/Necklaces.html"> Necklaces </a> </li> 
                                    <li> <a href="New-Arrivals/Scarves.html"> Scarves </a> </li> 
                                </ul> 
                            </li> 
                            <li> <a href="New-Arrivals/Online-Exclusives.html"> Online Exclusives </a> </li>
                        </ul>
                    </li>
                    <li> 
                        <a href="#" class="primary"> Charles &amp; Keith Collection </a> 
                        <ul> 
                            <li> <a href="Signature-Label.html"> View All </a> </li> 
                            <li> <a href="New-Arrivals/Signature-Label.html"> New Arrivals </a> </li> 
                            <li> <a href="Online-Exclusives/Signature-Label.html"> Online Exclusives </a> </li> 
                            <li> <a href="Signature-Label/Boots.html"> Boots </a> </li> 
                            <li> <a href="Signature-Label/Clogs.html"> Clogs </a> </li> 
                            <li> <a href="Signature-Label/Flats.html"> Flats </a> </li> 
                            <li> <a href="Signature-Label/Heels.html"> Heels </a> </li> 
                            <li> <a href="Signature-Label/Wedges.html"> Wedges </a> </li> 
                            <li> <a href="Sale/Signature-Label.html"> SALE </a> </li> 
                        </ul> 
                    </li>
                    <li> 
                        <a href="#" class="primary"> Shoes </a> 
                        <ul> 
                            <li> <a href="Shoes.html"> View All </a> </li> 
                            <li> <a href="New-Arrivals/Shoes.html"> New Arrivals </a> </li> 
                            <li> <a href="Online-Exclusives/Shoes.html"> Online Exclusives </a> </li> 
                            <li> <a href="Signature-Label/Shoes.html"> Charles &amp; Keith Collection </a> </li> 
                            <li> <a href="Shoes/Boots.html"> Boots </a> </li> 
                            <li> <a href="Shoes/Clogs.html"> Clogs </a> </li> 
                            <li> <a href="Shoes/Flats.html"> Flats </a> </li> 
                            <li> <a href="Shoes/Heels.html"> Heels </a> </li> 
                            <li> <a href="Shoes/Wedges.html"> Wedges </a> </li> 
                            <li> <a href="Sale/Shoes.html"> SALE </a> </li> 
                        </ul> 
                    </li>
                    <li> 
                        <a href="#" class="primary"> Bags </a> 
                        <ul> 
                            <li> <a href="Bags.html"> View All </a> </li> 
                            <li> <a href="New-Arrivals/Bags.html"> New Arrivals </a> </li> 
                            <li> <a href="Online-Exclusives/Bags.html"> Online Exclusives </a> </li> 
                            <li> <a href="Bags/Bowling.html"> Bowling </a> </li> 
                            <li> <a href="Bags/Card-Holder.html"> Card Holder </a> </li> 
                            <li> <a href="Bags/Clutch.html"> Clutch </a> </li> 
                            <li> <a href="Bags/Handbag.html"> Handbag </a> </li> 
                            <li> <a href="Bags/Haversack.html"> Haversack </a> </li> 
                            <li> <a href="Bags/Hobo.html"> Hobo </a> </li> 
                            <li> <a href="Bags/Iphone-Case.html"> iPhone Case </a> </li> 
                            <li> <a href="Bags/Passport-Holder.html"> Passport Holder </a> </li> 
                            <li> <a href="Bags/Satchel.html"> Satchel </a> </li> 
                            <li> <a href="Bags/Shoulder-Bag.html"> Shoulder Bag </a> </li> 
                            <li> <a href="Bags/Sling-Bag.html"> Sling Bag </a> </li> 
                            <li> <a href="Bags/Tote.html"> Tote </a> </li> 
                            <li> <a href="Bags/Wallet.html"> Wallet </a> </li> 
                            <li> <a href="Bags/Wristlet.html"> Wristlet </a> </li> 
                            <li> <a href="Sale/Bags.html"> SALE </a> </li> 
                        </ul> 
                    </li>
                    <li> 
                        <a href="#" class="primary"> Accessories </a> 
                        <ul>
                            <li> <a href="Accessories.html"> View All </a> </li> 
                            <li> <a href="New-Arrivals/Accessories.html"> New Arrivals </a> </li> 
                            <li> <a href="Online-Exclusives/Accessories.html"> Online Exclusives </a> </li> 
                            <li> <a href="Accessories/Sunglasses.html"> Sunglasses </a> </li> 
                            <li> <a href="Accessories/Belts.html"> Belts </a> </li> 
                            <li> <a href="Accessories/Bracelets.html"> Bracelets </a> </li> 
                            <li> <a href="Accessories/Necklaces.html"> Necklaces </a> </li> 
                            <li> <a href="Accessories/Scarves.html"> Scarves </a> </li> 
                            <li> <a href="Sale/Accessories.html"> SALE </a> </li> 
                        </ul> 
                    </li>
                    <li> 
                        <a href="#" class="primary"> Online Exclusives </a> 
                        <ul> 
                            <li> <a href="Online-Exclusives.html"> View All </a> </li> <li> <a href="New-Arrivals/Online-Exclusives.html"> New Arrivals </a> </li> <li> <a href="Online-Exclusives/Signature-Label.html"> Charles &amp; Keith Collection </a> </li> <li> <a href="Online-Exclusives/Shoes.html"> Shoes </a> </li> <li> <a href="Online-Exclusives/Bags.html"> Bags </a> </li> <li> <a href="Online-Exclusives/Bracelets.html"> Bracelets </a> </li> <li> <a href="Online-Exclusives/Necklaces.html"> Necklaces </a> </li> <li> <a href="Online-Exclusives/Scarves.html"> Scarves </a> </li> <li> <a href="Sale/Online-Exclusives.html"> Sale </a> </li> 
                        </ul> 
                    </li>
                    <li> 
                        <a href="#" class="primary"> <font color="red"> Sale </font> </a> 
                        <ul> 
                            <li> <a href="Sale.html"> View All </a> </li> <li> <a href="Sale/Shoes.html"> Shoes </a> </li> <li> <a href="Sale/Bags.html"> Bags </a> </li> <li> <a href="Sale/Accessories.html"> Accessories </a> </li> <li> <a href="Sale/Online-Exclusives.html"> Online Exclusives </a> </li> 
                        </ul> 
                    </li>
                    
                    <div class="spacer2"></div>
                    
                    <li>
                        <a href="#" class="primary">
                                                        Campaign
                                                    </a>
                        <ul>
                            <li>
                                <a href="Campaign/Summer.html">
                                                                SUMMER
                                                            </a>
                            </li>
                            <li>
                                <a href="Campaign/Spring.html">
                                                                SPRING
                                                            </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="primary">
                                                        Magazine
                                                    </a>
                        <ul>
                            <li>
                                <a href="Magazine/Summer.html">
                                                                SUMMER
                                                            </a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="#" class="primary">
                                                        Features
                                                    </a>
                        <ul>
                            <li>
                                <a href="Features/Gallery.html">
                                                                GALLERY
                                                            </a>
                            </li>
                        </ul>
                    </li>

                    <div class="spacer2">
                    </div>
                    <li>
                        <a href="Newsletter.html" class="primary">
                                                        Newsletter
                                                    </a>
                    </li>
                    <li>
                        <a href="Promotions.html" class="primary">
                                                        Promotions
                                                    </a>
                    </li>

                    <div class="spacer2">
                    </div>

                    <li>
                        <a href='#' class='primary'>
                                                        More +
                                                    </a>
                        <ul>
                            <li>
                                <a href='index.html#'>
                                                                Company
                                                            </a>
                                <ul>
                                    <li>
                                        <a href='Brand-Profile.html'>
                                                                        Brand Profile
                                                                    </a>
                                    </li>
                                    <li>
                                        <a href='Store-Locator.html'>
                                                                        Store Locator
                                                                    </a>
                                    </li>
                                    <li>
                                        <a href='Contact-Us.html'>
                                                                        Contact Us
                                                                    </a>
                                    </li>
                                    <li>
                                        <a href='Careers.html'>
                                                                        Careers
                                                                    </a>
                                    </li>
                                    <li>
                                        <a href='Press-Release.html'>
                                                                        Press Release
                                                                    </a>
                                    </li>
                                    <li>
                                        <a href='Franchising-Opportunities.html'>
                                                                        Franchising Opportunities
                                                                    </a>
                                    </li>
                                    <li>
                                        <a href='Corporate-Social-Responsibility.html'>
                                                                        Corporate Social Responsibility
                                                                    </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href='index.html#'>
                                                                Shopping Guide
                                                            </a>
                                <ul>
                                    <li>
                                        <a href='Shipping-Tracking.html'>
                                                                        Shipping &amp; Tracking
                                                                    </a>
                                    </li>
                                    <li>
                                        <a href='Tax-Duties.html'>
                                                                        Tax & Duties
                                                                    </a>
                                    </li>
                                    <li>
                                        <a href='Returns-Exchanges.html'>
                                                                        Returns &amp; Exchanges
                                                                    </a>
                                    </li>
                                    <li>
                                        <a href='Size-Conversion-Chart.html'>
                                                                        Size Conversion Chart
                                                                    </a>
                                    </li>
                                    <li>
                                        <a href='Care-Tips.html'>
                                                                        Care Tips
                                                                    </a>
                                    </li>
                                    <li>
                                        <a href='FAQ.html'>
                                                                        FAQ
                                                                    </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href='index.html#'>
                                                                Policies
                                                            </a>
                                <ul>
                                    <li>
                                        <a href='Terms-Of-Use.html'>
                                                                        Terms Of Use
                                                                    </a>
                                    </li>
                                    <li>
                                        <a href='Privacy-Policy.html'>
                                                                        Privacy Policy
                                                                    </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href='index.html#'>
                                                                Follow Us
                                                            </a>
                                <ul>
                                    <li>
                                        <a href='https://www.facebook.com/pages/Charles-Keith/157130102253?ref=ts' target='_blank'>
                                                                        Facebook
                                                                    </a>
                                    </li>
                                    <li>
                                        <a href='https://twitter.com/Charles_Keith' target='_blank'>
                                                                        Twitter
                                                                    </a>
                                    </li>
                                    <li>
                                        <a href='https://plus.google.com/101066707796671335057/posts?ref=ts%22%20target=%22_blank' target='_blank'>
                                                                        Google+
                                                                    </a>
                                    </li>
                                    <li>
                                        <a href='http://charleskeith.tumblr.com/?ref=ts%22%20target=%22_blank' target='_blank'>
                                                                        Tumblr
                                                                    </a>
                                    </li>
                                    <li>
                                        <a href='https://www.pinterest.com/charleskeith/' target='_blank'>
                                                                        Pinterest
                                                                    </a>
                                    </li>
                                    <li>
                                        <a href='http://charleskeithsays.com/' target='_blank'>
                                                                        Blog
                                                                    </a>
                                    </li>
                                    <li>
                                        <a href='http://statigr.am/charleskeithofficial' target='_blank'>
                                                                        Instagram
                                                                    </a>
                                    </li>
                                    <li>
                                        <a href='http://www.youtube.com/user/CharlesKeithChannel#p/c/4D814D67E7562346' target='_blank'>
                                                                        Youtube
                                                                    </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href='Feedback.html'>
                                                                Feedback
                                                            </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <div class="spacer">
                </div>
                <!--
                                  <div class="search-menu">
                                  <input name="" type="text" value="SEARCH..." onFocus="clearText(this)" onBlur="clearText(this)">
                                  
                                  <a href="#">
                                  >
                                  </a>
                                  </div>
                                            -->
            </div>
        </div>
        <div class="mainnav_arr">
            <img src="<?php echo App()->theme->baseUrl; ?>/images/icon-mainnav-arr-indicator.png" border="0" alt="" />
        </div>
        <div class="clear">
        </div>

        <!-- END OF MAIN MENU -->

        <!-- END OF MAIN MENU -->

        <!--   START OF MAIN CONTENT AREA -->
        <div style="padding-top: 80px; margin-left: 230px;">
            <div id="main-content-container-home">
                <?php echo $content; ?>
                <!--End of static-content -->
            </div>
        </div>
        <!-- END OF MAIN CONTENT AREA -->

        <div id="footer-home">
            <div class="copyright">
                <a href="https://www.facebook.com/pages/Charles-Keith/157130102253?ref=ts" target="_blank" class="socialmedia">Facebook</a>
                <a href="http://www.twitter.com/Charles_Keith" target="_blank" class="socialmedia"> Twitter </a> 
                <a href="https://plus.google.com/101066707796671335057/posts?ref=ts#101066707796671335057/posts?ref=ts" target="_blank" class="socialmedia"> Google+ </a> 
                <a href="http://charleskeith.tumblr.com/?ref=ts" target="_blank" class="socialmedia"> Tumblr </a> 
                <a href="http://www.pinterest.com/charleskeith/" target="_blank" class="socialmedia"> Pinterest </a> 
                <a href="http://charleskeithsays.com/" target="_blank" class="socialmedia"> Blog </a> 
                <a href="http://statigr.am/charleskeithofficial" target="_blank" class="socialmedia"> Instagram </a> 
                <a href="http://www.youtube.com/user/CharlesKeithChannel#p/c/4D814D67E7562346" target="_blank" class="socialmedia"> YouTube </a>                
            </div>
        </div>
        
        <script type="text/javascript">
            var _gaq = _gaq || [];
        </script>

        <!-- Start Crazyegg -->
        <script type="text/javascript">
            setTimeout(function() {
                var a = document.createElement("script");
                var b = document.getElementsByTagName("script")[0];
                a.src = document.location.protocol + "//dnn506yrbagrg.cloudfront.net/pages/scripts/0024/6147.js?" + Math.floor(new Date().getTime() / 3600000);
                a.async = true;
                a.type = "text/javascript";
                b.parentNode.insertBefore(a, b)
            }, 1);
        </script>
        <!-- end Crazyegg -->


    </div>
    <!--End of landing-->
    
    <script type="text/javascript" src="<?php echo App()->theme->baseUrl; ?>/js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo App()->theme->baseUrl; ?>/js/cufon-yui.js"></script>
    <script type="text/javascript" src="<?php echo App()->theme->baseUrl; ?>/js/Century_Gothic_700.font.js"></script>
    <script type="text/javascript" src="<?php echo App()->theme->baseUrl; ?>/js/common.js"></script>    
    <script type="text/javascript" src="<?php echo App()->theme->baseUrl; ?>/js/jquery.easing.min.js"></script>
    <script type="text/javascript" src="<?php echo App()->theme->baseUrl; ?>/js/supersized.3.2.7.js"></script>    
    <script type="text/javascript" src="<?php echo App()->theme->baseUrl; ?>/js/jScrollPane.js"></script>
    <script type="text/javascript" src="<?php echo App()->theme->baseUrl; ?>/js/browserDetect.js"></script>
    <script type='text/javascript' src='<?php echo App()->theme->baseUrl; ?>/js/jquery.cookie.js'></script>
    <script type='text/javascript' src='<?php echo App()->theme->baseUrl; ?>/js/jquery.dcjqaccordion.2.7.min.js'></script>
    <script type="text/javascript" src="<?php echo App()->theme->baseUrl; ?>/js/jquery.dd.js"></script>    
    <script src="<?php echo App()->theme->baseUrl; ?>/js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>
    <!-- Smooth Div Scroll 1.3 minified-->
    <script src="<?php echo App()->theme->baseUrl; ?>/js/mainnav-smoothScrolling.js" type="text/javascript"></script>  
    <script type="text/javascript" src="<?php echo App()->theme->baseUrl; ?>/js/ProductController.js"></script>
    <!--<script type="text/javascript" src="<?php echo App()->theme->baseUrl; ?>/js/SmallShoppingBagController.js"></script>-->
    <!--<script type="text/javascript" src="<?php echo App()->theme->baseUrl; ?>/js/engine.js"></script>-->
    <script type="text/javascript" src="<?php echo App()->theme->baseUrl; ?>/js/util.js"></script>
    <script type="text/javascript" src="<?php echo App()->theme->baseUrl; ?>/js/script.js"></script>
    <script type="text/javascript">
        landing();
    </script>
</body>

<!-- Mirrored from www.charleskeith.com/INTLStore/CK/ASM/Home by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 26 Apr 2015 15:53:59 GMT -->
</html>