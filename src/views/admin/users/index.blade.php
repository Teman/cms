@extends('cms::template.layout')


@section('content')
<div class="page-header userPageHeader">
    <div id="flashBar"></div>
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
        <button type="button" id="btnSelectAll" class="btnSelectAll btn btn-default btn-sm">Select all</button>
        <button type="button" id="btnDeselectAll" class="btnDeselectAll btn btn-default btn-sm">Deselect all</button>
        <button type="button" id="btnDeleteAll" class="btnDeleteAll btn btn-danger btn-xs">Delete</button>
    {{ Form::close() }}
    </div>

    <div id="wrapper" class="table-responsive">
        <table id="keywords" class="tablesorter table table-condensed table-main">
            <thead>
                 <tr>
                    <th>Select</th>
                    <th>Email</th>
                    <th>Role</th>

                </tr>
            </thead>

            <tbody>
            @foreach ($users->chunk(4) as $row)
            <div class="row"
                   @foreach($row as $user)
                    <tr id="item_{{$user->id}}">
                        <td>
                            <div class="checkboxUserPage">
                                {{ Form::checkbox('user', $user->id)}}
                            </div>

                            {{ link_to_route('admin.users.edit', 'Edit', $user->id, ['class' => 'btnEdit btn btn-default btn-xs']) }}

                        </td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->roles[0]->name }}</td
                    </tr>
                @endforeach
             </div>
            @endforeach
            </tbody>
        </table>
    </div>
{{$users->links()}}
</div>

@stop
