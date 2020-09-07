jQuery(document).ready(function($) {
    // FIXED HEADER SCROLL
    $(window).scroll(function() {
        if ($(window).scrollTop() >= 10) {
            $('header').addClass('fixed-header');
        } else {
            $('header').removeClass('fixed-header');
        }
    });
    $('.show_password').click(function() {

        $(this).toggleClass('show');

        if ($(this).hasClass('show')) {
            $(this).parent().find('.show_password_field').attr('type', 'text');
        } else {
            $(this).parent().find('.show_password_field').attr('type', 'password');
        }

    });
    $('.upload-file').change(function() {
        var filepath = this.value;
        var m = filepath.match(/([^\/\\]+)$/);
        var filename = m[1];
        $('.upload-label').html(filename);

    });

    var dropdown = $('.multiple').dropdown({
        searchable: false,
        choice: multipleDropdownChange
    });

    function multipleDropdownChange(e) {
        switch (e.target.dataset.value) {
            case 'government':
                $('#address_government_hospital').toggle();
                break;
            case 'private':
                $('#address_private_hospital').toggle();
                break;
            case 'other':
                $('.other_qualification').toggle();
                break;
            default:
                break;
        }
    }

    $('body').on('click', 'span.user-arrow', function(e) {
        $('ul.profile').toggleClass('active-profile');
    });

    $('input:radio[name=active]').change(function() {
        if (this.value == '1') {
            $(".student").show();
            $(".none-student").hide();

        } else if (this.value == '0') {
            $(".none-student").show();
            $(".student").hide();
        }
        resetForm();
    });

    $("#nav-icon").click(function() {
        $(".mobile-menu").toggleClass("active");
    });
    $(".close-icon").click(function() {
        $(".mobile-menu").removeClass("active");
    });



    $('select[name=province]').on('change', function(e) {
        $('select[name=district]').find('option').remove().end().append('<option value="" disabled selected>Select</option>');
        $.each(JSON.parse($('option:selected', this).attr('cities')), function(key, city) {
            $('select[name=district]').append('<option value="' + city.id + '">' + city.title + '</option>')
        })
    });

    $(".user_register_form").on('submit', function(e) {
        e.preventDefault();
        $('input[type=submit]').attr('disabled', true);
        let formID = $(this).attr('id');
        let formData = new FormData(this);
        formData.append('active', $("input[name=active]:checked").val());
        formData.append('basic_qualification', $('[name="basic_qualification"]', this).val());
        if (formID == 'student_form') {
            formData.append('workplace_type', $('[name="workplace_type"]', this).val());
        }
        $.ajax({
            url: e.target.action,
            type: e.target.method,
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                const response = JSON.parse(data);

                if (response.errors) {
                    appendError(response.errors, formID);
                }

                if (response.success) {
                    window.location = "/thankyou";
                    // resetForm();
                    // $('#'+formID + ' .submit-btn').prepend("<span class='sub-text' style='font-size: 16px'>You have successfully registered! Please check your email.</span>");
                }
                $('input[type=submit]').attr('disabled', false);
            },
            error: function(e) {
                console.log(e);
            }
        });
    });

    function appendError(data, formID) {
        $('#' + formID + ' .error').remove();
        if (typeof data === 'object' && data !== null) {
            let flag = true;
            $.each(data, function(key, item) {
                if (flag) {
                    var errorInput = $('#' + formID + " [name='" + key + "']");
                    $('html,body').animate({ scrollTop: errorInput.closest('.width100').offset().top - 100 }, 500, function() {
                        errorInput.focus();
                    });
                    flag = false;
                }
                if (typeof item === 'object' && item !== null) {
                    $.each(item, function(k, i) {
                        $('#' + formID + " [name='" + key + "']").parent().append("<p style='color:red' class='error'>" + i + "</p>");
                    });
                } else {
                    $('#' + formID + " [name='" + key + "']").parent().append("<p style='color:red' class='error'>" + item[0] + "</p>");
                }
            });
        } else {
            $('#' + formID).append("<p style='color:red' class='error'>" + data + "</p>");
        }
    }

    function resetForm() {
        $('.user_register_form').trigger("reset");
        $('.error').remove();
        $('.other_qualification').hide();
        // $("select").each(function() { this.selectedIndex = 0 });
        // dropdown.reset();
        $('.dropdown-option').removeClass('dropdown-chose');
        $('.dropdown-selected').remove();
        $.each($('.multiple').data().dropdown.config.data, function(index, element) {
            element.selected = false;
        });
    }


    // Validation
    $('.numeric').on('input', function(event) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    $('.alphaonly').on('input', function() {
        this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
    });
    $('.cnic').on('input', function() {
        this.value = this.value.replace(/[^\d+(-\d+)*]/g, '');
    });
    $('.pmdc_no').on('input', function() {
        // this.value = this.value.replace(/[^\d+-[A-Z]+]/g, '');
    });


    $(document).on('click', 'a[href^=\\#]', function(e) {
        e.preventDefault(); // prevent hard jump, the default behavior

        var target = $(this).attr("href"); // Set the target as variable

        // perform animated scrolling by getting top-position of target-element and set it as scroll target
        $('html, body').stop().animate({
            scrollTop: $(target).offset().top
        }, 600, function() {
            location.hash = target; //attach the hash (#jumptarget) to the pageurl
        });

        return false;
    });


    $(window).scroll(function() {
        var scrollDistance = $(window).scrollTop();
        $('section').each(function(i) {
            if ($(this).position().top <= scrollDistance) {
                $('nav a.active').removeClass('active');
                $('nav a').eq(i).addClass('active');
            }
        });
    }).scroll();

});