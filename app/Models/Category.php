<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
        //this 
        //Category تعود على اسم الكلاس 
        //هنا نقول كل تصنيف يمتلك العديد من المنتجات 
        //علاقة one to many
    }
}
