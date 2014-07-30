@extends('cms::template.layout')

@section('content')
    <h1>Users</h1>


    {{ link_to_route('admin.users.create', 'Create new user', [], ['class' => 'btn btn-primary']) }}


    <table class="table table-hover table-condensed">
        <thead>
            <tr>
                <th>E-mail</th>
                <th>Role</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{{ $user->email }}}</td>
                <td>{{{ $user->roles[0]->name }}}</td>
                <td>{{ link_to_route('admin.users.edit', 'Edit', $user->id, ['class' => 'btn btn-primary']) }}</td>

                <td>
                    {{ Form::open(['method' => 'DELETE', 'route' => ['admin.users.destroy', $user->id]]) }}
                        {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                    {{ Form::close() }}
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>
@stop