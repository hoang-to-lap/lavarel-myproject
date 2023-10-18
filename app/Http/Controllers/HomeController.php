<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index(){
        $categories = Category::where('parent_id',0)->get();
        $menus = Menu::where('parent_id',0)->get();
        $product  = Product::Latest()->take(8)->get();
        return view('shop.homeshop' , compact('categories','menus','product'));
    }
    public function shop(){
        $categories = Category::where('parent_id',0)->get();
        $menus = Menu::where('parent_id',0)->get();
        $product  = Product::Latest()->paginate(6);
        return view('shop.component.productshop' , compact('categories','menus','product'));
    }
    public function detail($id){
        $categories = Category::where('parent_id',0)->get();
        $menus = Menu::where('parent_id',0)->get();
        $product = Product::find($id);
        return view('shop.component.productdetail' , compact('categories','menus','product'));
    }
  
}
