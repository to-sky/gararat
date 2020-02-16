import * as $ from 'jquery';
import 'summernote';
import 'summernote/dist/summernote-bs4.min.css';

export default (function () {
    $('.summernote').summernote({
        height: 300,
        toolbar: [
            // [groupName, [list of button]]
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript', 'fontsize', 'color', 'forecolor', 'backcolor']],
            ['para', ['style', 'ul', 'ol', 'paragraph', 'height']],
            ['insert', ['link', 'table', 'picture', 'video', 'hr']],
            ['misc', ['fullscreen', 'undo', 'redo', 'help']]
        ]
    });
}())