<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DataTables;
use Hash;

use App\Models\Pelanggan;


class PelangganController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Pelanggan::select('*')->orderBy('id','DESC');
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '<div class="row"><a href="javascript:void(0)" id="'.$row->id.'" class="btn btn-primary btn-sm ml-2 btn-edit">Edit</a>';
                           $btn .= '<a href="javascript:void(0)" id="'.$row->id.'" class="btn btn-danger btn-sm ml-2 btn-delete">Delete</a></div>';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return view('admin.pelanggan.index');
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {   
        $request->request->add(['password' => Hash::make($request->password)]);
        Pelanggan::create($request->all());
    }

    public function show($id)
    {
        
    }

    public function edit(Pelanggan $pelanggan)
    {
        return response()->json($pelanggan);
    }

    public function update(Request $request, Pelanggan $pelanggan)
    {
        $pelanggan->update($request->all());
    }

    public function destroy(User $user)
    {
        $user->delete();
    }
}
