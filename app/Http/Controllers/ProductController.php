<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\ProductOption;
use App\Services\ProductService;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ProductOptionRequest;

class ProductController extends Controller
{

    public function __construct()
    {
       $this->middleware(['permission:create product'])->only('store');
       $this->middleware(['permission:modify product'])->only('update');
       $this->middleware(['permission:delete product'])->only('destroy');
    }

    public function index(): View
    {
        $products = ProductService::getProduct();
        $options = ProductOption::all();
        return view('partials.product',compact('products','options'));
    }

    public function store(ProductRequest $request): RedirectResponse 
    {
        ProductService::store($request->validated());
        return back()->with('success','Product Crerated');
    }

    public function update(ProductRequest $request,$id): RedirectResponse 
    {
        ProductService::update($request->validated(),$id);
        return back()->with('success','Product Updated');
    }

    public function destroy($id): RedirectResponse 
    {
        ProductService::destroy($id);
        return back()->with('success','Product Deleted');
    }

    public function storeOption(ProductOptionRequest $request): RedirectResponse 
    {
        ProductService::storeOption($request->validated());
        return back()->with('success','Option Crerated');

    }

  
}
