import * as $ from 'jquery';
import 'select2';
import 'select2/dist/css/select2.min.css';
import 'select2-theme-bootstrap4/dist/select2-bootstrap.min.css';

export default (function () {
    $.fn.select2.defaults.set( "theme", "bootstrap" );
    $.fn.select2.defaults.set( "with", "100%" );

    $('.select2-element').select2();

    $('.select2-element-tag').select2({
        tags: true
    });
}())