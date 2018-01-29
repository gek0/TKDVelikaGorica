/**
 * main JS file
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

jQuery(document).ready(function($){
    //toggle 3d navigation
    $('.cd-3d-nav-trigger').on('click', function(){
        toggle3dBlock(!$('.cd-header').hasClass('nav-is-visible'));
    });

    //select a new item from the 3d navigation
    $('.cd-3d-nav').on('click', 'a', function(){
        var selected = $(this);
        selected.parent('li').addClass('cd-selected').siblings('li').removeClass('cd-selected');
        updateSelectedNav('close');
    });

    $(window).on('resize', function(){
        window.requestAnimationFrame(updateSelectedNav);
    });

    function toggle3dBlock(addOrRemove) {
        if(typeof(addOrRemove)==='undefined') addOrRemove = true;
        $('.cd-header').toggleClass('nav-is-visible', addOrRemove);
        $('.cd-3d-nav-container').toggleClass('nav-is-visible', addOrRemove);
        $('main').toggleClass('nav-is-visible', addOrRemove).one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
            //fix marker position when opening the menu (after a window resize)
            addOrRemove && updateSelectedNav();
        });
    }

    //this function update the .cd-marker position
    function updateSelectedNav(type) {
        var selectedItem = $('.cd-selected'),
            selectedItemPosition = selectedItem.index() + 1,
            leftPosition = selectedItem.offset().left,
            backgroundColor = selectedItem.data('color'),
            marker = $('.cd-marker');

        marker.removeClassPrefix('color').addClass('color-'+ selectedItemPosition).css({
            'left': leftPosition,
        });
        if( type == 'close') {
            marker.one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
                toggle3dBlock(false);
            });
        }
    }

    $.fn.removeClassPrefix = function(prefix) {
        this.each(function(i, el) {
            var classes = el.className.split(" ").filter(function(c) {
                return c.lastIndexOf(prefix, 0) !== 0;
            });
            el.className = $.trim(classes.join(" "));
        });
        return this;
    };
});

jQuery(document).ready(function(){
    /**
     *   add lazy loading to images out of screen viewport
     */
    $(function() {
        $("img.lazy").lazyload({
            effect : "fadeIn"
        });
    });

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
     * back to top animation
     */
    if ($('#back-to-top').length > 0) {
        var scrollTrigger = 100, // px
            backToTop = function () {
                var scrollTop = $(window).scrollTop();
                if (scrollTop > scrollTrigger) {
                    $('#back-to-top').addClass('show');
                } else {
                    $('#back-to-top').removeClass('show');
                }
            };
        backToTop();
        $(window).on('scroll', function () {
            backToTop();
        });
        $('#back-to-top').on('click', function (e) {
            e.preventDefault();
            $('html,body').animate({
                scrollTop: 0
            }, 700);
        });
    }

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