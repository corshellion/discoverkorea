<?php

namespace App\Http\Controllers;
use App\ModelFile;
use App\ModelKontak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class File extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Session::get('login')){
           $data = \App\ModelFile::all();
          return view('file',compact('data'));
        }
        else{
            return view('login');
        }
        
    }
    public function index_pengguna()
    {
        if(Session::get('login')){
            $data = \App\ModelFile::all();
            return view('file_pengguna',compact('data'));
         }
         else{
             return view('login');
         }
         
        
    }
    public function social()
    {
        if(Session::get('login')){
            $data = DB::table('file')
            ->orderBy('created_at', 'desc')
            ->get();
            return view('socialview',compact('data'));
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
        $data = \App\ModelFile::where('uid',$id)->first();
        DB::table('file')->where('uid', $id)->update( [
            'status_post' => 'ditangguhkan',
        ]);
        $username=$data->username;
        DB::table('notifikasi')->insert(
            ['id_notification' => $hasilrandom,'from' => $user,'to' => $username, 'message' => 'Unggahan anda ditangguhkan karena belum memenuhi syarat ketentuan yang berlaku.', 'date' => date('Y-m-d H:i:s')]
        );
        return redirect('/file_pengguna')->with(['alert-success' => 'Data berhasil diubah!']);
    }
    public function aktifkan(Request $request,$id)
    {
        $bytes = random_bytes(10);
        $hasilrandom=bin2hex($bytes);
        
        $data = \App\ModelFile::where('uid',$id)->first();
        DB::table('file')->where('uid', $id)->update( [
            'status_post' => 'aktif',
        ]);
        $username=$data->username;
        DB::table('notifikasi')->insert(
            ['id_notification' => $hasilrandom,'from' => $user,'to' => $username, 'message' => 'Akun anda telah diaktifkan  kembali karena sudah memenuhi syarat ketentuan yang berlaku.', 'date' => date('Y-m-d H:i:s')]
        );
        return redirect('/file_pengguna')->with(['alert-success' => 'Data berhasil diubah!']);
    }
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Session::get('login')){
            return view('file_create');
         }
         else{
             return view('login');
         }
         
        
    }
    public function unggahan_pengguna()
    {
        if(Session::get('login')){
            $data = \App\ModelKontak::all();
            return view('unggahan_create',compact('data'));
         }
         else{
             return view('login');
         }
        
    }
  /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_pengguna(Request $request)
    {
        $bytes = random_bytes(10);
        $hasilrandom=bin2hex($bytes);
        $fileMimeType = $request->file('file')->getMimeType();
          $type =substr($fileMimeType,0,5);
         
        $data = new \App\ModelFile();
        $data->uid = $hasilrandom;
        $data->username = $request->input('name');
        $data->title = $request->input('title');
        $data->status = $request->input('status');
        $file = $request->file('file');
        $ext = $file->getClientOriginalExtension();
        $newName = rand(100000,1001238912).".".$ext;
        $file->move('uploads/file',$newName);
        $data->file = $newName;
        $data->status_post ='aktif';
        $data->type = $type;
        $data->previlege = 0;
        $data->category = 'post';
        $data->ended_at=date('Y-m-d H:i:s');
        $data->save();
        return redirect('/file_pengguna')->with(['alert-success' => 'Data berhasil ditambahkan!']);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        $bytes = random_bytes(10);
        $hasilrandom=bin2hex($bytes);
        $hasil;
        try {

            $user = DB::table('users')->where('email', $id)->first();

            $hasil= $user->previlege;
          
          } catch (\Exception $e) {
          
              $hasil=0;
          }
          $fileMimeType = $request->file('file')->getMimeType();
          $type =substr($fileMimeType,0,5);
         
        $data = new \App\ModelFile();
        $data->uid = $hasilrandom;
        $data->username = $request->input('name');
        $data->status = $request->input('status');
        $data->title = $request->input('title');
        $file = $request->file('file');
        $ext = $file->getClientOriginalExtension();
        $newName = rand(100000,1001238912).".".$ext;
        $file->move('uploads/file',$newName);
        $data->file = $newName;
        $data->status_post ='aktif';
        $data->type = $type;
        $data->previlege = $hasil;
        $data->category = 'news';
        $data->save();
        return redirect()->route('file.index')->with('alert-success','Data berhasil ditambahkan!');
    }
    //untuk edit data

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        if(Session::get('login')){
            $data = \App\ModelFile::findOrFail($id);
            return view('file_edit',compact('data'));
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
    public function update(Request $request, $id)
    {
        $data = \App\ModelFile::findOrFail($id);
        $data->username = $request->input('name');
        if (empty($request->file('file'))){
            $data->file = $data->file;
        }
        else{
            unlink('uploads/file/'.$data->file); //menghapus file lama
            $file = $request->file('file');
            $ext = $file->getClientOriginalExtension();
            $newName = rand(100000,1001238912).".".$ext;
            $file->move('uploads/file',$newName);
            $data->file = $newName;
        }
        $data->save();
        return redirect()->route('file.index')->with('alert-success','Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function hapus($id)
    {
        
        
            $dataku = DB::table('file')->where('uid', $id)->first();

            $kategori= $dataku->category;
            DB::table('file')->where('uid', $id)->delete();
       
            if($kategori=='ads')
            {
                return redirect('/iklan')->with(['alert-success' => 'Data berhasil dihapus!']);
            }else
            {
                return redirect('/file_pengguna')->with('alert-success','Data berhasil dihapus!');
            }
          
          
        
    }
}