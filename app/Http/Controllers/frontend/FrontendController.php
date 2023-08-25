<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;
class FrontendController extends Controller
{
    public function __construct()
    {

        // if(Session::has('userId')){
        //     $tempId = Session::get('userId');
        //     setcookie('tempId', $this->encrypt($tempId), time() + (60 * 30), "/");
        // }else{
        //     $tempId = $this->encrypt('user'.rand(10,1000000));
        //     if(!isset($_COOKIE['tempId'])) {
        //         setcookie('tempId', $tempId, time() + (60 * 30), "/");
        //     } 
        // }
        //echo $this->decrypt($tempId);die;
  
        
        
    }
    public function index()
    {
        //print_r(Session::all());die;
        
        $userId = $this->getUserId();
        $product = DB::select("SELECT p.*,c.count,c.isHalf FROM `products` p left join carts c on p.id = c.product and c.userId = '$userId' order by p.id");	
        //$product = product::select("products.*","carts.count")->leftJoin("carts","products.id","=","carts.product",'carts.tempId',"=",'www')->get();
        return view('frontend/index')->with('products',$product);
    }


}
