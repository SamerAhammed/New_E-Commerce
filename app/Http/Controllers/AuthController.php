<?php
/*
لم نقم باضافة شيئ جديد هنا 
يمكنك التوسع في مفاهيم 
Validator,token
يمكن تحديد زمن للتوكن واشياء اخرى تفيد في الامان 
توسع في مكتبة الباسبورت التي استخدمناها
اهم شيء هنا يختصر الكثير 
Auth::user()
جلب بيانات المستخدم الحالي 
Auth::id()
جلب رقم المستخدم الحالي 
يجب الانتباه الى استخدامهم فقط عندما يكون المستخدم قام بتسجيل دخوله 
والا سوف يظهر خطأ  
$user=Auth::user();
if($user){
    ....
} 
هنا نفحص ان المستخدم موجد  بعدها نقوم بالعمليات التي نريدها

*/
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function signup()
    {
        return view('register.signup');
    }
    public function submit_signup(Request $request)
    {
      
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|unique:users',
            'password' => 'required|string',
            'whatsapp_url'=> 'required|string'
        ]);
        
        if ($validator->fails()) {
          
           $errors=$validator->errors();
           
            return redirect()->route('signup')->with('errors',$errors);
        }
        User::create([
            'name' => $request->name,
            'email' =>  $request->email,
            'password'=> bcrypt($request->password),
            'whatsapp_url'=> $request->whatsapp_url,
        ]);
        return redirect('signup');
    }
     public function login()
    {
        return view('register.login');
    }

    public function submit_login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string',
            'password' => 'required|string'
        ]);
        
        if ($validator->fails()) {

            $errors=$validator->errors();
            return redirect()->route('login')->with('errors',$errors);  
        }
        $credentials = request(['email', 'password']);
        if(!Auth::attempt($credentials))
        return redirect()->route('login')->with('faild','Unauthorized');
        
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        return redirect()->route('home')->with([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
           
        ]);
    }
    public function logout(Request $request)
    {
       
        
    
        Auth::logout();

        return redirect('login');
      
    }
}
