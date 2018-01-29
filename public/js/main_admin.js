/**
 * main admin JS file
 */

jQuery(document).ready(function(){
    /**
     *   BBcode editor
     */
    var editor = $("#codeEditor");
    if (editor.length > 0) {
        var lg = {
            lang: "hr",
            buttons: "bold,italic,underline,strike,sup,sub,|,justifyleft,justifycenter,justifyright,quote,|,table,bullist,numlist,fontcolor,code,|,link,video,removeFormat"
        };

        editor.wysibb(lg);
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
     *   toogle tags-collection container view
     */
    $("#toogle-tags-collection").click(function(event){
        event.preventDefault();

        //update element value
        if($(this).children().attr('class') == 'fa fa-chevron-down'){
            $(this).children().attr('class', 'fa fa-chevron-up');
        }
        else if($(this).children().attr('class') == 'fa fa-chevron-up'){
            $(this).children().attr('class', 'fa fa-chevron-down');
        }

        $("#tags-collection").toggle(250);
    });

    /**
     *   add selected tag to tags input
     */
    $("#tags-collection ul li").click(function() {
        $('#news_tags').tagsinput('add', $(this).text());
        $(this).fadeOut(300, function(){ $(this).remove(); }); //remove used tag from DOM
    });

    /**
     *   news contents
     */
    //set news header (title and logo) height equal (biggest dimension on page)
    var maxHeightHeader = 0;
    var newsHeader = $(".news-all-header-title");
    var newsContent = $(".news-all-content");

    if(newsContent.length > 0) {
        newsHeader.each(function () {
            if ($(this).height() > maxHeightHeader) {
                maxHeightHeader = $(this).height();
            }
        });
        newsHeader.height(maxHeightHeader);

        //set whole news div height equal (biggest div height dimension on page)
        var maxHeightContent = 0;
        newsContent.each(function () {
            if ($(this).height() > maxHeightContent) {
                maxHeightContent = $(this).height();
            }
        });
    }
});

jQuery(window).load(function() {
    /**
     *   BBCode editor returning blank text on refresh, FF bug
     */
    var editor = $("#codeEditor");
    if(editor.length > 0) {
        var editorLength = editor.val().length;
        if (editorLength < 1) {
            editor.sync();
        }
    }

    /**
     *  Bootstrap Select show selected values
     */
    $('select[name=selValue]').val(1);
    $('.selectpicker').selectpicker('refresh')
});

/**
* datatables initialization
 */
$(document).ready(function(){
    $('#data-table').DataTable({
        "responsive": true,
        "paging": true,
        "bInfo": false,
        "language": {
            "lengthMenu": 'Prikaži _MENU_ zapisa po stranici',
            "zeroRecords": 'Niti jedan zapis nije pronađen',
            "info": 'Prikazujem stranicu _PAGE_ od _PAGES_',
            "infoEmpty": 'Trenutno nema zapisa',
            "infoFiltered": '(filtrirano od ukupno _MAX_ zapisa)',
            "thousands": '.',
            "loadingRecords": 'Učitavanje tablice...',
            "processing": 'Obrada podataka...',
            "search": 'Pretraga:',
            "paginate": {
                "first": 'Prva',
                "last": 'Zadnja',
                "next": 'Sljedeća',
                "previous": 'Prethodna'
            },
            "aria": {
                "sortAscending": ' aktivirajte za sortiranje stupca uzlazno',
                "sortDescending": ' aktivirajte za sortiranje stupca silazno'
            }
        }
    });
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

/**
 *   catch laravel form/route notifications
 */
function catchLaravelNotification(errorHtmlSourceID, notificationType) {
    var outputMsg = $('#outputMsg');
    var errorMsg = $('#'+errorHtmlSourceID).html();
    outputMsg.append(errorMsg).addClass(notificationType).slideDown();

    //timer
    var numSeconds = 5;
    function countDown(){
        numSeconds--;
        if(numSeconds == 0){
            clearInterval(timer);
        }
        $('#notificationTimer').html(numSeconds);
    }
    var timer = setInterval(countDown, 1000);

    function restoreNotification(){
        outputMsg.fadeOut(1000, function(){
            setTimeout(function () {
                outputMsg.empty().attr('class', 'notificationOutput');
            }, 2000);
        });
    }

    //hide notification if user clicked
    $('#notifTool').click(function(){
        restoreNotification();
    });

    setTimeout(function () {
        restoreNotification();
    }, numSeconds * 1000);
}

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
