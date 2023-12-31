<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Category;
class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'category_id',
        'name',
        'price',
        'description',
        'img_url',
        
    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    } 
    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
    public function getFeaturedAttribute($img_url){
        return asset($img_url);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class,'product_id');
    }

    //لكي نقوم بربط جدولين 
    //one to many
    //نكتب تابع في اول مودل اما 
    //hasMany  هنا يكون الثاني تابع له
    //مثلا المستخدم تابع له اكثر من منتج

    //belongsToاما التابع في المودل الاخر يكون
    //المنتج يتبع لمستخدم واحد
    //


    //هذه اكثر علاقة مستخدمة 
    //لا ينصح باستخدام علاقة 
    //many to many
    //مع انه يمكن تحقيقها بالتوابع
    //ولكن في قواعد البيانات  الافضل ان نقوم بكسر العلاقة لتصبح علاقتين 
    //one to many
}
