<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Category;
class ProductController extends Controller
{
    
    public function index()
    {
        $product=Product::paginate(10);
        $categories=Category::latest()->get();
        return view('products.index',compact('product'))->with('categories',$categories);

        /*      
        
        هذا التابع يقوم بعرض المنتجات 
        في السطر 14 يقوم بجلب البيانات بواسطة المودل 
        ويقوم بارجاعها على دفعات 10منتجات في كل مرة

        في السطر 15 نقوم بالتوجه الى فيو الاندكس مع تمرمر المتغير الذي حفظنا به المنتجات
        ملف الاندكس موجود في الفيو 
        
        */
    }
    public function show(Product $product)
    {
        return view('products.show')->with('product',$product);
        /*
        التابع هنا يحتوي على بارامتر من الراوت 
        داخل قوسي التابع في السطر 28 نقوم بالبحث عن المنتج
        ثم نعيده الى الفرونت
        
        
        */
    }

    
    public function create()
    {
        $categories=Category::latest()->get();
        return view('products.create')->with('categories',$categories);
        /*
        عرض الصفحة المطلوبة فقط

        */
    }

    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'price' => 'required',
        ]);
        if ($validator->fails()) {
            
            return redirect()->route('create')->with('faild','Please enter name and price');
        }
        /*
        قمنا بعمل تحقق بان الاسم والسعر موجودين 
        يمكن اضافة شروط عدة مثل عدد الحروف  وعدم التكرار 
        
        
        */

        $user=Auth::id();
        $user=User::find($user);
        $user->products()->create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
        ]);

        $product =  Product::create([
            'name' => $request->name,
            'category_id'=> $request->category_id,
            'price' => $request->price,
            'description' => $request->description,
            'user_id'=>Auth::id()
        ]);

        /*
        ادخلنا المعلومات في قاعدة البيانات
        مع الانتباه ان الاسماء نفس اسماء الحقول ونفسها الموجودة في الموديل

        
        */
        
        return redirect()->route('home');
        
        /*
        هنا اعدنا التوجيه الى راوت وليس صفحة فرونت 
        لانه لو اعدناه الى الفرونت تحتاج ان ترسل معه القيم 
        */
    }

    
    public function edit(Product $product)
    {
        //
    }

    
    public function update(Request $request, Product $product)
    {
        //
    }

    
    public function destroy(Product $product)
    {
            $product->delete();
            return redirect()->route('home');
            

    }
}
