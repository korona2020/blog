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
            @if($posts->count() >0)
            <table class="table">
                <thead>
                 <th>Image</th>
                 <th>Title</th>
                 <th>Action</th>
                 <th></th>
                </thead>

                <tbody>

                    @foreach($posts as $post)
                         <tr>
                             <td><img src="{{asset('storage/'.$post->image)}}" width="60px" height="60px"></td>
                             <td>{{$post->title}}</td>
                             <td>
                                 @if(!$post->trashed())
                                    <a href="{{route('posts.edit',$post->id)}}" class="btn btn-info btn-sm">Edit</a>
                                 @endif
                             </td>
                             <td>
                                 {!! Form::open(['method'=>'DELETE', 'route'=>['posts.destroy',$post->id]]) !!}
                                 @if(!$post->trashed())
                                     {!! Form::submit('Trash', ['class'=>'btn btn-warning btn-sm']) !!}
                                 @else
                                     {!! Form::submit('Delete', ['class'=>'btn btn-danger btn-sm']) !!}
                                 @endif
                                 {!! Form::close() !!}
                             </td>
                         </tr>
                    @endforeach

                </tbody>
            </table>
            @else
                <p class="text-center"><strong>No post found</strong></p>
            @endif
        </div>
    </div>
@endsection
