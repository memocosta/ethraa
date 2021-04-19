(function($) {

    'use strict';

    $('#start-work').datepicker({
        defaultDate: '',
        startDate: '',
        autoclose: true,
        orientation: (($('html[dir="rtl"]').get(0)) ? 'bottom right' : 'bottom'),
        container: '.start-work',
        rtl: (($('html[dir="rtl"]').get(0)) ? true : false)
    });

    $('#end-work').datepicker({
        defaultDate: '',
        startDate: '',
        autoclose: true,
        orientation: (($('html[dir="rtl"]').get(0)) ? 'bottom right' : 'bottom'),
        container: '.end-work',
        rtl: (($('html[dir="rtl"]').get(0)) ? true : false)
    });

    CKEDITOR.replace('map');
    CKEDITOR.replace('about_short');
    CKEDITOR.replace('about');
    CKEDITOR.replace('judicial_accountability');
    CKEDITOR.replace('consulting');
    CKEDITOR.replace('economic_studies');
    CKEDITOR.replace('body');

}).apply(this, [jQuery]);