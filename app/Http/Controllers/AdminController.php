<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();
class AdminController extends Controller
{
    public function index(){
        return view('admin_login');
       
    }

 
    public function dashboard(Request $request){
        $admin_email = $request->admin_email;
        $admin_password = md5($request->admin_password);
        $result = DB::table('tbl_admin')
                  ->where('admin_email',$admin_email)
                  ->where('admin_password',$admin_password)
                  ->first();
                  if($result){
                      Session::put('admin_name',$result->admin_name);
                      Session::put('admin_id',$result->admin_id);
                      
                      return redirect('/dashboard');
                  }
        
                 else{
                    Session::put('message','Email or password invalid!');
                    return redirect('/admin');
                }
                     

       
    }


}
