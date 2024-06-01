<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\SendMail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail as FacadesMail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LoginController extends Controller
{

   // public function sendMail(){
   //    $subject = "hello world";
   //    $body = "my name is body";
   //    FacadesMail::to('mamta256k511@gmail.com')->send(new SendMail($subject,$body));
   //    dd("done");
   // }


   public function login(Request $request){
      $helper = new Helper;
      $data = $helper->sum(2,3);
      echo $data; die;
      $request->validate([
         'email'     => 'required|email',
         'password'  => 'required|min:5|max:10'
      ]);

      if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
         
         return redirect()->route('dashboard')->with('success','Login successfully');
      }
      
      return redirect('/')->with('success','Email and password incorrect');
   }

   public function register(Request $request){

      $validator = Validator::make($request->all(), [
                        'name'   => 'required|string|min:5|max:20|bail',
                        'email'  => 'required|email',
                        'password'   => 'required',
                        'state'  => 'required|string'
                        ]);

      if($validator->fails()){
         return redirect('/register')
               ->withErrors($validator)
               ->withInput();
      }
      $validateData  = $validator->validated();
      //$password      = Hash::make(Str::random(10));
      
      unset($validateData['state']);
      $password = $validateData['password'];
      unset($validateData['password']);
      $validateData['password'] = password_hash($password,PASSWORD_DEFAULT);
      $user = new User;
      $user->insert($validateData);

      return redirect()->route('login')
               ->with('success','Register successfully.')
               ->with('alert-class','alert-success');

   }
}
