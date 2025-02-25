<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    public $timestamps=false;

    public function products(){
        return $this->belongsToMany(Product::class,'products_orders')->withPivot('quantity');
    }

    public function status(){
        return $this->belongsTo(Status::class);
    }

    public function netPrice(){
        $items = $this->products->all();
        $netPrice = 0;
        foreach ($items as $item){
            $quantity = $item->pivot->quantity;
            $price = $item->price;
            $netPrice+= $quantity*$price;
        }
        return $netPrice;
    }
}
