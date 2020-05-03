@extends('layouts.app')

@section('content')

    <div class="card card-default">
        <div class="card-header">
            Roles
        </div>
        <div class="card-body">

            @if($users->count() > 0)
                <table class="table">
                    <thead>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Action</th>
                    </thead>

                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->role->name}}</td>
                            @if(!$user->checkRole())
                                <td>
                                    {!! Form::open(['method'=>'put','route'=>['users.update',$user->id]]) !!}
                                        {!! Form::submit('Make Admin',['class'=>'btn btn-info btn-sm']) !!}
                                    {!! Form::close() !!}
                                </td>
                            @else
                                <td>
                                    {!! Form::open(['method'=>'put','route'=>['users.update',$user->id]]) !!}
                                    {!! Form::submit('Make User',['class'=>'btn btn-info btn-sm']) !!}
                                    {!! Form::close() !!}
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-center"><strong>No roles found</strong></p>
            @endif
            @include('partials.modal')
        </div>
    </div>
@endsection
@section('scripts')
    <script>

        function handleDelete(id)
        {
            var form = document.getElementById('deleteRoleForm')
            form.action = '/roles/' + id

            $('#deleteModal').modal('show')
        }
    </script>
@endsection

