var listForm = $('.list-form'),
btnDelete = $('#btnDelete'),
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
                       /* nombreElementsTraites++;
                        if (nombreElementsSelectionnes == nombreElementsTraites) {
                            console.log('succes');
                            $(':checkbox').change();
                        }
                        */
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
        btnDeselectAll.prop('disabled', false);
    }
    else
    {
        btnDeselectAll.prop('disabled', true);
    }
}
