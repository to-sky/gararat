let fullConfig = {
    selector: "textarea.tinymce",
    plugins: [
        "advlist autolink image imagetools charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table directionality",
        "emoticons template paste textpattern link"
    ],
    contextmenu: "link media | cell row column deletetable",
    toolbar: "preview code | undo redo | styleselect | bold italic | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | table | link image media",
    height: "550",
    file_picker_callback: function (callback, value, meta) {
        let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
        let y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

        let type = 'image' === meta.filetype ? 'Images' : 'Files',
            url = '/admin/filemanager?editor=tinymce5&type=' + type;

        tinymce.activeEditor.windowManager.openUrl({
            url: url,
            title: 'Filemanager',
            width: x * 0.8,
            height: y * 0.8,
            onMessage: (api, message) => {
                callback(message.content);
            }
        });
    }
};

let lightConfig = {
    selector: "textarea.tinymce-lite",
    plugins: [
        "link"
    ],
    contextmenu: "link media | cell row column deletetable",
    toolbar: "undo redo | styleselect | bold italic | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link",
    height: "300"
};

tinymce.init(fullConfig);
tinymce.init(lightConfig);
