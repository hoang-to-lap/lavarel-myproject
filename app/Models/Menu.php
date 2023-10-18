<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{    
    use SoftDeletes;
    use HasFactory;
    protected $fillable = ['name' , 'parent_id' , 'slug' ];
    public function menuChirld(){
        return $this->hasMany(Menu::class , 'parent_id');
    }
}
