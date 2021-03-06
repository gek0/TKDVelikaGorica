/**
 * google map
 */
google.maps.event.addDomListener(window, "load", function () {
    function createMap(id){
        var selector_map = $('#'+id);
        var img_pin = selector_map.attr('data-pin');
        var data_map_x = selector_map.attr('data-map-x');
        var data_map_y = selector_map.attr('data-map-y');
        var data_map_2_x = selector_map.attr('data-map-2-x');
        var data_map_2_y = selector_map.attr('data-map-2-y');
        var scrollwhell = selector_map.attr('data-scrollwhell');
        var draggable = selector_map.attr('data-draggable');
        var map_zoom = selector_map.attr('data-zoom');
        var tooltip_text = selector_map.attr('data-tooltip-text');
        var tooltip_text_2 = selector_map.attr('data-tooltip-2-text');

        var style=[{featureType:"all",elementType:"labels.text.fill",stylers:[{saturation:36},{color:"#000000"},{lightness:40}]},{featureType:"all",elementType:"labels.text.stroke",stylers:[{visibility:"on"},{color:"#000000"},{lightness:16}]},{featureType:"all",elementType:"labels.icon",stylers:[{visibility:"off"}]},{featureType:"administrative",elementType:"geometry.fill",stylers:[{lightness:20}]},{featureType:"administrative",elementType:"geometry.stroke",stylers:[{color:"#000000"},{lightness:17},{weight:1.2}]},{featureType:"administrative.province",elementType:"labels.text.fill",stylers:[{color:"#e3b141"}]},{featureType:"administrative.locality",elementType:"labels.text.fill",stylers:[{color:"#e0a64b"}]},{featureType:"administrative.locality",elementType:"labels.text.stroke",stylers:[{color:"#0e0d0a"}]},{featureType:"administrative.neighborhood",elementType:"labels.text.fill",stylers:[{color:"#d1b995"}]},{featureType:"landscape",elementType:"geometry",stylers:[{color:"#000000"},{lightness:20}]},{featureType:"poi",elementType:"geometry",stylers:[{color:"#000000"},{lightness:21}]},{featureType:"road",elementType:"labels.text.stroke",stylers:[{color:"#12120f"}]},{featureType:"road.highway",elementType:"geometry.fill",stylers:[{lightness:"-77"},{gamma:"4.48"},{saturation:"24"},{weight:"0.65"}]},{featureType:"road.highway",elementType:"geometry.stroke",stylers:[{lightness:29},{weight:.2}]},{featureType:"road.highway.controlled_access",elementType:"geometry.fill",stylers:[{color:"#f6b044"}]},{featureType:"road.arterial",elementType:"geometry",stylers:[{color:"#4f4e49"},{weight:"0.36"}]},{featureType:"road.arterial",elementType:"labels.text.fill",stylers:[{color:"#c4ac87"}]},{featureType:"road.arterial",elementType:"labels.text.stroke",stylers:[{color:"#262307"}]},{featureType:"road.local",elementType:"geometry",stylers:[{color:"#a4875a"},{lightness:16},{weight:"0.16"}]},{featureType:"road.local",elementType:"labels.text.fill",stylers:[{color:"#deb483"}]},{featureType:"transit",elementType:"geometry",stylers:[{color:"#000000"},{lightness:19}]},{featureType:"water",elementType:"geometry",stylers:[{color:"#0f252e"},{lightness:17}]},{featureType:"water",elementType:"geometry.fill",stylers:[{color:"#080808"},{gamma:"3.14"},{weight:"1.07"}]}];

        var locations = [
            [tooltip_text, data_map_x, data_map_y, 2],
            [tooltip_text_2, data_map_2_x, data_map_2_y, 2]
        ];

        if (selector_map !== undefined) {
            var map = new google.maps.Map(document.getElementById(id), {
                zoom: parseInt(map_zoom),
                scrollwheel: false,
                zoomControl: true,
                disableDoubleClickZoom: true,
                navigationControl: true,
                mapTypeControl: true,
                scaleControl: false,
                draggable: draggable,
                styles: style,
                center: new google.maps.LatLng(data_map_x, data_map_y),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });
        }

        var infowindow = new google.maps.InfoWindow();
        var marker, i;

        for (i = 0; i < locations.length; i++) {
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: map,
                animation: google.maps.Animation.DROP,
                icon: img_pin
            });

            google.maps.event.addListener(marker, 'click', (function (marker, i) {
                return function () {
                    infowindow.setContent(locations[i][0]);
                    infowindow.open(map, marker);
                }
            })(marker, i));
        }
    }

    if ($(window).width() <= 768) {
        createMap("map-container-mobile");
        $("#google_map").empty();
    }
    else {
        createMap("google_map");
        $("#map-container-mobile").empty();
    }

    $(window).on('resize', function() {
        if ($(window).width() <= 768) {
            createMap("map-container-mobile");
            $("#google_map").empty();
        }
        else {
            createMap("google_map");
            $("#map-container-mobile").empty();
        }
    });
});