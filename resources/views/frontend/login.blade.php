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
                        <h4 class="text-center pt-3 pb-3 text-center">Log In</h4>   
                        @error('loginerror')
                            <p class="error text-center">{{ $message }}</p>
                        @enderror
                        <form method="post" action="{{route('/user/login')}}">
                            @csrf
                            <div class="clearfix">
                                <div class="form-group ">
                                    <div class="field-inner">
                                        <input type="text" pattern="[0-9]{10}"
                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                            maxlength="10" class="cusField" name="phonenumber"
                                            placeholder="Phone Number*" required="" value="{{old('phonenumber')}}">
                                            @error('phonenumber')
                                                <small class="error">{{ $message }}</small><br>
                                            @enderror
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="field-inner">
                                        <input type="password" maxlength="15" minlength="4" class="cusField" name="password"
                                            placeholder="Password*" required="" value="{{old('password')}}">
                                            @error('password')
                                                <small class="error">{{ $message }}</small>
                                            @enderror

                                    </div>

                                </div>

                                <div class="form-group text-center">
                                    <button type="submit" class="theme-btn btn-style-one clearfix"
                                        style="background:rgb(0,0,0);color:white!important">
                                        <span class="btn-wrap">
                                            <span class="text-one " style="color:white!important">Login</span>
                                            <span class="text-two">Login</span>
                                        </span>
                                    </button>
                                    <p class="mt-3">New to Tandoor Mahal? <a href="{{route('/register')}}" class="theme-red">Create account</a></p>
                                    <p style="font-size:12px">By clicking on Login, I accept the Terms & Conditions & Privacy Policy</p>
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