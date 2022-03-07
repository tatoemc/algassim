<?php

namespace App\Http\Controllers;

use App\Models\Orphan;
use App\Models\Sponsor;
use App\Models\Sponserform;
use App\Models\Guardian;
use App\Http\Requests\StoreOrphanRequest;
use App\Http\Requests\UpdateOrphanRequest;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Image;
use Storage; 

class OrphanController extends Controller
{
    
    function __construct()
     {

       $this->middleware('permission:orphan-list', ['only' => ['index']]);
       $this->middleware('permission:orphan-create', ['only' => ['create','store']]);
       $this->middleware('permission:orphan-edit', ['only' => ['edit','update']]);
       $this->middleware('permission:orphan-delete', ['only' => ['destroy']]);

     }
    
    public function index()
    {
       
        $user_id = Auth::user()->id;
        
        if (Auth::user()->user_type == 'admin')
        {
            $orphans = Orphan::all(); 
        }
        if (Auth::user()->user_type == 'user')
        {
            $orphans = Orphan::all(); 
        }
        elseif (Auth::user()->user_type == 'sponsor')
        { 
            $orphans = Orphan::where('user_id',$user_id)->get();
        }
        elseif (Auth::user()->user_type == 'guardian')
        {
            $orphans = Orphan::where('stauts', '0')->get(); 
        }
        
        return view ('orphans.index',compact('orphans'));

        
    }

    public function create()
    {
        $sponsors = Sponsor::with(['user' => function ($query) {
            $query->select('id', 'name');
        }])
        ->get(); 
         //dd($sponsors );
        return view ('orphans.create',compact('sponsors'));
    }

    public function store(StoreOrphanRequest $request)
    {
        //dd($request->all());
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'b_date' => 'required',
            'father_deth' => 'required',
            'gender' => 'required',
            'schoolLevel' => 'required',
            'add' => 'required',
            'ssn' => 'required',
            'helth_state' => 'required',
            'brother_count' => 'required',
            'death_certif' => 'required',
            'images' => 'required'
           
        ],[
            'name.required' =>'يرجي ادخال الاسم ',
            'b_date.required' =>'يرجي ادخال تاريخ الميلاد ',
            'father_deth.required' =>'يرجي ادخال تاريخ الوفاة ',
            'gender.required' =>'يرجي اختيار النوع   ',
            'schoolLevel.required' =>'يرجى ادخال المرحلة الدراسية',
            'add.required' =>'يرجى ادخال العنوان',
            'ssn.required' =>'يرجى ادخال الرقم الوطنى',
            'helth_state.required' =>'يرجي اختيار الحالة الصحية ',
            'brother_count.required' =>'يرجي اختيار عدد الاخوان ',
            'death_certif.required' =>'يرجى ادخال شهادة الوفاة',
            'images.required' =>'يرجى ادخال  صورة اليتيم',
           
        ]);
        
        $orphan = new Orphan; 
        $orphan->name = $request->name;
        $orphan->b_date = $request->b_date;
        $orphan->father_deth = $request->father_deth;
        $orphan->gender = $request->gender;
        $orphan->schoolLevel = $request->schoolLevel;
        $orphan->add = $request->add;
        $orphan->ssn = $request->ssn; 
        $orphan->helth_state = $request->helth_state;
        $orphan->note = $request->note;
        $orphan->brother_count = $request->brother_count;
        $orphan->death_certif = $request->death_certif;
      // dd($request->all());
        if((Auth::user()->user_type) == "admin")
        {
            
            $orphan->user_id = $request->sponsor_id;
        }
        elseif((Auth::user()->user_type) == "user")
        {
            
            $orphan->user_id = $request->sponsor_id;
        }
       
        else 
        {
            $orphan->user_id = (Auth::user()->id);
        }
        
        if ($request->hasFile('images')) {
            $image = $request->file('images');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/' . $filename);
            Image::make($image)->resize(100, 100)->save($location);

            $orphan->images = $filename;
        } 

        if ($request->hasFile('death_certif')) {
            $image = $request->file('death_certif');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('certificate/' . $filename);
            Image::make($image)->resize(100, 100)->save($location);

            $orphan->death_certif = $filename;
        } 
        
        $orphan->save();
        session()->flash('add_orphan');
        if((Auth::user()->user_type) == "admin")
        {
        
        return redirect('/orphans');
        }
        elseif((Auth::user()->user_type) == "sponsor")
        {
            return redirect()->route('orphans.show', $orphan->id);
        }
    }//end of store

    public function show(Orphan $orphan)
    {
     
       return view ('orphans.show',compact('orphan'));

    }

    public function edit(Orphan $orphan)
    {
        return view ('orphans.edit',compact('orphan'));
    }

    public function update(Request $request)
    {
        //dd($request->all());
        $id = $request->id;
        
        $orphan = Orphan::findOrFail($id);
        //dd( $orphan);
      $orphan->name = $request->input('name');
      $orphan->b_date = $request->input('b_date');
      $orphan->father_deth = $request->input('father_deth');
      $orphan->gender = $request->input('gender');
      $orphan->schoolLevel = $request->input('schoolLevel');
      $orphan->add = $request->input('add');
      $orphan->helth_state = $request->input('helth_state');
      $orphan->ssn = $request->input('ssn');
      $orphan->brother_count = $request->input('brother_count');

      if ($request->hasFile('images')) {
        $image = $request->file('images');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $location = public_path('images/' . $filename);
        Image::make($image)->resize(100, 100)->save($location);

        $orphan->images = $filename;
    } 

    if ($request->hasFile('death_certif')) {
        $image = $request->file('death_certif');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $location = public_path('certificate/' . $filename);
        Image::make($image)->resize(100, 100)->save($location);

        $orphan->death_certif = $filename;
    } 
     
      $orphan->save();
         session()->flash('edit_orphan');
        return redirect()->route('orphans.show', $id); 
       
    }

    public function destroy(Request $request)
    {
       
        $id = $request->orphan_id;
        $orphan = Orphan::findOrFail($id);
      
        $orphan->delete();
        session()->flash('delete_orphan');
        return back();
    }

    public function report(Request $request)
    {
       
        if ($request->type = 1)
        {
            
            $orphans = Orphan::where('stauts',1)->get();
        }
        elseif ($request->type = 2)
        {
            $orphans = Orphan::where('stauts',0)->get();
        }
        else
        {
            $orphans = Orphan::all(); 
        }

        return view ('orphans.report',compact('orphans'));

    }//end of report

    public function get_file($id)

    {
        
        $orphan = Orphan::findOrFail($id);
        $contents= Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($orphan->death_certif);
        return response()->download( $contents);
    }


}
