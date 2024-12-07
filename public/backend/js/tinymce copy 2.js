$(function() {
  'use strict';

  //Tinymce editor
  if ($("#tinymceExample").length) {
    tinymce.init({
      selector: 'textarea',
      language: typeof tinymceLanguage !== 'undefined' ? tinymceLanguage : 'en', // Default to 'en' if no language set
      min_height: 350,
      default_text_color: 'red',
      plugins: [
        "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
        "save table contextmenu directionality emoticons template paste textcolor",
      ],
      toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code',
      toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help',
      image_title: true,
      automatic_uploads: true,
      file_picker_types: 'image',

      // image_advtab: true,
      // templates: [
      //   { title: 'Test template 1', content: 'Test 1' },
      //   { title: 'Test template 2', content: 'Test 2' }
      // ],
      // content_css: [],
      // images_upload_url: '/upload_image', // Your server-side upload endpoint
      // automatic_uploads: true,
      // file_picker_types: 'image',
      // file_picker_callback: function(callback, value, meta) {
      //   if (meta.filetype === 'image') {
      //     const input = document.createElement('input');
      //     input.setAttribute('type', 'file');
      //     input.setAttribute('accept', 'image/*');
      //     input.onchange = function() {
      //       const file = this.files[0];
      //       const reader = new FileReader();
      //       reader.onload = function() {
      //         callback(reader.result, { alt: file.name });
      //       };
      //       reader.readAsDataURL(file);
      //     };
      //     input.click();
      //   }
      // },
      // images_upload_handler: function(blobInfo, success, failure) {
      //   // Use AJAX or Fetch API to upload the image to your server
      //   const formData = new FormData();
      //   formData.append('file', blobInfo.blob(), blobInfo.filename());

      //   fetch('/upload_image', { // Replace with your upload endpoint
      //     method: 'POST',
      //     body: formData
      //   })
      //   .then(response => response.json())
      //   .then(result => {
      //     if (result && result.location) {
      //       success(result.location); // URL of the uploaded image
      //     } else {
      //       failure('Image upload failed.');
      //     }
      //   })
      //   .catch(() => failure('Image upload failed.'));
      // }


      file_picker_callback: function (cb, value, meta) {
        var input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.setAttribute('accept', 'image/*');
    
        /*
          Note: In modern browsers input[type="file"] is functional without
          even adding it to the DOM, but that might not be the case in some older
          or quirky browsers like IE, so you might want to add it to the DOM
          just in case, and visually hide it. And do not forget do remove it
          once you do not need it anymore.
        */
    
        input.onchange = function () {
          var file = this.files[0];
    
          var reader = new FileReader();
          reader.onload = function () {
            /*
              Note: Now we need to register the blob in TinyMCEs image blob
              registry. In the next release this part hopefully won't be
              necessary, as we are looking to handle it internally.
            */
            var id = 'blobid' + (new Date()).getTime();
            var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
            var base64 = reader.result.split(',')[1];
            var blobInfo = blobCache.create(id, file, base64);
            blobCache.add(blobInfo);
    
            /* call the callback and populate the Title field with the file name */
            cb(blobInfo.blobUri(), { title: file.name });
          };
          reader.readAsDataURL(file);
        };
    
        input.click();
      },
      content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'


    });
  }
});
