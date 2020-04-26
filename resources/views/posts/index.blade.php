@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-end">
    <a href="{{route('posts.create')}}" class="btn btn-success mb-2">Add a Post</a>
</div>
    <div class="card card-default">
        <div class="card-header">
            All Posts
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                 <th>Image</th>
                 <th>Title</th>
                 <th></th>
                 <th></th>
                </thead>

                <tbody>
                @foreach($posts as $post)
                     <tr>
                         <td><img src="{{asset('storage/'.$post->image)}}" width="60px" height="60px"></td>
                         <td>{{$post->title}}</td>
                         <td>

                         </td>
                         <td>
                             <a href="{{route('posts.edit',$post->id)}}" class="btn btn-info btn-sm">Edit</a>
                             <a href="" class="btn btn-danger btn-sm">Trash</a>
                         </td>
                     </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
