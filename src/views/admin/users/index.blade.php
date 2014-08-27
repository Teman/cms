@extends('cms::template.layout')


@section('content')
<div class="page-header userPageHeader">
  <h1>
       <a href="/admin/users/create">
         <i class="fa fa-plus-circle userAddbtn ">

          </i>
       </a>
       Create new user
   </h1>
</div>

<div class="list-form">
    <div class="btn-toolbar">
    {{ Form::open() }}
        {{ Form::submit('Select all', ['class' => 'btnSelectUsers btn btn-default btn-sm']) }}
        <button type="button" id="btnDelete" class="btnDeleteUsers btn btn-danger btn-xs">Delete</button>
    {{ Form::close() }}
    </div>

    <div id="table" class="table-responsive">
        <table class="table table-condensed table-main">
            <thead>
                <tr>
                    <th>Select</th>
                    <th>E-mail</th>
                    <th>Role</th>

                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                <tr id="item_{{$user->id}}">
                    <td>
                        <div class="checkboxUserPage">
                            {{ Form::checkbox('user', $user->id)}}
                        </div>

                        {{ link_to_route('admin.users.edit', 'Edit', $user->id, ['class' => 'btnEdit btn btn-default btn-xs']) }}

                    </td>
                        <td>{{{ $user->email }}}</td>
                        <td>{{{ $user->roles[0]->name }}}</td
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>
@stop