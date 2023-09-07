<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    public function index()
    {
        $products = ProductService::getApiProduct();
        $products = ProductResource::collection($products);
        return response()->json($products, 200);
    }
}
