<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\ModelUser;
use App\ModelKontak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class User extends Controller
{
    //
    public function index(){
        if(!Session::get('login')){
            return redirect('login')->with('alert','Kamu harus login dulu');
        }
        else{
            return view('user');
        }
    }

    public function login(){
         if(!Session::get('login')){
            return view('login');
        }
        else{
            return view('user');
        }
    }

    public function loginPost(Request $request){

        $email = $request->email;
        $password = $request->password;

        $data = ModelUser::where('email',$email)->first();
        if($data){ //apakah email tersebut ada atau tidak
            if(Hash::check($password,$data->password)){
                Session::put('username',$data->username);
                Session::put('name',$data->name);
                Session::put('email',$data->email);
                Session::put('login',TRUE);
                return redirect('home_user');
            }
            else{
                return redirect('login')->with('alert','Password atau Email, Salah !');
            }
        }
        else{
            return redirect('login')->with('alert','Password atau Email, Salah!');
        }
    }

    public function logout(){
        Session::flush();
        return redirect('login')->with('alert','Kamu sudah logout');
    }

    public function register(Request $request){
        return view('register');
    }
    public function registerUser(Request $request){
        // $rules = array(
        //     'name' => 'required|min:4',
        //     'username' => 'required|min:4||unique:kontak',
        //     'email' => 'required|min:4|email|unique:kontak',
        //     'password' => 'required',
        //     'confirmation' => 'required|same:password',
        // );    
        // $messages = array(
        //     'name.required'    => 'Yuk cantumkan nama lengkapmu agar temanmu bisa mengenalimu.',
        //     'username.unique'      => 'Maaf kawan, username ini telah digunakan orang lain, silahkan menggunakan username lainnya.',
        //     'email.unique'    => 'Maaf kawan, e-mail ini telah digunakan orang lain, silahkan menggunakan email lainnya',
        //     'email.email'    => 'Hai kawan, ada sesuatu yang salah, coba masukan e-mail yang benar ',
        //     'password.required' => 'Yuk isi password yang benar :)',
        //     'confirmation.required'      => 'Ada yang salah lho, coba kamu cek passwordmu dengan password konfirmasi.',
        //             );
        // $validator = Validator::make( $request->all(), $rules, $messages );
        $rules = [
            'name' => 'required|min:4',
            'username' => 'required|min:4||unique:kontak',
            'email' => 'required|min:4|email|unique:kontak',
            'password' => 'required',
            'confirmation' => 'required|same:password',
        ];
    
        $customMessages = [
            'name.required'    => 'Yuk cantumkan nama lengkapmu agar temanmu bisa mengenalimu.',
            'username.unique'      => 'Maaf kawan, username ini telah digunakan orang lain, silahkan menggunakan username lainnya.',
            'email.unique'    => 'Maaf kawan, e-mail ini telah digunakan orang lain, silahkan menggunakan email lainnya',
            'email.email'    => 'Hai kawan, ada sesuatu yang salah, coba masukan e-mail yang benar ',
            'password.required' => 'Yuk isi password yang benar :)',
            'confirmation.required'      => 'Ada yang salah lho, coba kamu cek passwordmu dengan password konfirmasi.',
        ];
    
        $this->validate($request, $rules, $customMessages);            

        // $this->validate($request, [
        //     'name' => 'required|min:4',
        //     'username' => 'required|min:4||unique:kontak',
        //     'email' => 'required|min:4|email|unique:kontak',
        //     'password' => 'required',
        //     'confirmation' => 'required|same:password',
        // ]);
        $bytes = random_bytes(10);
        $hasilrandom=bin2hex($bytes);
        $bytes2 = random_bytes(10);
        $register_token=bin2hex($bytes2);    
        $data =  new ModelKontak();
        $data->username = $request->username;
        $data->uid = $hasilrandom;
        $data->profile_picture='profile-default-discoverkorea.png';
        $data->previlege = 0;
        $data->nama = $request->name;
        $data->remember_token = $register_token;
        $data->email = $request->email;
        $data->verified = 0;
        $data->status = 'aktif';
        $data->nohp = '-';
        $data->alamat = '-';
        $data->password = bcrypt($request->password);
        $data->save();
        return redirect('/')->with('alert-success','Kamu berhasil Register');
       
    }
    public function registerPost(Request $request){
        $bytes = random_bytes(10);
        $hasilrandom=bin2hex($bytes);
        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|min:4|email|unique:users',
            'password' => 'required',
            'confirmation' => 'required|same:password',
        ]);

        $data =  new ModelUser();
        $data->username = $request->username;
        $data->uid = $hasilrandom;
        $data->previlege = 1;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->save();
        return redirect('/login')->with('alert-success','Kamu berhasil Register');
    }
}