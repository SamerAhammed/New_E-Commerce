<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\User;
class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'user_id',
        'value',
       
        
    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function products(){
        return $this->belongsTo(Product::class,'product_id');
    }

}
