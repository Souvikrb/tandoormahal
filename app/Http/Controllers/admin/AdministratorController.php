<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Session;
class AdministratorController extends Controller
{
   
    public function index()
    {
       
        return view('administrator/dashboard');
    }

    public function login()
    {
     
        return view('administrator/login');
    }

    public function login_save(Request $request)
    {
        $validation = $request->validate([
            'phone'    => 'required|numeric',
            'password' => 'required'
        ]);
        $data = user::where('phone',$request->phone)->first();
        if(!empty($data)){
            if($request->password == $this->decrypt($data->password)){
                Session::put('adminId', $data->id);
                return redirect('/administrator')->withErrors(array('successMessage'=>'Your are successfully logged in.'));
            }else{
                return redirect('/admin/login')->withErrors(array('loginerror'=>'Your credentials is incorrect.'));
            }
        }else{
            return redirect('/admin/login')->withErrors(array('loginerror'=>'Your don\'t have an account.'));
        }
        
    }

    public function logout(){
        Session::forget('adminId');
        Session::forget('username');
        setcookie('tempId','', time() + (60 * 30), "/");
        return redirect('/admin/login');
    }

}
