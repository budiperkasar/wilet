<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class MemberController extends Controller
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

        $memberData = DB::table('tb_member')->get();

        $members = [];

        foreach ($memberData as $memberDatum)
        {
            $members[] = [
                'id_member' => $memberDatum->id_member,
                'nama_member' => $memberDatum->nama_member,
                'alamat_member' => $memberDatum->alamat_member,
                'jk' => $memberDatum->jk,
                'tlp' => $memberDatum->tlp,
                'subsc_state' => $memberDatum->subsc_state,
                'subsc_label' => $this->getNewSubsLabel($memberDatum->subsc_state)

            ];
        }

        return view('member/index',compact('members'));
    }

    public function getNewSubsLabel($state)
    {
        $states = [
            'sign_up' => trans('subscription.state.sign_up'),
            'subscribed' => trans('subscription.state.subscribed'),
            'unsubscribed' => trans('subscription.state.unsubscribed')
        ];

        return $states[$state];
    }

    public function getSubscLabel(string $state)
    {
//        return $state ? ucwords(str_replace('_', ' ' , $state)) : null;
       switch ($state) {
           case 'sign_up': return 'Berminat';
           case 'subscribed': return 'Berlangganan';
           case 'unsubscribed': return 'Berhenti Berlangganan';
           default: return 'Belum Terdaftar';
       }
    }

    public function store(Request $request)
    {


            DB::table('tb_member')->insert([
                'nama_member'=> $request->nama_member,
                'alamat_member' => $request->alamat_member,
                'jk'=>$request->jk,
                'tlp' => $request->tlp,
                'subsc_state' => $request->subsc_state
            ]);

        return redirect()->back()->with('masuk','Data Berhasil Di Input');
    }

    public function edit($id)
    {
        $member = DB::table('tb_member')->where('id_member',$id)->first();
        return view('member/edit',compact('member'));
    }

    public function update(Request $request)
    {

        DB::table('tb_member')->where('id_member',$request->id_member)->update([
            'nama_member'=> $request->nama_member,
            'alamat_member' => $request->alamat_member,
            'jk'=>$request->jk,
            'tlp' => $request->tlp,
            'subsc_state' => $request->subsc_state
        ]);

        return redirect('member')->with('update','Data Berhasil Di Update');
    }

}
