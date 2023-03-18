<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Requests\CompanyRequest;
use App\Models\Employee;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use Validator;
use PDF;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('company.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->passes()) {
            $compancy=new Company();
            $compancy->name=$request->name;
            $compancy->email=$request->email;
            $compancy->website=$request->website;
            $compancy->address=$request->address;
          //  $compancy->pdf=$request->pdf;
            $compancy->save();
            return response()->json(['status'=>"true"]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete(Request $request)
    {
        $id=$request->id;
        $compancy_id=Employee::where('company_id',$id)->exists();
        if($compancy_id)
        {
            return response()->json(['status'=>"false"]);
        }
        else
        {
            Company::find($id)->delete();
            return response()->json(['status'=>"true"]);
        }
      
    }


    public function edit_logo(Request $request)
    {
      
        $validator = Validator::make($request->all(), [
       // 'logo' => 'mimes:jpg,png|dimensions:width=100,height=100'
        ]);
        if ($validator->passes()) {
        if($request->file('logo'))
            {
                $file=$request->file('logo');
                $file_name=$file->getClientOriginalName();
                $file->storeAs('public/images',$file_name);
                $is_file_uploaded = Storage::disk('dropbox')->put('CRM_Laravel_Project',$file);
               
            }
        $edit=Company::where('
        id',$request->id)->update([
            "logo"=>$file_name
        ]);
        return response()->json(['status'=>"true"]);
        }
        return response()->json(['error'=>$validator->getMessageBag()->toArray()]);

    }


    public function edit_file(Request $request)
    {
        $validator = Validator::make($request->all(), [
             'pdf' => 'mimes:pdf'
             ]);
             if ($validator->passes()) {
             if($request->file('pdf'))
                 {
                     $file=$request->file('pdf');
                     $file_name=$file->getClientOriginalName();
                     $file->storeAs('public/PDF',$file_name);
                 }
             $edit=Company::where('id',$request->id)->update([
                 "pdf"=>$file_name
             ]);
             return response()->json(['status'=>"true"]);
             }
             return response()->json(['error'=>$validator->getMessageBag()->toArray()]);
     
    }

    public function edit_compancy(Request $request)
    {
        $edit_company=Company::where('id',$request->id)->first();
        return response()->json(['status'=>"true",'edit_company'=>$edit_company]);
    }


    public function update_compancy(Request $request)
    {
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->passes()) {
            $compancy=Company::find($request->id);
            $compancy->name=$request->name;
            $compancy->email=$request->email;
            $compancy->website=$request->website;
            $compancy->address=$request->address;
          //  $compancy->pdf=$request->pdf;
            $compancy->update();
            return response()->json(['status'=>"true"]);
        }
    	return response()->json(['error'=>$validator->getMessageBag()->toArray()]);
        
    }

    public function getdata(Request $request)
    {
        if ($request->ajax()) {
            $data = Company::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('logo',function($row){
                   $logo = '<button class="btn btn-outline-success btn-sm logo_btn" data-toggle="modal" data-target="#logo_upload" data-id="'.$row->id.'">Browse</button>';
                   return $logo;
                })
                ->addColumn('pdf',function($row){
                    $pdf = '<button id="'.$row->id.'"class="btn btn-outline-success btn-sm pdf_btn"  data-toggle="modal" data-target="#File_upload" data-id="'.$row->id.'">Browse</button>';
                    return $pdf;
                 })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="" class="edit btn btn-primary btn-sm" data-toggle="modal" data-target="#company_create" data-id="'.$row->id.'">Edit</a>';
                    $btn .= '<a href="" id="'.$row->id.'" class="delete btn btn-danger ml-2 btn-sm">Delete</a>';
                   
                    $btn .= '<a href="'.route('generatepdf',$row->id).'" class="pdf btn btn-warning ml-2 btn-sm">PDF</a>';
                    return $btn;
                })
                ->rawColumns(['logo','pdf','action'])
                ->make(true);
        }
        return view('compancy');
    }


    public function generatePDF($id)
    {
        $data=Company::where('id',$id)->get();
        $pdf = PDF::loadView('mypdf',compact('data'));
        return $pdf->stream('company.pdf');
    }
    
}
