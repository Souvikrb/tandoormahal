<x-frontend-header />
<section class="inner-banner">
    <div class="image-layer" style="background-image: url(<?=URL::to('/');?>/web-resources/images/slider/cart.jpg);">
    </div>
    <div class="auto-container">
        <div class="inner">

        </div>
    </div>
</section>

<section class="contact-page pattern1">
    <!--location Section-->


    <!--Location form Section-->
    <div class="auto-container">
        <div>
            <div class="row clearfix justify-content-md-center">
                <!--form Section-->
                <!--form image Section-->
                <div class="col-lg-6 col-md-12 col-sm-12 col-sm-push-12 col-xs-push-12 menu-tabs">
                    <div class="default-form reservation-form account-form pattern1">
                        <h4 class="text-center pt-3 pb-3 text-center">Create New Account</h4>                   
                        <form method="post" action="{{url('/register/user')}}">
                            @csrf
                            <div class="clearfix">
                                <div class="form-group">
                                    <div class="field-inner">
                                        <input type="text" class="cusField"
                                            onkeypress="return /^[a-zA-Z_ ]/i.test(event.key)" name="username"
                                            placeholder="Your Name*" required="" value="{{old('username')}}">
                                            @error('username')
                                                <small class="error">{{ $message }}</small>
                                            @enderror
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="field-inner">
                                        <input type="text" pattern="[0-9]{10}"
                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                            maxlength="10" class="cusField" name="phonenumber"
                                            placeholder="Phone Number*" required="" value="{{old('phonenumber')}}">
                                            @error('phonenumber')
                                                <small class="error">{{ $message }}</small><br>
                                            @enderror
                                        <small style="position:absolute" class="text-left">*Please enter your active
                                            phone number.</small>
                                    </div>

                                </div>
                                <div class="form-group ">
                                    <div class="field-inner">
                                        <input type="text" maxlength="15" minlength="4" class="cusField" name="password"
                                            placeholder="Password*" required="" value="{{old('password')}}">
                                            @error('password')
                                                <small class="error">{{ $message }}</small>
                                            @enderror

                                    </div>

                                </div>
                                <div class="form-group">
                                    <div class="field-inner">
                                        <input class="cusField"
                                            pattern="[a-zA-Z0-9.-_]{1,}@[a-zA-Z.-]{2,}[.]{1}[a-zA-Z]{2,}" type="email"
                                            name="email" placeholder="Your Email"  value="{{old('email')}}">
                                            @error('email')
                                                <small class="error">{{ $message }}</small>
                                            @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="field-inner">
                                        <select class="cusField " name="deliveryArea" required >
                                            <option>select area*</option>
                                            <option value="Rasapunja More" <?=(old('deliveryArea') == 'Rasapunja More')?'selected':''?>>Rasapunja More</option>
                                            <option <?=(old('deliveryArea') == 'Camp')?'selected':''?> value="Camp">Camp</option>
                                            <option <?=(old('deliveryArea') == 'Other')?'selected':''?> value="Other">Other</option>
                                        </select>
                                        @error('deliveryArea')
                                                <small class="error">{{ $message }}</small>
                                            @enderror
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <div class="field-inner">
                                        <textarea class="cusField" name="address" placeholder="Full Address*"
                                            required="">{{old('address')}}</textarea>
                                            @error('address')
                                                <small class="error">{{ $message }}</small>
                                            @enderror
                                    </div>
                                </div>

                                <div class="form-group text-center">
                                    <button type="submit" class="theme-btn btn-style-one clearfix"
                                        style="background:rgb(0,0,0);color:white!important">
                                        <span class="btn-wrap">
                                            <span class="text-one " style="color:white!important">Register</span>
                                            <span class="text-two">Register</span>
                                        </span>
                                    </button>
                                    <p class="mt-3">Already have an account? <a href="{{route('/login')}}" class="theme-red">Log in</a></p>
                                    <p style="font-size:12px">By creating an account, I accept the Terms & Conditions & Privacy Policy</p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

</section>
<br>
<x-frontend-footer />