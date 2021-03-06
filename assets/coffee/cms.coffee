###
# Please edit here, NEVER in the cms.js, ktnxbai
# hint: use 'grunt watch'
###

# checkbox functionality
$('.btn-select-all').click ->
  $('input[type=checkbox]').prop('checked', true)
$('.btn-deselect-all').click ->
  $('input[type=checkbox]').prop('checked', false)
$('.btn-delete-all').click ->
  if confirm('Are you sure?')
    $('input:checked').each ->
      delete_item($(this).parent().parent())
$('.btn-delete-item').click ->
  if confirm('Are you sure?')
    delete_item($(this).parent().parent())

# rich text editor (last class is legacy support)
tinymce.init({
  selector: 'textarea.richtext, textarea.richTextBoxEditor',
  menubar: false,
  plugins: [
    "advlist autolink lists link charmap anchor",
    "searchreplace visualblocks code",
    "table contextmenu paste"
  ],
  toolbar: "styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link | code",
  height: 300
});

flash = (msg, type = "info") ->
  $("#messages").append "<div class='alert alert-#{type}' role='alert'>#{msg}</div>"

delete_item = ($row) ->
  name = $row.data('name')
  $.ajax
    type: "post"
    data:
      _method: "delete"
    url: $row.data('delete-url')
    success: ->
      $row.fadeOut "fast", ->
        $(this).remove()
        $(".alert").remove()
        flash("#{name} deleted", 'warning')
    error: ->
      flash('something went wrong deleting', 'danger')