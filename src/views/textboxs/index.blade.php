@extends('cms::template.layout')


@section('content')



<h6>this is a test</h6>
<form>

        <textarea name="richTextBoxEditorSimple" class="richTextBoxEditor" data-editor-template="simple" rows="10" cols="80">
            This is my textarea to be replaced with CKEditor.
        </textarea>
        <textarea name="richTextBoxEditorBasic" class="richTextBoxEditor" data-editor-template="basic" rows="10" cols="80">
                 This is my textarea to be replaced with CKEditor.
         </textarea>
         <textarea name="richTextBoxEditorAdvanced" class="richTextBoxEditor" data-editor-template="advanced" rows="10" cols="80">
                 This is my textarea to be replaced with CKEditor.
         </textarea>

</form>
@stop