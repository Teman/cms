
/*
 * Please edit here, NEVER in the cms.js, ktnxbai
 * hint: use 'grunt watch'
 */
var delete_item, flash;

$('.btn-select-all').click(function() {
  return $('input[type=checkbox]').prop('checked', true);
});

$('.btn-deselect-all').click(function() {
  return $('input[type=checkbox]').prop('checked', false);
});

$('.btn-delete-all').click(function() {
  if (confirm('Are you sure?')) {
    return $('input:checked').each(function() {
      return delete_item($(this).parent().parent());
    });
  }
});

$('.btn-delete-item').click(function() {
  if (confirm('Are you sure?')) {
    return delete_item($(this).parent().parent());
  }
});

tinymce.init({
  selector: 'textarea.richtext, textarea.richTextBoxEditor',
  menubar: false,
  plugins: ["advlist autolink lists link charmap anchor", "searchreplace visualblocks code", "table contextmenu paste"],
  toolbar: "styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link | code",
  height: 300
});

flash = function(msg, type) {
  if (type == null) {
    type = "info";
  }
  return $("#messages").append("<div class='alert alert-" + type + "' role='alert'>" + msg + "</div>");
};

delete_item = function($row) {
  var name;
  name = $row.data('name');
  return $.ajax({
    type: "post",
    data: {
      _method: "delete"
    },
    url: $row.data('delete-url'),
    success: function() {
      return $row.fadeOut("fast", function() {
        $(this).remove();
        $(".alert").remove();
        return flash("" + name + " deleted", 'warning');
      });
    },
    error: function() {
      return flash('something went wrong deleting', 'danger');
    }
  });
};
