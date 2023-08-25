<x-admin-header/>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Upload Your Sales Transaction</h3>
                
              </div>
              
              <!-- /.card-header -->
              <!-- form start -->
              <form id="saleForm" method="post" action="" enctype="multipart/form-data" >
                @csrf
                <div class="card-body">
                
                  <div class="form-group">
                    <label for="exampleInputEmail1">Date</label>
                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                        <input type="text" name="date" value="{{date('d-m-Y')}}" class="form-control datetimepicker-input" placeholder="DD-MM-YYYY" data-target="#reservationdate" required/>
                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <x-forms.file name="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required="required " /> 
                  </div>
              
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Review <span class="loader"></span></button>
                </div>
           
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>

        <div class="row" id="sales_data" style="display:none">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Verify Current Data</h3>
                <button class="btn btn-warning btn-sm btn-dark float-right" id="uploadBtn">Upload All</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table class="table table-bordered" >
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Menu</th>
                      <th>Quantity</th>
                      <th>Discount</th>
                      <th>Total</th>
                      <th>Review</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
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
    
    $('#saleForm').submit(function(e){
      e.preventDefault();
      var formData = new FormData($(this)[0]);
      $.ajax({
          url: '{{ url('/sales-excel-data-review') }}',
          type: 'POST',              
          data: formData,
          cache       : false,
          contentType : false,
          processData : false,
          dataType    : 'JSON',
          success: function(result)
          {
            var row = '';
            if(result){
              $.each(result,function(idx,data){
                let review = '---';
                if(data.review !== null && data.review !== undefined && data.review != ''){
                  review = data.review;
                }
                let discount = '---';
                if(data.discount != '0' && data.discount !== undefined && data.discount != ''){
                  discount = data.discount;
                }
                row += '<tr id="row'+data.id+'"><td>'+(idx+1)+'</td><td><b>'+data.menu+'<b><br><small class="text-danger">Created '+data.entry+'</small></td><td>'+data.quantity+'</td><td>'+discount+'</td><td>'+data.total+'</td><td>'+review+'</td><td><div class="btn-group btn-group-sm"><button  data-sId="'+data.id+'"  class="btn btn-primary editicon"><i class="fas fa-pen"></i></button><button data-sId="'+data.id+'"  class="btn btn-danger delicon"><i class="fas fa-trash"></i></button></div></td></tr>';
              })
              $('#sales_data').show();
              $('#sales_data table tbody').html(row);
            }
            
          },
          error: function(data)
          {
              let error = '';
              if(data.responseJSON.errors.date){
                error = data.responseJSON.errors.date;
              }
              if(data.responseJSON.errors.file){
                error = '<br>'+ data.responseJSON.errors.file;
              }
              Toast.fire({
                icon: 'error',
                title: error
              })
          }
      });
    })
 
    $(document).on('click', '.editicon', function() {
      var sid = $(this).data('sid');
      $('#sId').val(sid);
        $.ajax({
          url: '{{ url('/sales-excel-fetch-editdata') }}',
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

    $(document).on('click', '.delicon', function() {
      var sid = $(this).data('sid');
      $('#sId').val(sid);
      var y = confirm('Do you want to remove?');
      if(y){
          $.ajax({
            url: '{{ url('/sales-excel-remove-editdata') }}',
            type: 'GET',              
            data: {'id':sid},
            dataType    : 'JSON',
            success: function(result)
            {
              Toast.fire({
                icon: 'success',
                title: result
              })
              $('#row'+sid).remove();
            }
        });
      }
        
      
    });

    $('#modalSaleForm').submit(function(e){
      e.preventDefault();
      var formData = new FormData($('#modalSaleForm')[0]);
      $.ajax({
          url: '{{ url('/sales-excel-update-editdata') }}',
          type: 'POST',              
          data: formData,
          dataType    : 'JSON',
          cache       : false,
          contentType : false,
          processData : false,
          success: function(result)
          {
            $('#modalSaleForm')[0].reset();
            Toast.fire({
                icon: 'success',
                title: result.msg
            })

            var row = '';
            if(result.responce){
              $.each(result.responce,function(idx,data){
                let review = '---';
                if(data.review !== null && data.review !== undefined && data.review != ''){
                  review = data.review;
                }
                let discount = '---';
                if(data.discount != '0' && data.discount !== undefined && data.discount != ''){
                  discount = data.discount;
                }
                row += '<tr id="row'+data.id+'"><td>'+(idx+1)+'</td><td><b>'+data.menu+'<b><br><small class="text-danger">Created '+data.entry+'</small></td><td>'+data.quantity+'</td><td>'+discount+'</td><td>'+data.total+'</td><td>'+review+'</td><td><div class="btn-group btn-group-sm"><button  data-sId="'+data.id+'"  class="btn btn-primary editicon"><i class="fas fa-pen"></i></button><button data-sId="'+data.id+'"  class="btn btn-danger delicon"><i class="fas fa-trash"></i></button></div></td></tr>';
              })
              $('#sales_data').show();
              $('#sales_data table tbody').html(row);
            }
            $('#edit-modal').modal('hide');
            
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
              Toast.fire({
                icon: 'error',
                title: error
              })
          }
      });
    })

    $('#uploadBtn').click(function(){
      var y = confirm('Do you want to upload all data?');
      if(y){
        $.ajax({
            url: '{{ url('/sales-excel-upload-alldata') }}',
            type: 'GET', 
            dataType : 'JSON',
            success: function(result)
            {
              Toast.fire({
                icon: 'success',
                title: result
              })
              $('#sales_data').hide();
            }
        });
      }
    })
    

    
    
  </script>
 