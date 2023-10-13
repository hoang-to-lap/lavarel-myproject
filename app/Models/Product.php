<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name' , 'price' , 'feature_image_path' , 'content' , 'user_id' , 'category_id' , 'feature_image_name'];
    public function images(){
        return $this->hasMany(ProductImage::class,'product_id');
    }
    public function tags(){
        return $this->belongsToMany(Tag::class , table:'product_tags' , foreignPivotKey:'product_id' , relatedPivotKey:'tag_id')->withTimestamps();
    }
    public function category(){
        return $this->belongsTo(Category::class,foreignKey:'category_id');
    }
}
