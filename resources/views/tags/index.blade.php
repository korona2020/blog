@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-end">
        <a href="{{route('tags.create')}}" class="btn btn-success mb-2">Add Tag</a>
    </div>
    <div class="card card-default">
        <div class="card-header">
            Tags
        </div>
        <div class="card-body">
            @if($tags->count() > 0)
                <table class="table">
                    <thead>
                    <th>Name</th>
                    <th>Nr. Posts</th>
                    <th></th>
                    <th>Action</th>
                    </thead>

                    <tbody>
                    @foreach($tags as $tag)
                        <tr>
                            <td>{{$tag->name}}</td>
                            <td>{{$tag->posts->count()}}</td>
                            <td></td>
                            <td>
                                <a href="{{route('tags.edit',$tag->id)}}" class="btn btn-info btn-sm" style="color: white">Edit</a>
                                <button onclick="handleDelete({{$tag->id}})" class="btn btn-danger btn-sm">Delete</button>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-center"><strong>No tags found</strong></p>
            @endif
            @include('partials.modal')
        </div>
    </div>
@endsection
@section('scripts')
    <script>

        function handleDelete(id)
        {
            var form = document.getElementById('deleteTagForm')
            form.action = '/tags/' + id

            $('#deleteModal').modal('show')
        }
    </script>
@endsection

