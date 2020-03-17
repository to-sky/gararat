import * as $ from 'jquery';
import 'blueimp-gallery'
import 'blueimp-gallery/css/blueimp-gallery.min.css';
import 'blueimp-gallery/js/jquery.blueimp-gallery.min'

export default (function () {
    document.getElementById('blueimp').onclick = function (event) {
        event = event || window.event;
        var target = event.target || event.srcElement,
            link = target.src ? target.parentNode : target,
            options = {index: link, event: event},
            links = this.getElementsByTagName('a');
        blueimp.Gallery(links, options);
    };
}())