<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class EmployeeController extends Controller
{

// For display frontpage

    public function index()
    {
        $title = "User Registration";
        $btn = "Add User";
        $heading = "User Registration Form";
        $url = route('store.form');
        $data = compact('title','btn','heading','url');
        return view('employeeregister')->with($data);
    }


    // For store data in database with some type of validation

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:employees',
            'image' => 'required|mimes:png,jpg,jpeg|max:2048',
            'password' => [
                'required',
                'max:20',
                'min:8',
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/',
            ],
            'confirm_password' => 'required|same:password'
        ]);

       $employee = new Employee();
       $employee->name = $request['name'];
       $employee->email = $request['email'];

       $file = $request->file('image');

       $imagename = "Souvik-".date('dmyhisms').'.'.$file->getClientOriginalExtension();
       $destination = "public/uploads";
       $file->move($destination,$imagename);

       $employee->image = $imagename;

       $employee->password = Hash::make($request['password']);

       $employee->save();

        return redirect('employeedashboard')->with('success','User added successfully!');

    }


    // For display records from database

    public function view()
    {
        $title = "User Dashboard";
        $records = Employee::orderBy('id','desc')->paginate(3);

        $data = compact('title','records');

        return view('employeedashboard')->with($data);
    }


    // For delete records

    public function delete(Request $request)
    {
        $formid = $request->input('user_delete_id');
        $id = decrypt($formid);
        $record = Employee::find($id);

        $destination = "public/uploads/".$record->image;
        if(File::exists($destination)){
            File::delete($destination);
        }

        $record->delete();
        return redirect()->back()->with('success','Record deleted successfully!');
    }

    // For fetch value from databse in form when we will click the edit button

    public function edit($id)
    {
        $id = decrypt($id);
        $record = Employee::find($id);

        $btn = "UPDATE";
        $heading = "User Update Form";
        $title = "User Update Form";
        $url = route('employee.update',['id' => encrypt($id)]);
        $data = compact('record','btn','heading','title','url');
        return view('employeeupdate')->with($data);
    }


    // For update the new values in database

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'image' => 'required|mimes:png,jpg,jpeg|max:2048',

        ]);

        $id = decrypt($id);
        $employee = Employee::find($id);

        $employee->name = $request['name'];
        $employee->email = $request['email'];

       if($request->hasFile('image')){
        $destination = "public/uploads/".$employee->image;
        if(File::exists($destination)){
            File::delete($destination);
        }
        $employee->delete();



        $file = $request->file('image');

        $imagename = "Souvik-".date('dmyhisms').'.'.$file->getClientOriginalExtension();
        $destination = "public/uploads";
        $file->move($destination,$imagename);

        $employee->image = $imagename;

    }

       $employee->save();

        return redirect('employeedashboard')->with('success','User updated successfully!');
    }


    // For change status

    public function status($id)
    {
        $id = decrypt($id);
        $data = Employee::find($id);

        if($data->status == 1){
            $data->status = 0;
        }else{
            $data->status = 1;
        }

        $data->save();

        return redirect()->back();
    }

    // For multiple records delete

    public function multipleDelete(Request $request)
    {
        foreach($request->input(['id'],[]) as $key => $value){
            $id = decrypt($value);
            $data = Employee::find($id);
            $destination = "public/uploads/".$data->image;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $data->delete();
        }

        return redirect()->back()->with('success','All records have been deleted!');
    }

}
