@extends('layouts.app')

@section('content')

    <div class="card card-default">
        <div class="card-header">
            {{!isset($role) ? 'Add a Role' : 'Edit Role'}}
        </div>
        <div class="card-body">
            @if(empty($role))
                {!! Form::open(['route'=>'roles.store']) !!}
                <div class="form-group">
                    {!! Form::label('name','Name') !!}
                    {!! Form::text('name',null, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('Add Role',['class'=>'btn btn-success']) !!}
                </div>
                {!! Form::close() !!}
            @endif
            @if(!empty($role))
                {!! Form::model($role,['method'=>'PUT','route'=>['roles.update',$role->id]]) !!}
                <div class="form-group">
                    {!! Form::label('name','Name') !!}
                    {!! Form::text('name',null, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('Edit Role',['class'=>'btn btn-success']) !!}
                </div>
                {!! Form::close() !!}
            @endif
            @include('partials.errors')
        </div>
    </div>
@endsection
