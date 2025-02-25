@extends('layout')

@section('title')
    Продукты
@endsection

@section('content')
    <main>
        <div class="row">
            <div class="col-4">
                <h1>Добавить товар</h1>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form name="add" method="post" action="/products">
                    @csrf
                   <input class="form-control" type="text" name="name" placeholder="Имя продукта">
                   <textarea class="form-control" name="description" placeholder="Описание"></textarea>
                   <input class="form-control" name="price" placeholder="Цена">
                   <select class="form-select" name="category_id">
                       <option value="0" selected>Без Категории</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary">Добавить</button>
                </form>
            </div>
            <div class="col-6">
                <h1>Товары</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Название</th>
                            <th scope="col">Категория</th>
                            <th scope="col">Описание</th>
                            <th scope="col">Цена</th>
                            <th scope="col">Редактировать</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($models as $model)
                            <tr class="table-primary">
                                <th scope="row">{{$model->id}}</th>
                                <th scope="row">{{$model->name}}</th>
                                <th scope="row">@if(isset($model->category)){{$model->category->name}} @else Без категории @endif</th>
                                <th scope="row">{{$model->description}}</th>
                                <th scope="row">{{$model->price}}</th>
                                <th scope="row">
                                    <a class="btn btn-primary" href="/product/{{$model->id}}">Редактировать</a>
                                    <a class="btn btn-secondary" href="/product/{{$model->id}}/delete">Удалить</a>
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-2"></div>
        </div>
    </main>
@endsection
