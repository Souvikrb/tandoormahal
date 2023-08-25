<div class="container">
    <!-- Modal -->
    <div class="modal fade cusModal " id="myModal" role="dialog" >
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content pattern1">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" style="font-size: 37px;margin-top: -11px;">&times;</button>
                    <div class="default-form reservation-form account-form pattern1">
                            <h4 class="text-center pt-3 pb-3 text-center">Create New Account</h4>
                            @if($errors->any())
    {!! implode('', $errors->all('<div>:message</div>')) !!}
@endif
                        <form method="post" action="{{url('create-user')}}">
                            @csrf
                            <div class="clearfix">
                                <div class="form-group">
                                    <div class="field-inner">
                                        <input type="text" class="cusField" onkeypress="return /^[a-zA-Z_ ]/i.test(event.key)" name="username" 
                                            placeholder="Your Name" required="">
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="field-inner">
                                        <input type="text" pattern="[0-9]{10}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="10" class="cusField" name="phonenumber" 
                                            placeholder="Phone Number" required="">
                                            <small style="position:absolute" class="text-left">*Please enter your active phone number.</small>
                                    </div>
                                    
                                </div>
                                <div class="form-group ">
                                    <div class="field-inner">
                                        <input type="text" maxlength="15" minlength="4" class="cusField" name="password" placeholder="Password" required="">
                                           
                                    </div>
                                    
                                </div>
                                <div class="form-group">
                                    <div class="field-inner">
                                        <input class="cusField" pattern="[a-zA-Z0-9.-_]{1,}@[a-zA-Z.-]{2,}[.]{1}[a-zA-Z]{2,}" type="email" name="email" 
                                            placeholder="Your Email" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="field-inner">
                                    <select class="cusField l-icon" name="deliveryArea" required>
                                        <option>select area</option>
                                        <option>Rasapunja More</option>
                                        <option>Camp</option>
                                        <option>Nawabad</option>
                                    </select>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <div class="field-inner">
                                        <textarea class="cusField" name="address" placeholder="Full Address"
                                            required=""></textarea>
                                    </div>
                                </div>

                                <div class="form-group text-center">
                                <button  type="submit" class="theme-btn btn-style-one clearfix"
                                                style="background:rgb(0,0,0);color:white!important">
                                                <span class="btn-wrap">
                                                    <span class="text-one " style="color:white!important">Submit</span>
                                                    <span class="text-two">Submit</span>
                                                </span>
                                            </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
               
            </div>

        </div>
    </div>
</div>
