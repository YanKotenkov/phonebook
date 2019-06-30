jQuery(document).ready(function($) {
    'use strict';
    let $contactList = $('.contact-list');

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
    });
});
