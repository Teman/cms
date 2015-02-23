@extends('cms::template.layout')


@section('content')
<h1>
  <a href="{{route('admin.users.create')}}" class='Addbtn' title="Add new user"><i class="fa fa-plus-circle"></i></a>
  Cms users
</h1>
<hr/>
<div class="list-form">
    <div class="text-right">
        <button type="button" class="btn-select-all btn btn-default btn-xs">Select all</button>
        <button type="button" class="btn-deselect-all btn btn-default btn-xs">Deselect all</button>
        <button type="button" class="btn-delete-all btn btn-danger btn-xs">Delete</button>
    </div>

    <br/><br/>

    <div id="wrapper" class="table-responsive">
        <table id="keywords" class="tablesorter table table-condensed table-main">
            <thead>
                 <tr>
                    <th width="5%"></th>
                    <th>Email</th>
                    <th>Role</th>
                    @if(Config::get('cms::auth.can_set_password'))
                     <th>Password set</th>
                    @endif
                    <th class="text-right" width="15%">Actions</th>
                </tr>
            </thead>

            <tbody>
            @foreach ($users->chunk(4) as $row)
              @foreach($row as $user)
                <tr data-name="{{$user->email}}" data-delete-url="{{route('admin.users.destroy',$user->id)}}">
                    <td>{{ Form::checkbox('user', $user->id)}}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->roles[0]->name }}</td>
                    @if(Config::get('cms::auth.can_set_password'))
                        <td>{{ $user->password_set ? 'Yes' : 'No' }}</td>
                    @endif
                    <td class="text-right">

                      {{ Form::open(['url'=>route('admin.users.destroy', $user->id), 'class'=>'form-inline delform',  'method'=>'delete']) }}
                          <button type="submit" class="btn btn-default btn-xs">
                              <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Delete
                          </button>
                      {{ Form::close() }}

                      <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary btn-xs">
                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit
                      </a>

                     </td>
                </tr>
                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>
{{$users->links()}}
</div>

@stop
