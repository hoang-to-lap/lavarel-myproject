<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Product;
use Illuminate\Http\Request;
use Cart;
use Darryldecode\Cart\Cart as CartCart;
use Illuminate\Support\Facades\Session;

 session_start();
class CartController extends Controller
{
    //
    public function addcart($id , Request $request){
   
    $user_id = Session::get('id_user');
    $data = Product::find($id);
    $size = $request->size;

    Cart::session($user_id)->add(array(
        'id' => $id, // inique row ID
        'name' => $data->name,
        'price' =>$data->price,
        'quantity' => 1,
        'attributes' => 
        [
            'size' => $size,
            'iamge' =>$data->feature_image_path
        ]
    ));
    return redirect()->route(route:'showcart');
    }
    public function showcart(){
        $user_id = Session::get('id_user');
        $total = Cart::session($user_id)->getSubTotal();
        $sub = Cart::session($user_id)->getTotal();
        $item = Cart::session($user_id)->getContent();
        
        $categories = Category::where('parent_id',0)->get();
        $menus = Menu::where('parent_id',0)->get();
        return view('shop.component.cart' , compact('categories','menus','item','total','sub'));
    }
    public function deletecart($id){
        $user_id = Session::get('id_user');
        Cart::session($user_id)->remove($id);
        return redirect()->route(route:'showcart');
    }
    public function clear(){
        $user_id = Session::get('id_user');
        Cart::session($user_id)->clear();
        return redirect()->route(route:'showcart');
    }
    public function updatetang($id){
        $user_id = Session::get('id_user');
        $product = Cart::session($user_id)->get($id);
        $qty = $product->quantity ++;
  
       
        Cart::session($user_id)->update($id,[
            'quantity'=>$qty
        ]);
        return redirect()->route(route:'showcart');
    }
    public function updategiam($id){
        $user_id = Session::get('id_user');
        $product = Cart::session($user_id)->get($id);
        $qty = $product->quantity --;
        if($product->quantity<=0){
            Cart::session($user_id)->remove($id);
        }else{
            Cart::session($user_id)->update($id,[
                'quantity'=>$qty
            ]);
        }
       
        return redirect()->route(route:'showcart');
    }
  
}
