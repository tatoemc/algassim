<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Sponserform;
use App\Models\Guardian;
use App\Models\Orphan;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
       

        $count_all = Orphan::count();
        $count_orphan1 = Orphan::where('stauts',0)->count();
        $count_orphan2 = Orphan::where('stauts',1)->count();

        if($count_orphan1 == 0){
            $persent1=0;
        }
        else{
            $persent1 = $count_orphan1/ $count_all*100;
        }
  
        if($count_orphan2 == 0){
              $persent2=0;
          }
          else{
              $persent2 = $count_orphan2/ $count_all*100;
          }

          $user_id = Auth::user()->id;
          $guardian = Guardian::where('user_id',$user_id)
          ->with('user','sponserforms')
          ->first();
         //get orphans
          $orphans = Orphan::where('user_id',$user_id)->get();
          //get Payment
         // $guardian = Guardian::where('user_id',Auth::user()->id)->first();
         // $guardian_id = $guardian->id;
         
          //dd($payments);
        
        return view('home',compact('guardian','orphans','persent1','persent2'));
    }
}
