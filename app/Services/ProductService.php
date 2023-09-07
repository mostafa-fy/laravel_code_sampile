<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductOption;
use Illuminate\Support\Facades\Auth;
use App\Traits\FileHandler;

class ProductService
{
  use FileHandler;

    public static function getProduct()
    {
      return  Product::with('user','selectedOptions')->paginate(10);
    }

    public static function getApiProduct()
    {
      return  Product::with('user')->get()->loadMissing('selectedOptions');
    }


    public static function store($data)
    {
      $data['image'] = Self::save_img($data['image'],'product_image');
      $product =  Product::create($data + ['user_id'=>Auth::id()]);
       
      if (isset($data['keys'])) {
        foreach ($data['keys'] as $i => $key) {
            $product->selectedOptions()->create([
                'key'=>$key,
                'value'=>$data['values'][$i]
            ]);
        }
        
      }
    
    }

    public static function update($data,$id)
    {
        $product =  Product::find($id);

        if ( isset($data['image'])) {
          Self::remove('storage/'.$product->image);
            $data['image'] = FileHandler::save_img($data['image'],'product_image');
        }
     
           $product->update($data);
       
            if ( $product->selectedOptions()->exists()) {
            $product->selectedOptions()->delete();

        }
        if (isset($data['keys'])) {
        foreach ($data['keys'] as $i => $key) {

        $product->selectedOptions()->create([
            'key'=>$key,
            'value'=>$data['values'][$i]
        ]);

       }
     }

    }

    public static function destroy($id)
    {
        $product =  Product::find($id);
        Self::remove('storage/'.$product->image);
        $product->delete();
    }

    public static function storeOption($data)
    {
        $values = [];
        foreach ($data['values'] as $value) {
            $values[]+= $value;
        }

        $data['values'] = json_encode($values);
        ProductOption::create($data);
    }
}