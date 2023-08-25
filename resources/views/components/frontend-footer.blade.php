<!--Main Footer-->

<footer class="main-footer">
        <div class="image-layer" style="background-image:url('{{asset('web-resources/images/slider/slider1.jpg')}}');"></div>
        <div class="upper-section">
            <div class="auto-container">
                <div class="row clearfix">
                    <!--Footer Col-->
                    <div class="footer-col info-col col-lg-6 col-md-12 col-sm-12">
                        <div class="inner wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                            <div class="content">
                                <div class="logo"><a href="index.html" ><img src="{{asset('web-resources/images/logo.png')}}" alt="" ></a></div>
                                <div class="info">
                                    <ul>
                                        <li>Rasapunja More, Kolkata - 70010411</li>
                                        <li><a href="mailto:booking@domainname.com">enquiry@tandoormahal.in</a></li>
                                        <li><a href="tel:+917980667658">Booking Request : +91 7980667658</a></li>
                                    </ul>
                                </div>
                           
                            </div>
                        </div>
                    </div>
                    <!--Footer Col-->
                    <div class="footer-col links-col col-lg-3 col-md-6 col-sm-12">
                        <div class="inner wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                            <ul class="links">
                                <li><a href="home.html">Home</a></li>
                                <li><a href="menu-list-1.html">Menus</a></li>
                                <li><a href="about.html">About us</a></li>
                                <li><a href="our-chef.html">Our chefs</a></li>
                                <li><a href="contact-us.html">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                    <!--Footer Col-->
                    <div class="footer-col links-col last col-lg-3 col-md-6 col-sm-12">
                        <div class="inner wow fadeInRight" data-wow-delay="0ms" data-wow-duration="1500ms">
                            <img class="social-icon" src="{{asset('web-resources/images/icons/facebook.svg')}}">
                            <img class="social-icon" src="{{asset('web-resources/images/icons/instagram.svg')}}">
                            <img class="social-icon" src="{{asset('web-resources/images/icons/linkedin.svg')}}">
                            <img class="social-icon" src="{{asset('web-resources/images/icons/youtube.svg')}}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="auto-container">
                <div class="copyright">&copy; <?=date('Y')?>. All Rights Reserved   |    Crafted by <a href="#" target="blank">Tandoor Mahal</a></div>
            </div>
        </div>
         <div class="cart-popsec <?=(Session::get('cart_count') < 1)?'div-none':''?>" >
            <div class="main-col " style="padding-top: 5px;">
                <i class="fa fa-shopping-cart"></i>
                <b>&nbsp;&nbsp;{{Session::get('cart_count')}}&nbsp; ITEMS ADDED</b>
            </div>
            
            <div class="btn-col" style="padding-top: 5px;"><a href="{{route('/cart')}}" class="btn btn-danger">Next</a>
                <span class="ml-2 remove-cartpopup"><i class="fa fa-times cart-remove-icon"></i></span>
            </div>
        </div>

        <div class="foot-call">

            <div class="col border-right"><a href="https://api.whatsapp.com/send?phone=9123345052&amp;text=Hello" target="_blank"><img src="https://img.icons8.com/color/30/000000/whatsapp.png" alt="Whatsapp Us - axisclinics"></a></div>
            <div class="col border-right" style="padding-top: 5px;"><a href="javascript:void(0)" style="color:white" class="filter"><i style="font-size: 24px;" class="fa fa-filter-list"></i></a></div>
            <div class="col border-right" style="padding-top: 5px;"><a href="{{route('/cart')}}" style="color:white"><i style="font-size: 24px;" class="fa fa-shopping-cart"></i><span class="badge badge-dark cart-badge">1</span></a></div>
            <div class="col" style="padding-top: 5px;"><a href="{{route('/user/order')}}" style="color:white"><i style="font-size: 24px;" class="fa fa-user"></i></a></div>
        </div>
    </footer>

</div>
<!--End pagewrapper--> 

<!--Scroll to top-->
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="icon fa fa-angle-up"></span></div>


<script src="{{asset('web-resources/js/popper.min.js')}}" ></script>
<script src="{{asset('web-resources/js/bootstrap.min.js')}}" ></script>
<script src="{{asset('web-resources/js/jquery-ui.js')}}" ></script>
<script src="{{asset('web-resources/js/jquery.fancybox.js')}}" ></script>
<script src="{{asset('web-resources/js/swiper.js')}}" ></script>
<script src="{{asset('web-resources/js/owl.js')}}" ></script>
<script src="{{asset('web-resources/js/appear.js')}}" ></script>
<script src="{{asset('web-resources/js/wow.js')}}" ></script>
<script src="{{asset('web-resources/js/parallax.min.js')}}" ></script>
<script src="{{asset('web-resources/js/custom-script.js')}}"></script>
<script src="{{asset('web-resources/js/myscript.js')}}"></script>
</body>


</html>