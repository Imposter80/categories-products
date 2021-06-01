@extends('layouts.master')

@section('title', 'Page Title')
@section('menu')
    @parent
@endsection
@section('content')

    <div class="jumbotron text-center">
        <h2>Все товары</h2>

    </div>
    <a href="{{url('product/create')}}" class="btn btn-success">Создать товар</a>

    <form method="GET" action="{{ route('product.index')}}">
        <div class="filters row" style="padding: 10px">
            <div class="row" style="padding: 5px">
                <label for="search">Поиск:
                    <input type="text" name="search" id="search" size="34" placeholder="Введите текст для поиска" value="{{request()->search}}">
                </label>
            </div>
            <div class="col-sm-12 col-md-12" style="padding: 5px">
                <label for="price_from">Цена от:
                    <input type="number" name="price_from" id="price_from" step="0.01" style="width: 7em"  value="{{request()->price_from}}">
                </label>
                <label for="price_to">до:
                    <input type="number" name="price_to" id="price_to" step="0.01" style="width: 7em" value="{{request()->price_to}}">
                </label>
            </div>
            <div class="col-sm-4 col-md-4" style="padding: 5px">
                <label for="categoryid">Категория:</label>
                {!! Form::select('categoryid', $categories, null, ['placeholder' => 'Выберите категорию'], ['class'=>'col-sm-2 col-md-2 col-lg-2'])!!}
            </div>

            <div class="col-sm-12 col-md-12" style="padding: 5px">
                <button type="submit" class="btn btn-primary">Применить</button>
            </div>
        </div>
    </form>



    <div class="row">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Название</th>
                <th scope="col">Описание</th>
                <th scope="col">Цена</th>
                <th scope="col">Категория</th>
                <th scope="col">Дата</th>
                <th scope="col">Операции</th>
            </tr>
            </thead>
            @foreach($products as $p)
                <tr>
                    <td>{{$p->productname}}</td>
                    <td>{{$p->productdescription}}</td>
                    <td>{{$p->price}}</td>
                    <td>{{$p->category_name}}</td>
                    <td>{{$p->created_at->format('d-m-Y')}}</td>
                    <td>
                        <a href="{{ route('product.edit', $p->id)}}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('product.destroy',$p->id) }}" method="POST" style="display: inline-block">

                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>

    </div>

@endsection


