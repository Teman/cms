@extends('cms::template.layout')


@section('content')



<h2>this is a testpage</h2>

    {{ Form::open(['method'=>'post','route' => 'admin.textbox.store']) }}

        <textarea name="richTextBoxEditorSimple" class="richTextBoxEditor" data-editor-template="simple" rows="10" cols="80">
            This is my textarea to be replaced with CKEditor.
        </textarea>

    <div class="form-group">
        {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
    </div>
    {{Form::close()}}





@stop