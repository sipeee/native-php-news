(function ($) {
    'use strict';

    $(function () {
        $('.delete-confirmation').on('click', function () {
            return confirm('Are you sure you want to delete?');
        });
    });
})(jQuery);
