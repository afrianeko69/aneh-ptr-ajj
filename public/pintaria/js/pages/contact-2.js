// CONTACT MAP

var PageContact2 = function() {

	var _init = function() {

		var mapbg = GMaps.createPanorama({
			el: '#gmapbg',
			lat: -6.229763,
			lng: 106.805703,
			scrollwheel: false
		});
	}

    return {
        //main function to initiate the module
        init: function() {

            _init();

        }

    };
}();

$(document).ready(function() {
    PageContact2.init();
    $( window ).resize(function() {
		PageContact2.init();
	});
});