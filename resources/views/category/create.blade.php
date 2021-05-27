@extends('layouts.master')

@section('title', 'Page Title')
@section('menu')
    @parent
@endsection
@section('content')
    <div class="jumbotron text-center">
        <h2>{{$page}}</h2>
    </div>
    <div class="row">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(session('message'))
            <div class="alert alert-success" >
                {{session('message')}}
            </div>
        @endif
        {!! Form::model($category, array('action'=>'App\Http\Controllers\CategoryController@store')) !!}
        <div class='form-group'>
            {!! Form::label('categoryname','Название категории')!!}
            {!! Form::text('categoryname', '', ['class'=>'form-control'])!!}
        </div>
        <div class='form-group'>
            {!! Form::label('categorydescription','Описание категории')!!}
            {!! Form::textarea ('categorydescription', '', ['class'=>'form-control','rows="3"'])!!}
        </div>
        <button class="btn btn-success" type="submit">Сохранить</button>
        {!! Form::close() !!}
    </div>
@endsection

























