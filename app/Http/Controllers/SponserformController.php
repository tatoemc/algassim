<?php

namespace App\Http\Controllers;

use App\Models\Sponserform;
use App\Models\User;
use App\Models\Orphan;
use App\Models\Sponsor;
use App\Models\Guardian;
use App\Models\Payment;
use App\Http\Requests\StoreSponserformRequest;
use App\Http\Requests\UpdateSponserformRequest;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SponserformController extends Controller
{
    
    function __construct()
     {
       $this->middleware('permission:sponserform-list', ['only' => ['index']]);
       $this->middleware('permission:sponserform-create', ['only' => ['create','store']]);
       $this->middleware('permission:sponserform-edit', ['only' => ['edit','update']]);
       $this->middleware('permission:sponserform-delete', ['only' => ['destroy']]);

     }
     
    public function index()
    {
        $sponserforms = Sponserform::all(); 
        return view ('sponserforms.index',compact('sponserforms'));
    }

    
    public function create()
    {
        $sponsors = Sponsor::all(); 
        $guardians = Guardian::all(); 
        $orphans = Orphan::where('stauts', '0')->get(); 

        return view ('sponserforms.create',compact('orphans','sponsors','guardians'));
    }
 
   
    public function store(StoreSponserformRequest $request)
    {
        
        //dd($request->all());
        $validatedData = $request->validate([
            'kafal_type' => 'required',
            'payment_type' => 'required',
            'amount' => 'required',
            'orphan_id' => 'required',
            'guardian_id' => 'required',
          
        ],[

          
            'kafal_type.required' =>'يرجي اختيار نوع الكفالة ',
            'payment_type.required' =>'يرجى اختيار طريقة الدفع',
            'amount.required' =>'يرجى اختيار قيمة الكفالة',
            'orphan_id.required' =>'يرجى اختيار  اليتيم',
            'guardian_id.required' =>'يرجى اختيار  الكافل',


        ]);
        
        $orphan = Orphan::findOrFail($request->orphan_id);
        $user_id = $orphan->user_id;
        $orphan->update([
            'stauts' => '1',
        ]);
        
        $sponserform = new Sponserform; 
        $sponserform->kafal_type = $request->kafal_type;
        $sponserform->payment_type = $request->payment_type;
        $sponserform->amount = $request->amount;
        $sponserform->orphan_id = $request->orphan_id;
        $sponserform->guardian_id = $request->guardian_id; 
        $sponserform->note = $request->note; 
        $sponserform->user_id = $user_id;

       
        $sponserform->save();

        $sponserform->guardians()->sync([
            $request->guardian_id 
        ]);
       
      
        session()->flash('add_sponserform');
        return redirect('/sponserforms');
           
    }

   
    public function show(Sponserform $sponserform)
    {
       
        dd($sponserform->guardian->user->name);
        return view ('sponserforms.show',compact('sponserform'));
    }

    
    public function edit(Sponserform $sponserform)
    {
        //
    }

   
    public function update(UpdateSponserformRequest $request, Sponserform $sponserform)
    {
        //
    }

   
    public function destroy(Sponserform $sponserform)
    {
        //
    }
}
