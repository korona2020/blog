@extends('layouts.app')

@section('content')

    <div class="card card-default">
        <div class="card-header">
            {{!isset($category) ? 'Add a Category' : 'Edit Category'}}
        </div>
        <div class="card-body">
            @if(empty($category))
                {!! Form::open(['route'=>'categories.store']) !!}
                <div class="form-group">
                    {!! Form::label('name','Name') !!}
                    {!! Form::text('name',null, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('Add Category',['class'=>'btn btn-success']) !!}
                </div>
                {!! Form::close() !!}
            @endif
            @if(!empty($category))
                {!! Form::model($category,['method'=>'PUT','route'=>['categories.update',$category->id]]) !!}
                <div class="form-group">
                    {!! Form::label('name','Name') !!}
                    {!! Form::text('name',null, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('Edit Category',['class'=>'btn btn-success']) !!}
                </div>
                {!! Form::close() !!}
            @endif
            @include('partials.errors')
        </div>
    </div>
@endsection
