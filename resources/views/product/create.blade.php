@extends('layouts.master')

@section('title', 'Page Title')
@section('menu')
    @parent
@endsection
@section('content')
    <div class="jumbotron text-center">
        <h2>Новый товар</h2>
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
        {!! Form::model($product, array('action'=>'App\Http\Controllers\ProductController@store')) !!}
        <div class='form-group'>
            {!! Form::label('productname','Название товара')!!}
            {!! Form::text('productname', '', ['class'=>'form-control'])!!}
        </div>
        <div class='form-group'>
            {!! Form::label('productdescription','Описание товара')!!}
            {!! Form::textarea ('productdescription', '', ['class'=>'form-control','rows="3"'])!!}
        </div>
        <div class='form-group'>
            {!! Form::label('price','Цена товара')!!}
            {!! Form::number('price', '', ['class'=>'form-control', 'value="0"'])!!}
        </div>
        <div class='form-group'>
            {!! Form::label('categoryid','Категории', ['class'=>'col-sm-12 col-md-12 col-lg-12'])!!}
            {!! Form::select('categoryid', $categories, '', ['class'=>'col-sm-2 col-md-2 col-lg-2'])!!}
            <a href="{{url('category/create')}}"  class="btn btn-primary btn-sm" type='submit' > Создать категорию</a>

        </div>
        <button class="btn btn-success" type="submit">Сохранить</button>
        {!! Form::close() !!}
    </div>
@endsection
