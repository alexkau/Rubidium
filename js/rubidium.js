$(document).ready(function() {
	$('textarea.editor').ckeditor();
    $('#navsort').sortable({
        placeholder: "ui-state-highlight",
        axis: "y",
        handle: ".handle",
        update : function () {
            var order = $('#navsort').sortable('serialize');
            $('#hidden').load('sources/ajax.php?method=sortable_admin&'+order);
        }
    });
    $('#navsort').disableSelection();
});
function confirmDelete(delUrl) {
  if (confirm("Are you sure you want to delete this page?")) {
    document.location = delUrl;
  }
}
function confirmDeleteItem(delUrl) {
  if (confirm("Are you sure you want to delete this item?")) {
    document.location = delUrl;
  }
}