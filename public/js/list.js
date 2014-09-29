var listForm = $('.list-form'),
    btnDelete = $('#btnDeleteAll'),
    btnSelectAll = $('#btnSelectAll'),
    btnDeselectAll = $('#btnDeselectAll'),
    date = $('#date'),
    cropper = $(".cropper"),
    dataX = $("#dataX"),
    dataY = $("#dataY"),
    dataH = $("#dataH"),
    dataW = $("#dataW"),
    CroppedImagedata;



btnDelete.click(function(){
    var checkedCheckboxes = listForm.find(':checkbox:checked');

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
                    $("#flashBar").append('<div class="alert alert-danger" role="alert">'+index_view_model_name+' deleted</div>');
                })
            },
            error:function(){
                //console.log('an error occured');
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

//function SaveCroppedImage(src_filename, extension)
//{
//   console.log(CroppedImagedata);
//
//    CroppedImagedata['src_filename'] = src_filename;
//    CroppedImagedata['extension'] = extension;
//    console.log(CroppedImagedata);
//
//    $.ajax({
//        type: 'post',
//        data:CroppedImagedata,
//        url: '/crop',
//        success:function(){
//
//        }
//});
//}

$(document).ready(function() {

    $(".listItem").each(function(){
        //console.log($(this).attr('href'));

        var aHref = $(this).attr('href')
        var windowURL = window.location;

        if(aHref == windowURL)
        {
            $(this).addClass('active');
        }


    });

//    cropper.cropper({
//        aspectRatio: 16 / 9,
//        done:function(data)
//        {
//            CroppedImagedata = data;
//
//        }
//    });

    $("#cropper_reset").click(function() {
        cropper.cropper("reset");
    });
    $("#cropper_free_ratio").click(function() {
        cropper.cropper("setAspectRatio","auto");
    });
    $("#cropper_set_data").click(function() {
        cropper.cropper("setData", {
            x: dataX.val(),
            y: dataY.val(),
            width: dataW.val(),
            height:dataH.val()
        });
    });

    var dropzone = $('#my-awesome-dropzone');
    dropzone.options = {
        paramName:"file",
        maxFilesize:2

    }

    var datepickers =$('.dp');

    datepickers.each(function(){

        var dateP = $(this);
        dateP.datepicker();

        dateP.keydown(function(e){
            dateP.ForceNumericOnly();
            if (e.keyCode != 8){
                if ($(this).val().length == 2){
                    $(this).val($(this).val() + "/");
                }else if ($(this).val().length == 5){
                    $(this).val($(this).val() + "/");
                }
                else if($(this).val().length >9 && e.keyCode>47 && e.keyCode <58)
                {
                    $(this).val($(this).val().substring(0,$(this).val().length-1));
                }
            }
        });
    })

    //automaticly search for all richtextbox editors on the page with classname
    var richtextboxes = $('.richTextBoxEditor');
    richtextboxes.each( function(){
        var textbox = $(this);
        var type = textbox.data('editor-template');

        if ( ! type || type == 'Simple' ){
            CKEDITOR.replace(textbox.get(0),{
                customConfig: 'richTextBoxConfigs/ckeditor_custom_configSimple.js'
            });
        }

        if ( type == 'Basic' ){
            CKEDITOR.replace(textbox.get(0) ,{
                customConfig: 'richTextBoxConfigs/ckeditor_custom_configBasic.js'
            });
        }
        if ( type == 'Advanced' ){
            CKEDITOR.replace(textbox.get(0) ,{
                customConfig: 'richTextBoxConfigs/ckeditor_custom_configAdvanced.js'
            });
        }

    });

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
jQuery.fn.ForceNumericOnly =
    function()
    {
        return this.each(function()
        {
            $(this).keydown(function(e)
            {
                var key = e.charCode || e.keyCode || 0;
                // allow backspace, tab, delete, enter, arrows, numbers and keypad numbers ONLY
                // home, end, period, and numpad decimal
                return (
                    key == 8 ||
                        key == 9 ||
                        key == 13 ||
                        key == 46 ||
                        key == 110 ||
                        key == 190 ||
                        (key >= 35 && key <= 40) ||
                        (key >= 48 && key <= 57) ||
                        (key >= 96 && key <= 105));
            });
        });
    };