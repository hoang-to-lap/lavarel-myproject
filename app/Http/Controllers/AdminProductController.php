<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Components\Recusive;
use App\Models\Category;
use App\Traits\StoreImageTrait;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class AdminProductController extends Controller

{
    use StoreImageTrait;
    private $category;
    public function __construct(Category $category){
     
        $this->category = $category;
    }
    public function list(){
       return view('adminproduct.list');
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
        $dataUpload = $this->storeTraitUpload($request , fieldName:'txtImage' , folderName:'product');
       
dd($dataUpload);
    }

}
