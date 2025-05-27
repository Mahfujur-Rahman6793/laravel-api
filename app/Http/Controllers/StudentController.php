<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(){
        return view('ajax.student.show');
    }
    public function getStudent(){
        $students = Student::all();
        return view('ajax.student.partial.details', compact('students'))->render();
    }
    public function create()
    {
        return view('ajax.student.create');
    }
    public function store(Request $request){
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'phone' => 'nullable|string|max:15',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
        } else {
            $imageName = null;
        }
        Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'image' => $imageName,
        ]);

        return response()->json([
            'success' => 'Student created successfully!',
            'route_redirect' => route('create-student')
        ]);
    }
    public function edit($id){
        $student = Student::findOrFail($id);
        // dd($student);
        return view('ajax.student.edit',compact('student'));
    }
    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,'.$id,
            'phone' => 'nullable|string|max:15',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $student = Student::findOrFail($id);

        if($request->hasFile('image')){
            if($student->image){
                unlink(public_path('images/'.$student->image));
            }
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
        } else {
            $imageName = $student->image;
        }

        $student->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'image' => $imageName,
        ]);

        return response()->json([
            'success' => 'Student updated successfully!',
            'route_redirect' => route('show-student')
        ]);
    }
    public function destroy($id){
        $student = Student::findOrFail($id);
        $student->delete();
        // dd($student);
        return redirect()->back()->with('success', 'Student deleted successfully!');
    }
}
