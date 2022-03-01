<?php

namespace App\Http\Controllers;

use App\Models\Guardian;
use App\Models\User;
use App\Http\Requests\StoreGuardianRequest;
use App\Http\Requests\UpdateGuardianRequest;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Image;

class GuardianController extends Controller
{
   
    function __construct()
     {

       $this->middleware('permission:guardian-list', ['only' => ['index']]);
       $this->middleware('permission:guardian-create', ['only' => ['create','store']]);
       $this->middleware('permission:guardian-edit', ['only' => ['edit','update']]);
       $this->middleware('permission:guardian-delete', ['only' => ['destroy']]);

     }
    
    public function index()
    {
        $guardians = Guardian::with(['user'])->get();
        return view ('guardians.index',compact('guardians'));
    }

    public function create()
    {
        return view ('guardians.create');
    }

    
    public function store(StoreGuardianRequest $request)
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
            'note' => 'required',
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
        $user->note = $request->note;
        

        if ($request->hasFile('images')) {
            $image = $request->file('images');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/' . $filename);
            Image::make($image)->resize(100, 100)->save($location);

            $user->images = $filename;
        } 
     
        $user->save();

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
               'created_by' => Auth::user()->name,
              
           ]);
       }

       session()->flash('add_guardian');
        return redirect('/guardians');
    }

    
    public function show(Guardian $guardian)
    {
        $orphans = $guardian->user->orphans;
        return view ('guardians.show',compact('guardian','orphans'));
    }

   
    public function edit(Guardian $guardian)
    {
        return view ('guardians.edit',compact('guardian'));
    }

   
    public function update(UpdateGuardianRequest $request, Guardian $guardian)
    {
        $id = $guardian->user->id;
        
        
        $this->validate($request, [

            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'phone' => 'required',
            'bank_account' =>'sometimes',
            'add' => 'required',
            'ssn' => 'required',
            'note' => 'required',
        ],[

            'name.required' =>'يرجي ادخال الاسم ',
            'email.required' =>'البريد الالكتروني مطلوب',
            'ssn.required' =>'الرقم الوطني مطلوب',
            'phone.required' =>'الهاتف مطلوب',
            'bank_account.required' =>'رقم الحساب البنكي مطلوب',
            'add.required' =>'العنوان مطلوب',
            'note.required' =>'العنوان مطلوب',
            

        ]);

        $user = User::find($id);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->ssn = $request->input('ssn');
        $user->phone = $request->input('phone');
        $user->bank_account = $request->input('bank_account');
        $user->add = $request->input('add');
        $user->note = $request->input('note');
        
        
        if ($request->hasFile('images')) {
            $image = $request->file('images');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/' . $filename);
            Image::make($image)->resize(100, 100)->save($location);
            $oldFilename = $user->image;
            $user->images = $filename;
           // Stroage::delete();
            Storage::delete($oldFilename);
        }
       

        $user->save();

       
        session()->flash('edit_guardian');
        return redirect('/guardians');
    }

   
    public function destroy(Request $request)
    {
        
        $user_id = $request->guardian_id;
        $guardian_id = $request->guardian_id;

        
        $guardian = Guardian::where('user_id', $request->guardian_id)->first();
        $guardian->delete();

        $user = User::find($user_id);
        Storage::delete($user->images);
        $user->delete();

        session()->flash('delete_guardian');
        return redirect('/guardians');
    }
}
