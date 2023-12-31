<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Category;
use App\Models\Intrtaction;
use App\Models\Comment;
use Carbon\Carbon;
class ProductController extends Controller
{
    
    public function index()
    {
        $product=Product::paginate(5);
         //ارسال كل خمس منتجات في صفحة
        //  لانه اذا كان لديك عدد كبير من المنتجات سيستغرق الامر وقت كبير لجلب كافة البيانات

        $categories=Category::latest()->get();
        
        return view('products.index',compact('product'))->with('categories',$categories);
            //compact,with
            //يمكن اختيار احدى الطريقتين لارسال البيانات الى الواجهة
            //يمكن وضع اكثر من with 
            //return view('products.index)->with('categories',$categories)->with('products',$products);

        
    }
    public function show(Product $product)
    {
        $user_id=Auth::id();
        $intrtaction=Intrtaction::query()
        ->where('user_id',$user_id)
        ->where('product_id',$product->id)->first();
            //عندما ضغط المستخدم على منتج معين نريد معرفة اذا كان اول مرة قام بمشاهدته 
            //اذا كانت اول مرة سيتحقق الشرط في الاسفل ونضيف تفاعل لهذا المستخدم على المنتج

        if($intrtaction==null){
            $intrtaction= Intrtaction::create([
                'product_id' => $product->id,
                'user_id' =>    $user_id,
            ]);
        }
        $views=Intrtaction::query()->where('product_id',$product->id)->count();
        //count()
        //تابع يقوم بجلب عدد السجلات في الداتا بيز  
        //قمنا بجلب عدد المشاهدات للمنتج 
        $likes=Intrtaction::query()
        ->where('product_id',$product->id)
        ->where('check_likes',true)
        ->count();
        
        $comments = $product->comments;
       // استطعنا الكتابة بهذاالشكل لانه تم الربط في المودل بالعلاقات
        return view('products.show')
        ->with('product',$product)
        ->with('views',$views)
        ->with('comments',$comments)
        ->with('likes',$likes);
        
    }

    
    public function create()
    {
        $categories=Category::latest()->get();
        return view('products.create')->with('categories',$categories);
        
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

        $img_url = $this -> saveImage($request->img_url,folder:'images/products');
        $product =  Product::create([
            'name' => $request->name,
            'category_id'=> $request->category_id,
            'price' => $request->price,
            'description' => $request->description,
            'img_url'=>$img_url,
            'user_id'=>Auth::id()
        ]);

        
        
        return redirect()->route('home');
        
        
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
    public function saveImage($photo ,$folder){
                //لا يمكن تخزين صورة في قاعدة البيانات لذلك نقوم بتخزين رابط الصورة في قاعدة البيانات 
        //ونخزن الصورة في مجلد الصور 
        //الصور العامة يمكن تخزينها في مجلد ال public
        //اما الصور الشخصية او الهامة مثل صور هوية يفضل تخزينها في مجلد storage
        //قمنا باضافة الوقت الحالي على اسماء الصور لكي لا يحدث تشابه بالاسماء
        
        $newimage = $photo->getclientOriginalExtension();
    $img_url = time().'.'.$newimage;
    $path = $folder;
    $photo ->move($path, $img_url);
    return $img_url;
    }

    
    public function filter(Request $request){

        //نقوم بعمل الفلتر من خلال جلب كل المنتجات وتطبيق الشرط المناسب 

        $product= Product::query()->get();
        $product= $product->where('price', '<',  $request->price);
        return response()->json($product,status:Response::HTTP_OK);

    }

    public function search(Request $request)
    {
        $output='';
        
        if($request->ajax()){
        //LIKE 
        //تشبه المساواة ولكن عند اضافة اشارة بالمئة عليها 
        //% تعني انه اي شيء يأتي قبلها مسموح به 
        //والثانية تسمح بكل شيئ بعد الكلمة التي يدخلها المستخدم 
        //بهذه الطريقة اذا ادخل المستخدم ثلاث حروف مثلا
        //سوف تعرض النتائج التي تحوي هذه الحروف في وسط الكلمة او اولها او اخرها
        //ارسلنا النتائج ضمن كود الهتمل لانه سوف يضعه ضمن بلوك حددناه باستخدام ال 
        //id
            $data = Product::where('name', 'LIKE', '%' . $request->search . '%')->get();
            if($request->search !=null){
                foreach($data as $data){
                    $output .=
                    '
                    <div>
                      <div>
                      <div style="overflow: hidden ; word-wrap: break-word ;  ">
                      <div class="row my-1"  style="background-color: #ffffff">
                          
                          '.'<a class="col-12  col-md-12 my-1 btn" style="text-align: center ;" >'.'
                          '.$data->name.'
                          </a> '.'
                          
                      </div>
                  </div>
                      </div>
                      
                    </div>
                    
        
                    ';
                }
            }
        
         
        }
        return response($output);
       
    }
}
