<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orphan;
use App\Models\Sponsor;
use App\Models\Sponserform;
use App\Models\Guardian;
use App\Models\User;

class ReportsController extends Controller
{

    public function index(Request $request)
    {
        
        $type = $request->type;
        
        if($type == 0)
        {
            $orphans = Orphan::all();
        }
        elseif ($type == 1)
         {
            $orphans = Orphan::where('stauts',1)->get();
        }
        elseif ($type == 2)
        {
            $orphans = Orphan::where('stauts',0)->get();
        }
         //dd($orphans);
      
        return view ('reports.index',compact('orphans'));
    }

    public function usereport(Request $request)
    {

       // dd($request->all());
       $guardians = Guardian::with(['user'])->get();
      
        return view ('reports.usereport',compact('guardians'));

    }//end of reportsorphans 

    public function sponsorsreport(Request $request)
    {

       // dd($request->all());
       $sponsors = Sponsor::with(['user'])->get();
        return view ('reports.sponsorsreport',compact('sponsors'));

    }//end  sponsorsReport

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
