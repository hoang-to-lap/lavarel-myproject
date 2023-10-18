<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
session_start();

class AdminController extends Controller
{
    //
    
//     public function loginAdmin(){
     
//         return view('admin.login');
//     }
//     public function postLoginAdmin(Request $request){
        
//         $remeber = $request->has(key:'remember_me') ? true : false;
// if(auth()->attempt([
//     'email' => $request->txtName,
//     'password' => $request->txtPass
// ],$remeber)){
// return redirect()->to(path:'home');
// }else{
//     echo "<script>alert('Tài khoản hoặc mật khẩu không đúng')</script>";
//     return redirect()->route(route:'back');
// }
//     }

public function showhome(){
    $this->AuthLog();
    return view('home');
}
public function AuthLog(){
    $admin_id = Session::get('id');
    if($admin_id){
        return redirect()->to(path:'home');
    }else{
        return redirect()->route(route:'back')->send();
    }
}

public function loginAdmin(){
 
    return view('admin.login');
}
public function postLoginAdmin(Request $request){
    
    $admin_name = $request->txtName;
    $admin_pass = md5($request->txtPass);
    $result = DB::table('admin1')->where('name' , $admin_name)->where('password' , $admin_pass)->first();
   if($result){
Session::put('name',$result->name);
Session::put('id',$result->id);
return redirect()->to(path:'home');
   }
   else{
    echo "<script>alert('Tài khoản hoặc mật khẩu không đúng')</script>";
    return redirect()->route(route:'back');
   }
}
public function logoutAdmin(){
    $this->AuthLog();
    Session::put('name',null);
    Session::put('id',null);
    return redirect()->route(route:'back');
}
}
