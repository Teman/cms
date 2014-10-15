
/*
 * CMS coffeescript source file
 * Please edit here, NEVER in the cms.js, ktnxbai
 */
$('.btn-select-all').click(function() {
  return $('input[type=checkbox]').prop('checked', true);
});

$('.btn-deselect-all').click(function() {
  return $('input[type=checkbox]').prop('checked', false);
});

$('.btn-delete-all').click(function() {
  return confirm('Are you sure?');
});

$('textarea.richtext').wysihtml5();
