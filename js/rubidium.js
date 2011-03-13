$(document).ready(function() {
	$('textarea.editor').ckeditor();
});
function confirmDelete(delUrl) {
  if (confirm("Are you sure you want to delete this page?")) {
    document.location = delUrl;
  }
}
