<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\customer;
use App\Models\cart;
use App\Models\order;
use Illuminate\Support\Facades\Crypt;
use DB;
use Session;


class UserController extends Controller
{
    public function createUser()
    {
        
        return view('frontend/registration');
    }

    public function login()
    {
        
        return view('frontend/login');
    }

    public function registerUser(Request $request)
    {
        $userId = $this->getUserId();

        /* Create new customer ==============*/
        $validated = $request->validate([
            'username'     => 'required',
            'phonenumber'  => 'required|numeric|unique:customers',
            'password'     => 'required',
            'deliveryArea' => 'required',
            'address'      => 'required',
        ]);
        $data = new customer();
        $data['uniqueId']      = $userId ;
        $data['username']      = $request->username;
        $data['phonenumber']   = $request->phonenumber;
        $data['password']      = $this->encrypt($request->password);
        $data['email']         = $request->email;
        $data['deliveryArea']  = $request->deliveryArea;
        $data['address']       = $request->address;
        $data->save();

        /* Data transfer cart to order table ==============*/
        $customer_id = $userId;
        Session::put(array('userId'=>$customer_id,'username'=>$request->username));
        setcookie('tempId', $this->encrypt($customer_id), time() + (60 * 30), "/");
        $placeOrder = 0;
        if(isset($_COOKIE['placeOrder'])){
            $placeOrder = $_COOKIE['placeOrder'];
        }
        
        if($placeOrder == '1'){
            $cartData = cart::where('userId',$userId)->get();
            $bundle = $userId.'-'.rand(10,100);
            foreach($cartData as $c){
                // $orderObj[] = array('userid'=>$c->userid,'product'=>$c->product,'count'=>$c->count,'mode'=>'COD','status'=>'Processing');
                if($c->count > 0){
                    $orderObj = new order();
                    $orderObj['userid']      = $customer_id;
                    $orderObj['product']     = $c->product;
                    $orderObj['count']       = $c->count;
                    $orderObj['isHalf']      = $c->isHalf;
                    $orderObj['bundle']      = $bundle;
                    $orderObj['mode']        = 'COD';
                    $orderObj['status']      = 'Processing';
                    $orderObj->save();
                }
                
            }
            //DB::table('orders')->insert($orderObj);

            /* Delete cart data ==============*/
            cart::where('userid',$userId)->delete();
            setcookie('placeOrder','', time() + (60 * 30), "/");
        }
        
        return redirect('/user/order');
    }

    public function loginUser(Request $request)
    {

        /* Create new customer ==============*/
        $validated = $request->validate([
            'phonenumber'  => 'required|numeric',
            'password'     => 'required',
        ]);

        $data = customer::where(array('phonenumber'=>$request->phonenumber))->first();
        if($data){
            if($request->password == $this->decrypt($data->Password)){
                Session::put(array('userId'=>$data->uniqueId,'username'=>$data->username));
                setcookie('tempId', $this->encrypt($data->uniqueId), time() + (60 * 30), "/");
                /* Data transfer cart to order table ==============*/
                $customer_id = $data->uniqueId;
                $cookieId = Crypt::decryptString($_COOKIE['tempId']);
                $placeOrder = 0;
                if(isset($_COOKIE['placeOrder'])){
                    $placeOrder = $_COOKIE['placeOrder'];
                }
                if($placeOrder == '1'){
                    $cartData = cart::where('userId',$cookieId)->get();
                    $bundle = $customer_id.'-'.rand(10,100);
                    foreach($cartData as $c){
                        // $orderObj[] = array('userid'=>$c->userid,'product'=>$c->product,'count'=>$c->count,'mode'=>'COD','status'=>'Processing');
                        if($c->count > 0){
                            $orderObj = new order();
                            $orderObj['userid']      = $customer_id;
                            $orderObj['product']     = $c->product;
                            $orderObj['count']       = $c->count;
                            $orderObj['isHalf']      = $c->isHalf;
                            $orderObj['bundle']      = $bundle;
                            $orderObj['mode']        = 'COD';
                            $orderObj['status']      = 'Processing';
                            $orderObj->save();
                        }
                    }
                    //DB::table('orders')->insert($orderObj);

                    /* Delete cart data ==============*/
                    cart::where('userid',$cookieId)->delete();
                    setcookie('placeOrder','', time() + (60 * 30), "/");
                    return redirect('/user/order');
                }
                return redirect('/');
            }else{
                return redirect('/login')->withErrors(array('loginerror'=>'Your credentials is incorrect'));
            }
            
        }else{
            return redirect('/login')->withErrors(array('loginerror'=>'Your credentials is incorrect'));
        }
     

        /* Data transfer cart to order table ==============*/
        // $customer_id = $data->id;
        // Session::put('userId', $data->id);
        // $userId = $this->getUserId();
        // $cartData = cart::where('userId',$userId)->get();
       
        // foreach($cartData as $c){
        //     $orderObj = new order();
        //     $orderObj['userid']      = $customer_id;
        //     $orderObj['product']     = $c->product;
        //     $orderObj['count']       = $c->count;
        //     $orderObj['mode']        = 'COD';
        //     $orderObj['status']      = 'Processing';
        //     $orderObj->save();
            
        // }

        /* Delete cart data ==============*/
        // cart::where('userid',$userId)->delete();
        // return redirect('/administrator');
    }

    public function logout(){
        Session::forget('userId');
        Session::forget('username');
        setcookie('placeOrder','', time() + (60 * 30), "/");
        setcookie('tempId','', time() + (60 * 30), "/");
        return redirect('/');
    }

    public function order(){
        $userId = $this->getUserId();

        $orderdata = order::select("orders.id","orders.mode","orders.bundle","orders.count as qunt","orders.status","orders.created_at","p.product as product_name","p.slPrice","p.prodImg","p.type","c.username","c.phonenumber","c.altPhonenumber","c.deliveryArea","c.address",DB::raw("(select GROUP_CONCAT(CONCAT(o.count,' x ',pp.product, CASE WHEN o.isHalf = 'half' THEN ' ( Half )' ELSE '' END,'<br>')) from orders o left join products pp on o.product = pp.id where o.bundle = orders.bundle  ) as plist"),DB::raw("( select sum(o.count* CASE WHEN o.isHalf = 'half' THEN pp.halfPrice ELSE pp.slPrice END ) from orders o left join products pp on o.product = pp.id where o.bundle = orders.bundle  ) as sub_total")  )->leftJoin("products as p","orders.product","=","p.id")->leftJoin("customers as c","orders.userid","=","c.uniqueId")->where('orders.userid',$userId)->groupBy('orders.bundle')->get();
        // echo '<pre>';
        // print_r($orderdata);die;
 
        return view('frontend/dashboard/order')->with(array('data'=>$orderdata));
    }

    public function profile()
    {
        $userId = $this->getUserId();
        $data = customer::where(array('uniqueId'=>$userId))->first();
        return view('frontend/dashboard/profile')->with(array('customer_data'=>$data));
    }

    public function user_update(Request $request)
    {
        $userId = $this->getUserId();

        /* Create new customer ==============*/
        $validated = $request->validate([
            'username'     => 'required',
            'phonenumber'  => 'required|numeric',
            'deliveryArea' => 'required',
            'address'      => 'required',
            
        ]);

        customer::where('uniqueId', $userId)
        ->update(['username' => $request->username,'phonenumber' => $request->phonenumber,'deliveryArea' => $request->deliveryArea,'address' => $request->address,'email' => $request->email]);
        return redirect('/user/profile');
    }






}
