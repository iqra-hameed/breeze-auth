<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use Spatie\Permission\Models\Role;

use DB;
use Hash;
use Illuminate\Support\Arr;
use DataTables;

class CompanyController extends Controller
{

    function __construct()
    {
        $this->middleware->auth();
        //  $this->middleware('permission:company-list|company-create|company-edit|company-delete', ['only' => ['index','show']]);
        //  $this->middleware('permission:company-create', ['only' => ['create','store']]);
        //  $this->middleware('permission:company-edit', ['only' => ['edit','update']]);
        //  $this->middleware('permission:company-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $form = Company::latest()->get();
            return Datatables::of($form)->addColumn('name', function ($row) {
                return  $row->name;
            })
                ->addColumn('email', function ($row) {
                    return  $row->email;
                })
                ->addColumn('logo', function ($row) {
                    return  $row->logo;
                })
                ->addColumn('website', function ($row) {
                    return  $row->website;
                })
                ->addColumn('creator_id', function ($row) {
                    return  $row->creator_id;
                })

                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';

                    return $btn;
                })->rawColumns(['action'])->make(true);
        }
        return view('company');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data= new Company();
        $data['id']= $$request->product_id;
        $data['name']= $$request->name;
        $data['email']= $$request->email;
        $data['website']= $$request->website;

        if($request->file('image')){
            $file= $request->file('image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('public/Image'), $filename);
            $data['logo']= $filename;
            var_dump($data['logo']);
die();
        }

        $data->save();
        return response()->json(['success' => ' saved successfully.']);
    }


    public function edit($id)
    {
        $company = Company::find($id);
        return response()->json($company);
    }


    public function destroy($id)
    {
        Company::find($id)->delete();

        return response()->json(['success' => ' deleted successfully.']);
    }


    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $logo = time().'.'.$request->image->extension();

        $request->image->move(public_path('images'), $logo);

        /* Store $imageName name in DATABASE from HERE */

        return back()
            ->with('success','You have successfully upload image.')
            ->with('image',$logo);
    }
}
