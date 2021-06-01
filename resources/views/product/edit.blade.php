@extends('layouts.master')

@section('title', 'Page Title')
@section('menu')
    @parent
@endsection
@section('content')
    <div class="jumbotron text-center">
        <h2>Изменение товара</h2>
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
        <form method="post" action="{{ route('product.update', $product->id) }}">
            <div class="form-group">
                @csrf
                @method('PATCH')
                <label for="productname">Название товара</label>
                <input type="text" class="form-control" name="productname" value="{{ $product->productname }}"/>
            </div>
            <div class="form-group">
                <label for="productdescription">Описание товара</label>
                <input type="textarea" rows="3" class="form-control"  name="productdescription" value="{{ $product->productdescription }}"/>
            </div>
            <div class="form-group">
                <label for="price">Цена товара</label>
                <input type="number" class="form-control" step="0.01" name="price" value="{{ $product->price }}"/>
            </div>
            <div class="form-group">
                <label for="categoryid" class="col-sm-12 col-md-12 col-lg-12">Категории</label>
                {!! Form::select('categoryid', $categories, '', ['class'=>'col-sm-2 col-md-2 col-lg-2'])!!}
                <a href="{{url('category/create')}}"  class="btn btn-primary btn-sm" type='submit' > Создать категорию</a>
            </div>
            <button class="btn btn-success" type="submit">Сохранить изменения</button>
        </form>

    </div>
@endsection
