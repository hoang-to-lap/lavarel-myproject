<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Components\Recusive;
use App\Models\Category;
use App\Traits\StoreImageTrait;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\ProductImage;
use App\Models\ProductTag;
use App\Models\Tag;
use Exception;
use Illuminate\Support\Facades\Log;


use Illuminate\Support\Facades\Session;
class AdminProductController extends Controller

{
    use StoreImageTrait;
    private $category;
    private $product;
    private $productImage;
    private $productTag;
    private $tag;
    public function __construct(Category $category , Product $product , ProductImage $productImage , 
    Tag $tag , ProductTag $productTag){
     
        $this->category = $category;
        $this->product = $product;
        $this->productImage = $productImage;
        $this->tag = $tag;
        $this->productTag = $productTag;
    }
    public function AuthLog(){
        $admin_id = Session::get('id');
        if($admin_id){
            return redirect()->to(path:'home');
        }else{
            return redirect()->route(route:'back')->send();
        }
    }
    //hien thi danh sach
    public function list(){
        $this->AuthLog();
        $products = $this->product->paginate(5);
       return view('adminproduct.list' , compact('products'));
    }
    // hien thi bang them
    public function create(){
        $this->AuthLog();
        $htmlOption = $this->getCategory($parentid='');
        return view('adminproduct.add',compact(var_name:'htmlOption'));
    }
    function getCategory($parentid){
        $data = $this->category->all();
        $recusive = new Recusive($data);
        
        $htmlOption =   $recusive->categoryRecusive($parentid);
        return $htmlOption;
    }
    //them san pham
    public function store(Request $request){
        $this->AuthLog();
        $dataProduct = [
'name' => $request->txtName,
'price' => $request->txtPrice,
'content' => $request->txtContent,
'user_id' => auth()->id(),
'category_id' => $request->txtCategory_id
        ];
        $dataUploadFeatureImage = $this->storeTraitUpload($request , fieldName:'txtImage' , folderName:'product');

if(!empty( $dataUploadFeatureImage)){
    $dataProduct['feature_image_name'] = $dataUploadFeatureImage['file_name'];
    $dataProduct['feature_image_path'] = $dataUploadFeatureImage['file_path'];
}
 $product =    $this->product->create( $dataProduct);
//insert image detail
if($request->hasFile('txtImageDetail')){
    foreach($request->txtImageDetail as $fileItem){
$dataUploadDetailImage = $this->storeTraitUploadDetail($fileItem,folderName:'product');
$product->images()->create([
   
   'image_path' => $dataUploadDetailImage['file_path'],
   'image_name' => $dataUploadDetailImage['file_name'],
   ]);
// $this->productImage->create([
//  'product_id' => $product->id,
// 'image_path' => $dataUploadDetailImage['file_path'],
// 'image_name' => $dataUploadDetailImage['file_name'],
// ]);

    }
}
//insert tag product
foreach($request->txtTag as $tagItem){
  $tag =   $this->tag->firstOrCreate([
        'name' => $tagItem
    ]);
   $tagIds[] = $tag->id;
}
$product->tags()->attach( $tagIds);
return redirect()->route('product.list');
    }
    public function edit($id){
        $this->AuthLog();
        $product = $this->product->find($id);
        $htmlOption = $this->getCategory($product->category_id);
        return view('adminproduct.edit',compact('htmlOption','product'));
    }



    //update san pham
    public function update($id,Request $request){
        $this->AuthLog();
        $dataProductUpdate = [
'name' => $request->txtName,
'price' => $request->txtPrice,
'content' => $request->txtContent,
'user_id' => auth()->id(),
'category_id' => $request->txtCategory_id
        ];
        $dataUploadFeatureImage = $this->storeTraitUpload($request , fieldName:'txtImage' , folderName:'product');

if(!empty( $dataUploadFeatureImage)){
   $dataProductUpdate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
   $dataProductUpdate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
}
    $this->product->find($id)->update( $dataProductUpdate);
    $product = $this->product->find($id);
//insert image detail
if($request->hasFile('txtImageDetail')){
    $this->productImage->where('product_id' , $id)->delete();
    foreach($request->txtImageDetail as $fileItem){
$dataUploadDetailImage = $this->storeTraitUploadDetail($fileItem,folderName:'product');
$product->images()->create([
   
   'image_path' => $dataUploadDetailImage['file_path'],
   'image_name' => $dataUploadDetailImage['file_name'],
   ]);


    }
}
//insert tag product
foreach($request->txtTag as $tagItem){
  $tag =   $this->tag->firstOrCreate([
        'name' => $tagItem
    ]);
   $tagIds[] = $tag->id;
}
$product->tags()->sync( $tagIds);
return redirect()->route('product.list');
    }
    // Xoa san pham 
    public function delete($id){
try{
    $this->product->find($id)->delete();
    return redirect()->route('product.list');
    return response()->json(
        [
            'code' => 200 ,
            'message' => 'success',
    
    
        ] , status: 200
        );

}catch(Exception $exception){
Log::error("message" . $exception->getMessage() . '---line:' . $exception->getLine());
return response()->json(
    [
        'code' => 500 ,
        'message' => 'fail',


    ] , status: 500
    );
}
    }

}
