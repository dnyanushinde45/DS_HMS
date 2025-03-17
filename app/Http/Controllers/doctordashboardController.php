<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use function Laravel\Prompts\confirm;

class DoctorDashboardController extends Controller
{

    public function home()
{
    $doctorCount = Doctor::count(); // Fetch doctor count
    return view('doctor.home', compact('doctorCount'));
}

    public function doctordashboard(){
        return view("doctor.doctordashboard");
    }

    public function storedoctor(Request $request){
        $rules = [
            "name" => "required",
            "email" => "required|unique:doctor,email",
            "phonenumber" => "required|numeric",
            "address" => "required",
            "department" => "required",
            "post" => "required",
            "gender" => "required|string|in:male,female,other",
            "password" => "required|min:6",
        ];

        if($request->image != ""){
            $rules['image'] = 'image';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Store doctor details
        $doctor = new Doctor();
        $doctor->name = $request->name;
        $doctor->email = $request->email;
        $doctor->phonenumber = $request->phonenumber;
        $doctor->address = $request->address;
        $doctor->department = $request->department;
        $doctor->post = $request->post;
        $doctor->gender = $request->gender; 
        $doctor->password = Hash::make($request->password); // Secure password
        $doctor->save();

        // if($request->image != ""){
            
        //     //here we will store image
        // $image = $request->image;
        // $ext = $image->getClientOriginalExtension();
        // $imageName = time().'.'.$ext; //unique image name

        // //save image to products directroy
        // $image->move(public_path('upload/doctorsimages'), $imageName);

        // //save image name in database
        // $doctor->image = $imageName;
        // $doctor->save();
        // }

        return redirect()->route('doctordashboard')->with('success', 'Doctor registered successfully');
    }

    public function display(Request $request){
        $doctorlist = DB::table('doctors')->simplePaginate(8);

        // dd( $doctorlist);
        return view('doctor.display', compact('doctorlist'));
    }

    public function edit($id){
        $doctors = Doctor::findOrFail($id);
        return view('doctor.update', [
            'doctors' => $doctors
        ]);
    }

    public function update(Request $request, $id){
        $doctors = doctor::findOrFail($id);

        $rules = [
            "name" => "required",
            "email" => "required|unique:doctor,email",
            "phonenumber" => "required|numeric",
            "address" => "required",
            "department" => "required",
            "post" => "required",
            "gender" => "required|string|in:male,female,other",
            "password" => "required|min:6",
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return redirect()->route('doctor.update',$doctors->id)->withErrors($validator)->withInput();
        }

        
        $doctors->name = $request->name;
        $doctors->email = $request->email;
        $doctors->phonenumber = $request->phonenumber;
        $doctors->address = $request->address;
        $doctors->department = $request->department;
        $doctors->post = $request->post;
        $doctors->gender = $request->gender; 
        $doctors->password = Hash::make($request->password);
        
        $doctors->save();

        return redirect()->route('doctorlist')->with("success","update successfully");

    }

    public function destroy($id){
        $doctors = Doctor::findOrFail($id);


            $doctors->delete();
            return redirect()->route("doctorlist")->with("success","Delete successfully");
    }

//     public function userDashboard()
// // {
// // //    $doctorCount = Doctor::count(); 
// //     // dd($doctorCount); // This will dump and stop execution

// //     return view('Customer.userDashboard');
// }
}
