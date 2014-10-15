###
# CMS coffeescript source file
# Please edit here, NEVER in the cms.js, ktnxbai
###

# checkbox functionality
$('.btn-select-all').click ->
  $('input[type=checkbox]').prop('checked', true)
$('.btn-deselect-all').click ->
  $('input[type=checkbox]').prop('checked', false)
$('.btn-delete-all').click ->
  if confirm('Are you sure?')
    alert('sorry, not yet implemented')

# rich text editor
$('textarea.richtext').wysihtml5()