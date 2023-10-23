<?php

namespace App\Http\Controllers;

use App\Models\account;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
session_start();
class HomeController extends Controller
{
    //

    private $account;
    public function __construct(account $account){
     
        $this->account = $account;
    }
    //trang home
    public function index(){
        $categories = Category::where('parent_id',0)->get();
        $menus = Menu::where('parent_id',0)->get();
        $product  = Product::Latest()->take(8)->get();
        return view('shop.homeshop' , compact('categories','menus','product'));
    }
    //List ra tat ca san pham
    public function shop(){
        $categories = Category::where('parent_id',0)->get();
        $menus = Menu::where('parent_id',0)->get();
        $product  = Product::Latest()->paginate(6);
        return view('shop.component.productshop' , compact('categories','menus','product'));
    }

    //trang chi tiet san pham
    public function detail($id){
        $categories = Category::where('parent_id',0)->get();
        $menus = Menu::where('parent_id',0)->get();
        $product = Product::find($id);
        return view('shop.component.productdetail' , compact('categories','menus','product'));
    }
    //search san pham
  public function search(Request $request){
$categories = Category::where('parent_id',0)->get();
$menus = Menu::where('parent_id',0)->get();
$keyword = $request->txtKeyword;
$data = $keyword;
$keyword = str_replace(' ','%',$keyword);
$product = Product::where('name','like','%'.$keyword.'%')->paginate(6);
return view('shop.component.searchproduct' , compact('categories','menus','product','data'));
  }

  //dan toi trang dang ki dang nhap
  public function login(){
    $categories = Category::where('parent_id',0)->get();
$menus = Menu::where('parent_id',0)->get();
    return view('user.dangnhap',compact('categories','menus'));
  }
  public function dangki(){
    $categories = Category::where('parent_id',0)->get();
$menus = Menu::where('parent_id',0)->get();
    return view('user.dangki',compact('categories','menus'));
  }
  //Dang ki tai khoan
  public function createaccount(Request $request){
$data = $request->validate([
  'user_name' => 'required|unique:accounts|max:100',
  'email' => 'required|unique:accounts|max:100',
  'password' => 'required|required_with:repassword|same:password|max:100',
  'repassword' => 'required|same:password|max:100',
  'number_phone' => 'required|max:100',
  'fullname' => 'required|max:100'

],
[
  'user_name.unique' => 'Tài khoản này đã tồn tại, vui lòng nhập tên khác',
  'email.unique' => 'Email này đã tồn tại , vui lòng nhập email khác',
  'user_name.required' => 'Username không được để trống',
  'email.required' => 'Email không được để trống',
  'password.required' => 'Password không được để trống',
  'repassword.same' => 'Password không giống nhau , Vui lòng nhập lại',
  'number_phone.required' => 'Password không được để trống',
  'fullname.required' => 'Fullname không được để trống',
]);
$acc=$this->account->create(
  [
    'user_name' => $request->user_name,
    'email' => $request->email,
    'password' => md5($request->password),
    'number_phone' => $request->number_phone,
    'fullname' => $request->fullname
  ]
);
if($acc){
  echo"<script>alert('Tạo tài khoản thành công')</script>";

}
return redirect()->route('login.user');

  }
  public function dangnhap(Request $request){
$data = $request->validate([
  'user_name' => 'required|max:100',
  'password' => 'required|max:100',
],
[
  'user_name.required' => 'Username không được để trống',
  'password.required' => 'Password không được để trống',
]
);
$user_name = $request->user_name;
    $password = md5($request->password);
    $result = DB::table('accounts')->where('user_name' , $user_name)->where('password' , $password)->first();
   if($result){
Session::put('name',$result->fullname);
Session::put('id_user',$result->id);
return redirect()->to(path:'myshop');
   }
   else{
    echo "<script>alert('Tài khoản hoặc mật khẩu không đúng')</script>";
    return redirect()->route(route:'login.user');
   }
}
public function logoutUser(){

  Session::put('name',null);
  Session::put('id_user',null);
  return redirect()->route(route:'home.shop');
}
// public function AuthLog(){
//   $user_id = Session::get('id');
//   if($user_id){
//       return redirect()->to(path:'home');
//   }else{
//       return redirect()->route(route:'back')->send();
//   }
// }
  
}
