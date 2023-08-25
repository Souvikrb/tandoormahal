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
                <h3 class="card-title">Sales</h3>
                
              </div>
              <form id="saleForm" method="post" action="" enctype="multipart/form-data" >
                @csrf
                <x-forms.add-sale />
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Save <span class="loader"></span></button>
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

        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <x-admin-footer/>

  <script>
    
    $('#saleForm').submit(function(e){
      e.preventDefault();
      var formData = new FormData($(this)[0]);
      $.ajax({
          url: '{{ url('/sales-save-data') }}',
          type: 'POST',              
          data: formData,
          cache       : false,
          contentType : false,
          processData : false,
          dataType    : 'JSON',
          success: function(result)
          {
            $('#saleForm')[0].reset();
            Toast.fire({
                icon: 'success',
                title: result
            })
            
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
    
  </script>
 