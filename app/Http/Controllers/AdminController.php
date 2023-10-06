<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    
    public function loginAdmin(){
     
        return view('admin.login');
    }
    public function postLoginAdmin(Request $request){
        
        $remeber = $request->has(key:'remember_me') ? true : false;
if(auth()->attempt([
    'email' => $request->txtName,
    'password' => $request->txtPass
],$remeber)){
return redirect()->to(path:'home');
}else{
    echo "<script>alert('Tài khoản hoặc mật khẩu không đúng')</script>";
    return redirect()->route(route:'back');
}
    }
}
