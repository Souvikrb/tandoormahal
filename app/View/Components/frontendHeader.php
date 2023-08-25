<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Session;
use Illuminate\Support\Facades\Crypt;
use App\Models\cart;
class frontendHeader extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        
        
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        if(Session::has('userId')){
            $tempId = Session::get('userId');
        }else if(isset($_COOKIE['tempId'])) {
            $tempId = Crypt::decryptString($_COOKIE['tempId']);
        }else{
            $tempId = 'user'.rand(10,1000000);
            setcookie('tempId', Crypt::encryptString($tempId), time() + (60 * 30), "/");
        }
        $cart = cart::where('userid',$tempId)->count();
        Session::put('cart_count',$cart);
        return view('components.frontend-header')->with(array('cart_count'=>$cart));
    }
}
