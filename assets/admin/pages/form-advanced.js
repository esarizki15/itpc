/*
 Template Name: Zinzer - Responsive Bootstrap 4 Admin Dashboard
 Author: Themesdesign
 Website: www.themesdesign.in
 File: Form Advanced components
 */


!function($) {
    "use strict";
    /*datepicker("setDate", new Date()*/
    var AdvancedForm = function() {};

    AdvancedForm.prototype.init = function() {
        //creating various controls

        //colorpicker start

        // Date Picker
        jQuery('#datepicker').datepicker();
        jQuery('#datepicker-autoclose').datepicker({
            autoclose: true,
			      format: "yyyy-mm-dd",
            todayHighlight: true
        });
        jQuery('#datepicker-inline').datepicker();
        jQuery('#datepicker-multiple-date').datepicker({
            format: "yyy/mm/dd",
            clearBtn: true,
            multidate: true,
            multidateSeparator: ","
        });
        jQuery('#date-range').datepicker({
            toggleActive: true
        });


    },
    //init
    $.AdvancedForm = new AdvancedForm, $.AdvancedForm.Constructor = AdvancedForm
}(window.jQuery),

//initializing
function ($) {
    "use strict";
    $.AdvancedForm.init();
}(window.jQuery);
