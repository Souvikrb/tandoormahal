<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\cart;
use Session;
use App\Models\order;
class CartController extends Controller
{

    public function index()
    {   
        $userId = $this->getUserId();
        //echo $userId;die;
        //$cart = cart::where('userid',$userId)->get();
        $cart = cart::select("products.product as productname","products.prodImg","products.slPrice","products.halfPrice","products.tags","carts.*",'products.id as prodid')->join("products","products.id","=","carts.product")->where('carts.userId',$userId)->where('carts.count','!=','0')->get();
        // echo '<pre>';
        // print_r($cart);die;
        return view('frontend/cart')->with('cartdata',$cart);
    }
    public function addtoCart(Request $request){
        $id = $request->id;
        $type = $request->type;
        $hIdx = ($request->hIdx == '')?' ':$request->hIdx;
        $userId = $this->getUserId();
        $data = cart::where(array('userid'=>$userId,'product'=>$id))->first();
        $objs = new cart();
        if(!empty($data)):
            $count = $data->count;
            if($type == 'add'){
                $count++;
            }else if($type == 'remove'){
                $count--;
            }

            if($count > 0){
                cart::where(array('userid'=>$userId,'product'=>$id))->update(array('count' => $count,'isHalf' => $hIdx));
            }else{
                cart::where(array('userid'=>$userId,'product'=>$id))->delete();
            }
            
            
           $cart_count = cart::where('userid',$userId)->count();
            echo json_encode(array('count'=>$count,'cart_count'=>$cart_count));
        else: 
            
            $objs['userid']   = $userId;
            $objs['product']  = $id;
            $objs['count']    = 1;
            $objs['isHalf']   = $hIdx;
            $objs->save();
            $cart_count = cart::where('userid',$userId)->count();
            echo json_encode(array('count'=>'1','cart_count'=>$cart_count));
        endif;
        
    }

    public function addHalf(Request $request){
        $id = $request->id;
        $hIdx = $request->hIdx;
        $userId = $this->getUserId();
        $data = cart::where(array('userid'=>$userId,'product'=>$id))->first();
        $objs = new cart();
        if(!empty($data)):
            cart::where(array('userid'=>$userId,'product'=>$id))->update(array('isHalf' => $hIdx));
        endif;
        echo json_encode(array('status'=>'success'));
        
    }


    public function orderSubmit(Request $request)
    {  
        
        $userId = Session::get('userId');
        if($userId == ''){
            setcookie('placeOrder', '1', time() + (60 * 30), "/");
            return redirect('/login');
        }else{
            
                $cartData = cart::where('userId',$userId)->get();
                $bundle = $userId.'-'.rand(10,100);
                foreach($cartData as $c){
                    if($c->count > 0){
                        $orderObj = new order();
                        $orderObj['userid']      = $userId;
                        $orderObj['product']     = $c->product;
                        $orderObj['count']       = $c->count;
                        $orderObj['isHalf']      = $c->isHalf;
                        $orderObj['bundle']      = $bundle;
                        $orderObj['mode']        = 'COD';
                        $orderObj['status']      = 'Processing';
                        $orderObj->save();
                    }
                    
                }
                cart::where('userid',$userId)->delete();
                setcookie('placeOrder','', time() + (60 * 30), "/");
                return redirect('/user/order');
        }
    }
}
