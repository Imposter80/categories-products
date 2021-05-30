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
    {{$products->links()}}
@endsection


