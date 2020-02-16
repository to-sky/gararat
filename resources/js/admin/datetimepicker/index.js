import * as $ from 'jquery';
import 'jquery-datetimepicker/build/jquery.datetimepicker.full.min.js';
import 'jquery-datetimepicker/build/jquery.datetimepicker.min.css';

export default (function () {

    // $.datetimepicker.setLocale('fr');

    $('.datetimepicker-element').datetimepicker({
        timepicker:false,
        format:'Y-m-d'
    }).attr('autocomplete', "off");

    $('.datetimepicker-element-time').datetimepicker({
        format:'Y-m-d H:i:s'
    }).attr('autocomplete', "off");
}())