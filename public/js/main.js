/**
 * main JS file
 */

/**
 * cover video
 */
var min_w = 300;
var vid_w_orig;
var vid_h_orig;
$(function() {
    vid_w_orig = parseInt($('video').attr('width'));
    vid_h_orig = parseInt($('video').attr('height'));
    $(window).resize(function () { fitVideo(); });
    $(window).trigger('resize');
});

function fitVideo() {
    $('#video-viewport').width($('.fullsize-video-bg').width());
    $('#video-viewport').height($('.fullsize-video-bg').height());

    var scale_h = $('.fullsize-video-bg').width() / vid_w_orig;
    var scale_v = $('.fullsize-video-bg').height() / vid_h_orig;
    var scale = scale_h > scale_v ? scale_h : scale_v;

    if (scale * vid_w_orig < min_w) {scale = min_w / vid_w_orig;};

    $('video').width(scale * vid_w_orig);
    $('video').height(scale * vid_h_orig);

    $('#video-viewport').scrollLeft(($('video').width() - $('.fullsize-video-bg').width()) / 2);
    $('#video-viewport').scrollTop(($('video').height() - $('.fullsize-video-bg').height()) / 2);

};

/**
 * scroll to top
 */
$(window).scroll(function() {
    if ($(this).scrollTop() >= 100) {
        $('#return-to-top').fadeIn(200);
    } else {
        $('#return-to-top').fadeOut(200);
    }

    // scroll the sidebar content
    var full_width = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
    if (($(this).scrollTop() >= 0 && $(this).scrollTop() <= 1500) && full_width >= 1281) {
        $("#sidebar").stop().animate({"marginTop": ($(window).scrollTop())}, "slow");
    }

});
$('#return-to-top').click(function() {
    $('body,html').animate({
        scrollTop : 0
    }, 700);
});

jQuery(document).ready(function(){
    /**
     *   team containers
     */
    var teamContent = $(".team-text");
    if(teamContent.length > 0) {
        var maxHeightContent = 0;
        teamContent.each(function () {
            if ($(this).height() > maxHeightContent) {
                maxHeightContent = $(this).height();
            }
        });
        teamContent.height(maxHeightContent);
    }

    /**
     *   add lazy loading to images out of screen viewport
     */
    $(function() {
        $("img.lazy").lazyload({
            effect : "fadeIn"
        });
    });

    /**
    *   timeline animation
     */
    var leftTime = $('.left-time');
    var rightTime = $('.right-time');
    if(leftTime.length > 0) {
        $(leftTime).animate({opacity: "show"}, 1500);
    }
    if(rightTime.length > 0) {
        $(rightTime).animate({opacity: "show"}, 1500);
    }

    /**
     *  email ajax script for main contact form
     */
    $("#contact-form").submit(function (event) {
        event.preventDefault();
        var submitButton = $('#contactSubmit');

        // disable button for another submits
        // add spinning icon class
        submitButton.addClass('disabled');
        $('#contactSubmit i').addClass('fa-spin');

        //get input fields values
        var values = {};
        $.each($(this).serializeArray(), function (i, field) {
            values[field.name] = field.value;
        });
        var token = $('#contact-form > input[name="_token"]').val();

        //user output
        var errorMsg = "";
        var successMsg = "<h4>E-mail s Vašim upitom je uspješno poslan</h4>";

        $.ajax({
            type: 'post',
            url: $(this).attr('action'),
            dataType: 'json',
            headers: {'X-CSRF-Token': token},
            data: {_token: token, formData: values},
            success: function (data) {
                //check status of validation and query
                if (data.status === 'success') {
                    swal({
                        title: successMsg,
                        type: 'success',
                        timer: 2500,
                        onOpen: function () {
                            swal.showLoading()
                        }
                    }).then(
                        function () {},
                        // handling the promise rejection
                        function (dismiss) {
                            if (dismiss === 'timer') {
                                console.log('Mail sent');
                            }
                        }
                    );

                    $(this).trigger('reset');
                }
                else {
                    $.each(data.errors, function(index, value) {
                        $.each(value, function(i){
                            errorMsg += value[i] + '<br>';
                        });
                    });

                    $('#contactSubmit i').removeClass('fa-spin');

                    swal({
                        title: 'Ispravite navedene greške',
                        html: errorMsg,
                        type: 'error',
                        timer: 5000,
                        onOpen: function () {
                            swal.showLoading()
                        }
                    }).then(
                        function () {},
                        // handling the promise rejection
                        function (dismiss) {
                            if (dismiss === 'timer') {
                                console.log('Mail error');
                            }
                        }
                    );
                }
            }
        });

        //restore default class and reset captcha/form
        setTimeout(function(){
            var submitButton = $('#contactSubmit');

            submitButton.removeClass('disabled');
            $('#contactSubmit i').removeClass('fa-spin');
            grecaptcha.reset();
            $('#contact-form').trigger('reset');
        }, 5000);

    });

    /**
     *   live tags filtering
     */
    var tagsFilter = $("#filter");
    if(tagsFilter.length > 0) {
        //prevent submit action if user tried
        $("#live-search").submit(function(event){
            event.preventDefault();
        })

        //start search/filter function
        tagsFilter.keyup(function () {
            $("#filter-count").text("Tražim..");

            var filter = $(this).val(), count = 0;

            $(".tags li").each(function () {
                if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                    $(this).fadeOut();
                }
                else {
                    $(this).show();
                    count++;
                }
            });

            setTimeout(function () {
                if(count > 0) {
                    $("#filter-count").text('Klknite na traženi tag za prikaz svih vijesti s istim.');
                }
                else{
                    $("#filter-count").text('Nije pronađen niti jedan tag.');
                }
            }, 1500);
        });
    }

    /**
     *   submit form if option changed in drop-down menu
     */
    if($('#sort_option').length > 0) {
        $(this).change(function () {
            $('#formSort').submit();
        });
    }

});

/**
 * contact page form
 */
(function ($) {
    "use strict";

    /*==================================================================
     [ Focus Contact2 ]*/
    $('.input-full-flex').each(function(){
        $(this).on('blur', function(){
            if($(this).val().trim() != "") {
                $(this).addClass('has-val');
            }
            else {
                $(this).removeClass('has-val');
            }
        })
    })


    /*==================================================================
     [ Validate after type ]*/
    $('.validate-input .input-full-flex').each(function(){
        $(this).on('blur', function(){
            if(validate(this) == false){
                showValidate(this);
            }
            else {
                $(this).parent().addClass('true-validate');
            }
        })
    })

    /*==================================================================
     [ Validate ]*/
    var input = $('.validate-input .input-full-flex');

    $('.validate-form').on('submit',function(){
        var check = true;

        for(var i=0; i<input.length; i++) {
            if(validate(input[i]) == false){
                showValidate(input[i]);
                check=false;
            }
        }

        return check;
    });


    $('.validate-form .input-full-flex').each(function(){
        $(this).focus(function(){
            hideValidate(this);
            $(this).parent().removeClass('true-validate');
        });
    });

    function validate (input) {
        if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
            if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                return false;
            }
        }
        else {
            if($(input).val().trim() == ''){
                return false;
            }
        }
    }

    function showValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');
    }
})(jQuery);


/**
* bootstrap checkbox icons
 */
$(function () {
    $('.button-checkbox').each(function () {

        // Settings
        var $widget = $(this),
            $button = $widget.find('button'),
            $checkbox = $widget.find('input:checkbox'),
            color = $button.data('color'),
            settings = {
                on: {
                    icon: 'fa fa-check-square-o'
                },
                off: {
                    icon: 'fa fa-square-o'
                }
            };

        // Event Handlers
        $button.on('click', function () {
            $checkbox.prop('checked', !$checkbox.is(':checked'));
            $checkbox.triggerHandler('change');
            updateDisplay();
        });
        $checkbox.on('change', function () {
            updateDisplay();
        });

        // Actions
        function updateDisplay() {
            var isChecked = $checkbox.is(':checked');

            // Set the button's state
            $button.data('state', (isChecked) ? "on" : "off");

            // Set the button's icon
            $button.find('.state-icon')
                .removeClass()
                .addClass('state-icon ' + settings[$button.data('state')].icon);

            // Update the button's color
            if (isChecked) {
                $button
                    .removeClass('btn-default')
                    .addClass('btn-' + color + ' active');
            }
            else {
                $button
                    .removeClass('btn-' + color + ' active')
                    .addClass('btn-default');
            }
        }

        // Initialization
        function init() {

            updateDisplay();

            // Inject the icon if applicable
            if ($button.find('.state-icon').length == 0) {
                $button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i> ');
            }
        }
        init();
    });
});

/**
 * cover section scroller
 */
$(function() {
    $('#scroller').on('click', function(e) {
        var offset = -4;
        $('html, body').animate({
            scrollTop: $("#latest-news").offset().top + offset
        }, 2000);
    });
});

/**
 *  image lightbox gallery
 */
(function($){
    $(document).ready(function(){
        //activity indicator
        var activityIndicatorOn = function(){
                $( '<div id="imagelightbox-loading"><div></div></div>' ).appendTo('body');
            },
            activityIndicatorOff = function(){
                $('#imagelightbox-loading').remove();
            },
        //overlay
            overlayOn = function(){
                $( '<div id="imagelightbox-overlay"></div>' ).appendTo('body');
            },
            overlayOff = function(){
                $('#imagelightbox-overlay').remove();
            },
        //close button
            closeButtonOn = function(instance){
                $( '<button type="button" id="imagelightbox-close" title="Zatvori"></button>' ).appendTo('body').on('click touchend', function(){ $(this).remove(); instance.quitImageLightbox(); return false; });
            },
            closeButtonOff = function(){
                $('#imagelightbox-close').remove();
            },
        //arrows
            arrowsOn = function(instance, selector){
                var $arrows = $('<button type="button" class="imagelightbox-arrow imagelightbox-arrow-left" title="Prethodna"></button><button type="button" class="imagelightbox-arrow imagelightbox-arrow-right" title="Sljedeća"></button>');
                $arrows.appendTo('body');

                $arrows.on('click touchend', function(e){
                    e.preventDefault();

                    var $this = $(this),
                        $target = $(selector + '[href="' + $('#imagelightbox').attr('src') + '"]'),
                        index = $target.index(selector);

                    if ($this.hasClass('imagelightbox-arrow-left')) {
                        index = index - 1;
                        if (!$(selector).eq(index).length)
                            index = $(selector).length;
                    } else {
                        index = index + 1;
                        if (!$(selector).eq(index).length)
                            index = 0;
                    }

                    instance.switchImageLightbox(index);
                    return false;
                });
            },
            arrowsOff = function(){
                $('.imagelightbox-arrow').remove();
            };

        //run gallery
        var selector = 'a[data-imagelightbox="gallery-images"]';
        var instance = $(selector).imageLightbox({
            onStart:        function() { overlayOn(); closeButtonOn(instance); arrowsOn(instance, selector); },
            onEnd:          function() { overlayOff(); closeButtonOff(); arrowsOff(); activityIndicatorOff(); },
            onLoadStart:    function() { activityIndicatorOn(); },
            onLoadEnd:      function() { activityIndicatorOff(); $('.imagelightbox-arrow').css('display', 'block'); }
        });

    });
})(this.jQuery);