<x-admin-header/>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper ">


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row" >
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">All Products</h3>
                <a href="{{route('/admin/products/add')}}" class="btn bg-warning text-light float-right btn-sm"><b>Add New</b></a>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive ">
                <table class="table " >
                  <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th style="width: 10px">Product</th>
                            <th></th>
                            <th>Price</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                  </thead>
                  <tbody>
                            <?php $i = 0; ?>
                            @if(!empty($data))
                                @foreach($data as $d)
                                <?php $i++; ?>
                                <tr>
                                    <td >{{$i}}</td>
                                    <td ><img class="badge-image" src="{{asset('storage/products/'.$d->prodImg)}}"></td>
                                    <td >{{$d->product}} <br> <small class="text-danger">{{$d->tags}}</small></td>
                                    <td>{{($d->slPrice == '')?'----':$d->slPrice}}</td>
                                    
                                    <td>{{$d->type}}</td>
                                    <td>{{$d->status}}</td>
                                    <td><div class="btn-group btn-group-sm "><a  href="{{url('/admin/products/edit/'.$d->id)}}"  data-sId="{{$d->id}}"  class="btn btn-primary editicon btn-rounded"><i class="fas fa-pen"></i></a></div></td>
                                </tr>
                                @endforeach
                            @endif
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                  <li class="page-item"><a class="page-link" href="#">«</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">»</a></li>
                </ul>
              </div>
            </div>
            <!-- /.card -->
          </div>
       
          <!-- /.col -->
        </div>

        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
 
  <div class="modal fade" id="edit-modal">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Modify data</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id="modalSaleForm" method="post" action="" enctype="multipart/form-data" >
              <div class="modal-body">
              
                  <input type="hidden" id="sId" name="sId">
                  @csrf
                  <x-forms.add-sale />
                
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" >Edit Data</button>
              </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

  <!-- /.content-wrapper -->
  <x-admin-footer/>

  <script>

 
    $(document).on('click', '.editicon', function() {
      var sid = $(this).data('sid');
      $('#sId').val(sid);
        $.ajax({
          url: '{{ url('/sales-fetch-editdata') }}',
          type: 'GET',              
          data: {'id':sid},
          dataType    : 'JSON',
          success: function(result)
          {
            $('#menu').val(result.menu);
            $('#quantity').val(result.quantity);
            $('#discount').val(result.discount);
            $('#price').val(result.total);
            $('#review').val(result.review);
            $('#date').val(result.entry);
            $('#edit-modal').modal('show');
            
          }
      });
      
    });

    // $(document).on('click', '.delicon', function() {
    //   var sid = $(this).data('sid');
    //   $('#sId').val(sid);
    //   var y = confirm('Do you want to remove?');
    //   if(y){
    //       $.ajax({
    //         url: '{{ url('/sales-remove-editdata') }}',
    //         type: 'GET',              
    //         data: {'id':sid},
    //         dataType    : 'JSON',
    //         success: function(result)
    //         {
    //             toastr.success(result)
    //             setTimeout(function () {
    //                 location.reload();
    //             }, 1000);  
              
    //         }
    //     });
    //   }
        
      
    // });

    $('#modalSaleForm').submit(function(e){
      e.preventDefault();
      var formData = new FormData($('#modalSaleForm')[0]);
      $.ajax({
          url: '{{ url('/sales-update-editdata') }}',
          type: 'POST',              
          data: formData,
          dataType    : 'JSON',
          cache       : false,
          contentType : false,
          processData : false,
          success: function(result)
          {
            $('#modalSaleForm')[0].reset();
            $('#edit-modal').modal('hide');
            toastr.success(result.msg)
            setTimeout(function () {
                location.reload();
            }, 1000);

            
          },
          error: function(data)
          {
              let error = '';
          
              if(data.responseJSON.errors.menu){
                error += data.responseJSON.errors.menu;
              }
              if(data.responseJSON.errors.quantity){
                error += '<br>'+ data.responseJSON.errors.quantity;
              }
              if(data.responseJSON.errors.discount){
                error += '<br>'+ data.responseJSON.errors.discount;
              }
              if(data.responseJSON.errors.price){
                error += '<br>'+ data.responseJSON.errors.price;
              }
              if(data.responseJSON.errors.date){
                error += '<br>'+ data.responseJSON.errors.date;
              }
              toastr.error(error)
          }
      });
    })

    

    
    
  </script>
 