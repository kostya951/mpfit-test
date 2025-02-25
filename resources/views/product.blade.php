@extends('layout')

@section('title')
    Редактирование {{$model->id}}
@endsection

@section('content')
    <main>
        <div class="row">
           <div class="col-3"></div>
           <div class="col-6">
               @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
               <form class="form-horizontal" name="edit" action="/product/edit" method="post">
                    @csrf
                   <label class="label label-default" for="id">id</label>
                   <input class="form-control" type="text" name="id" id="id" value="{{$model->id}}" readonly>
                   <label class="label label-default" for="name">Имя</label>
                   <input class="form-control" type="text" name="name" id="name" value="{{$model->name}}">
                   <label class="label label-default" for="description">Описание</label>
                   <textarea class="form-control" name="description" id="description">{{$model->description}}</textarea>
                   <label class="label label-default" for="price">Цена</label>
                   <input class="form-control" name="price"  id="price" value="{{$model->price}}">
                   <label class="label label-default" for="category">Категория</label>
                   <select class="form-select" name="category_id" id="category">
                       <option value="0" @if(!isset($model->category)) selected @endif>Без Категории</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}" @if(isset($model->category) && $category->id == $model->category->id) selected   @endif>{{$category->name}}</option>
                        @endforeach
                    </select>
                   <button class="btn btn-primary"  type="submit">Отправить</button>
               </form>
           </div>
           <div class="col-3"></div>
        </div>
    </main>
@endsection
