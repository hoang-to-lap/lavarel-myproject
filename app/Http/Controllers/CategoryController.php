<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Components\Recusive;
use Illuminate\Support\Str;
use App\Models\Menu;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;



class CategoryController extends Controller
{
  
    private $category;
    public function __construct(Category $category){
     
        $this->category = $category;
    }
    public function AuthLog(){
        $admin_id = Session::get('id');
        if($admin_id){
            return redirect()->to(path:'home');
        }else{
            return redirect()->route(route:'back')->send();
        }
    }
    
  
    public function create(){
        $this->AuthLog();
$htmlOption = $this->getCategory($parentid='');

return view('category.add', compact(var_name:'htmlOption'));
}


   
    
 
    public function list(){
        $this->AuthLog();
        $list = $this->category->latest()->paginate(5);

        return view('category.list' , compact('list'));

    }
    public function store(Request $request){
        $this->AuthLog();
        $this->category->create(
            [
                'name' =>$request->txtName,
                'parent_id'=>$request->txtParent_id ,
                'slug' => Str::slug($request->txtName)
            ]
            );
      return redirect()->route(route:'categories.list');

    }
    function getCategory($parentid){
        $data = $this->category->all();
        $recusive = new Recusive($data);
        
        $htmlOption =   $recusive->categoryRecusive($parentid);
        return $htmlOption;
    }
   public function edit($id){
    $this->AuthLog();
    $category = $this->category->findOrFail($id);
$htmlOption = $this->getCategory($category->parent_id);



return view('category.edit' , compact('category','htmlOption'));
    }

     public function delete($id){
        $this->AuthLog();
$this->category->find($id)->delete();
 return redirect()->route(route:'categories.list');
    }
    public function update($id , Request $request){
        $this->category->find($id)->update(
            [
                'name' =>$request->txtName,
                'parent_id'=>$request->txtParent_id ,
                'slug' => Str::slug($request->txtName)
            ]
            );
            return redirect()->route(route:'categories.list');

    }
    public function productOfCategory($slug,$id){
        $categories = Category::where('parent_id',0)->get();
        $menus = Menu::where('parent_id',0)->get();
         $product = Product::where('category_id' , $id)->paginate(6);

      
         return view('shop.component.productcategory', compact('categories','menus','product'));
       

    }
}
