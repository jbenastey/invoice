/*
 Template Name: Veltrix - Responsive Bootstrap 4 Admin Dashboard
 Author: Themesbrand
 File: Form Advanced Components Init
 */



!function($) {
    "use strict";

    var AdvancedForm = function() {};

    AdvancedForm.prototype.init = function() {
        //creating various controls

        // Select2
        $(".select2").select2();

        $(".select2-limiting").select2({
            maximumSelectionLength: 2
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
