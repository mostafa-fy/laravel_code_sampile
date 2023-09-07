
  <!-- Modal -->
  <div class="modal fade" id="exampleModal2{{$product->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
           
                    <form method="put" action="{{ route('products.update',['product'=>$product->id]) }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

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
                                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}" required >

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
                          <option value="{{$value}}">{{$value}}</option>
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