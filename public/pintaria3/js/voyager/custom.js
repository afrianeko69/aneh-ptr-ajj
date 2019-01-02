$(document).ready(function () {
    // Handles form that incorporated array form validation
    $(".form-edit-add-multiple-data").submit(function (e) {
        e.preventDefault();

        var url = $(this).attr('action');
        var form = $(this);
        var data = new FormData(this);

        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: data,
            processData: false,
            contentType: false,
            beforeSend: function () {
                $("body").css("cursor", "progress");
                $(".has-error").removeClass("has-error");
                $(".help-block").remove();
            },
            success: function (d) {
                $("body").css("cursor", "auto");

                $.each(d.errors, function (key, row) {
                    // Handle form array format
                    var regex = /\.[0-9]+$/;
                    var field = key;
                    if (regex.test(key)) {
                        field = key.replace(regex, '[]');
                        $("[name='"+field+"']").each(function (index) {
                            // Find which owns which
                            if (index == key.replace(/^.*\./, '')) {
                                $(this).parent().addClass("has-error");
                                $(this).parent().append("<span class='help-block' style='color:#f96868'>"+row+"</span>");
                            }
                        });
                    } else {
                        // Regular form format
                        $("[name='"+key+"']").parent().addClass("has-error");
                        $("[name='"+key+"']").parent().append("<span class='help-block' style='color:#f96868'>"+row+"</span>");
                    }

                    //Scroll to first error
                    if (Object.keys(d.errors).indexOf(key) === 0) {
                        $('html, body').animate({
                            scrollTop: $("[name='"+field+"']").parent().offset().top
                                    - $('nav.navbar').height() + 'px'
                        }, 'fast');
                    }
                });
            },
            error: function () {
                $(form).unbind("submit").submit();
            }
        });
    });

    $.fn.editorInit = function () {
        tinymce.init({
            menubar: false,
            selector:'textarea.richTextBox',
            skin: 'voyager',
            min_height: 600,
            resize: 'vertical',
            plugins: 'link, image, code, youtube, giphy, table, textcolor, lists',
            extended_valid_elements : 'input[id|name|value|type|class|style|required|placeholder|autocomplete|onclick]',
            file_browser_callback: function(field_name, url, type, win) {
                    if(type =='image'){
                      $('#upload_file').trigger('click');
                    }
                },
            toolbar: 'styleselect bold italic underline  | forecolor backcolor | alignleft aligncenter alignright | bullist numlist outdent indent | link image table youtube | code',
            convert_urls: false,
            image_caption: true,
            image_title: true
        });
    };
});
