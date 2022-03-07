<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;

class StudentController extends Controller
{
    
    public function index()
    {
        $students = Student::all(); 
        return view ('students.index',compact('students'));
    }

   
    public function create()
    {
        return view ('students.create');
    }

   
    public function store(StoreStudentRequest $request)
    {
        
       

        Student::create([
            'name' => $request->name,
            'add' => $request->add,
            'dept_id' => $request->dept_id,
        ]);


        return view ('students.index');
    }

    
    public function show(Student $student)
    {
        //
    }

    
    public function edit(Student $student)
    {
        //
    }

    
    public function update(UpdateStudentRequest $request, Student $student)
    {
        //
    }

   
    public function destroy(Student $student)
    {
        //
    }
}
