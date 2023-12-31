<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
class ProductOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user=Auth::user();
        $product= Product::query()->where('id',$request->id)->first();
        //قمنا بجلب معلومات المنتج الذي يريد المستخدم حذفه 
        
        if ($user->id == $product->user_id) {
            //نختبر ان المستخدم هو صاحب المنتج
            //اذا تحقق الشرط سوف يكمل التنفيذ ال الكونترولر
            return $next($request);
        }
        else{
            // اذا لم يتحقق الشرط نعيده للصفحة الرئيسية 
            return redirect()->route('home')->with('faild','Unauthorized');
        }
    }
}
