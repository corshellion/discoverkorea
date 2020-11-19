<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\ModelReportUser;
use App\ModelReportPost;
use App\ModelFile;
use App\ModelKontak;
use Illuminate\Support\Facades\Session;
class ControllerReport extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Session::get('login')){
            $data = ModelReportUser::groupBy('user_reported')->select('user_reported', \DB::raw('count(*) as total'))->get();
            return view('report_user',compact('data'));
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
    public function index2()
    {
        if(Session::get('login')){
            $data = ModelReportPost::groupBy('id_post')->select('id_post', \DB::raw('count(*) as total'))->get();
            return view('report_post',compact('data'));
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
    public function lapor_post(Request $request,$id)
    {
        $bytes = random_bytes(10);
        $hasilrandom=bin2hex($bytes);
        $user=Session::get('username');
        DB::table('post_report_list')->insert(
            ['id_report' => $hasilrandom,'id_post' => $id, 'reporter' =>  $user, 'date' => date('Y-m-d H:i:s')]
        );
        $data = ModelFile::where('uid',$id)->first();
        $username=$data->username;
        
        DB::table('notifikasi')->insert(
            ['id_notification' => $hasilrandom,'from' => $user,'to' => $username, 'message' => 'Pengguna melaporkan unggahan dari '.$username.' sebagai tidak pantas.', 'date' => date('Y-m-d H:i:s')]
        );
        return redirect('/laporan_berita')->with(['alert-success' => 'Berhasil Menambahkan Data!']);
    }
    public function lapor_pengguna(Request $request,$id)
    {
        $bytes = random_bytes(10);
        $hasilrandom=bin2hex($bytes);
        $user=Session::get('username');
        DB::table('user_report_list')->insert(
            ['id_report' => $hasilrandom,'user_reported' => $id,'reporter' =>  $user, 'date' => date('Y-m-d H:i:s')]
        );
        $data = ModelKontak::where('username',$id)->first();
        $username=$id;
        DB::table('notifikasi')->insert(
            ['id_notification' => $hasilrandom,'from' => $user,'to' =>$username, 'message' => 'Pengguna melaporkan  '.$username.' sebagai akun tidak pantas.', 'date' => date('Y-m-d H:i:s')]
        );
        return redirect('/laporan_pengguna')->with(['alert-success' => 'Berhasil Menambahkan Data!']);
    }
    public function decline_post(Request $request,$id)
    {
        DB::table('post_report_list')->where('id_post', $id)->delete();
        return redirect('/file_pengguna')->with(['alert-success' => 'Data berhasil diubah!']);
    }
    public function decline_user(Request $request,$id)
    {
        DB::table('user_report_list')->where('user_reported', $id)->delete();
        return redirect('/file_pengguna')->with(['alert-success' => 'Data berhasil diubah!']);
    }
    public function aktifkan_post_report(Request $request,$id)
    {
       
        DB::table('file')->where('uid', $id)->update( [
            'status_post' => 'ditangguhkan',
        ]);
        DB::table('post_report_list')->where('id_post', $id)->delete();
        return redirect('/file_pengguna')->with(['alert-success' => 'Data berhasil diubah!']);
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
    //     $data = ModelKontak::where('id',$id)->first();
    //     $data->delete();
    //     return redirect()->route('ckontak.index')->with('alert-success','Data berhasi dihapus!');
    // }
}
