<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\ModelKontak;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;
class ControllerKontak extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = \App\ModelKontak::all();
    
        if(count($data) > 0){ //mengecek apakah data kosong atau tidak
            $res['message'] = "Success!";
            $res['values'] = $data;
            return response($res);
        }
        else{
            $res['message'] = "Empty!";
            return response($res);
        }
    }
    public function coba()
    {
        $data = \App\ModelKontak::all();
    
        if(count($data) > 0){ //mengecek apakah data kosong atau tidak
            $res['message'] = "Success!";
            $res['values'] = count($data);
            return response($res);
        }
        else{
            $res['message'] = "Empty!";
            return response($res);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postuser(Request $request)
    {
            $rules = array(
                'name' => 'required|min:4',
                'username' => 'required|min:4||unique:kontak',
                'email' => 'required|min:4|email|unique:kontak',
                'password' => 'required|min:6',
                'confirmation' => 'required|same:password',
            );    
            $messages = array(
                'name.required'    => 'Yuk cantumkan nama lengkapmu agar temanmu bisa mengenalimu.',
                'username.unique'      => 'Maaf kawan, username ini telah digunakan orang lain, silahkan menggunakan username lainnya.',
                'email.unique'    => 'Maaf kawan, e-mail ini telah digunakan orang lain, silahkan menggunakan email lainnya',
                'email.email'    => 'Hai kawan, ada sesuatu yang salah, coba masukan e-mail yang benar ',
                'password.required' => 'Yuk isi password yang benar :)',
                'confirmation.required'      => 'Ada yang salah lho, coba kamu cek passwordmu dengan password konfirmasi.',
                        );
            $validator = Validator::make( $request->all(), $rules, $messages );

            if ( $validator->fails() ) 
            {
                return response()->json($validator->errors()->first(), 400);
                // return [
                //     'success' => 400, 
                //     'message' => $validator->errors()->first()
                // ];
            }
     
        $bytes = random_bytes(10);
        $hasilrandom=bin2hex($bytes);
        $bytes2 = random_bytes(10);
        $register_token=bin2hex($bytes2); 

        $data =  new ModelKontak();
        $data->username = $request->username;
        $data->uid = $hasilrandom;
        $data->previlege = 0;
        $data->nama = $request->name;
        $data->email = $request->email;
        $data->remember_token = $register_token;
        $data->verified = 0;
        $data->status = 'aktif';
        $data->nohp = '-';
        $data->alamat = '-';
        $data->password = bcrypt($request->password);

        if($data->save()){
            $res['message'] = "Success!";
            $res['value'] = "$data";
            return response($res);
        }
        if(!$data->save()) {
             $res['message'] = "Failed!";
            return response($res);
        }
        
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = \App\ModelKontak::where('username',$id)->get();
    
        if(count($data) > 0){ //mengecek apakah data kosong atau tidak
            $res['message'] = "Success!";
            $res['values'] = $data;
            return response($res);
        }
        else{
            $res['message'] = "Failed!";
            return response($res);
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    protected $primaryKey = 'uid';
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatedetailakun(Request $request, $id)
{
    $rules = array(
        'nama' => 'required|min:4',
    );    
    $messages = array(
        'nama.required'    => 'Yuk cantumkan nama lengkapmu agar temanmu bisa mengenalimu.',
                );
    $validator = Validator::make( $request->all(), $rules, $messages );

    if ( $validator->fails() ) 
    {
        return response()->json($validator->errors()->first(), 400);
        // return [
        //     'success' => 400, 
        //     'message' => $validator->errors()->first()
        // ];
    }
    //
    $cekaman=0;
    $cekaman2=0;
    $username = $request->input('username');
    $email = $request->input('email');
    $nohp = $request->input('nohp');
    $nama = $request->input('nama');
    $alamat = $request->input('alamat');

    $data = ModelKontak::where('email',$email)->get();
    $data2 = ModelKontak::where('username',$username)->get();
    if(count($data) > 0){ //mengecek apakah data kosong atau tidak
        $dataemail = DB::table('kontak')->where('uid', $id)->first();
        $emailtamp=$dataemail->email;
            if( $emailtamp!=$email )
            {
                $res['message'] = "Maaf kawan, e-mail ini telah digunakan orang lain, silahkan menggunakan email lainnya!";
               return response($res);
            }else
            {
                $cekaman=1;    
            }
    }
    if(count($data2) > 0){ //mengecek apakah data kosong atau tidak
        $datausername = DB::table('kontak')->where('uid', $id)->first();
        $datausername=$dataemail->username;
            if( $datausername!=$username )
            {
                $res['message'] = "Maaf kawan, username ini telah digunakan orang lain, silahkan menggunakan username lainnya.";
               return response($res);
            }else
            {
                $cekaman2=1;    
            }
    }
   if($cekaman==1|| $cekaman2==1)
   {
    $dataku = \App\ModelKontak::where('username',$id)->get();
    if(DB::table('kontak')->where('uid', $id)->update( [
        'username' => $username,
        'email' => $email,
        'nohp' =>  $nohp,
        'nama' => $nama,
        'alamat' => $alamat,
    ])){
        $res['message'] = "Success!";
        $res['value'] = "$dataku";
        return response($res);
    }
    else{
        $res['message'] = "Tidak ada perubahan data darimu.";
        return response($res);
    }
   }
   if($cekaman==0)
   {
        $res['message'] = "Maaf kawan, e-mail ini telah digunakan orang lain, silahkan menggunakan email lainnya!";
        return response($res);
   }
   if($cekaman2==0)
   {
        $res['message'] = "Maaf kawan, username ini telah digunakan orang lain, silahkan menggunakan username lainnya.";
        return response($res);
   }
   
    
    
}
public function updatebio(Request $request, $id)
{
    //
    $bio = $request->input('biodata');

    $data = \App\ModelKontak::where('uid',$id)->first();

    if(DB::table('kontak')->where('uid', $id)->update( [
        'biodata' => $bio,
    ])){
        $res['message'] = "Success!";
        $res['value'] = "$data";
        return response($res);
    }
    else{
        $res['message'] = "Failed!";
        return response($res);
    }
    
    
}

public function updatepassword(Request $request, $id)
{
    $rules = array(
        'oldpassword' => 'required',
        'password' => 'required|min:6',
        'confirmation' => 'required|same:password',
    );    
    $messages = array(
        'oldpassword.required' => 'Yuk isi password yang benar :)',
        'password.required' => 'Yuk isi password yang benar :)',
        'confirmation.required'      => 'Ada yang salah lho, coba kamu cek passwordmu dengan password konfirmasi.',
                );
    $validator = Validator::make( $request->all(), $rules, $messages );

    if ( $validator->fails() ) 
    {
        return [
            'success' => 0, 
            'message' => $validator->errors()->first()
        ];
    }
    //
    $oldpassword = $request->input('oldpassword');
    $password = $request->input('password');
    $confirmation = $request->input('confirmation');
    $bytes = random_bytes(10);
    $hasilrandom=bin2hex($bytes);
    $data = \App\ModelKontak::where('uid',$id)->first();
    if($data){ //apakah email tersebut ada atau tidak
        if(Hash::check($oldpassword,$data->password)){

            if(DB::table('kontak')->where('uid', $id)->update( [
                'password' => bcrypt($request->password),
                'remember_token' => $hasilrandom,
            ])){
                $res['message'] = "Success!";
                $res['value'] = "$data";
                return response($res);
            }
            else{
                $res['message'] = "Failed!";
                return response($res);
            }

        }
        else{
            $res['message'] = "Password lama salah !";
            return response()->json($res, 400);
        }
    }

   
    
    
}
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = \App\ModelKontak::where('uid',$id)->first();

        if($data->delete()){
            $res['message'] = "Success!";
            $res['value'] = "$data";
            return response($res);
        }
        else{
            $res['message'] = "Failed!";
            return response($res);
        }
    }
}
