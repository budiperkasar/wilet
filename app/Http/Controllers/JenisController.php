<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class JenisController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        
        $jenis = DB::table('tb_jenis')->get();
        return view('jenis/index',compact('jenis'));
    }

    public function store(Request $request)
    {
            DB::table('tb_jenis')->insert([
                'nama_jenis'=> $request->nama_jenis,
            ]);
        
        return redirect()->back()->with('masuk','Data Berhasil Di Input');
    }

    public function edit($id)
    {
        $jenis = DB::table('tb_jenis')->where('id_jenis',$id)->first();
        return view('jenis/edit',compact('jenis'));
    }

    public function update(Request $request)
    {
        DB::table('tb_jenis')->where('id_jenis',$request->id_jenis)->update([
            'nama_jenis'=> $request->nama_jenis,
        ]);

        return redirect('jenis')->with('update','Data Berhasil Di Update');
    }

}
