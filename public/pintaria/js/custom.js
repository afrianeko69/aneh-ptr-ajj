$(document).ready(function() {
    
    $('.suggestion').val(getUrlParameter('keyword'));

    $(document).on('click', '.search-btn', function () {
        if (!$('.suggestion').val()){
            return false;
        }
    });

    $('.email-newsletter').keypress(function (e) {
        var key = e.which;
        if(key == 13)  // the enter key code
        {
            $('.daftar-newsletter').click();
            return false;  
        }
    });

    $(document).on('click', '.daftar-newsletter',function(){
        $('.error').text('');
        $email = $('.email-newsletter').val();
        if ($email == ''){
            $('.error-email-newsletter').text('Mohon isikan email Anda');
            setTimeout(function(){ $('.error-email-newsletter').text('') }, 5000);
        } else {
            $.ajax({
                type: 'POST',
                url: newsletterURL,
                data: {
                    "_token": formToken,
                    "email": $email,
                },
                success: function (data) {
                    $('.email-newsletter').val('');
                    showSuccessMessage('.container-notification', 'Anda telah terdaftar berlangganan pada Newsletter kami.',false);
                },
                error: function (reject) {
                    var response = reject.responseJSON;
                    if(reject.status == 422) {
                        $('.error.error-email-newsletter').text(response.email[0]);
                    } else {
                        showErrorMessage('.container-notification', response.message,false);
                    }
                }
            });
        }
    });
    
    $(document).on('submit', '.form-saya-berminat', function(e) {
        e.preventDefault();
        $('.form-saya-berminat .btn-saya-berminat').attr('disabled', true);
        $('.form-saya-berminat .error').children().html('');
        var spin = caseShowLoadingSpin('.form-saya-berminat', "65");

        $.ajax({
            url: sayaBerminatURL,
            type: "POST",
            async: true,
            data: $(this).serialize(),
            success:function(response){
                if(response.status == 200) {
                    scrollToTop();
                    window.location = mohonInfoURL;
                } else if(response.status == 422) {
                    $('.form-saya-berminat .error-g-recaptcha-response').children().html(response.message);
                }
                spin.stop();
                $('.form-saya-berminat .btn-saya-berminat').attr('disabled', false);
            },
            error:function(response){
                if(response.status == 422) {
                    var first_key = '';
                    $.each(response.responseJSON, function (key, val){
                        if(first_key == '') {
                            first_key = key;
                        }
                        $('.form-saya-berminat .error-' + key).children().html(val[0]);
                    });

                    // Scroll to specific element
                    scrollToElement('.form-saya-berminat .error-'+first_key);
                }
                spin.stop();
                $('.form-saya-berminat .btn-saya-berminat').attr('disabled', false);
            }
        });
    });

    $('.bundle.owl-carousel').owlCarousel({
        items: 4,
        loop:false,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1
            },
            650: {
                items: 2
            },
            850: {
                items: 3
            },
            1024: {
                items: 4
            }
        }
    });

    // show hide user dropdown
    $('body').click(function(){
        $('.user-dropdown').hide();
    })
    $('.user-pic').click(function(event){
        event.stopPropagation();
        $('.user-dropdown').toggle();
    });
});

var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === 'undefined' ? true : sParameterName[1].replace(/[&\/\\#,+()$~%.'":*?<>{}]/g, " ");
        }
    }
};

function scrollToTop(){
    document.body.scrollTop = 0; // For Chrome, Opera and Safari
    document.documentElement.scrollTop = 0; // For IE and Firefox
}

// Validate password strength
var validatePassword = function(password, bar, status) {
    if(password && password.length > 0) {
        var txtPass = password.val();
        var strengthPercentage = 100;
        var errMsg = [];

        if ( !(/[A-Z]/.test(txtPass)) ) {
            // memiliki huruf besar,
            strengthPercentage-=25;
            errMsg.push('Lemah \n');
            bar.css('background-color', 'orange');
        }
        if ( !(/[a-z]/.test(txtPass)) ) {
            // memiliki huruf kecil
            strengthPercentage-=25;
            errMsg.push('Lemah \n');
            bar.css('background-color', 'orange');
        }
        if ( !(/[0-9]/.test(txtPass)) && !(/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/.test(txtPass)) ) {
            // angka atau nonalfanumerik (contoh: !,@,&)"
            strengthPercentage-=25;
            errMsg.push('Lemah \n');
            bar.css('background-color', 'orange');
        }
        if (txtPass.length < 8 ) {
            // minimal 8 karakter,
            strengthPercentage-=25;
            errMsg.push('minimal 8 karakter \n');
            bar.css('background-color', 'red');
        }

        errMsg = errMsg.filter (function (value, index, array) {
            return array.indexOf (value) == index;
        });

        password.data('validation', errMsg);
        bar.width( parseInt(strengthPercentage) + '%');

        if (strengthPercentage === 100) {
            bar.css('background-color', 'green');
            status.html("Kuat");
            return true;
        } else {
            if (txtPass.length < 8 ) {
                status.html("Terlalu Pendek");
            } else {
                status.html("Lemah");
            }
        }
    }

    password.focus();
    return false;
};

function caseShowLoadingSpin(container, type) {
    switch(type) {
        case "50":
        case "60":
            return showLoading(container, type + '%', 15, 8);
            break;
        case "65":
        case "70":
            return showLoading(container, type + '%', 20, 13);
            break;
        default:
            return showLoading(container, "50%", 20, 13);
    }
}

function showErrorMessage(container, message, animation) {
    $(container).html('<div class="alert alert-danger">'+
                        '<button class="close" type="button" data-dismiss="alert" aria-label="close">'+
                            '<span aria-hidden="true">&times;</span>'+
                        '</button>'+
                        '<span class="message-flash-danger">'+message+'</span>'+
                    '</div>');
    $(container).removeClass('hide');
    if (animation){
        scrollToElement('.alert.alert-danger');
    } else {
        moveToElement('.alert.alert-danger');
    }
    
}

function showSuccessMessage(container, message, animation) {
    $(container).html('<div class="alert alert-info">'+
                        '<button class="close" type="button" data-dismiss="alert" aria-label="close">'+
                            '<span aria-hidden="true">&times;</span>'+
                        '</button>'+
                        '<span class="message-flash">'+message+'</span>'+
                    '</div>');
    $(container).removeClass('hide');
    if (animation){
        scrollToElement('.alert.alert-info');
    } else {
        moveToElement('.alert.alert-info');
    }
}

function scrollToElement(element) {
    $('html, body').animate({
        scrollTop: ($(element).offset().top) - 150
    }, 1500);
}

function moveToElement(element) {
    $('html, body').animate({
        scrollTop: ($(element).offset().top) - 150
    }, 0);
}

/*
* Important notes, when calling this function please make sure
* to save the instance return from this function to stop the spin
*/
function showLoading(target, top, radius, lines){
    var opts = {
          lines: lines // The number of lines to draw
        , length: 28 // The length of each line
        , width: 14 // The line thickness
        , radius: radius // The radius of the inner circle
        , scale: 1 // Scales overall size of the spinner
        , corners: 1 // Corner roundness (0..1)
        , color: '#000' // #rgb or #rrggbb or array of colors
        , opacity: 0.25 // Opacity of the lines
        , rotate: 0 // The rotation offset
        , direction: 1 // 1: clockwise, -1: counterclockwise
        , speed: 1 // Rounds per second
        , trail: 60 // Afterglow percentage
        , fps: 20 // Frames per second when using setTimeout() as a fallback for CSS
        , zIndex: 2e9 // The z-index (defaults to 2000000000)
        , className: 'spinner' // The CSS class to assign to the spinner
        , top: top // Top position relative to parent
        , left: '50%' // Left position relative to parent
        , shadow: false // Whether to render a shadow
        , hwaccel: false // Whether to use hardware acceleration
        , position: 'absolute' // Element positioning
    };
    var spin = new Spinner(opts).spin();
    $(target).append(spin.el);
    return spin;
}
setTimeout(function() {
    $('.alert').remove();
}, 5000);

function removeAlertDanger() {
    setTimeout(function() {
        $('.alert.alert-danger').remove();
    }, 5000);
}

function removeSpinAndDisabled(spin, container) {
    spin.stop();
    $(container).attr('disabled', false);
    removeAlertDanger();
}

Number.prototype.formatMoney = function(c, d, t){
var n = this,
    c = isNaN(c = Math.abs(c)) ? 2 : c,
    d = d == undefined ? "." : d,
    t = t == undefined ? "," : t,
    s = n < 0 ? "-" : "",
    i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
    j = (j = i.length) > 3 ? j % 3 : 0;
   return 'Rp ' + s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
 };