<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class OutletController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        
        $outlet = DB::table('tb_outlet')->get();
        return view('outlet/index',compact('outlet'));
    }

    public function store(Request $request)
    {
            DB::table('tb_outlet')->insert([
                'nama_outlet'=> $request->nama_outlet,
                'alamat_outlet' => $request->alamat_outlet,
                'tlp_outlet' => $request->tlp_outlet,
            ]);
        
        return redirect()->back()->with('masuk','Data Berhasil Di Input');
    }

    public function edit($id)
    {
        $outlet = DB::table('tb_outlet')->where('id_outlet',$id)->first();
        return view('outlet/edit',compact('outlet'));
    }

    public function update(Request $request)
    {
        
        DB::table('tb_outlet')->where('id_outlet',$request->id_outlet)->update([
            'nama_outlet'=> $request->nama_outlet,
            'alamat_outlet' => $request->alamat_outlet,
            'tlp_outlet' => $request->tlp_outlet,
        ]);

        return redirect('outlet')->with('update','Data Berhasil Di Update');
    }

}
