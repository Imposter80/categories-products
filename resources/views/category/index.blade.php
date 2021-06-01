@extends('layouts.master')

@section('title', 'Page Title')
@section('menu')
    @parent
@endsection
@section('content')

    <div class="jumbotron text-center">
        <h2>Все категории</h2>

    </div>
    <a href="{{url('category/create')}}" class="btn btn-success">Создать категорию</a>

    <form method="GET" action="{{ route('category.index')}}">
        <div class="filters row" style="padding: 10px">
            <div class="row" style="padding: 5px">
                <label for="search">Поиск:
                    <input type="text" name="search" id="search" size="34" placeholder="Введите текст для поиска" value="{{request()->search}}">
                </label>
            </div>
            <div class="col-sm-12 col-md-12" style="padding: 5px">
                <label for="price_from">Сумма от:
                   <input type="number" name="price_from" id="price_from" step="0.01" style="width: 7em"  value="{{request()->price_from}}">
                </label>
                <label for="price_to">до:
                    <input type="number" name="price_to" id="price_to" step="0.01" style="width: 7em" value="{{request()->price_to}}">
                </label>
            </div>
            <div class="col-sm-12 col-md-12" style="padding: 5px">
                <label for="count_from">Количество от:
                    <input type="number" name="count_from" id="count_from" style="width: 6em" value="{{request()->count_from}}">
                </label>
                <label for="count_to">до:
                    <input type="number" name="count_to" id="count_to" style="width: 6em" value="{{request()->count_to}}">
                </label>
            </div>
            <div class="col-sm-8 col-md-8" style="padding: 5px">
                    <button type="submit" class="btn btn-primary">Применить</button>
            </div>
        </div>
    </form>


    <div class="row">
            <table class="table" id="table_id">
                <thead>
                <tr>
                    <th scope="col">Название</th>
                    <th scope="col">Описание</th>
                    <th scope="col">Сумма</th>
                    <th scope="col">Количество</th>
                    <th scope="col">Дата</th>
                    <th scope="col">Операции</th>
                </tr>
                </thead>

                @foreach($categories as $key=>$category)
                <tr>

                    <td>{{$category->categoryname}}</td>
                    <td>{{$category->categorydescription}}</td>

                    <td>{{$category->sum_product}}</td>
                    <td>{{$category->amount_product}}</td>

                    <td>{{$category->created_at->format('d-m-Y')}}</td>

                    <td>
                        <a href="{{ route('category.edit', $category->id)}}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('category.destroy',$category->id) }}" method="POST" style="display: inline-block">
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
























