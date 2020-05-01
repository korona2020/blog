@extends('layouts.app')

@section('content')

    <div class="card card-default">
        <div class="card-header">
            {{!isset($post) ? 'Add a Post' : 'Edit Post'}}
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
                    {!! Form::label('tags', 'Tags ') !!}
                    {!! Form::select('tags[]', $tags, null, ['class'=>'form-control','multiple']) !!}
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
                        <img height="150px" width="150px" src="{{asset('storage/' . $post->image)}}" alt="">
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
                            {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('tags', 'Tags ') !!}
                            {!! Form::select('tags[]', $tags, null, ['class'=>'form-control','multiple']) !!}
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

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.tags-selector').select2();
        });
    </script>
@endsection
