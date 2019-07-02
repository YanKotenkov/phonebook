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
        let $this = $(this),
            $form = $contactForm.find('form');

        $this.hide();
        $showContactInfo.removeClass('table-active');
        $contactInfo.html('');
        $contactForm.show();
        if ($form.find('input#id').length) {
            $form.find('input#id').remove();
        }
        $('#contact-edit-caption').text('Добавить контакт');
        $('.js-save-contact').attr('data-url', '/add-contact');
    }).on('click', '.js-show-edit-contact-form', function () {
        let $this = $(this),
            id = $this.data('id');

        $contactInfo.html('');

        $.get({
            url: '/get-contact-form',
            data: {
                id: id
            },
            success: response => {
                $contactForm.show();
                $contactForm.html(response);
                let $form = $contactForm.find('form');
                if ($form.find('input#id').length) {
                    $form.find('input#id').val(id);
                } else {
                    $form.append('<input id="id" name="id" value="' + id +'" type="hidden">');
                }
                $('#contact-edit-caption').text('Редактировать контакт');
                $('.js-save-contact').attr('data-url', '/edit-contact');
            }
        });
    }).on('click', '.js-save-contact', function (event) {
        event.preventDefault();

        let $this = $(this),
            $form = $('form#contact-form'),
            formData = new FormData($form[0]),
            $photo = $('#photo'),
            id = formData.get('id');

        if ($photo.length && $photo[0].files.length) {
            let photo = $photo[0].files[0];
            formData.append('photo', photo);
        }

        $.ajax({
            url: $this.data('url'),
            method: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: (response, status, jqHHR) => {
                $contactInfo.html(response);

                if (id !== null) {
                    $contactForm.find('form')
                }

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

        if (confirm('Вы точно хотите удалить запись?')) {
            $.ajax({
                url: '/delete-contact' + '?id=' + $this.data('id'),
                method: 'post',
                success: response => {
                    $contactInfo.html('');
                    $contactForm.hide();
                    $.get({
                        url: '/',
                        success: response => {
                            $contactList.html(response);
                        }
                    });
                }
            });
        }
    });
});
