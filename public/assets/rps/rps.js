$(function () {
  // Loop through summernote elements
  for (var i = 0; i <= 10; i++) {
      $('#summernote' + i).summernote({
          height: 200,
      });
  }
  
  // CodeMirror
  var codeMirrorElements = document.getElementsByClassName("codeMirrorDemo");
  for (var i = 0; i < codeMirrorElements.length; i++) {
      CodeMirror.fromTextArea(codeMirrorElements[i], {
          mode: "htmlmixed",
          theme: "monokai"
      });
  }
});