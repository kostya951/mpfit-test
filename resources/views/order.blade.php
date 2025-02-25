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
               <form class="form-horizontal" name="edit" action="/order/edit" method="post">
                    @csrf
                   <label class="label label-default" for="id">id</label>
                   <input class="form-control" type="text" name="id" id="id" value="{{$model->id}}" readonly>
                   <label class="label label-default" for="name">Имя</label>
                   <input class="form-control" type="text" name="fio" id="name" value="{{$model->fio}}">
                   <label class="label label-default" for="date">Дата</label>
                   <input class="form-control" name="date" id="date" value="{{$model->date}}" readonly>
                   <label class="label label-default" for="status">Статус</label>
                   <select class="form-select" name="status_id" id="status">
                        @foreach($statuses as $status)
                            <option value="{{$status->id}}" @if($status->id == $model->status->id) selected   @endif>{{$status->name}}</option>
                        @endforeach
                    </select>
                   <button class="btn btn-primary"  type="submit">Отправить</button>
               </form>
           </div>
           <div class="col-3"></div>
        </div>
    </main>
@endsection

