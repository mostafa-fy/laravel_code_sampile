<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SelelctedProductOption extends Model
{
    use HasFactory;

    protected $fillable = ['key','value','product_id'];

    public function product(): belongsTo
    {
        return $this->belongsTo(Product::class);
    }

}
