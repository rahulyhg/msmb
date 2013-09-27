/*
 * Constants used throughout the site.
 *
 */

var SELECTED_PURCHASE = "selected-purchase";

var SELECTED_PURCHASE_SELECTOR = "."+ SELECTED_PURCHASE;
var UNACTIONABLE = "unactionable";
var UNACTIONABLE_SELECTOR = "."+UNACTIONABLE;
var EXPAND_STATE_SELECTOR = '.expand-state';

var selected = "selected";
var unselected = "unselected";
var ANIMATION_DURATION = 0;
var ANIMATION_DURATION_SHORT = 10;
var LINEAR_ANIMATION = 'linear';

var EMAIL = 'email';
var BUYABLE = 'buyable';
    
var RELEASE = 'release';
var BETA = 'beta';

var LINUX= "linux";
var WINDOWS = "windows";
var MAC= "mac";
var UNIX = "unix";

var RPM = "RPM";
var TARGZ = "tar.gz";


var BETA_STRING=" BETA";
var EMPTY_STRING="";


var BLANK_EMAIL_MESSAGE = "Email cannot be blank";

var EMAIL_ADDRESS_MESSAGE = 'Please enter a valid email address';
var BUY_NOW_MESSAGE = 'Add to cart';

var corresponding="enterprise-single";


//Fairly general functions used throughout the site.

/**
 *  A function that tells whether an element is an email div.
 */
function isEmailDiv(element){
    return (element.innerHTML.indexOf("Contact")==0);
}

/**
 *  A function that tells whether an element is an buy div.
 */
function isBuyDiv(element){
    return (element.innerHTML.indexOf("$")==0);
}


/**
 * Tells whether the given HTML DOM element contains a price
 */
function isActionable(element){
    return isBuyDiv(element) || isEmailDiv(element);
}

/**
 * Toggles state of an element storing expansion state.
 */
function toggleExpandState(element){
    if($(element).hasClass(selected)) {
        $(element).removeClass(selected).addClass(unselected);
    } else {
        $(element).removeClass(unselected).addClass(selected);
    }
}

/**
 *  Add animation for the selected purchase.
 */
function animateSelectedPurchase(){
    $(SELECTED_PURCHASE_SELECTOR).css("text-align","left")
    .fadeOut(0,function(){})
    .fadeIn(300,function(){})
    .siblings("a")
    .find(".buy-div").stop(false,true).animate({
        "left":"-=65px"
    },ANIMATION_DURATION,
    LINEAR_ANIMATION,
    function(){})
    .fadeIn(300,function(){});
}

/**
 *  A function that return the id corresponding to a given selected purchase.
 */
function getCorresponding(elementId){
    var PREMIUM_SUPPORT_SUFFIX="-ps";
    var index=elementId.indexOf(PREMIUM_SUPPORT_SUFFIX);
    if(index!=-1){
        return elementId.substring(0,index);
    } else {
        return elementId+PREMIUM_SUPPORT_SUFFIX;
    }
}

/**
 * Remove animation for the selected purchase.
 */
function deanimateSelectedPurchase(){
    $(SELECTED_PURCHASE_SELECTOR).css("text-align","center")
    .siblings("a")
    .find(".buy-div").hide(0).stop(false,true).animate({
        "left":"+=65px"
    },ANIMATION_DURATION_SHORT,
    LINEAR_ANIMATION,
    function(){});
}


/**
 *  A function that marks a div as a price or an email.
 */
function markAsPriceOrEmail(element){
    if(isEmailDiv(element)){
        $(element).addClass(EMAIL);
    }else if(isBuyDiv(element)){
        $(element).addClass(BUYABLE);
    }
}

/**
 *   A function to do things when the bleeding edge button is clicked.
 */
function doBeta(element){
    if($(element).hasClass('beta')){
        $(element).removeClass('beta');
        $(element).addClass('release');
        $(element).parents('.wy-product-download-tab').find('.release-div').show();
        $(element).parents('.wy-product-download-tab').find('.beta-div').hide();
        $(element).html('Switch to beta downloads');
        $(element).siblings(".betalink-text").html("Want bleeding edge of ");
    } else if($(element).hasClass('release')){
        $(element).removeClass('release');
        $(element).addClass('beta');
        $(element).parents('.wy-product-download-tab').find('.release-div').hide();
        $(element).parents('.wy-product-download-tab').find('.beta-div').show();
        $(element).html('Switch back');
        $(element).siblings(".betalink-text").html("Want stable version of ");
    }
}




/**
 *  Utility functions to display the appropriate download buttons.
 */
function show32bit(){
    $('.bit32-div').show();
}

function show64bit(){
    $('.bit64-div').show();
}

function hide32bit(){
    $('.bit32-div').hide();
}

function hide64bit(){
    $('.bit64-div').hide();
}

function hideReleaseDivs(){
    $('.release-div').hide();
}

function hideBetaDivs(){
    $('.beta-div').hide();
}


/*
 * I want to write a function that returns the operating system of the
 * browser.
 */
function getOperatingSystem(){
    var OSName="Unknown OS";

    if (navigator.appVersion.indexOf("Win")!=-1) {
        OSName=WINDOWS;
    }
    if (navigator.appVersion.indexOf("Mac")!=-1) {
        OSName=MAC;
    }
    if (navigator.appVersion.indexOf("X11")!=-1) {
        OSName=UNIX;
    }
    if (navigator.appVersion.indexOf("Linux")!=-1) {
        OSName=LINUX;
    }

    return OSName;
}

/*
 *  I want to write a function that toggles support prices and normal
 *  prices for a particular premium div.
 *
 *  This function does 6 things:
 *  1. Deanimates the purchase marked as selected purchase.
 *  2. Removes selected purchase class from that purchase.
 *  3. Shows the div which has prices requested.
 *  4. Hides the other div.
 *  5. Marks the default purchase as selected purchase.
 *  6. Animates this selected purchase.
 *
 *  Clearly I have to kill all animations at the beginning of this function.
 *  Otherwise the pending animations create undesired effects.
 */
function setProductPrices(elementToSet, showWithPremiumSupport,setSelectedPurchase){
    deanimateSelectedPurchase();
    $(SELECTED_PURCHASE_SELECTOR).removeClass(SELECTED_PURCHASE);
    if(showWithPremiumSupport){
        elementToSet
        .find('.premium-support')
        .show();
        elementToSet
        .find('.without-premium-support')
        .hide();
    } else{
        elementToSet
        .find('.premium-support')
        .hide();
        elementToSet
        .find('.without-premium-support')
        .show();
    }
    if(setSelectedPurchase){
        setNextSelectedPurchase();
        animateSelectedPurchase();
    }

}

/*
 *  I want a function which toggles between Premium Support prices and
 *  normal prices.
 */
function setProductPricesToggle(elementId)
{
    corresponding = getCorresponding($(SELECTED_PURCHASE_SELECTOR)
        .parent('li')
        .slice(0,1)
        .attr('id')
        );
    
    if($("#"+elementId).hasClass('premium-support-prices-shown')){
        $("#"+elementId).removeClass('premium-support-prices-shown')
        .addClass('premium-support-prices-not-shown');
        $("#"+elementId).parents(".wy-buy-tab").find(".with-without").html("without");
        $("#"+elementId).html("Show me prices with Premium Support");
        setProductPrices($("#"+elementId).parents(".wy-buy-tab"),false,true);
    }else{
        $("#"+elementId).removeClass('premium-support-prices-not-shown')
        .addClass('premium-support-prices-shown');
        $("#"+elementId).parents(".wy-buy-tab").find(".with-without").html("with");
        $("#"+elementId).html("Show me prices without Premium Support");
        setProductPrices($("#"+elementId).parents(".wy-buy-tab"),true,true);
    }

    
}

function validateForm() {

    //        var email = $("#email").val();
    var country = $("#country").val();
    var state = $("#state").val();
    var zip_code = $("#zip_code").val();
    var area_code = $("#area_code").val();
    var metro_code = $("#metro_code").val();

    var type = $("#type").val();
    var packType = $("#packType").val();
    var os = $("#os").val();
    var bits = $("#bits").val();
    var email = $("#email").val();
    var product = $("#product").val();
    //        var newsletter = $("#newsletter").is(':checked');

    if ($.trim(email).length == 0) {
        $("#email-error").html(BLANK_EMAIL_MESSAGE);
        $("#email").focus();
        return false;
    }

    if (validateEmail(email)) {
        $(".ajax-spinner").show();
        $.post("/webyog/emailLinks", {
            email: email,
            type: type,
            packType: packType,
            os: os,
            bits: bits,
            product: product,
            zip_code: zip_code,
            metro_code: metro_code,
            area_code: area_code,
            country: country,
            state:state
        },
        function(data) {
            if (data != false) {
                $("#download-form-container").colorbox.resize({
                    height: "660px"
                });
                $(".ajax-spinner").hide();
                $("#download-form-container").css("height", "660px");
                $("#email-send-div").hide();
                $("#message-div").show();
                $("#data-div .response").html(data);
            }
        });
    }
    else {
        $("#email-error").html(EMAIL_ADDRESS_MESSAGE);
        $("#email").focus();
        return false;
    }
}

function validateSalesForm() {
    var name = $("#email-form-container #name").val();
    var message = $("#email-form-container #message").val();
    var subject = $("#email-form-container #subject").val();
    var replyEmail = $("#email-form-container #reply-email").val();
    var emailType = $("#email-form-container #emailType").val();
    var product = $("#email-form-container #product").val();
    

    //        var newsletter = $("#newsletter").is(':checked');
    if ($.trim(replyEmail).length == 0) {
        $("#email-form-container #sales-email-error").html(BLANK_EMAIL_MESSAGE);
        $("#email-form-container #reply-email").focus();
        return false;
    }
    if (validateEmail(replyEmail)) {
        $.post("/webyog/emailSales", {
            email: replyEmail,
            name: name,
            subject: subject,
            message: message,
            emailType: emailType
        },
        function(data) {
            //if no products are to be shown, make the container smaller
            if(product=="none"){
                $("#email-form-container").colorbox.resize({
                    width: "700px",
                    height: "160px"
                });
                $("#email-form-container").css("width", "640px");
                $("#email-form-container").css("height", "220px");
            } else {
                $("#email-form-container").colorbox.resize({
                    width: "700px"
                });
                $("#email-form-container").css("width", "640px");
                
                
            }
            $("#email-form-container #sales-email-send-div").hide();
            $("#email-form-container #sales-message-div").show();
            $("#email-form-container #sales-message-div .response").html(data);
        });
    }
    else {
        $("#email-form-container #sales-email-error").html(EMAIL_ADDRESS_MESSAGE);
        $("#email-form-container #reply-email").focus();
        return false;
    }
}

function validateSalesFormVisifire() {
    var name = $("#email-form-container-visifire #name").val();
    var message = $("#email-form-container-visifire #message").val();
    var subject = $("#email-form-container-visifire #subject").val();
    var replyEmail = $("#email-form-container-visifire #reply-email").val();
    var emailType = $("#email-form-container-visifire #emailType").val();
    var product = $("#email-form-container-visifire #product").val();


    //        var newsletter = $("#newsletter").is(':checked');
    if ($.trim(replyEmail).length == 0) {
        $("#email-form-container-visifire #sales-email-error").html(BLANK_EMAIL_MESSAGE);
        $("#email-form-container-visifire #reply-email").focus();
        return false;
    }
    if (validateEmail(replyEmail)) {
        $.post("/webyog/emailSales", {
            email: replyEmail,
            name: name,
            subject: subject,
            message: message,
            emailType: emailType
        },
        function(data) {
            //if no products are to be shown, make the container smaller
            if(product=="none"){
                $("#email-form-container-visifire").colorbox.resize({
                    width: "700px",
                    height: "160px"
                });
                $("#email-form-container-visifire").css("width", "640px");
                $("#email-form-container-visifire").css("height", "220px");
            } else {
                $("#email-form-container-visifire").colorbox.resize({
                    width: "700px"
                });
                $("#email-form-container-visifire").css("width", "640px");


            }
            $("#email-form-container-visifire #sales-email-send-div").hide();
            $("#email-form-container-visifire #sales-message-div").show();
            $("#email-form-container-visifire #sales-message-div .response").html(data);
        });
    }
    else {
        $("#email-form-container-visifire #sales-email-error").html(EMAIL_ADDRESS_MESSAGE);
        $("#email-form-container-visifire #reply-email").focus();
        return false;
    }
}

/**
 *
 */
function setNextSelectedPurchase(){
    $("#"+corresponding)
    .find('div:first')
    .addClass(SELECTED_PURCHASE);
}

function validateEmail(sEmail){
    var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    if (filter.test(sEmail)){
        return true;
    }else{
        return false;
    }
}

/**
 *  I want to write a function that tells the default text for a given function.
 */
function getDefaultText(field){
    if(field=="email"){
        return "user@domain";
    }
    return field;
}

/*
 *  I want to write a function which sets the email popup anchors.
 */
function setEmailPopupAnchors(){
    //Specify the behaviour for the email buttons
    $( 'a[href$="email-form-container"]').colorbox(
    {
        inline:true,
        fixed: true,
        transition: 'none',
        scrolling: false,
        returnFocus: false,
        onLoad:function(){
            $("#email-form-container #reply-email, #email-form-container #name, #email-form-container #subject, #email-form-container #message").val("");
            $("#email-form-container").show();
            $("#email-form-container #sales-email-send-div").show();
            $("#email-form-container #sales-message-div").hide();
            
            $("#email-form-container").show().animate({
                "height":"465px",
                "width":"485px"
            },
            ANIMATION_DURATION,
            LINEAR_ANIMATION,
            function(){});
        },
        onComplete:function(){
//            $("#email-form-container #name").focus();
        },
        onCleanup:function(){
            $("#email-form-container").hide();
        },
        onClosed: function(){
            $("#email-form-container").hide();
            $("#email-form-container").css("width","485px;");
            $("#email-form-container #sales-email-send-div").show();
            $("#email-form-container #sales-message-div").hide();
            $("#email-form-container #sales-email-error").html("");
        }
            
    });

}

/*
 *  I want to write a function which sets the email popup anchors.
 */
function setEmailPopupAnchorsVisifire(){
    //Specify the behaviour for the email buttons
    $( 'a[href$="email-form-container-visifire"]').colorbox(
    {
        inline:true,
        fixed: true,
        transition: 'none',
        scrolling: false,
        returnFocus: false,
        onLoad:function(){
            $("#email-form-container-visifire #reply-email, #email-form-container-visifire #name, #email-form-container-visifire #subject, #email-form-container-visifire #message").val("");
            $("#email-form-container-visifire").show();
            $("#email-form-container-visifire #sales-email-send-div").show();
            $("#email-form-container-visifire #sales-message-div").hide();

            $("#email-form-container-visifire").show().animate({
                "height":"465px",
                "width":"485px"
            },
            ANIMATION_DURATION,
            LINEAR_ANIMATION,
            function(){});
        },
        onComplete:function(){
//            $("#email-form-container-visifire #name").focus();
        },
        onCleanup:function(){
            $("#email-form-container-visifire").hide();
        },
        onClosed: function(){
            $("#email-form-container-visifire").hide();
            $("#email-form-container-visifire").css("width","485px;");
            $("#email-form-container-visifire #sales-email-send-div").show();
            $("#email-form-container-visifire #sales-message-div").hide();
            $("#email-form-container-visifire #sales-email-error").html("");
        }

    });

}


/*
 * I want to write a function that sets the selected tab in the header to the id
 * specified in the first argument.
 */
function setSelectedTab(tabId){
    $(".wy-selected-tab").removeClass("wy-selected-tab");
    $(tabId).addClass("wy-selected-tab");
}





/**
 *  I want to write a function that marks the correct download tab based on
 *  the operating system.
 */
function markMatchingOS(OSName){
    if(OSName == WINDOWS){
        $("#monyog-windows-download-tab").addClass("matching-operating-system");
    } else if (OSName == LINUX || OSName ==  UNIX) {
        $("#monyog-linux-download-tab").addClass("matching-operating-system");
    }
}

/**
 *  I want to write a function that displays the download tab for the matching
 *  operating system.
 */
function showMatchingOperatingSystem(){
    $('.matching-operating-system').find('dt span.expand-state')
    .removeClass('unselected').addClass('selected')
    .end()
    .find('dd').show();
}


/*
 *  I want to create an anchor for a collapsable div. The div should get expanded 
 *  when the anchor is referenced in a browser.
 *  The id must be the element's id attribute.
 */
function createAnchorForCollapsableDiv(id){
    /*
     *  I want to show the feature list table if that is the id that is 
     *  referred in the page URL
     */
    var pathname = $(location).attr("href");
    
    
    String.prototype.endsWith = function(suffix) {
        return this.indexOf(suffix, this.length - suffix.length) !== -1;
    };

    
    if(pathname.endsWith(id)){
        $(id)
        .find("dd")
        .show()
        .siblings("dt")
        .find("span.expand-state")
        .removeClass("unselected")
        .addClass("selected");
    }
}


/*
 *  I want to write a function that sets the behaviour for youtube popups in t
 */
function setYoutubePopups(){
    $(".youtube").colorbox({
        fixed:true,
        scrolling: false,
        iframe:true,
        innerWidth:600,
        innerHeight:338,
        transition: 'none'
    });
    $(".youtube-old").colorbox({
        fixed:true,
        scrolling: false,
        iframe:true,
        innerWidth:605,
        innerHeight:450,
        transition: 'none'
    });
}

/**
 *  A function that contains default code to be executed whenever a page is
 *  loaded.
 */
function defaultDocumentReady(){
    /**
     * Called when the DOM is ready for processing.
     */

    // GENERAL BEHAVIOUR.
    /*
     * Adds a function to the click event of dt elements that are children
     * of dd elements.
     */
    $('dd').hide().end().find('dt').click(function() {
        $(this).next().slideToggle();
        $(this).find(EXPAND_STATE_SELECTOR).each(function(index,element) {
            toggleExpandState(this);
        });
    });


    //1. BEHAVIOR FOR THE PRODUCT DOWLOAD TABS
    $('#monyog64bit').click(function(){
        $(this).find(EXPAND_STATE_SELECTOR)
        .removeClass(unselected).addClass(selected);
        $('#monyog32bit').find(EXPAND_STATE_SELECTOR)
        .removeClass(selected).addClass(unselected);
        show64bit();
        hide32bit();
    });

    $('#monyog32bit').click(function(){
        $(this).find(EXPAND_STATE_SELECTOR)
        .removeClass(unselected).addClass(selected);
        $('#monyog64bit').find(EXPAND_STATE_SELECTOR)
        .removeClass(selected).addClass(unselected);
        show32bit();
        hide64bit();
    });






    //2. BEHAVIOR FOR THE MONYOG PREMIUM TAB
    /*
     *  I want to set the font color of all the items in the feature list
     *  table to white.
     */
    $(".feature-list-table .feature-list-column ul li div")
    .addClass("wy-white")
    .children()
    .addClass("wy-white");

    /*
     *  I want the heading of the feature list table to be in font-level-1.
     */
    //Get a wrapped element set. This set contains all feature list column headings.
    $(".feature-list-column ul li:first-child div")
    .addClass("wy-font-level-2");


    


    createAnchorForCollapsableDiv("#sqlyog-feature-list");
    createAnchorForCollapsableDiv("#sqlyog-what-is-premium-support");

    createAnchorForCollapsableDiv("#monyog-feature-list");
    createAnchorForCollapsableDiv("#monyog-what-is-premium-support");



   
    /*
     *  I want to add left and right paddings of 20px to all definitions.
     */
    $(".feature-list-table .feature-list-column ul li div")
    .addClass("wy-default-left-right-padding")
    .children("dd")
    .addClass("wy-default-left-right-padding");

    /*
     * Add a tick in front of all checklist items.
     */
    $('.wy-checklist li').prepend('<span class="wy-img-button tick-mark"></span>');


    /*
     *  I want to set the click event of the product prices link.
     */
    $("#sqlyog-product-prices-link,#monyog-product-prices-link").click(function(event){
        setProductPricesToggle(event.target.id);
    });


    /*
     * Long JQuery chain. Adds behaviour for Product prices table.
     */
    // Mark elements that are unactionable.
    $("#monyog-premium .wy-inner-fourth ul li > div, #sqlyog-premium .wy-inner-fourth ul li > div")
    .each(function(index,element) {
        if(!isActionable(element)){
            $(element).addClass(UNACTIONABLE);
        } else {
            $(element).removeClass(UNACTIONABLE).each(function(index,element){
                markAsPriceOrEmail(element);
            });
        }

    })
    .filter(':not('+ UNACTIONABLE_SELECTOR+')')
    .parent()
    .mouseenter(function(){
        if(!$(this).find('div:first').hasClass(SELECTED_PURCHASE)){
            //The old selected purchase. is selected. its special effects are removed.
            deanimateSelectedPurchase();

            // The old selected purchase is no more the selected purchase
            $(SELECTED_PURCHASE_SELECTOR).removeClass(SELECTED_PURCHASE);


            //This element is the selected purchase. Mark it.
            $(this).find('div:first').addClass(SELECTED_PURCHASE);



            //This element is the selected purchase. Animate it.
            animateSelectedPurchase();
        //Mark the div that contains the selected purchase as the new selected
        //version.
        // setSelectedVersion();
        }
    });


    //Specify the image and text for email buttons.
    $('.email')
    .siblings('a')
    .find('.buy-div')
    .append('Email')
    .find('.wy-img-button')
    .addClass('email-button');


    //Specify the image and text for buy now buttons.
    $('.buyable')
    .siblings('a')
    .find('.buy-div')
    .append(BUY_NOW_MESSAGE)
    .find('.wy-img-button')
    .addClass('buy-button');



    /*
     *  Animate the present selected purchase
     */

    /*
     *  Show prices for product with Premium Support.
     *  I am calling animateSelectedPurchase once before
     *  calling this function. There s a reason for that.
     *
     *  If I don't call it, the selected purchase is animated undesirably.
     */

    $(".default-purchase").addClass(SELECTED_PURCHASE);
    animateSelectedPurchase();
    setProductPrices($("#sqlyog-premium"),true,false);
    setProductPrices($("#monyog-premium"),true,false);
    $(".default-purchase").addClass(SELECTED_PURCHASE);
    animateSelectedPurchase();


    //COLOR BOX BASED BEHAVIOR.
    //
    //Set the behaviour for download buttons.
    //    setDownloadButtons();
    $(".wy-download-button-anchor").colorbox(
    {
        inline:true,
        fixed: true,
        transition: 'none',
        scrolling: false,
        returnFocus: false,
        onLoad:function(){
            $("#email").val("");
            $(".ajax-spinner").hide();
            
            if($(this).find('.wy-download-button').hasClass('monyog')) {
                $("#product").val('MONyog');
            } else {
                $("#product").val('SQLyog');
            }
            if($(this).find('.wy-download-button').hasClass('windows')) {
                $("#os").val('WINDOWS');
            } else {
                $("#os").val('LINUX');
            }
            if($(this).find('.wy-download-button').hasClass('bit32')) {
                $("#bits").val('32');
            } else {
                $("#bits").val('64');
            }
            if($(this).find('.wy-download-button').hasClass('release')) {
                $("#type").val('RELEASE');
            } else {
                $("#type").val('BETA');
            }
            if($(this).find('.wy-download-button').hasClass('rpm')) {
                $("#packType").val('RPM');
            } else if($(this).find('.wy-download-button').hasClass('targz')) {
                $("#packType").val('TARGZ');
            } else {
                $("#packType").val('EXE');
            }
            $("#download-form-container").show().animate({
                "height":"160px"
            },
            ANIMATION_DURATION,
            LINEAR_ANIMATION,
            function(){});
        },
        onComplete:function(){
            $("#email").focus();
        },
        onCleanup:function(){
            
        },
        onClosed: function(){
            $("#download-form-container").hide();
            $("#download-form-container").css("height","160px;");
            $("#email-send-div").show();
            $("#message-div").hide();
            $("#email-error").html("");
        }
    });
    
    setEmailPopupAnchors();


    //Specify the behaviour for the youtube buttons.
    setYoutubePopups();


    //Hide 32 bit downloads by default.
    hide32bit();
    //Hide beta downloads by default.
    hideBetaDivs();

}


/*
 * A function that displays a fancy title for screenshots.
 */
function fancyTitle(title, currentArray, currentIndex, currentOpts){
    if(title != ''){
        var counterText = currentOpts.custom_counterText;
        var $container = $('<div id="fancybox-custom-title-container"></div>');
        var $title = $('<span id="fancybox-custom-title"></span>');
        if(currentArray.length > 1){
            var $counter = $('<span id="fancybox-custom-counter"></span>');
            $counter.text(
                counterText
                .replace('{#index#}', (currentIndex+1))
                .replace('{#count#}', currentArray.length));
            $container.append($counter);
        }
        $title.text(title);
        $container.append($title);
        return $container;
    }
}

/*
 * A function that displays does the default behaviour for screenshots pages
 */
function fancyboxSlideshow(){
    $("a.grouped_elements").fancybox({
            'fixed' : true,
            'padding' : 2,
            'transitionIn'		: 'none',
            'transitionOut'		: 'none',
            'titlePosition' 	: 'inside',
            'openEffect': 'fade',
            'prevEffect': 'fade',
            'nextEffect': 'fade',
            'titleFormat'       : fancyTitle,
            'loop': false,
            'autoPlay' : true ,//  slideshow will start after opening the first gallery item,
            'playSpeed' : 10000 // 3sec pause between changing next item
        });
}