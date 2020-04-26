@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-end">
    <a href="{{route('categories.create')}}" class="btn btn-success mb-2">Add Category</a>
</div>
    <div class="card card-default">
        <div class="card-header">
            Categories
        </div>
        <div class="card-body">
            @if($categories->count() > 0)
                <table class="table">
                    <thead>
                        <th>Name</th>
                        <th>Action</th>
                    </thead>

                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{$category->name}}</td>
                            <td>
                                <a href="{{route('categories.edit',$category->id)}}" class="btn btn-info btn-sm" style="color: white">Edit</a>
                                <button onclick="handleDelete({{$category->id}})" class="btn btn-danger btn-sm">Delete</button>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-center"><strong>No categories found</strong></p>
            @endif
            @include('partials.modal')
        </div>
    </div>
@endsection
@section('scripts')
    <script>

        function handleDelete(id)
        {
            var form = document.getElementById('deleteCategoryForm')
            form.action = '/categories/' + id

            $('#deleteModal').modal('show')
        }
    </script>
@endsection

