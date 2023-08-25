<x-frontend-header />


<!-- Inner Banner Section -->
<section class="inner-banner home-banner">
    <div class="image-layer"
        style="background-image: url({{asset('web-resources/images/slider/slider1.jpg')}});background-position: bottom;">
    </div>
    <div class="auto-container">
        <div class="inner">
            <div>
                <form method="get" action="#" id="filterForm">
                    <div class="form-group" style="text-align: left;">
                        <span class="s-info tag-badge " data-slug="">Recomanded</span>

                        <input type="hidden" name="cat_val" id="cat_val">
                        <input type="text" class="search-field" autocomplete="off" list="menulist" name="dish" value=""
                            placeholder="Find anythings">
                        <datalist id="menulist">
                            <option value="Tandoor">
                        </datalist>
                        <button type="submit" class="search-btn">
                            <span class="btn-wrap">
                                <span class="text-one"><i class="fa fa-search"></i></span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!--End Banner Section -->

<!--Menu Section-->
<section class="menu-section pattern1">

    <div class="auto-container">

        <div class="tabs-box menu-tabs">

            <div class="tabs-content">
                <!--Tab-->

                <div class="row clearfix">
                    @if(!empty($products))
                        @foreach($products as $p)
                        @php 
                            if($p->type == 'Non-Veg'):
                                $Taglogo = 'nonveg-logo.png';
                            else:
                                $Taglogo = 'veg-logo.png';
                            endif;
                        @endphp
                        <div class="menu-col col-lg-6 col-md-12 col-sm-12" >
                        <!--Block-->
                            <div class="dish-block">
                                <div class="inner-box" id="prod-sec{{$p->id}}">
                                    <div class="dish-image">
                                        <a href="javascript:void(0)">
                                            <img src="{{asset('storage/products/'.$p->prodImg)}}"
                                                alt="">
                                        </a>
                                        <div class="cart-sec prod{{$p->id}}" >
                                            @if( $p->count < '1')
                                                <button class="btn cart-btn" onclick="add_to_cart('{{$p->id}}','add')">ADD</button>
                                            @else
                                                <button class="btn addbtn "><span onclick="add_to_cart('{{$p->id}}','remove')" class="minus">-</span><span class="count">{{$p->count}}</span><span class="plus" onclick="add_to_cart('{{$p->id}}','add')">+</span></button>
                                            @endif
                                        </div>
                                    </div>
                                    @if($p->tags != '')
                                        <div class="bestsellerWrap">
                                            <span class="bestsellerleft"></span>{{$p->tags}}
                                            <span class="bestsellerright" style=""></span>
                                        </div>
                                    @endif
                                    <div class="title clearfix">
                                        <input type="hidden" class="halfPrice" value="{{$p->halfPrice}}">
                                        <input type="hidden" class="rgPrice" value="{{$p->rgPrice}}">
                                        <input type="hidden" class="slPrice" value="{{$p->slPrice}}">
                                        <div class="ttl clearfix">
                                            <h5>
                                                <a href="javascript:void(0)"><img src="{{asset('web-resources/images/'.$Taglogo)}}" width="13px">&nbsp;&nbsp;<?=$p->product?>
                                                
                                                
                                                <!-- <span class="s-info">Best Choice</span> -->
                                                </a>
                                                @if($p->halfPrice != '' && $p->halfPrice > 0)
                                                <div class="custom-control custom-switch mt-2">
                                                  <input type="checkbox" <?=($p->isHalf == 'half' && $p->count != '0')?'checked':''?> class="custom-control-input" data-id="{{$p->id}}" id="customSwitch{{$p->id}}">
                                                    <label class="custom-control-label " for="customSwitch{{$p->id}}"> half</label>
                                                </div>
                                                @endif

                                            </h5>
                                        </div>
                                        <div class="price">
                                            @if($p->isHalf == 'half')
                                                <span class="text-danger">₹{{$p->halfPrice}}</span> 
                                            @else
                                                @if($p->rgPrice != '' && $p->rgPrice > 0)
                                                <small><del >₹{{$p->rgPrice}}</del></small>
                                                @endif
                                                <span class="text-danger">₹{{$p->slPrice}}</span> 
                                            @endif
                                            
                                        </div>
                                    </div>
                                    <div class="text desc">
                                        <a href="javascript:void(0)">
                                            <p>{{$p->description}}</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endif;

            </div>

            <!--Tab-->
        </div>
    </div>
    </div>
</section>
<script>


function add_to_cart(id,type){
    var hIdx = ' ';
    if($('#prod-sec'+id+' .title .custom-control-input').is(":checked")){
         hIdx = 'half';
    }
    $.ajax({
        url: '{{ url('/cart/add') }}',
        type: 'POST',              
        data: {'id':id,'type':type,'hIdx':hIdx},
        dataType: 'JSON',
        success: function(result)
        {
            if(result.count > 0){
                $('.prod'+id).html('<button class="btn addbtn "><span onclick="add_to_cart('+"'"+id+"'"+","+"'remove'"+')"  class="minus">-</span><span class="count">'+result.count+'</span><span class="plus" onclick="add_to_cart('+"'"+id+"'"+","+"'add'"+')">+</span></button>');

                $('.cart-pack').html('<i class="fa fa-shopping-cart"></i><span class="badge badge-danger cart-badge">'+result.cart_count+'</span>');
                
            }
            if(result.count < 1){
                $('.prod'+id).html('<button onclick="add_to_cart('+"'"+id+"'"+","+"'add'"+')" class="btn cart-btn" >ADD</button>');
                $('.cart-pack').html('<i class="fa fa-shopping-cart"></i>');
                
            }

            if(result.cart_count > 0){
                $('.cart-popsec .main-col b').text(result.cart_count+' ITEMS ADDED');
                $('.cart-popsec').show('1000');
            }else{
                $('.cart-popsec').hide('1000');
            }
        
        }
    });
}

$('.title .custom-control-input').change(function(){
    var hprice =  $(this).parent().parent().parent().parent().find('.halfPrice').val();
    var sprice =  $(this).parent().parent().parent().parent().find('.slPrice').val();
    var rprice =  $(this).parent().parent().parent().parent().find('.rgPrice').val();
    var id = $(this).data('id');
    if($(this).is(":checked")){
        var hIdx = 'half';
        var c = $(this).parent().parent().parent().parent().find('.price').html('<span class="text-danger">₹'+hprice+'</span>');
    }else{
        var hIdx = ' ';
        var c = $(this).parent().parent().parent().parent().find('.price').html('<small><del>₹'+rprice+'</del></small><span class="text-danger">₹'+sprice+'</span>');
    }

    $.ajax({
        url: '{{ url('/cart/add/half') }}',
        type: 'POST',              
        data: {'id':id,'hIdx':hIdx},
        dataType: 'JSON',
        success: function(result)
        {
            
        }
    });
})

</script>

<x-frontend-footer />