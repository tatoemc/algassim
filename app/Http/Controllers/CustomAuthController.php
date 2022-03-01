<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\User;
use App\Models\Guardian;
use App\Models\Sponsor;
use Illuminate\Support\Facades\Auth;

class CustomAuthController extends Controller
{

    public function index()
    {
        return view('auth.login');
    }  
      



    public function registration()
    {
        return view('auth.register');
    }
      

    public function customRegistration(Request $request)
    {  
        // return $request->all();
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'user_type' => 'required|min:6',
            'gender' => 'required',
            'phone' => 'required',
            'bank_account' =>'sometimes',
            'add' => 'required',
            'ssn' => 'required',
           // 'images' =>'sometimes|image'
        ]);
           
       
        $user = new User; 
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->user_type = $request->user_type;
        $user->gender = $request->gender;
        $user->phone = $request->phone;
        $user->bank_account = $request->bank_account;
        $user->add = $request->add;
        $user->ssn = $request->ssn;

        if ($request->hasFile('images')) {
            $image = $request->file('images');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/' . $filename);
            Image::make($image)->resize(100, 100)->save($location);

            $user->images = $filename;
        } 
     
        $user->save();
       

       // $check = $this->create($data);
       if($request->user_type == 'sponsor')
       {
           $user_id = User::latest()->first()->id;
           Sponsor::create([
           'user_id' => $user_id,
            ]);

       }
       elseif($request->user_type == 'guardian')
       {
           $user_id = User::latest()->first()->id;
           Guardian::create([
               'user_id' => $user_id,
              
           ]);
       }
       
       session()->flash('Add', 'تم التسجيل بنجاح - الرجاء تسجيل الدخول');
        return redirect("login");
    }


    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }    
    
   
}