@extends('cms::template.layout')


@section('content')
<h1>
  Cms users
  <small>
  <a href="{{route('admin.users.create')}}" class='btn btn-default btn-sm'>
    <i class="fa fa-plus-circle"></i>
    add new user
  </a>
</h1>
<hr/>
<div class="list-form">  
    <button type="button" class="btn-select-all btn btn-default btn-xs">Select all</button>
    <button type="button" class="btn-deselect-all btn btn-default btn-xs">Deselect all</button>
    <button type="button" class="btn-delete-all btn btn-danger btn-xs">Delete</button>
  
    <div id="wrapper" class="table-responsive">
        <table id="keywords" class="tablesorter table table-condensed table-main">
            <thead>
                 <tr>
                    <th width="10%"></th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
            @foreach ($users->chunk(4) as $row)
              @foreach($row as $user)
                <tr data-name="{{$user->email}}" data-delete-url="{{route('admin.users.destroy',$user->id)}}">
                    <td>{{ Form::checkbox('user', $user->id)}}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->roles[0]->name }}</td>
                    <td>{{ link_to_route('admin.users.edit', 'Edit', $user->id, ['class' => 'btn btn-default btn-xs']) }}</td>
                    <td><button type="button" class="btn-delete-item btn btn-danger btn-xs">Delete</button></td>
                </tr>
                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>
{{$users->links()}}
</div>

@stop
