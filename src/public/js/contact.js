jQuery(document).ready(function($) {
    'use strict';
    let $contactList = $('.contact-list'),
        $showContactInfo = $('.show-contact-info'),
        $contactInfo = $('.contact-info');

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

        $showContactInfo.removeClass('table-active');
        $this.addClass('table-active');

        $.get({
            url: 'contact-info',
            data: {
                id: $this.data('id')
            },
            success: response => {
                $contactInfo.html(response);
            }
        });
    })
});
