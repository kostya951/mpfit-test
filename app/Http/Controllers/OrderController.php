<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Status;
use DateTime;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function all(){
        $models = (new Order())->all();
        $products = (new Product())->all();
        return view('orders',['models' => $models,'products'=>$products]);
    }

    public function get($id){
        $model = Order::where('id',$id)->first();
        $statuses = Status::all();
        if(isset($model)) {
            return view('order', ['model' => $model,'statuses' => $statuses]);
        }
        return redirect('orders');
    }

    public function add(Request $request){
        $valid = $request->validate([
            'fio' => 'required|min:1|max:255',
            'products' => 'array',
            'quantity' => 'array',
            'quantity.*' => 'required|numeric|gt:0|regex:/^\d+(\.\d{1,2})?$/'
        ]);

        $model = new Order();
        $model->fio = $request->input('fio');
        $model->date = (new DateTime())->format('Y-m-d h:i:s');
        $model->status_id = 1;

        $model->save();

        $quantities = $request->input('quantity');

        foreach ($request->input('products') as $key=>$product_id){
            $model->products()->attach($product_id,['quantity' => $quantities[$key]]);
        }

        return redirect('orders');
    }

    public function edit(Request $request){
        $validate = $request->validate([
            'fio' => 'required|min:1|max:255'
        ]);

        $model = Order::where('id',$request->input('id'))->first();
        $model->fio = $request->input('fio');
        $model->status_id = $request->input('status_id');

        $model->update();
        return redirect('orders');
    }

    public function delete($id){
        $model = Order::where('id',$id)->first();
        if(isset($model)){
            $model->delete();
        }
        return redirect('orders');
    }
}
