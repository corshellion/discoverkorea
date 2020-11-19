<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::resource('ckontak','ControllerUser'); //tambahkan baris ini

Route::get('/', function () {
    return view('index');
});
Route::get('/index', function () {
    return view('index');
});


Route::get('/buatkontak', function () {
    return view('kontak_create');
});

Route::get('/halaman-kedua', function () {
    return view('halamandua');
});


//User admin
Route::get('/home_user', 'User@index');
Route::get('/login', 'User@login');
Route::get('/register', 'User@register');
Route::post('/loginPost', 'User@loginPost');
Route::post('/registerUser', 'User@registerUser');
Route::post('/registerPost', 'User@registerPost');
Route::get('/hapususer/{id}', 'ControllerUser@hapus');
Route::get('/hapusfile/{id}', 'File@hapus');
Route::get('/logout', 'User@logout');
Route::get('/user', 'ControllerUser@index');
//pengguna customer
Route::get('/tangguhkan/{id}', 'ControllerUser@tangguhkan');
Route::get('/penangguhan/{id}', 'ControllerUser@tangguhkan2');
Route::get('/file_pengguna', 'File@index_pengguna');
Route::get('/aktifkan/{id}', 'ControllerUser@aktifkan');
Route::get('/aktifkan_post/{id}', 'File@aktifkan');
Route::get('/tangguhkan_post/{id}', 'File@tangguhkan');
//Unggahan admin
Route::post('/unggahberita/{id}', 'File@store');
Route::get('/unggah_file', 'File@create');
Route::resource('file','File');
//unggahan pengguna
Route::get('/unggahan_pengguna', 'File@unggahan_pengguna');
Route::post('/unggahpost_pengguna', 'File@store_pengguna');
//coba
Route::get('/reload','ControllerKontak@coba');
//Grup Fanbase
Route::get('/fanbase','ControllerGrup@index');
Route::get('/dropfanbase/{id}','ControllerGrup@removefanbase');
//Laporan 
Route::get('/laporan_pengguna','ControllerReport@index');
Route::get('/laporan_berita','ControllerReport@index2');
// Permintaan Iklan
Route::get('/iklan','ControllerAds@iklanaktif');
Route::get('/buat_iklan','ControllerAds@buat_iklan');
Route::post('/buat_permintaan_iklan','ControllerAds@unggah_permintaan_iklan');
Route::get('/permintaan_iklan','ControllerAds@permintaan_iklan');
Route::get('/aktifkan_iklan/{id}','ControllerAds@aktifkan_iklan');
Route::get('/batalkan_iklan/{id}','ControllerAds@decline_iklan');
//social view
Route::get('/social', 'File@social');
//laporan
Route::get('/laporkan/{id}', 'ControllerReport@lapor_post');
Route::get('/laporkan_pengguna/{id}', 'ControllerReport@lapor_pengguna');
Route::get('/aktifkan_post_report/{id}', 'ControllerReport@aktifkan_post_report');
Route::get('/decline_report/{id}', 'ControllerReport@decline_post');
Route::get('/decline_user_report/{id}', 'ControllerReport@decline_user');
//verifikasi pengguna
Route::get('/verified/{id}', 'ControllerUser@verifikasi');
Route::get('/unverified/{id}', 'ControllerUser@copot_verifikasi');
//REST API

//user
Route::get('/apiuser','ControllerKontak@index');
Route::get('/apiuser/{id}','ControllerKontak@show');
Route::get('/getkategori','ControllerAPI@getkategori');
Route::get('/gettag','ControllerAPI@gettag');
Route::get('/getkfanbase','ControllerAPI@dapatkanfanbase');
Route::post('/apiuser/store','ControllerKontak@postuser');
Route::post('/apiuser/like','ControllerAPI@likepost');
Route::post('/apiuser/bookmark','ControllerAPI@bookmark');
Route::get('/apiuser/getcomment/{id}','ControllerAPI@getcomment');
Route::post('/apiuser/kirimcomment','ControllerAPI@kirimcomment');
Route::post('/apiuser/createfanbase','ControllerAPI@createfanbase');
Route::post('/apiuser/updatedetailakun/{id}','ControllerKontak@updatedetailakun');
Route::get('/apiuser/followed/{id}/{id2}','ControllerAPI@followed');
Route::get('/apiuser/fanbasefollowed/{id}/{id2}','ControllerAPI@fanbasefollowed');
Route::post('/apiuser/followfanbase','ControllerAPI@followfanbase');
Route::post('/apiuser/unfollowfanbase','ControllerAPI@unfollowfanbase');
Route::post('/apiuser/unfollowuser','ControllerAPI@unfollowuser');
Route::get('/apiuser/showpesan/{id}','ControllerAPI@getmessage');
Route::get('/apiuser/getroom/{id}','ControllerAPI@getroom');
Route::get('/apiuser/getfanbasechat/{id}','ControllerAPI@getfanbasechat');
Route::get('/apiuser/fanbase/{id}','ControllerAPI@getfanbase');
Route::get('/apiuser/fanbase2/{id}','ControllerAPI@getfanbase2');
Route::post('/apiuser/pesan','ControllerAPI@message');
Route::post('/apiuser/kirimpesan','ControllerAPI@sendmessage');
Route::post('/apiuser/kirimpesanfanbase','ControllerAPI@sendmessagefanbase');
Route::post('/apiuser/unggahapiunggahanpengguna','ControllerAPI@unggahpostpengguna');
Route::post('/apiuser/unggahapiunggahanfanbase','ControllerAPI@unggahpostfanbase');
Route::post('/apiuser/updatephotoprofile','ControllerAPI@updatephotoprofile');
Route::post('/apiuser/ubahfotofanbase','ControllerAPI@ubahfotofanbase');
Route::post('/apiuser/updatestruktur','ControllerAPI@updatestruktur');
Route::post('/apiuser/updatebio/{id}','ControllerKontak@updatebio');
Route::post('/apiuser/updatefanbaseinfo','ControllerAPI@updatefanbaseinfo');
Route::post('/apiuser/updatepassword/{id}','ControllerKontak@updatepassword');
Route::post('/apiuser/delete/{id}','ControllerKontak@destroy');
Route::post('/apiuser/followuser','ControllerAPI@followuser');
Route::get('/apiuser/followerfanbase/{id}','ControllerAPI@lihatfollowerfanbase');
Route::get('/apiuser/follower/{id}','ControllerAPI@lihatfollower');
Route::get('/apiuser/following/{id}','ControllerAPI@lihatfollowing');
Route::post('/apiuser/laporpost','ControllerAPI@lapor_post');
Route::post('/apiuser/laporpengguna','ControllerAPI@lapor_pengguna');
//login

Route::post('/apiloginpost', 'ControllerAPI@loginPost');
//Unggahan
Route::get('/apiunggah','ControllerAPI@getallunggahan');
Route::get('/apiunggahfollowing/{id}','ControllerAPI@getunggahan');
Route::get('/apiunggahdetail/{id}/{id2}','ControllerAPI@getunggahandetail');
Route::get('/apiunggah/{id}','ControllerAPI@getspecified');
Route::get('/apiunggahfanbase/{id}','ControllerAPI@getspecifiedfanbase');
Route::get('/apinotifikasi','ControllerAPI@getnotifikasi');
Route::get('/apinotifikasi/{id}','ControllerAPI@getnotifikasispecified');

//unggahan tidak dipakai karena controller udah dihapus tgl 14 agustus
Route::get('/unggahan','ControllerUnggahan@index');
Route::get('/unggahan/{id}','ControllerUnggahan@show');
Route::post('/unggahan/store','ControllerUnggahan@store');
Route::post('/unggahan/update/{id}','ControllerUnggahan@update');
Route::post('/unggahan/delete/{id}','ControllerUnggahan@destroy');





