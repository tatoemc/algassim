<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Sponserform;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Orphan;
use Illuminate\Support\Facades\Auth;
use Image;

class PaymentController extends Controller
{
   
    function __construct()
    {

      $this->middleware('permission:payment-list', ['only' => ['index']]);
      $this->middleware('permission:payment-create', ['only' => ['create','store']]);
      $this->middleware('permission:payment-edit', ['only' => ['edit','update']]);
      $this->middleware('permission:payment-delete', ['only' => ['destroy']]);

    }
    
    public function index()
    {

        $payments = Payment::whereMonth('created_at',Carbon::now()->format('m'))
        ->get();

        return view ('payments.index',compact('payments'));
    }

   
    public function create(Request $request)
    {
        $orphan_id = $request->id;
        $sponserform = Sponserform::where('orphan_id',$orphan_id)->first();
        
         

        //dd($sponserform->orphan->user->name);
        return view ('payments.create',compact('sponserform'));
    }

    
    public function store(StorePaymentRequest $request)
    {
       
       // dd($request->all());
        $orphan_id = $request->orphan_id;
        $orphan = Orphan::where('id', $orphan_id)
        ->with('user','sponserform')
        ->first();
        //dd();
        $sponserform_id  = $orphan->sponserform->id;
        
        $payment = new Payment; 
        $payment->sponserform_id = $sponserform_id;
        $payment->orphan_id = $orphan_id;
        $payment->guardian_id = $orphan->sponserform->guardian_id;
        $payment->images = $sponserform_id;

       
        if ($request->hasFile('images')) {
            $image = $request->file('images');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/payments/' . $filename);
            Image::make($image)->resize(100, 100)->save($location);

            $payment->images = $filename;
        } 
         
        $payment->save();
        session()->flash('add_payment');
        return redirect('/home');


    }// end of store

    
    public function show(Payment $payment,Request $request)
    {
        return view ('payments.show',compact('payment'));
    }
    public function getPayment(Request $request)
    {
        
        $orphans = Orphan::where('id',$request->id)
        ->with('payments')
        ->first();
        
        return view ('payments.payments',compact('orphans'));

    }
    
    public function edit(Payment $payment)
    {
       
    }

    
    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        

        $type = $request->type;

        if($type == 1)
        {

            $payment->update([
                'stauts' =>'1',
            ]);
            session()->flash('add_payment');
            return redirect('/payments');
        }
        
        dd($request->all());
    }//end of update

    
    public function destroy(Payment $payment)
    {
        //
    }
}
