jQuery(document).ready(function($) {
    'use strict';
    let $contactList = $('.contact-list'),
        $showContactInfo = $('.show-contact-info'),
        $contactInfo = $('.contact-info'),
        $contactForm = $('.contact-form');

    $('body').on('click', '.js-sort-link', function (event) {
        event.preventDefault();
        let $this = $(this);

        $.get({
            url: $this.attr('href'),
            data: {
                sortParam: $this.data('sort-param'),
                sortOrder: $this.data('sort-order')
            },
            success: response => {
                $contactList.html(response);
            }
        });
    }).on('click', '.show-contact-info', function () {
        let $this = $(this);

        $('.show-contact-info').removeClass('table-active');
        $this.addClass('table-active');
        $contactForm.hide();
        $('.js-show-add-contact-form').show();

        $.get({
            url: 'contact-info',
            data: {
                id: $this.data('id')
            },
            success: response => {
                $contactInfo.html(response);
            }
        });
    }).on('click', '.js-show-add-contact-form', function () {
        let $this = $(this);

        $this.hide();
        $showContactInfo.removeClass('table-active');
        $contactInfo.html('');
        $contactForm.show();
    }).on('click', '.js-add-contact', function (event) {
        event.preventDefault();
        event.stopPropagation();

        let $form = $('form#contact-form'),
            formData = new FormData($form[0]),
            $photo = $('#photo');

        if ($photo.length && $photo[0].files.length) {
            let photo = $photo[0].files[0];
            formData.append('photo', photo);
        }

        $.ajax({
            url: $form.attr('action'),
            method: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: (response, status, jqHHR) => {
                $contactInfo.html(response);
                $contactForm.hide();
                $contactForm.find('form').trigger('reset');
                $.get({
                    url: '/',
                    success: response => {
                        $contactList.html(response);
                    }
                });
            },
            error: (jqHHR) => {
                if (jqHHR.status === 422) {
                    $contactForm.html(jqHHR.responseText);
                }
            }
        });
    }).on('click', '.js-delete-contact', function (event) {
        event.stopImmediatePropagation();
        let $this = $(this);

        $.ajax({
            url: '/delete-contact' + '?id=' + $this.data('id'),
            method: 'post',
            success: response => {

            }
        });
    });
});
