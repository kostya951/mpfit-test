@extends('layout')

@section('title')
    Заказы
@endsection

@section('content')
    <main>
        <div class="row">
            <div class="col-4">
                <h1>Добавить заказ</h1>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form name="add" method="post" action="/orders">
                    @csrf
                   <input class="form-control" type="text" name="fio" placeholder="ФИО">
                        @foreach($products as $product)
                            <div class="form-check">
                                <label class="form-check-label">
                                  <input class="form-check-input" id="{{$product->id}}" name="products[{{$product->id}}]" type="checkbox" value="{{$product->id}}">
                                    {{$product->name}}
                                </label>
                                <label class="label label-default">
                                    Количество {{$product->name}}
                                  <input class="form-control" id="product_{{$product->id}}" name="quantity[{{$product->id}}]" type="text" disabled>
                                </label>
                            </div>
                        @endforeach
                    <button type="submit" class="btn btn-primary">Добавить</button>
                </form>
            </div>
            <div class="col-6">
                <h1>Товары</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Дата создания</th>
                            <th scope="col">ФИО</th>
                            <th scope="col">Статус</th>
                            <th scope="col">Итоговая цена</th>
                            <th scope="col">Редактировать</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($models as $model)
                            <tr class="table-primary">
                                <th scope="row">{{$model->id}}</th>
                                <th scope="row">{{$model->date}}</th>
                                <th scope="row">{{$model->fio}}</th>
                                <th scope="row">{{$model->status->name}}</th>
                                <th scope="row">{{$model->netPrice()}}</th>
                                <th scope="row">
                                    <a class="btn btn-primary" href="/order/{{$model->id}}">Редактировать</a>
                                    <a class="btn btn-secondary" href="/order/{{$model->id}}/delete">Удалить</a>
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
