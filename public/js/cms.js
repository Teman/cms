
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
  if (confirm('Are you sure?')) {
    return alert('sorry, not yet implemented');
  }
});

$('textarea.richtext').wysihtml5();
