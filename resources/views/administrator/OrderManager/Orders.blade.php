<x-admin-header />

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper ">


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row" id="sales_data">
                @if($data->count() != 0)
                @foreach($data as $d)
                   <?php
                    $color = 'danger';
                    $progress_delivery="bg-gray";
                    $progress_finish="bg-gray";
                    if($d->status == 'Processing'){
                        $color = 'danger';
                        $progress="bg-gray";
                    }
                    else if($d->status == 'Delivering'){
                        $color = 'danger';
                        $progress_delivery="bg-primary";
                    }
                    else if($d->status == 'Completed'){
                        $progress_finish="bg-primary";
                        $progress_delivery="bg-primary";
                    } 
                    else if($d->status == 'Cancel'){
                        $color = 'dark';
                    } 
                    ?>
                <div class="col-md-12">
                    <!-- DIRECT CHAT WARNING -->
                    <div class="card card-warning direct-chat direct-chat-warning shadow collapsed-card pattern1">
                        <div class="card-header">
                            <div class="card-tools">
                                <button style="font-size: 10px;font-weight: 700;" type="button" class="btn btn-tool " data-card-widget="collapse">
                                    <span class="text-danger"><i class="fas fa-pin"></i><b>{{$d->username}} ( {{$d->deliveryArea}} ) </b></span><span > {{date('d M, Y  h:i a',strtotime($d->created_at))}}</span> <span class="badge badge-danger badge-plus"><i class="fas fa-plus"></i></span>
                                    
                                </button>
                                
                                <!-- <button type="button" data-card-widget="maximize" class="btn btn-tool" title="Contacts"
                                    data-widget="chat-pane-toggle">
                                    <i class="fas fa-comments"></i>
                                </button> -->
                            </div>
                            <div class="card-title">
                                <div class="row">
                                    <div class="col-md-3 col-3 m-auto text-center">
                                        <img class="badge-image" src="{{asset('storage/products/'.$d->prodImg)}}">
                                        <p class="mt-2"><span class="right badge badge-{{$color}} pt-2 pb-2 badge-status ">{{$d->status}}</span></p>
                                    </div>
                                    <div class="col-md-9 col-9 mt-3">
                                        <b><?=str_replace(',', '', rtrim($d->plist,'<br>'))?> </b>
                                        <br>
                                        
                                    </div>
                                </div>

                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="display: none;">
                            <div class="row p-3">
                                <div class="col-md-12">
                                    <div class="timeline">
                                        <div class="time-label">
                                            <span class="bg-red">{{date('d M, h:i a',strtotime($d->created_at))}}</span>
                                        </div>
                                        <div>
                                            <i class="fas fa-hourglass-start bg-primary"></i>
                                            <div class="timeline-item">
                                                @if($d->status != 'Cancel' && $d->status != 'Completed')
                                                <span class="time text-dark"><b><i class="fas fa-clock"></i>
                                                @php
                                                    $datetime_1 = $d->created_at; 
                                                    $datetime_2 = date('d M, h:i a'); 
 
                                                    $start_datetime = new DateTime($datetime_1); 
                                                    $diff = $start_datetime->diff(new DateTime($datetime_2)); 
                                                    echo $m =  ($diff->d == '0')? '':$diff->d.' days ';
                                                    echo $m =  ($diff->h == '0')? '':$diff->h.' hours ';
                                                    echo $m =  ($diff->i == '0')? '':$diff->i.' mins ago ';

                                                @endphp

                                             </b></span>
                                                @endif
                                                <h3 class="timeline-header"><a href="#" class="text-danger">Your Order</a> is  {{$d->status}}</h3>

                                                <div class="timeline-body">
                                                    <p><?=str_replace(',', '', rtrim($d->plist,'<br>'))?> </p>
                                                    <b>Total Price : <span class="text-danger"> ₹{{$d->sub_total}}</span></b><br>
                                                </div>
                                                 @if($d->status == 'Processing')
                                                <div class="timeline-footer">
                                                    <a class="btn btn-primary btn-sm" onclick="updateOrderStatus('{{$d->bundle}}','Delivering')">Complete</a>
                                                    <a class="btn btn-dark btn-sm" onclick="updateOrderStatus('{{$d->bundle}}','Cancel')">Cancel</a>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        @if($d->status != 'Cancel')
                                        <div>
                                            <i class="fas fa-bicycle {{$progress_delivery}}"></i>
                                            <div class="timeline-item">
                                                <!-- <span class="time"><i class="fas fa-clock"></i> 5 mins ago</span> -->
                                                <h3 class="timeline-header no-border "><a href="#" class="text-danger">Tandoor Mahal</a> is delivering this order</h3>
                                                @if($d->status != 'Completed')
                                                    @if($d->status != 'Processing')
                                                        <div class="timeline-footer">
                                                            <a class="btn btn-primary btn-sm" onclick="updateOrderStatus('{{$d->bundle}}','Completed')">Delivery Complete</a>
                                                        </div>
                                                    @else
                                                        <div class="timeline-footer">
                                                            <a class="btn btn-danger btn-sm disabled">Waiting</a>
                                                        </div>
                                                    @endif
                                                @endif
                                            </div>
                                            
                                        </div>
                                        @if($d->status != 'Completed')
                                        <div class="time-label">
                                            <span class="bg-green">Expected : 45min</span>
                                        </div>
                                        @endif
                                        <div>
                                            <div class="timeline-item">
                                                <!-- <span class="time"><i class="fas fa-clock"></i> 5 mins ago</span> -->
                                                <h3 class="timeline-header no-border"><a href="#" class="text-danger">{{$d->username}}</a> have placed this order.</h3>
                                                <div class="timeline-body">
                                                    <b>Phone No. :</b> {{$d->phonenumber}} <br>
                                                    @if($d->altPhonenumber != '')
                                                    <b>Alt Phone No. :</b> {{$d->altPhonenumber}}  <br>
                                                    @endif
                                                    <b>Delivery Area :</b> {{$d->deliveryArea}}<br>
                                                    <b>Address :</b> {{$d->address}}
                                                </div>
                                                @if($d->status != 'Completed')
                                                <div class="timeline-footer">
                                                    <a class="btn btn-primary btn-sm" onclick="updateOrderStatus('{{$d->bundle}}','Completed')">Payment Complete</a>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div>
                                            <i class="fas fa-flag-checkered {{$progress_finish}}"></i>
                                        </div>
                                        @else
                                        <div>
                                            <i class="fas fa-ban bg-danger"></i>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="direct-chat-contacts">
                                <div class="direct-chat-messages">
                                    <div class="direct-chat-msg">
                                        <div class="direct-chat-infos clearfix">
                                            <span class="direct-chat-name float-left">Alexander Pierce</span>
                                            <span class="direct-chat-timestamp float-right">23 Jan 2:00 pm</span>
                                        </div>
                                        <img class="direct-chat-img" src="../dist/img/user1-128x128.jpg"
                                            alt="Message User Image">
                                        <div class="direct-chat-text">
                                            Is this template really for free? That's unbelievable!
                                        </div>
                                    </div>
                                    <div class="direct-chat-msg right">
                                        <div class="direct-chat-infos clearfix">
                                            <span class="direct-chat-name float-right">Sarah Bullock</span>
                                            <span class="direct-chat-timestamp float-left">23 Jan 2:05 pm</span>
                                        </div>
                                        <img class="direct-chat-img" src="../dist/img/user3-128x128.jpg"
                                            alt="Message User Image">
                                        <div class="direct-chat-text">
                                            You better believe it!
                                        </div>
                                    </div>
                                    <form action="#" method="post">
                                        <div class="input-group">
                                            <input type="text" name="message" placeholder="Type Message ..."
                                                class="form-control">
                                            <span class="input-group-append">
                                                <button type="submit" class="btn btn-warning">Send</button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer" style="display: none;">
                            
                        </div>
                        <!-- /.card-footer-->
                    </div>
                    <!--/.direct-chat -->
                </div>
                @endforeach
                @endif
            </div>
        </div>
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
            <form id="modalSaleForm" method="post" action="" enctype="multipart/form-data">
                <div class="modal-body">

                    <input type="hidden" id="sId" name="sId">
                    @csrf
                    <x-forms.add-sale />

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Edit Data</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- /.content-wrapper -->

<script type="text/javascript" src="{{asset('dist/js/order.js')}}"></script>
<x-admin-footer />