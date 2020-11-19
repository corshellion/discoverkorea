<?php

namespace App\Http\Controllers;

use App\ModelFile;
use App\ModelAds;
use App\ModelKontak;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class ControllerAds extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function iklanaktif()
    {

        if(Session::get('login')){
            $data = ModelFile::all();
            return view('ads',compact('data'));
         }
         else{
             return view('login');
         }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function permintaan_iklan()
    {
        if(Session::get('login')){
            $data = ModelAds::all();
            return view('ads_request',compact('data'));
         }
         else{
             return view('login');
         }
    }
    public function buat_iklan()
    {

        if(Session::get('login')){
            $data = ModelKontak::all();
            return view('ads_create',compact('data'));
         }
         else{
             return view('user');
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
        $data = ModelKontak::where('uid',$id)->first();
        $data->status = 'ditangguhkan';
        $data->save();
        return redirect()->route('ckontak.index')->with('alert-success','Data berhasil diubah!');
    }
    public function aktifkan(Request $request,$id)
    {
        $data = ModelKontak::where('uid',$id)->first();
        $data->status = 'aktif';
        $data->save();
        return redirect()->route('ckontak.index')->with('alert-success','Data berhasil diubah!');
    }
    public function decline_iklan(Request $request,$id)
    {
        
        DB::table('ads_request')->where('id_request', $id)->delete();
        return redirect('/permintaan_iklan')->with(['alert-success' => 'Berhasil Menghapus Data!']);
    }
    public function aktifkan_iklan(Request $request,$id)
    {
        $bytes = random_bytes(10);
        $hasilrandom=bin2hex($bytes);
        $idreq=$id;
        $dataiklan = DB::table('ads_request')->where('id_request', $id)->first();
    
        $data = new ModelFile();
        $data->id = $hasilrandom;
        $data->username = $dataiklan->username;
        $data->status = $dataiklan->status;
        $data->file =$dataiklan->file;
        $data->type = $dataiklan->type;
        $data->previlege = 0;
        $data->status_post = 'aktif';
        $data->category = 'ads';
        $data->ended_at=date('Y-m-d H:i:s');
        $data->save();
        
        DB::table('ads_request')->where('id_request', $id)->delete();
        return redirect('/iklan')->with(['alert-success' => 'Berhasil Menambahkan Data!']);
    }
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function unggah_permintaan_iklan(Request $request)
    {
        $bytes = random_bytes(10);
        $hasilrandom=bin2hex($bytes);
        $fileMimeType = $request->file('file')->getMimeType();
          $type =substr($fileMimeType,0,5);
         
        $dataku = new ModelAds();
        $dataku->id_request = $hasilrandom;
        $dataku->username = $request->input('name');
        $dataku->status = $request->input('status');
        $file = $request->file('file');
        $ext = $file->getClientOriginalExtension();
        $newName = rand(100000,1001238912).".".$ext;
        $file->move('uploads/file',$newName);
        $dataku->file = $newName;
        $dataku->type = $type;
        $dataku->ended_at=date('Y-m-d H:i:s');
        $dataku->save();
        return redirect('/permintaan_iklan')->with(['alert-success' => 'Berhasil Menambahkan Data!']);
    }
    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {
    //     $data = new ModelKontak();
    //     $data->nama = $request->nama;
    //     $data->email = $request->email;
    //     $data->nohp = $request->nohp;
    //     $data->alamat = $request->alamat;
    //     $data->save();
    //     return redirect()->route('kontak.index')->with('alert-success','Berhasil Menambahkan Data!');
    // }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit($id)
    // {
    //     $data = ModelKontak::where('id',$id)->get();

    //     return view('kontak_edit',compact('data'));
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, $id)
    // {
    //     $data = ModelKontak::where('id',$id)->first();
    //     $data->nama = $request->nama;
    //     $data->email = $request->email;
    //     $data->nohp = $request->nohp;
    //     $data->alamat = $request->alamat;
    //     $data->save();
    //     return redirect()->route('ckontak.index')->with('alert-success','Data berhasil diubah!');
    // }


    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy($id)
    // {
    //     $data = ModelKontak::where('id_request',$id)->first();
    //     $data->delete();
    //     return redirect()->route('ckontak.index')->with('alert-success','Data berhasi dihapus!');
    // }
}
