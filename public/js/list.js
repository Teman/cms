var listForm = $('.list-form'),
btnDelete = $('#btnDelete');


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