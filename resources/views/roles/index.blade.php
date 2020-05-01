@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-end">
        <a href="{{route('roles.create')}}" class="btn btn-success mb-2">Add Role</a>
    </div>
    <div class="card card-default">
        <div class="card-header">
            Categories
        </div>
        <div class="card-body">

            @if($roles->count() > 0)
                <table class="table">
                    <thead>
                    <th>Name</th>
                    <th>Nr. Users</th>
                    <th>Action</th>
                    </thead>

                    <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td>{{$role->name}}</td>

                            <td>{{$role->users->count()}}</td>
                            <td>
                                <a href="{{route('roles.edit',$role->id)}}" class="btn btn-info btn-sm" style="color: white">Edit</a>
                                <button onclick="handleDelete({{$role->id}})" class="btn btn-danger btn-sm">Delete</button>

                            </td>
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

