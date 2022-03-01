<?php

namespace App\Http\Controllers;

use App\Models\Dept;
use App\Http\Requests\StoreDeptRequest;
use App\Http\Requests\UpdateDeptRequest;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class DeptController extends Controller
{
    
    function __construct()
    {

      $this->middleware('permission:dept-list', ['only' => ['index']]);
      $this->middleware('permission:dept-create', ['only' => ['create','store']]);
      $this->middleware('permission:dept-edit', ['only' => ['edit','update']]);
      $this->middleware('permission:dept-delete', ['only' => ['destroy']]);

    }
    
    public function index()
    {
        $depts =  Dept::all();
       
        return view ('depts.index',compact('depts'));
    }

    public function create()
    {
        return view ('depts.create');
    }

    
    public function store(StoreDeptRequest $request)
    {
        
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ],[

          
            'name.required' =>'يرجي ادخال الاسم ',
        ]);

        Dept::create([
            'name' => $request->name,
           
        ]);

        $depts =  Dept::all();

        session()->flash('dept_Add');
       // return redirect('/depts');
       return view ('depts.index',compact('depts'));
    }

    
    public function show(Dept $dept)
    {
        //
    }

    
    public function edit(Dept $dept)
    {
        return view ('depts.edit',compact('dept'));
    }

    public function update(UpdateDeptRequest $request, Dept $dept)
    {
     
       $dept->update([
            'name' => $request->name,
        ]);
        session()->flash('dept_edit');
        return redirect('/depts');
        
    }

    
    public function destroy(Request $request,$id)
    {
       
        $dept = Dept::findOrFail($id);
      
        $dept->delete();
        session()->flash('dept_delete');
        return redirect('/depts');
    }
}
