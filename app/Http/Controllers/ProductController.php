<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function all(){
        $models = (new Product())->all();
        $categories = (new Category())->all();
        return view('products',['models' => $models,'categories' => $categories]);
    }

    public function get($id){
        $model = Product::where('id',$id)->first();
        $categories = Category::all();
        if(isset($model)) {
            return view('product', ['model' => $model,'categories' => $categories]);
        }
        return redirect('products');
    }

    public function add(Request $request){
        $valid = $request->validate([
            'name' => 'required|min:5|max:255',
            'price' => 'required|numeric|gt:0|regex:/^\d+(\.\d{1,2})?$/'
        ]);
        $model = new Product();
        $model->name = $request->input('name');
        $model->description = $request->input('description');
        $model->price = $request->input('price');

        $category = Category::where('id', $request->input('category_id'))->first();
        $model->category_id = isset($category) ? $category->id : null;

        $model->save();

        return redirect('products');
    }

    public function edit(Request $request){
        $validate = $request->validate([
            'name' => 'required|min:5|max:255',
            'price' => 'required|numeric|gt:0|regex:/^\d+(\.\d{1,2})?$/'
        ]);

        $model = Product::where('id',$request->input('id'))->first();
        $model->name = $request->input('name');
        $model->description = $request->input('description');
        $model->price = $request->input('price');
        $model->price = $request->input('price');

        $category = Category::where('id', $request->input('category_id'))->first();
        $model->category_id = isset($category) ? $category->id : null;

        $model->update();
        return redirect('products');
    }

    public function delete($id){
        $model = Product::where('id',$id)->first();
        if(isset($model)){
            $model->delete();
        }
        return redirect('products');
    }
}
