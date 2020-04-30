@extends('layouts.app')

@section('content')

    <div class="card card-default">
        <div class="card-header">
            {{isset($post) ? 'Add a Post' : 'Edit Post'}}
        </div>
        <div class="card-body">
            @if(empty($post))
                {!! Form::open(['route'=>'posts.store', 'files'=>true]) !!}
                <div class="form-group">
                    {!! Form::label('title','Title') !!}
                    {!! Form::text('title',null, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('description','Description') !!}
                    {!! Form::text('description',null, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                   <input id="x" type="hidden" name="content">
                    <trix-editor input="x"></trix-editor>
                </div>
            <div class="form-group">
                {!! Form::label('published_at','Published_at') !!}
                {!! Form::date('published_at', \Carbon\Carbon::now(),['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('category_id', 'Category ') !!}
                {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::file('image',null, ['class'=>'form-control']) !!}
            </div>
                <div class="form-group">
                    {!! Form::submit('Add Post',['class'=>'btn btn-success']) !!}
                </div>
                {!! Form::close() !!}
            @endif
            @if(!empty($post))
                <div class="container">
                    <div class="row col-md-2">
                        <img src="{{asset('storage/' . $post->image)}}" alt="">
                    </div>
                    <div class="row col-md-6">

                        {!! Form::model($post,['method'=>'PUT','route'=>['posts.update',$post->id],'files'=>true]) !!}
                        <div class="form-group">
                            {!! Form::label('title','Title') !!}
                            {!! Form::text('title',null, ['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('description','Description') !!}
                            {!! Form::text('description',null, ['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('content','Content') !!}
                            <input id="x" value="{{$post->content}}" type="hidden" name="content">
                            <trix-editor input="x" ></trix-editor>
                        </div>
                        <div class="form-group">
                            {!! Form::label('published_at','Published_at') !!}
                            {!! Form::date('published_at', \Carbon\Carbon::now(),['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('category_id', 'Category ') !!}
                            {!! Form::select('category_id', $categories,null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::file('image',null, ['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::submit('Edit Post',['class'=>'btn btn-success']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>


                </div>

            @endif
            @include('partials.errors')
        </div>
    </div>
@endsection
