/*
 ***
 Author: Jaeeme
 Author URI: http://codersmag.com
 File Name : common.js
 *** 
 */

tinymce.init({
    selector: '#tiny-editor',
    width: '100%',
    height: 250,
    plugins: [
        "code ",
        "paste",
        'image',
        'link',

    ],

    automatic_uploads: true,
    relative_urls: false,
    remove_script_host: false,
    
    images_upload_handler: function (blobInfo, success, failure) {
        var xhr, formData;

        xhr = new XMLHttpRequest();
        xhr.withCredentials = false;
        xhr.open('POST', imagebaseUrl+'/editUploadImage');

        xhr.onload = function () {
            var json;

            if (xhr.status != 200) {
                failure('HTTP Error: ' + xhr.status);
                return;
            }

            console.log(xhr.response);
            //your validation with the responce goes here

            success(xhr.response);
        };

        formData = new FormData();
        formData.append('file', blobInfo.blob(), blobInfo.filename());

        xhr.send(formData);
    },
    browser_spellcheck: true,
    menu: {
        file: {
            title: 'File',
            items: 'newdocument restoredraft | preview | print'
        },
        edit: {
            title: 'Edit',
            items: 'undo redo | cut copy paste | selectall | searchreplace'
        },
        view: {
            title: 'View',
            items: 'code | visualaid visualchars visualblocks | preview fullscreen'
        },
        format: {
            title: 'Format',
            items: 'bold italic underline strikethrough superscript subscript codeformat | formats blockformats fontformats fontsizes align | forecolor backcolor | removeformat'
        },
        tools: {
            title: 'Tools',
            items: 'code wordcount'
        },
        table: {
            title: 'Table',
            items: 'inserttable | cell row column | tableprops deletetable'
        },
        help: {
            title: 'Help', items: 'help'
        }
    },
    branding: false,
    mobile: {
        menubar: true
    },

});


function baseUrl() {
    return baseUrl;
}