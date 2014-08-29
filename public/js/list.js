var listForm = $('.list-form'),
btnDelete = $('#btnDeleteAll'),
btnSelectAll = $('#btnSelectAll'),
btnDeselectAll = $('#btnDeselectAll');
var checkbxCounter;

btnDelete.click(function(){
    var checkedCheckboxes = listForm.find(':checkbox:checked'),
        nombreElementsTraites = 0,
        nombreElementsSelectionnes = checkedCheckboxes.length;



    var url = cleanUrl();
        checkedCheckboxes.each(function(){
            var id = $(this).val();
            $.ajax({
                type: 'post',
                data:{_method:'delete'},
                url: url + '/' + id,
                success:function(){
                    $('#item_' + id).fadeOut('fast', function () {
                        $(this).remove();

                        $( ".alert" ).remove();
                        //insert a flash message at the top
                        $("#flashBar").append('<div class="alert alert-danger" role="alert">User deleted</div>');
                       })
                },
                error:function(){
                   console.log('an error occured');
                }
            });
    });
});

function cleanUrl () {
    return document.URL.split('?')[0];
}



//Select and Deselect from the users on the user page
btnSelectAll.click(function(){

    var checkedCheckboxes = listForm.find(':checkbox');

    checkedCheckboxes.each(function(){
        this.checked = true;
    });
    deActivateBtn();
});

btnDeselectAll.click(function(){
    var checkedCheckboxes = listForm.find(':checkbox');

    checkedCheckboxes.each(function(){
        this.checked = false;
    });
    deActivateBtn();
});

$(document).ready(function() {

    console.log("load");
    deActivateBtn();
    var checkedCheckboxes = listForm.find(':checkbox');

    checkedCheckboxes.click(function(){
        deActivateBtn();
    });
});
function deActivateBtn()
{
    var checkedCheckboxes = listForm.find(':checkbox:checked');

    if(checkedCheckboxes.length >0)
    {
        btnDelete.prop('disabled',false);
        btnDeselectAll.prop('disabled', false);
    }
    else
    {
        btnDelete.prop('disabled',true);
        btnDeselectAll.prop('disabled', true);
    }
}
