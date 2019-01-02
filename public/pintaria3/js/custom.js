$(document).ready(function () {

//    $('.contact_menu .content').click(function () {
//        swal({
//            title: "Hubungi Kami",
//            text: "Telp : 021 2955 7313 \nWhatsapp : 0813 8276 5493 \nEmail : info@pintaria.com \nLine : @pintariaid \nJam operasional : 09.00 - 18.00 WIB",
//            button: {
//                text: "Tutup",
//                className: "contact_menu_btn",
//            }
//        });
//    });

    $('#hamburger').on('click', function () {
        $is_active = $('.header').hasClass('sticky_menu_active');
        if ($is_active) {
            $('#wh-widget-send-button').hide();
            $('.zopim').hide();
        } else {
            $('#wh-widget-send-button').show();
            $('.zopim').show();
        }
    });
    
    $('.suggestion').val(getUrlParameter('keyword'));

    $(document).on('click', '.search-btn', function () {
        if (!$('.suggestion').val()) {
            return false;
        }
    });

    $('.email-newsletter').keypress(function (e) {
        var key = e.which;
        if (key == 13)  // the enter key code
        {
            $('.daftar-newsletter').click();
            return false;
        }
    });

    $(document).on('click', '.daftar-newsletter', function () {
        $('.error').text('');
        $email = $('.email-newsletter').val();
        if ($email == '') {
            $('.error-email-newsletter').text('Mohon isikan email Anda');
            setTimeout(function () { $('.error-email-newsletter').text('') }, 5000);
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
                    showSuccessMessage('Anda telah terdaftar berlangganan pada Newsletter kami.');
                },
                error: function (reject) {
                    var response = reject.responseJSON;
                    if (reject.status == 422) {
                        $('.error.error-email-newsletter').text(response.email[0]);
                    } else {
                        showErrorMessage(response.message);
                    }
                }
            });
        }
    });

    $(document).on('submit', '.form-saya-berminat', function (e) {
        e.preventDefault();
        $('.form-saya-berminat .btn-saya-berminat').attr('disabled', true);
        $('.form-saya-berminat .error').children().html('');

        addProductCategoryToInput();
        
        $.ajax({
            url: sayaBerminatURL,
            type: "POST",
            async: true,
            data: $(this).serialize(),
            success: function (response) {
                if (response.status == 200) {
                    scrollToTop();
                    window.location = mohonInfoURL;
                } else if (response.status == 422) {
                    $('.form-saya-berminat .error-g-recaptcha-response').children().html(response.message);
                    grecaptcha.reset();
                }
                $('.form-saya-berminat .btn-saya-berminat').attr('disabled', false);
            },
            error: function (response) {
                if (response.status == 422) {
                    var first_key = '';
                    $.each(response.responseJSON, function (key, val) {
                        if (first_key == '') {
                            first_key = key;
                        }
                        $('.form-saya-berminat .error-' + key).children().html(val[0]);
                    });

                    // Scroll to specific element
                    scrollToElement('.form-saya-berminat .error-' + first_key);
                }
                $('.form-saya-berminat .btn-saya-berminat').attr('disabled', false);
                grecaptcha.reset();
            }
        });
    });

    // show hide user dropdown
    $('body').click(function () {
        $('.user-dropdown').hide();
    })
    $('.user-pic').click(function (event) {
        event.stopPropagation();
        $('.user-dropdown').toggle();
    });

    $(document).on('change', 'select.input_field', function(e) {
        var self = $(this);
        if(self.val().trim() !== '') {
            self.parent().addClass('input--filled');
        } else {
            self.parent().removeClass('input--filled');
        }
    });

    // Input field effect
    (function () {
        if (!String.prototype.trim) {
            (function () {
                // Make sure we trim BOM and NBSP
                var rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
                String.prototype.trim = function () {
                    return this.replace(rtrim, '');
                };
            })();
        }
        [].slice.call(document.querySelectorAll('input.input_field, textarea.input_field, select.input_field')).forEach(function (inputEl) {
            // in case the input is already filled..
            if (inputEl.value.trim() !== '') {
                classie.add(inputEl.parentNode, 'input--filled');
            }

            // events:
            inputEl.addEventListener('focus', onInputFocus);
            inputEl.addEventListener('blur', onInputBlur);
        });
        function onInputFocus(ev) {
            classie.add(ev.target.parentNode, 'input--filled');
        }
        function onInputBlur(ev) {
            if (ev.target.value.trim() === '') {
                classie.remove(ev.target.parentNode, 'input--filled');
            }
        }
    })();

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

function scrollToTop() {
    document.body.scrollTop = 0; // For Chrome, Opera and Safari
    document.documentElement.scrollTop = 0; // For IE and Firefox
}

// Validate password strength
var validatePassword = function (password, bar, status) {
    if (password && password.length > 0) {
        var txtPass = password.val();
        var strengthPercentage = 100;
        var errMsg = [];

        if (!(/[A-Z]/.test(txtPass))) {
            // memiliki huruf besar,
            strengthPercentage -= 25;
            errMsg.push('Lemah \n');
            bar.css('background-color', 'orange');
        }
        if (!(/[a-z]/.test(txtPass))) {
            // memiliki huruf kecil
            strengthPercentage -= 25;
            errMsg.push('Lemah \n');
            bar.css('background-color', 'orange');
        }
        if (!(/[0-9]/.test(txtPass)) && !(/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/.test(txtPass))) {
            // angka atau nonalfanumerik (contoh: !,@,&)"
            strengthPercentage -= 25;
            errMsg.push('Lemah \n');
            bar.css('background-color', 'orange');
        }
        if (txtPass.length < 8) {
            // minimal 8 karakter,
            strengthPercentage -= 25;
            errMsg.push('minimal 8 karakter \n');
            bar.css('background-color', 'red');
        }

        errMsg = errMsg.filter(function (value, index, array) {
            return array.indexOf(value) == index;
        });

        password.data('validation', errMsg);
        bar.width(parseInt(strengthPercentage) + '%');

        if (strengthPercentage === 100) {
            bar.css('background-color', 'green');
            status.html("Kuat");
            return true;
        } else {
            if (txtPass.length < 8) {
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
    switch (type) {
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

function showErrorMessage(message) {
    swal(message, {
        button: false,
        icon: 'warning',
        timer: 3000
    });
}

function showSuccessMessage(message) {
    swal(message, {
        button: false,
        icon: 'success',
        timer: 3000
    });
}

function scrollToElement(element) {
    $('html, body').animate({
        scrollTop: ($(element).offset().top) - 150
    }, 1500);
}

function scrollToElementWithDistance(element, distance) {
    $('html, body').animate({
        scrollTop: ($(element).offset().top) + distance
    }, 1500);
}

/*
* Important notes, when calling this function please make sure
* to save the instance return from this function to stop the spin
*/
function showLoading(target, top, radius, lines) {
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
setTimeout(function () {
    $('.alert').remove();
}, 5000);

function removeAlertDanger() {
    setTimeout(function () {
        $('.alert.alert-danger').remove();
    }, 5000);
}

function removeSpinAndDisabled(spin, container) {
    spin.stop();
    $(container).attr('disabled', false);
    removeAlertDanger();
}

Number.prototype.formatMoney = function (c, d, t) {
    var n = this,
        c = isNaN(c = Math.abs(c)) ? 2 : c,
        d = d == undefined ? "." : d,
        t = t == undefined ? "," : t,
        s = n < 0 ? "-" : "",
        i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
        j = (j = i.length) > 3 ? j % 3 : 0;
    return 'Rp ' + s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
};

function tracker(object_name, object_id) {
    $.ajax({
        url: trackerURL,
        type: 'POST',
        async: true,
        data: {
            'object_name': object_name,
            'object_id': object_id
        }
    });
}

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})
