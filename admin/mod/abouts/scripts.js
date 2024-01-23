tinymce.init({
   selector: "#swEditorText",
   menubar : true,
   theme: "modern",
   skin: "custom",
content_style: "p { font-size: 15px; }",
plugins: 'codemirror, preview  wordcount, advlist, autolink, lists, link, image, charmap, print, preview, hr, anchor pagebreak searchreplace wordcount, visualblocks, visualchars, fullscreen, insertdatetime, media, nonbreaking, save, paste, table, contextmenu, directionality, emoticons, paste, textcolor, colorpicker, textpattern',
//toolbar: 'undo redo | styleselect | bold italic  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | blockquote charmap| forecolor backcolor emoticons | table | link image media |  code preview sh4tinymce wordcount',
 contextmenu: "link image inserttable | cell row column deletetable",
  codemirror: {
    indentOnInit: true,
    path: 'codemirror-4.8',
    config: {
      lineNumbers: true       
    }
  },
toolbar1: "undo redo paste bold italic underline alignleft aligncenter alignright alignjustify bullist numlist outdent indent table blockquote charmap ",
toolbar2: "fontsizeselect styleselect link unlink emoticons insertdatetime image media forecolor backcolor code  preview fullscreen",
  content_css: [
    './assets/css/tiny.css'
  ],
image_advtab: true,
convert_urls: false,
paste_data_images: true,
fontsize_formats: "8px 10px 12px 14px 18px 24px 36px",
relative_urls: false,
remove_script_host: false,
file_browser_callback: function(field, url, type, win) {
    tinyMCE.activeEditor.windowManager.open({
        file: 'plugins/kcfinder/browse.php?opener=tinymce4&field=' + field + '&type=' + type,
        title: 'File Manager',
        width: 900,
        height: 500,
        inline: true,
        close_previous: false
    }, {
        window: win,
        input: field
    });
    return false;
}
});

$('#swdatatable').dataTable({
    "iDisplayLength": 20,
    "aLengthMenu": [[20, 30, 50, -1], [20, 30, 50, "All"]]
});