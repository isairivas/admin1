/*
 * MoonCake v1.3 - UI Components Demo JS
 *
 * This file is part of MoonCake, an Admin template build for sale at ThemeForest.
 * For questions, suggestions or support request, please mail me at maimairel@yahoo.com
 *
 * Development Started:
 * July 28, 2012
 * Last Update:
 * November 14, 2012
 *
 */

;
(function( $, window, document, undefined ) {
			
    var demos = {
        basicDatepicker: function(target) {
            target.datepicker();
        }	
    };
    $(document).ready(function() {
        if( $.fn.datepicker ) {
            demos.basicDatepicker( $( '.datepicker-basic' ) );
        }
        if( $.fn.Zebra_DatePicker ) {

            $('#filtro-mes').Zebra_DatePicker({
				format: 'm Y'
			});
        }
    });
	
}) (jQuery, window, document);