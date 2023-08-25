<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Crypt;
use Session;
class Controller extends BaseController
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        
        
    }
    public function getUserId(){
        if(Session::has('userId')){
            $tempId = $this->encrypt(Session::get('userId'));
        }else if(isset($_COOKIE['tempId'])) {
            $tempId = $_COOKIE['tempId'];
        }
        
        if(!isset($_COOKIE['tempId'])) {
            $tempId = $this->encrypt('user'.rand(10,1000000));
            setcookie('tempId', $tempId, time() + (60 * 30), "/");
            return $this->decrypt($tempId);
        }else{
            return $this->decrypt($tempId);
        }

    }

    public function encrypt($val){
        return  Crypt::encryptString($val);
    }

    public function decrypt($val){
        return Crypt::decryptString($val);
    }


}
