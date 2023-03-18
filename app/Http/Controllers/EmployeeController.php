<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Validator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('employee.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $compancy=Company::all();
        return view('employee.create',compact('compancy'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required'
        ]);
        if ($validator->passes()) {

        $employee= new Employee();
        $employee->first_name=$request->first_name;
        $employee->last_name=$request->last_name;
        $employee->company_id=$request->compancy_id;
        $employee->email=$request->email;
        $employee->phone=$request->phone;
        $employee->save();
        return response()->json(["status"=>"true"]);
        }
    	return response()->json(['error'=>$validator->getMessageBag()->toArray()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit=Employee::find($id);
        $compancy=Company::all();
        return view('employee.edit',compact('edit','compancy'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required'
        ]);
        if ($validator->passes()) {

        $employee= Employee::find($id);
        $employee->first_name=$request->first_name;
        $employee->last_name=$request->last_name;
        $employee->company_id=$request->compancy_id;
        $employee->email=$request->email;
        $employee->phone=$request->phone;
        $employee->update();
        return response()->json(["status"=>"true"]);
        }
    	return response()->json(['error'=>$validator->getMessageBag()->toArray()]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $compancy_id=Employee::where('company_id',$id)->exists();
        if($compancy_id)
        {
            return redirect('compancy')->withErrors(["message"=>"You Con't delete company"]);
        }
        else
        {
            Company::find($id)->delete();
            return redirect('compancy');
        }
    }

    public function delete($id)
    {
        Employee::find($id)->delete();
        return redirect('employee');
    }

    public function getdata(Request $request)
    {
        if ($request->ajax()) {
            $data = Employee::with('compancy')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('company', function ($row) {
                   return  $row->compancy->name;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="'.route('employee.edit',$row->id).'" class="edit btn btn-primary btn-sm">Edit</a>';
                    $btn .= '<a href="'.route('employee.delete',$row->id).'" class="delete btn btn-danger ml-2 btn-sm">Delete</a>';
                   return $btn;
                })
                ->rawColumns(['action','company'])
                ->make(true);
        }
        return view('employee');
    }

    public function data()
    {
        return "123";
    }
}
