<?php

namespace App\Http\Controllers;

use App\ModelKontak;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class ControllerUser extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Session::get('login')){
            $data = ModelKontak::all();
            return view('kontak',compact('data'));
         }
         else{
             return view('login');
         }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Session::get('login')){
            return view('kontak_create');
         }
         else{
             return view('login');
         }
        
       
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function tangguhkan(Request $request,$id)
    {
        $bytes = random_bytes(10);
        $hasilrandom=bin2hex($bytes);
        $user=Session::get('username');
        DB::table('kontak')->where('uid', $id)->update( [
            'status' => 'ditangguhkan',
        ]);
        $data = ModelKontak::where('uid',$id)->first();
        $username=$data->username;
        DB::table('notifikasi')->insert(
            ['id_notification' => $hasilrandom,'from' => $user,'to' => $username, 'message' => 'Akun anda telah ditangguhkan karena sudah memenuhi syarat ketentuan yang berlaku.', 'date' => date('Y-m-d H:i:s')]
        );
        return redirect()->route('ckontak.index')->with('alert-success','Data berhasil diubah!');
    }
    public function tangguhkan2(Request $request,$id)
    {
        $bytes = random_bytes(10);
        $hasilrandom=bin2hex($bytes);
        $user=Session::get('username');
        DB::table('kontak')->where('username', $id)->update( [
            'status' => 'ditangguhkan',
        ]);
       
        DB::table('notifikasi')->insert(
            ['id_notification' => $hasilrandom,'from' => $user,'to' => $id, 'message' => 'Akun anda telah ditangguhkan karena sudah memenuhi syarat ketentuan yang berlaku.', 'date' => date('Y-m-d H:i:s')]
        );
        DB::table('user_report_list')->where('user_reported', $id)->delete();
        return redirect()->route('ckontak.index')->with('alert-success','Data berhasil diubah!');
    }
    public function aktifkan(Request $request,$id)
    {
        $bytes = random_bytes(10);
        $hasilrandom=bin2hex($bytes);
        $user=Session::get('username');
        DB::table('kontak')->where('uid', $id)->update( [
            'status' => 'aktif',
        ]);
        $data = ModelKontak::where('uid',$id)->first();
        $username=$data->username;
        DB::table('notifikasi')->insert(
            ['id_notification' => $hasilrandom,'from' => $user,'to' => $username, 'message' => 'Akun anda telah diaktifkan karena sudah memenuhi syarat ketentuan yang berlaku.', 'date' => date('Y-m-d H:i:s')]
        );
        return redirect()->route('ckontak.index')->with('alert-success','Data berhasil diubah!');
    }
    public function verifikasi(Request $request,$id)
    {
        $bytes = random_bytes(10);
        $hasilrandom=bin2hex($bytes);
        $user=Session::get('username');
        DB::table('kontak')->where('uid', $id)->update( [
            'verified' => '1',
        ]);
        $data = ModelKontak::where('uid',$id)->first();
        $username=$data->username;
        DB::table('notifikasi')->insert(
            ['id_notification' => $hasilrandom,'from' => $user,'to' => $username, 'message' => 'Akun anda terverifikasi karena sudah memenuhi syarat ketentuan yang berlaku.', 'date' => date('Y-m-d H:i:s')]
        );
        return redirect()->route('ckontak.index')->with('alert-success','Data berhasil diubah!');
    }
    public function copot_verifikasi(Request $request,$id)
    {
        $bytes = random_bytes(10);
        $hasilrandom=bin2hex($bytes);
        $user=Session::get('username');
        DB::table('kontak')->where('uid', $id)->update( [
            'verified' => '0',
        ]);
        $data = ModelKontak::where('uid',$id)->first();
        $username=$data->username;
        DB::table('notifikasi')->insert(
            ['id_notification' => $hasilrandom,'from' => $user,'to' => $username, 'message' => 'Akun anda dicabut untuk diverifikasi karena belum memenuhi syarat ketentuan yang berlaku.', 'date' => date('Y-m-d H:i:s')]
        );
        return redirect()->route('ckontak.index')->with('alert-success','Data berhasil diubah!');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|alpha_dash|min:4|unique:kontak',
            'email' => 'required|min:4|email|unique:kontak',
            'password' => 'required',
            'confirmation' => 'required|same:password',
        ]);
     
        
        $data = new ModelKontak();
        $data->username = $request->username;
        $data->nama = $request->nama;
        $data->email = $request->email;
        $data->status = 'aktif';
        $data->password = bcrypt($request->password);
        $data->nohp = $request->nohp;
        $data->previlege = 0;
        $data->verified = 0;
        $data->alamat = $request->alamat;
        $data->save();
        return redirect()->route('ckontak.index')->with('alert-success','Berhasil Menambahkan Data!');
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
        $data = ModelKontak::where('id',$id)->get();

        return view('kontak_edit',compact('data'));
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
        $data = ModelKontak::where('id',$id)->first();
        $data->nama = $request->nama;
        $data->email = $request->email;
        $data->nohp = $request->nohp;
        $data->alamat = $request->alamat;
        $data->save();
        return redirect()->route('ckontak.index')->with('alert-success','Data berhasil diubah!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function hapus($id)
    {
        DB::table('kontak')->where('uid', $id)->delete();
        return redirect('/user')->with(['alert-success' => 'Data berhasil dihapus!']);
    }
}
