@extends('layouts.master')

@section('title', 'Page Title')
@section('menu')
    @parent
@endsection
@section('content')
    <div class="jumbotron text-center">
        <h2>Изменение категории</h2>
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
            <form method="post" action="{{ route('category.update', $category->id) }}">
                <div class="form-group">
                    @csrf
                    @method('PATCH')
                    <label for="categoryname">Название категории</label>
                    <input type="text" class="form-control" name="categoryname" value="{{ $category->categoryname }}"/>
                </div>
                <div class="form-group">
                    <label for="categorydescription">Описание категории</label>
                    <input type="textarea" rows="3" class="form-control"  name="categorydescription" value="{{ $category->categorydescription }}"/>
                </div>
                <button class="btn btn-success" type="submit">Сохранить изменения</button>
            </form>

    </div>
@endsection
