<x-admin-header/>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">


  <section class="content mt-4">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-globe"></i> AdminLTE, Inc.
                    <small class="float-right"><button class="btn btn-sm btn-primary"><i class="fas fa-pen"></i> Edit</button></small>
                    
                
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
              <div class="col-sm-4 invoice-col">
                  <small class="text-danger">Date: 2/10/2014 </small>
                  <br><br>
                  <b>Order ID:</b> 4F3S8J<br>
                  <b>Payment Method:</b> Cash<br>
                  <b>Amount:</b> 1200
                </div>
                <div class="col-sm-4 invoice-col">
                  
                  </div>
                <div class="col-sm-4 invoice-col">
                  
                  <address>
                    <strong>Address</strong><br>
                    795 Folsom Ave, Suite 600<br>
                    San Francisco, CA 94107<br>
                    Phone: (804) 123-5432<br>
                    Email: info@almasaeedstudio.com
                  </address>
                </div>
                <!-- /.col -->
               
                <!-- /.col -->
                
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped repeatRow" >
                    <thead>
                    <tr>
                      <th>#</th>
                      <th>Product</th>
                      <th>Qty</th>
                      <th>Price</th>
                      <th>Discount</th>
                      <th >Total Price</th>
                      <th style="width: 90px;"><button class="btn btn-sm bg-olive"><i class="fas fa-plus"></i> Add</button></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="tr_clone">
                      <td>1</td>
                      <td><input type="text" class="form-control" name="product[]"></td>
                      <td><input type="text" class="form-control" name="qnt[]"></td>
                      <td><input type="text" class="form-control" name="price[]"></td>
                      <td><input type="text" class="form-control" name="dis[]"></td>
                      <td><input type="text" class="form-control" name="tp[]"></td>
                      <td><div class="btn-group btn-group-sm"><button data-sid="1" class="btn btn-danger delicon"><i class="fas fa-trash"></i></button></div></td>
                    </tr>
                    
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  <p class="lead">Payment Methods:</p>
                  <img src="../../dist/img/credit/visa.png" alt="Visa">
                  <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
                  <img src="../../dist/img/credit/american-express.png" alt="American Express">
                  <img src="../../dist/img/credit/paypal2.png" alt="Paypal">

                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
                    plugg
                    dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                  </p>
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <p class="lead">Amount Due 2/22/2014</p>

                  <div class="table-responsive">
                    <table class="table" >
                      <tr>
                        <th style="width:50%">Subtotal:</th>
                        <td>$250.30</td>
                      </tr>
                      <tr>
                        <th>Tax (9.3%)</th>
                        <td>$10.34</td>
                      </tr>
                      <tr>
                        <th>Shipping:</th>
                        <td>$5.80</td>
                      </tr>
                      <tr>
                        <th>Total:</th>
                        <td>$265.24</td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                  <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                    Payment
                  </button>
                  <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Generate PDF
                  </button>
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>


  <!-- /.content-wrapper -->
  <x-admin-footer/>

  <script>
    var i = 0;
$('.btn').click(function(){
 i++;
  var $tr    = $(this).closest('.tr_clone');
    var newClass='newClass'+i;
    var $clone = $tr.clone().addClass(newClass);
    $clone.find(':text').val('');
    var $tableBody = $('.repeatRow').find("tbody");
    $trLast = $tableBody.find("tr:last"),
    $trLast.after($clone);
//   var $tableBody = $('.repeatRow').find("tbody"),
// $trLast = $tableBody.find("tr:last"),
// $trNew = $trLast.clone();

// $trLast.after($trNew);
console.log($clone);
})

   
    
  </script>
 