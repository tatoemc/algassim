<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use App\Models\User;
use App\Http\Requests\StoreSponsorRequest;
use App\Http\Requests\UpdateSponsorRequest;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Notifications\Sponser;
use App\Exports\SponsorsExport;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Image;


class SponsorController extends Controller
{ 
    
    function __construct()
    {

      $this->middleware('permission:sponsor-list', ['only' => ['index']]);
      $this->middleware('permission:sponsor-create', ['only' => ['create','store']]);
      $this->middleware('permission:sponsor-edit', ['only' => ['edit','update']]);
      $this->middleware('permission:sponsor-delete', ['only' => ['destroy']]);

    }
    
    public function index()
    {
       
        $sponsors = Sponsor::with(['user'])->get();
        return view ('sponsors.index',compact('sponsors'));
    }

  
    public function create()
    {
        return view ('sponsors.create');
    }

    
    public function store(StoreSponsorRequest $request)
    {
      //  return $request->all();
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
           'created_by' => Auth::user()->name,
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
       /*
       $sponsor_id = Sponsor::latest()->first();
       $user = User::get();
       
       Notification::send($user, new \App\Notifications\Sponser($sponsor_id));
      */
        session()->flash('add_sponsor');
        return redirect('/sponsors');
    }

    
    public function show(Sponsor $sponsor)
    {
        $id = $sponsor->user_id;
        $orphans = $sponsor->user->orphans;
        return view ('sponsors.show',compact('sponsor','orphans','id'));
    }

   
    public function edit(Sponsor $sponsor)
    {
        //dd();
        //$sponsor = $sponsor->user;
        return view ('sponsors.edit',compact('sponsor'));
    }

    public function update(UpdateSponsorRequest $request, Sponsor $sponsor)
    {
        //dd($sponsor);
        $id = $sponsor->user->id;
        
        
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

        session()->flash('edit_sponsor');
        return redirect('/sponsors');
        
       
    }

   
    public function destroy(Request $request)
    {
        //
        //return $request;
        $user_id = $request->sponsor_id;
        $sponsor_id = $request->sponsor_id;

       
        $sponsor = Sponsor::where('user_id', $request->sponsor_id)->first();
        $sponsor->delete();
       
        $user = User::find($user_id);
        
        Storage::disk('public_uploads')->delete($user->images);
        $user->delete();
        
        session()->flash('delete_sponsor');
        return redirect('/sponsors');
    }

    public function print_sponsor( $id )
    {
        
        $sponsor = Sponsor::where('id', $id)->first();
        return view('sponsors.print_sponsors',compact('sponsor'));
    }

    public function export() 
    {
        
        return Excel::download(new SponsorsExport, 'اوليا_الامور.xlsm');
    }




}//End of controller
