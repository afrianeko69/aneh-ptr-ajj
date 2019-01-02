// CONTACT MAP

var PageContact = function() {

	var _init = function() {

		var mapbg = new GMaps({
			div: '#gmapbg',
			lat: -6.229763,
			lng: 106.805703,
			scrollwheel: false,
		});


		mapbg.addMarker({
			lat: -6.229763,
			lng: 106.805703,
			title: 'Your Location',
			infoWindow: {
				content: 'Office8, Level 18A Jl. Jenderal Sudirman Kav. 52-53 (access from Jl. Senopati Raya No. 8B) Sudirman Central Business District (SCBD) Jakarta Selatan - 12190'
			}
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
    PageContact.init();
    $( window ).resize(function() {
		PageContact.init();
	});
});