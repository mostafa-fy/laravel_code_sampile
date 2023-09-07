@extends('layouts.app')

@section('content')

<div class="container">

  @foreach ($errors->all() as $error)
  <div class="alert alert-danger" role="alert">
   {{$error}}
  </div>
  @endforeach

  @if (Session::has('success'))
  <div class="alert alert-success" role="alert">
    {{Session::get('success')}}
   </div>
  @endif
    <div class="text-center">
        <h4>Dispaly Products</h4>
    </div>
    @can('create product')
  <div class="row mt-5">
    <div class="col-2">
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Product</button>
    </div>
    <div class="col-2">
        <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal1">Add Product Option</button>
        </div>
  </div>
   @endcan
  <table class="table mt-5">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">name</th>
      <th scope="col">user name</th>
      <th scope="col">image</th>
      @foreach ($options as $option)
      <th scope="col">{{$option->key}}</th>
      @endforeach
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach ($products as $product)
    <tr>
      <th scope="row">{{$loop->iteration}}</th>
      <td>{{$product->name}}</td>
      <td>{{$product->user?->name}}</td>
      <td><img src="{{asset($product->image)}}" height="150" width="150"></td>
     
      @foreach ($options as $option)
      @if ($product->selectedOptions()->exists())
      @foreach ($product->selectedOptions as $productOption)
      @if ($option->key == $productOption->key)
      <td>{{$productOption->value}}</td>
      @endif
      @endforeach
    
      @endif
      @endforeach
  
     <td>
      @can('modify product')
         <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal2{{$product->id}}">modify</i></button>
      @endcan
      @can('delete product')
      <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal3{{$product->id}}">delete</i></button>
      @endcan
     </td>
 
    
    </tr>

 <!-- Update Product -->
 <div class="modal fade" id="exampleModal2{{$product->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         
                  <form method="post" action="{{ route('products.update',['product'=>$product->id]) }}" enctype="multipart/form-data">
                      @csrf
                       @method('put')
                      <div class="row mb-3">
                          <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                          <div class="col-md-6">
                              <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name',$product->name) }}" required autocomplete="name" autofocus>

                              @error('name')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                      </div>

                      <div class="row mb-3">
                          <label for="image" class="col-md-4 col-form-label text-md-end">Image</label>

                          <div class="col-md-6">
                              <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}"  >

                              @error('image')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                      </div>

                      @foreach ($options as $option)
                      <div class="row mb-3">
                       <label for="image" class="col-md-4 col-form-label text-md-end">{{$option->key}}</label>
                       <div class="col-md-6">
                        <input type="hidden" value="{{$option->key}}" name="keys[]">
                       <select name="values[]" class="form-control">
                    @foreach (json_decode($option->values) as $value)
                        <option value="{{$value}}" @foreach ($product->selectedOptions as $productOption)
                          @selected($productOption->value == $value && $productOption->key == $option->key)
                        @endforeach>{{$value}}</option>
                    @endforeach
                       </select>
                   </div>
                      </div>
                      @endforeach

                    

                
              
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
  </form>
    </div>
    </div>
  </div>
 </div>

 <!-- Delete Product -->
 <div class="modal fade" id="exampleModal3{{$product->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         
                  <form method="post" action="{{ route('products.destroy',['product'=>$product->id]) }}" enctype="multipart/form-data">
                      @csrf
                       @method('delete')
                              
          <p>Are You Sure?</p>
                
              
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <button type="submit" class="btn btn-primary">Yes</button>
      </div>
  </form>
    </div>
    </div>
  </div>
 </div>

    @endforeach
   
  </tbody>
 
</table>
{{$products->links()}}
</div>
<x-create-product :options='$options' />
<x-create-product-option />
@stop
