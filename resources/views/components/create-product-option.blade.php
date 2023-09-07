

  <!-- Modal -->
  <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">Create Options</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
           
                    <form method="POST" action="{{ route('storeOption') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="key" class="col-md-4 col-form-label text-md-end">Option Key</label>

                            <div class="col-md-6">
                                <input id="key" type="text" class="form-control @error('key') is-invalid @enderror" name="key" value="{{ old('key') }}" required autocomplete="key" autofocus>

                                @error('key')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="key" class="col-md-4 col-form-label text-md-end">Option Value</label>

                            <div class="col-md-6" id="dynamicTable">
                                <input id="value" type="text" class="form-control" name="values[0]">
                            </div>
                            <div class="col-2">
                                <button type="button" name="add" id="add" class="btn btn-success">+</button>
                            </div>
                        </div>
                      

            
                
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </form>
      </div>
    </div>
  </div>
  </div>
  <script type="text/javascript">
   
    var i = 0;
       
    $("#add").click(function(){
   
        ++i;
        // <input id="value" type="text" class="form-control" name="values[0]">
        $("#dynamicTable").append('<tr><td><input type="text" name="values['+i+']" class="form-control mt-2" /></td><td><button type="button" class="btn btn-danger ms-2 remove-tr">-</button></td></tr>');
    });
   
    $(document).on('click', '.remove-tr', function(){  
         $(this).parents('tr').remove();
    });  
   
</script>