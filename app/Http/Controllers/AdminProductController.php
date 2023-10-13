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
    public function list(){
        $products = $this->product->paginate(5);
       return view('adminproduct.list' , compact('products'));
    }
    public function create(){
        $htmlOption = $this->getCategory($parentid='');
        return view('adminproduct.add',compact(var_name:'htmlOption'));
    }
    function getCategory($parentid){
        $data = $this->category->all();
        $recusive = new Recusive($data);
        
        $htmlOption =   $recusive->categoryRecusive($parentid);
        return $htmlOption;
    }
    public function store(Request $request){
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

}
