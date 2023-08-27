<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\cart;
class FrontendController extends Controller
{
    public function __construct()
    {
       
        $tempId = $this->getUserId();
        $cart = cart::where('userid',$tempId)->count();
        Session::put('cart_count',$cart);
  
    }
    public function index(Request $request)
    {
        //print_r(Session::all());die;
        $userId = $this->getUserId();
        $cart = cart::where('userid',$userId)->count();
        Session::put('cart_count',$cart);
        $search = '';
        if(isset($_GET['s'])){
            $search = $_GET['s'];
        }
        
        $product = DB::select("SELECT p.*,c.count,c.isHalf FROM `products` p left join carts c on p.id = c.product and c.userId = '$userId' where p.product like '%$search%'  order by p.id  ");	
        //$product = product::select("products.*","carts.count")->leftJoin("carts","products.id","=","carts.product",'carts.tempId',"=",'www')->get();
        return view('frontend/index')->with('products',$product);
    }


}
