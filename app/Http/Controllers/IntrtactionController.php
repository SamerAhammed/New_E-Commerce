<?php

namespace App\Http\Controllers;

use App\Models\Intrtaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Comment;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Response;
class IntrtactionController extends Controller
{

    public function like($product_id)
    {
        $user_id=Auth::id();
        $product=Product::query()->find($product_id);
        $intrtaction=Intrtaction::query()
        ->where('user_id',$user_id)
        ->where('product_id',$product_id)->first();
        //التفاعل هو جدول يربط المستخدم مع المنتج الذي تفاعل معه
        //عند الضغط على الاعجاب نبحث عن التفاعل الذي يحقق الشرطين 
        //هنا نحن نعلم انه موجود لذلك لم نضف شرط تحقق من وجوده
        //موجود لانه لا يمكن ضعط زر الاعجاب بدون ان يكون المستخدم قد شاهد المنتج 
        //وقمنا بانشاء التفاعل عند مشاهدة المنتج
        if($intrtaction){
            //نجعل الاعجاب يساوي النتيجة العكسية 
            //اذا كان 0 يصبح 1 واذا كان 1 يصبح 0
            //true  false or 0  1
            
            $intrtaction->check_likes=!$intrtaction->check_likes;
            $intrtaction->save();
            return redirect()->route('home');
            } else 
            {
               
                return response()->json(status:Response::HTTP_NO_CONTENT); 
        }

        }
    
        public function comment(Request $request, $product_id)
        {
            $user_id=Auth::id();
            $product=Product::query()->find($product_id);
            //هنا لم نضف شروط لانه يستطيع المستخدم وضع عدد غير منته من التعليقات 
            
            $product->comments()->create([
                'value' => $request->comment,
                'user_id'=> $user_id
            ]);
            
               
            return redirect()->route('home');
          
           
            }
}
