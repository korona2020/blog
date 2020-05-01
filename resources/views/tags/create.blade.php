@extends('layouts.app')

@section('content')

    <div class="card card-default">
        <div class="card-header">
            {{!isset($tag) ? 'Add a Tag' : 'Edit Tag'}}
        </div>
        <div class="card-body">
            @if(empty($tag))
                {!! Form::open(['route'=>'tags.store']) !!}
                <div class="form-group">
                    {!! Form::label('name','Name') !!}
                    {!! Form::text('name',null, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('Add Tag',['class'=>'btn btn-success']) !!}
                </div>
                {!! Form::close() !!}
            @endif
            @if(!empty($tag))
                {!! Form::model($tag,['method'=>'PUT','route'=>['tags.update',$tag->id]]) !!}
                <div class="form-group">
                    {!! Form::label('name','Name') !!}
                    {!! Form::text('name',null, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('Edit Tag',['class'=>'btn btn-success']) !!}
                </div>
                {!! Form::close() !!}
            @endif
            @include('partials.errors')
        </div>
    </div>
@endsection
