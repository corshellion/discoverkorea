<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\ModelKontak;
use App\ModelFile;
use App\ModelFileFanbase;
use App\ModelFollow;
use App\ModelChat;
use App\ModelChatDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ControllerAPI extends Controller
{
     //GET FANBASE
 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dapatkanfanbase()
    {
        $data= DB::table('fanbase')
        ->get();

        if(count($data) > 0){ //mengecek apakah data kosong atau tidak
          
            $response = json_encode(array('message' => 'success', 'values' => $data), JSON_NUMERIC_CHECK);
            $response = json_decode($response);
            return response()->json($response);

        }
        else{
            $res['message'] = "Data Kosong !";
            return response()->json($res, 400);
        }
    } 
 //GET CATEGORY
 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getkategori()
    {
        $data= DB::table('kategori')
         ->orderBy('id_kategori','ASC')
        ->get();

        if(count($data) > 0){ //mengecek apakah data kosong atau tidak
          
            $response = json_encode(array('message' => 'success', 'values' => $data), JSON_NUMERIC_CHECK);
            $response = json_decode($response);
            return response()->json($response);

        }
        else{
            $res['message'] = "Data Kosong !";
            return response()->json($res, 400);
        }
    } 
 //GET CATEGORY
 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function gettag()
    {
        $data= DB::table('tag')
         ->orderBy('id_tag','ASC')
        ->get();

        if(count($data) > 0){ //mengecek apakah data kosong atau tidak
          
            $response = json_encode(array('message' => 'success', 'values' => $data), JSON_NUMERIC_CHECK);
            $response = json_decode($response);
            return response()->json($response);

        }
        else{
            $res['message'] = "Data Kosong !";
            return response()->json($res, 400);
        }
    } 
 //GET ROOM MESSAGE
 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getroom($id)
    {
        $data= DB::table('room_chat')
        ->join('kontak', 'room_chat.user2', '=', 'kontak.uid')
        ->select(
            'room_chat.id_room',
            'kontak.uid',
            'kontak.username',
            'kontak.profile_picture')
        ->where('room_chat.user1', '=', $id)
        ->groupBy('room_chat.id_room')
        ->groupBy('kontak.uid')
        ->groupBy('kontak.username')
        ->groupBy('kontak.profile_picture')
         ->orderBy('room_chat.id_room','DESC')
        //  ->limit(1)
        ->get();
      // $data = \App\ModelChatDetail::where('id_room',$id)->get();

        if(count($data) > 0){ //mengecek apakah data kosong atau tidak
          
            $response = json_encode(array('message' => 'success', 'values' => $data), JSON_NUMERIC_CHECK);
            $response = json_decode($response);
           
            return response()->json($response);

        }
        else{
            $res['message'] = "Data Kosong !";
            return response()->json($res, 400);
        }
    }
 //GET FANBASE GROUP
 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getfanbase($id)
    {
        $data= DB::table('fanbase')
        ->join('fanbase_detail', 'fanbase.uid', '=', 'fanbase_detail.id_fanbase')
        ->join('kontak', 'fanbase_detail.uid_member', '=', 'kontak.uid')
        ->select(
            'fanbase.uid',
            'fanbase.photo',
            'fanbase.chairman',
            'fanbase.group_name',
            'fanbase.status',
            'fanbase.category',
            'fanbase.subkategori1',
            'fanbase.subkategori2',
            'fanbase.description',
            'kontak.username')
        ->where('fanbase_detail.uid_member', '=', $id)
         ->orderBy('fanbase.uid','ASC')
        //  ->limit(1)
        ->get();
      // $data = \App\ModelChatDetail::where('id_room',$id)->get();

        if(count($data) > 0){ //mengecek apakah data kosong atau tidak
          
            $response = json_encode(array('message' => 'success', 'values' => $data), JSON_NUMERIC_CHECK);
            $response = json_decode($response);
           
            return response()->json($response);

        }
        else{
            $res['message'] = "Data Kosong !";
            return response()->json($res, 400);
        }
    }
//GET FANBASE GROUP
 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getfanbase2($id)
    {
        $data= DB::table('fanbase')
        ->join('fanbase_detail', 'fanbase.uid', '=', 'fanbase_detail.id_fanbase')
        ->join('kontak', 'fanbase_detail.uid_member', '=', 'kontak.uid')
        ->select(
            'fanbase.uid',
            'fanbase.photo',
            'fanbase.chairman',
            'fanbase.group_name',
            'fanbase.status',
            'fanbase.category',
            'fanbase.subkategori1',
            'fanbase.subkategori2',
            'fanbase.description',
            'kontak.username')
        ->where('fanbase_detail.id_fanbase', '=', $id)
         ->orderBy('fanbase.uid','ASC')
        //  ->limit(1)
        ->get();
      // $data = \App\ModelChatDetail::where('id_room',$id)->get();

        if(count($data) > 0){ //mengecek apakah data kosong atau tidak
          
            $response = json_encode(array('message' => 'success', 'values' => $data), JSON_NUMERIC_CHECK);
            $response = json_decode($response);
           
            return response()->json($response);

        }
        else{
            $res['message'] = "Data Kosong !";
            return response()->json($res, 400);
        }
    }
  //GET COMMENTS CHAT
 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getcomment($id)
    {
        $data= DB::table('comments_post')
        ->join('kontak', 'comments_post.sender', '=', 'kontak.uid')
        ->select(
            'kontak.username',
            'kontak.profile_picture',
            'comments_post.sender',
            'comments_post.message',
            'comments_post.tanggal_pesan')
        ->where('comments_post.id_post', '=', $id)
         ->orderBy('comments_post.tanggal_pesan','DESC')
        //  ->limit(1)
        ->get();
      // $data = \App\ModelChatDetail::where('id_room',$id)->get();

        if(count($data) > 0){ //mengecek apakah data kosong atau tidak
          
            $response = json_encode(array('message' => 'success', 'values' => $data), JSON_NUMERIC_CHECK);
            $response = json_decode($response);
           
            return response()->json($response);

        }
        else{
            $res['message'] = "Data Kosong !";
            return response()->json($res, 400);
        }
    }
  //GET FANBASE CHAT
 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getfanbasechat($id)
    {
        $data= DB::table('fanbase_chat')
        ->join('fanbase_detailchat', 'fanbase_chat.id_room', '=', 'fanbase_detailchat.id_room')
        ->join('fanbase', 'fanbase_chat.id_fanbase', '=', 'fanbase.uid')
        ->join('kontak', 'fanbase_detailchat.sender', '=', 'kontak.uid')
        ->select(
            'fanbase.uid',
            'fanbase.group_name',
            'fanbase.status',
            'fanbase.category',
            'fanbase.subkategori1',
            'fanbase.subkategori2',
            'fanbase.description',
            'kontak.username',
            'kontak.profile_picture',
            'fanbase_chat.id_room',
            'fanbase_chat.id_fanbase',
            'fanbase_detailchat.message',
            'fanbase_detailchat.sender',
            'fanbase_detailchat.tanggal_pesan')
        ->where('fanbase_chat.id_fanbase', '=', $id)
         ->orderBy('fanbase_detailchat.tanggal_pesan','DESC')
        //  ->limit(1)
        ->get();
      // $data = \App\ModelChatDetail::where('id_room',$id)->get();

        if(count($data) > 0){ //mengecek apakah data kosong atau tidak
          
            $response = json_encode(array('message' => 'success', 'values' => $data), JSON_NUMERIC_CHECK);
            $response = json_decode($response);
           
            return response()->json($response);

        }
        else{
            $res['message'] = "Data Kosong !";
            return response()->json($res, 400);
        }
    }
  //GET MESSAGE
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getmessage($id)
    {
        $data =  DB::table('chat')
       ->join('kontak', 'chat.sender', '=', 'kontak.uid')
       ->select(
        'chat.id_room',
        'chat.message',
        'chat.sender',
        'kontak.nama',
        'chat.tanggal_pesan',
        'kontak.profile_picture')
       ->where('chat.id_room',$id) 
       ->groupBy('chat.id_room')
       ->groupBy('chat.sender')
       ->groupBy('chat.message')
       ->groupBy('kontak.nama')
       ->groupBy('chat.tanggal_pesan')
       ->groupBy('kontak.profile_picture')
       ->orderBy('chat.tanggal_pesan','DESC')->get();

    //    $data = \App\ModelChatDetail::where('id_room',$id) ->orderBy('tanggal_pesan','DESC')->get();

        if(count($data) > 0){ //mengecek apakah data kosong atau tidak
          
            $response = json_encode(array('message' => 'success', 'values' => $data), JSON_NUMERIC_CHECK);
            $response = json_decode($response);
           
            return response()->json($response);

        }
        else{
            $res['message'] = "Data Kosong !";
            return response()->json($res, 400);
        }
    }
  //GET API
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getallunggahan()
    {
        //
        $data = \App\ModelFile::all();

        if(count($data) > 0){ //mengecek apakah data kosong atau tidak
          
            $response = json_encode(array('message' => 'success', 'values' => $data), JSON_NUMERIC_CHECK);
            $response = json_decode($response);
           
            return response()->json($response);

        }
        else{
            $res['message'] = "Data Kosong !";
            return response()->json($res, 400);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //const data = await connection.query("select up.*,ft.*,CASE WHEN (SELECT COUNT(*) FROM like_table lt WHERE lt.id_post = up.id_post AND lt.username = 'konco44') > 0 THEN '1' ELSE '0' END AS liked from user_post up, follow_table ft where up.username=ft.user_following and user_followed=? order by date desc",[req.body.usernameku]);
    public function getunggahan($id)
    {
        $data= DB::table('kontak')
        ->Join('follow_table', 'follow_table.id_following', '=', 'kontak.uid')
        ->join('file', 'kontak.username', '=', 'file.username')
        ->select(
            'follow_table.id_following',
            'follow_table.id_follower',
            'kontak.username',
            'file.username',
            'file.uid',
            'file.previlege',
            'file.status_post',
            'file.category',
            'file.title',
            'file.status',
            'file.file',
            'file.type',
            'file.created_at',
            'file.updated_at',
            'file.ended_at',
            DB::raw("CASE WHEN (SELECT COUNT(*) FROM like_table,follow_table,kontak  WHERE like_table.id_post = file.uid AND like_table.uid_profile =follow_table.id_follower AND kontak.uid=follow_table.id_follower) > 0 THEN 1 ELSE 0 END AS liked"),
            DB::raw("CASE WHEN (SELECT COUNT(*) FROM bookmark_table,follow_table,kontak  WHERE bookmark_table.id_post = file.uid AND bookmark_table.uid_profile =follow_table.id_follower AND kontak.uid=follow_table.id_follower ) > 0 THEN 1 ELSE 0 END AS bookmark"),
            DB::raw("CASE WHEN (SELECT COUNT(*) FROM like_table  WHERE like_table.id_post = file.uid) > 0 THEN (SELECT COUNT(*) FROM like_table  WHERE like_table.id_post = file.uid) ELSE 0 END AS likes")
            )
        ->Where('follow_table.id_follower', '=', $id)
        ->orWhere('file.previlege','=',1)    
        
        
        ->get();

        if(count($data) > 0){ //mengecek apakah data kosong atau tidak
          
            $response = json_encode(array('message' => 'success', 'values' => $data), JSON_NUMERIC_CHECK);
            $response = json_decode($response);
           
            return response()->json($response);

        }
        else{
            $res['message'] = "Data Kosong !";
            return response()->json($res, 400);
        }
    }
    public function lapor_post(Request $request)
    {
        $id=$request->input('idpost');
        $user=$request->input('user');
        $bytes = random_bytes(10);
        $hasilrandom=bin2hex($bytes);
        DB::table('post_report_list')->insert(
            ['id_report' => $hasilrandom,'id_post' => $id, 'reporter' =>  $user, 'date' => date('Y-m-d H:i:s')]
        );
        $data = ModelFile::where('uid',$id)->first();
        $username=$data->username;
        
        DB::table('notifikasi')->insert(
            ['id_notification' => $hasilrandom,'from' => $user,'to' => $username, 'message' => 'Pengguna melaporkan unggahan dari '.$username.' sebagai tidak pantas.', 'date' => date('Y-m-d H:i:s')]
        );

        $res['message'] = "Success!";
        $res['values'] = $data;
        return response($res);
    }
    public function lapor_pengguna(Request $request)
    {
        $id=$request->input('user1');
        $username=$request->input('user2');
        $bytes = random_bytes(10);
        $hasilrandom=bin2hex($bytes);
        DB::table('user_report_list')->insert(
            ['id_report' => $hasilrandom,'user_reported' => $id,'reporter' =>  $username, 'date' => date('Y-m-d H:i:s')]
        );
        $data = ModelKontak::where('username',$id)->first();
        $username2=$id;
        DB::table('notifikasi')->insert(
            ['id_notification' => $hasilrandom,'from' => $username,'to' =>$username2, 'message' => 'Pengguna melaporkan  '.$username.' sebagai akun tidak pantas.', 'date' => date('Y-m-d H:i:s')]
        );

        $res['message'] = "Success!";
        $res['values'] = $data;
        return response($res);
        
    }
    public function getunggahandetail($id,$id2)
    {
        $data= DB::table('kontak')
        ->rightJoin('follow_table', 'follow_table.id_follower', '=', 'kontak.uid')
        ->join('file', 'kontak.username', '=', 'file.username')
        ->select(
            'follow_table.id_following',
            'follow_table.id_follower',
            'kontak.username',
            'file.username',
            'file.uid',
            'file.previlege',
            'file.status_post',
            'file.category',
            'file.title',
            'file.status',
            'file.file',
            'file.type',
            'file.created_at',
            'file.updated_at',
            'file.ended_at',
            DB::raw("CASE WHEN (SELECT COUNT(*) FROM like_table,follow_table  WHERE like_table.id_post = file.uid AND like_table.uid_profile =kontak.uid) > 0 THEN 1 ELSE 0 END AS liked"),
            DB::raw("CASE WHEN (SELECT COUNT(*) FROM bookmark_table,follow_table  WHERE bookmark_table.id_post = file.uid AND bookmark_table.uid_profile =kontak.uid) > 0 THEN 1 ELSE 0 END AS bookmark"),
            DB::raw("CASE WHEN (SELECT COUNT(*) FROM like_table  WHERE like_table.id_post = file.uid) > 0 THEN (SELECT COUNT(*) FROM like_table  WHERE like_table.id_post = file.uid) ELSE 0 END AS likes")
            )
        ->where('file.uid', '=', $id)
        ->Where('kontak.uid', '=', $id2)
        ->orWhere('file.previlege','=',1)    
        
        
        ->get();

        if(count($data) > 0){ //mengecek apakah data kosong atau tidak
          
            $response = json_encode(array('message' => 'success', 'values' => $data), JSON_NUMERIC_CHECK);
            $response = json_decode($response);
           
            return response()->json($response);

        }
        else{
            $res['message'] = "Data Kosong !";
            return response()->json($res, 400);
        }
    }
    public function getnotifikasi()
    {
        //
        $data = \App\ModelNotification::all();
    
        if(count($data) > 0){ //mengecek apakah data kosong atau tidak
          
            $response = json_encode(array('message' => 'success', 'values' => $data), JSON_NUMERIC_CHECK);
            $response = json_decode($response);
           
            return response()->json($response);

        }
        else{
            $res['message'] = "Data Kosong !";
            return response()->json($res, 400);
        }
    }
    public function loginPost(Request $request){

        $username = $request->username;
        $password = $request->password;
        $bytes = random_bytes(10);
        $token=bin2hex($bytes);
        $data = \App\ModelKontak::where('username',$username)->first();
        if($data){ //apakah email tersebut ada atau tidak
            if(Hash::check($password,$data->password)){

                $success['token'] = $data->remember_token;
                $success['username'] = $data->username;
                $success['uid'] = $data->uid;
                return response()->json(['success' => $success], 200);

            }
            else{
                $res['message'] = "Password atau Email, Salah !";
                return response()->json($res, 400);
            }
        }
       
        else{
            $res['message'] = "Password atau Email, Salah !";
            return response()->json($res, 400);
        }
    }
    //GET FOLLOWER FANBASE
     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function lihatfollowerfanbase($id)
    {   $data= DB::table('kontak')
        ->join('fanbase_detail', 'fanbase_detail.uid_member', '=', 'kontak.uid')
        ->select(
            'fanbase_detail.role',
            'kontak.username',
            'kontak.uid',
            'kontak.profile_picture')
        ->where('fanbase_detail.id_fanbase', '=', $id)
        ->get();
       // $data = \App\ModelFollow::where('id_follower',$id)->get();
    
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
    //GET FOLLOWER
     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function lihatfollower($id)
    {   $data= DB::table('kontak')
        ->join('follow_table', 'follow_table.id_following', '=', 'kontak.uid')
        ->select(
            'follow_table.id_following',
            'follow_table.id_follower',
            'kontak.username',
            'kontak.profile_picture')
        ->where('follow_table.id_follower', '=', $id)
        ->get();
       // $data = \App\ModelFollow::where('id_follower',$id)->get();
    
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
    //GET FOLLOWING
     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function lihatfollowing($id)
    {
        $data= DB::table('kontak')
        ->join('follow_table', 'follow_table.id_follower', '=', 'kontak.uid')
        ->select(
            'follow_table.id_following',
            'follow_table.id_follower',
            'kontak.username',
            'kontak.profile_picture')
        ->where('follow_table.id_following', '=', $id)
        ->get();
       // $data = \App\ModelFollow::where('id_following',$id)->get();
    
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
    /// GET API SPECIFIED
    public function getspecified($id)
    {
        $data = \App\ModelFile::where('username',$id)->get();
        
        if(count($data) > 0){ //mengecek apakah data kosong atau tidak
          
            $response = json_encode(array('message' => 'success', 'values' => $data), JSON_NUMERIC_CHECK);
            $response = json_decode($response);
           
            return response()->json($response);

        }
        else{
            $res['message'] = "Data Kosong !";
            return response()->json($res, 400);
        }
    }
        /// GET API SPECIFIED FANBASE POST
        public function getspecifiedfanbase($id)
        {
            $data = \App\ModelFileFanbase::where('id_fanbase',$id)->get();
            
            if(count($data) > 0){ //mengecek apakah data kosong atau tidak
              
                $response = json_encode(array('message' => 'success', 'values' => $data), JSON_NUMERIC_CHECK);
                $response = json_decode($response);
               
                return response()->json($response);
    
            }
            else{
                $res['message'] = "Data Kosong !";
                return response()->json($res, 400);
            }
        }
    public function getnotifikasispecified($id)
    {
        $data = \App\ModelNotification::where('to',$id)->get();
    
        if(count($data) > 0){ //mengecek apakah data kosong atau tidak
          
            $response = json_encode(array('message' => 'success', 'values' => $data), JSON_NUMERIC_CHECK);
            $response = json_decode($response);
           
            return response()->json($response);

        }
        else{
            $res['message'] = "Data Kosong !";
            return response()->json($res, 400);
        }
    }
    
    //GET FOLLOWED FANBASE ATAU BELUM
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function fanbasefollowed($id,$id2)
    {
        $data= DB::table('fanbase_detail')->where('uid_member',$id)->where('id_fanbase',$id2)->get();
    
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
    //GET FOLLOWED ATAU BELUM
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function followed($id,$id2)
    {
        $data = \App\ModelFollow::where('id_following',$id)->where('id_follower',$id2)->get();
    
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
    // POST A MESSAGE PRIVATE
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function message(Request $request)
    {
        $id=$request->input('user1');
        $id2=$request->input('user2');
        $data= DB::table('room_chat')
        ->select('room_chat.id_room')
        ->where('room_chat.user1', '=', $id)
        ->where('room_chat.user2', '=', $id2)
        ->orWhere('room_chat.user2', '=', $id)
        ->orWhere('room_chat.user1', '=', $id2)
        ->get();

        if(count($data) > 0){ //mengecek apakah data kosong atau tidak
            $res['message'] = "Success!";
            $res['values'] = $data;
            return response($res);
        }
        else{
           
            $bytes = random_bytes(10);
            $hasilrandom=bin2hex($bytes);
            $bytes2 = random_bytes(10);
            $roomid=bin2hex($bytes2);
            
            $data = new \App\ModelChat();
            $data->uid = $hasilrandom;
            $data->id_room = $roomid;
        
        
            if(DB::table('room_chat')->insert(
            ['uid'=>$hasilrandom,'id_room' => $roomid,'user1' => $id,'user2' => $id2]
        )){ //mengecek apakah data kosong atau tidak
                $res['message'] = "Success!";
                $res['values'] = $data;
                return response($res);
            }
            else{
                $res['message'] = "Failed!";
                return response($res);
            }
        }

       
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sendmessage(Request $request)
    {
        
        $message=$request->input('message');
        $uidsender=$request->input('uidsender');
        $roomid=$username=$request->input('idroom');    
        $bytes = random_bytes(10);
        $hasilrandom=bin2hex($bytes);
        $current_date = date('Y-m-d H:i:s');
        
        if(DB::table('chat')->insert(['uid'=>$hasilrandom,'id_room' => $roomid,'message' => $message,'sender' => $uidsender,'tanggal_pesan'=>$current_date])){ //mengecek apakah data kosong atau tidak
            $data= DB::table('chat')
            ->select('chat.sender',
            'chat.message')
            ->where('chat.id_room', '=', $roomid)
            ->get();
            $res['message'] = "Success!";
            $res['values'] = $data;
            return response($res);
        }
        else{
            $res['message'] = "Failed!";
            return response($res);
            }
       
    }
     /** Kirim pesan comment post
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function kirimcomment(Request $request)
    {
        $message=$request->input('message');
        $uidsender=$request->input('uidsender');
        $idpost=$username=$request->input('idpost');    
        $bytes = random_bytes(10);
        $hasilrandom=bin2hex($bytes);
        $current_date = date('Y-m-d H:i:s');
        
        if(DB::table('comments_post')->insert(['uid'=>$hasilrandom,'id_post' => $idpost,'message' => $message,'sender' => $uidsender,'tanggal_pesan'=>$current_date])){ //mengecek apakah data kosong atau tidak
          
            $res['message'] = "Success!";
            $res['values'] = '';
            return response($res);
        }
        else{
            $res['message'] = "Failed!";
            return response($res);
            }
       
    }
    // Kirim pesan fanbase
     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sendmessagefanbase(Request $request)
    {
        $message=$request->input('message');
        $uidsender=$request->input('uidsender');
        $roomid=$username=$request->input('idroom');    
        $bytes = random_bytes(10);
        $hasilrandom=bin2hex($bytes);
        $current_date = date('Y-m-d H:i:s');
        
        if(DB::table('fanbase_detailchat')->insert(['uid'=>$hasilrandom,'id_room' => $roomid,'message' => $message,'sender' => $uidsender,'tanggal_pesan'=>$current_date])){ //mengecek apakah data kosong atau tidak
          
            $res['message'] = "Success!";
            $res['values'] = '';
            return response($res);
        }
        else{
            $res['message'] = "Failed!";
            return response($res);
            }
       
    }
/**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //POST PENGGUNA
    public function unggahpostfanbase(Request $request)
{
    $bytes = random_bytes(10);
    $hasilrandom=bin2hex($bytes);
    $fileMimeType = $request->file('file')->getMimeType();
      $type =substr($fileMimeType,0,5);
     
    $data = new \App\ModelFileFanbase();
    $data->uid = $hasilrandom;
    $data->username = $request->input('name');
    $data->title = $request->input('title');
    $data->status = $request->input('status');
    $data->id_fanbase = $request->input('idfanbase');
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
    if($data->save()){
        $res['message'] = "Success!";
        $res['value'] = "$data";
        return response($res);
    }
    else{
        $res['message'] = "Failed!";
        return response($res);
    }
    
    
}
 /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //POST PENGGUNA
    public function unggahpostpengguna(Request $request)
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
    if($data->save()){
        $res['message'] = "Success!";
        $res['value'] = "$data";
        return response($res);
    }
    else{
        $res['message'] = "Failed!";
        return response($res);
    }
    
    
}
 /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //MEMPERBAHARUI FOTO PROFILE PENGGUNA
    public function ubahfotofanbase(Request $request)
{

    $data = DB::table('fanbase')->get();
    $fanbase = $request->input('fanbase');
    $file = $request->file('file');

    $ext = $file->getClientOriginalExtension();
    $newName = rand(100000,1001238912).".".$ext;
    $file->move('uploads/profile_fanbase',$newName);
    if( DB::table('fanbase')->where('uid',  $fanbase)->update( [
        'photo' =>  $newName,
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
/**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //MEMPERBAHARUI FOTO PROFILE PENGGUNA
    public function updatephotoprofile(Request $request)
{
     
    $data = new \App\ModelKontak();
    $username = $request->input('name');
    $file = $request->file('file');

    $ext = $file->getClientOriginalExtension();
    $newName = rand(100000,1001238912).".".$ext;
    $file->move('uploads/profile',$newName);
    if( DB::table('kontak')->where('username',  $username)->update( [
        'profile_picture' =>  $newName,
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
 /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //POST FOLLOW
    public function followuser(Request $request)
    {
        $rules = array(
            'mengikuti' => 'required|min:4',
            'pengikut' => 'required|min:4',
        );    
        $messages = array(
            'name.required'    => 'Yuk cantumkan nama lengkapmu agar temanmu bisa mengenalimu.',
            'username.unique'      => 'Maaf kawan, username ini telah digunakan orang lain, silahkan menggunakan username lainnya.',
                    );
        $validator = Validator::make( $request->all(), $rules, $messages );

        if ( $validator->fails() ) 
        {
            return [
                'success' => 0, 
                'message' => $validator->errors()->first()
            ];
        }
        $bytes = random_bytes(10);
        $hasilrandom=bin2hex($bytes);
         
        $data = new \App\ModelFollow();
        $data->uid = $hasilrandom;
        $mengikuti = $request->input('mengikuti');//yang diikuti
        $pengikut = $request->input('pengikut');//yang mengikuti
       
        if(DB::table('follow_table')->insert(
            ['uid'=>$hasilrandom,'id_following' => $mengikuti,'id_follower' => $pengikut]
        )){
            $res['message'] = "Success!";
            $res['value'] = "$data";
            return response($res);
        }
        else{
            $res['message'] = "gagal";
            return response($res);
        }
        
    }
    //LIKE POST USER
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function likepost(Request $request)
    {
        $idpost=$request->input('idpost');
        $uidprofile=$request->input('uidprofile'); 
        $bytes = random_bytes(10);
        $hasilrandom=bin2hex($bytes);
        $current_date = date('Y-m-d H:i:s');
        
        //cek ada atau tidak like double
        $data= DB::table('like_table')
        ->where('id_post', '=', $idpost)
        ->where('uid_profile', '=', $uidprofile)
        ->get();

        if(count($data) > 0){ //mengecek apakah data kosong atau tidak

            DB::table('like_table')->where('id_post', $idpost)->where('uid_profile', $uidprofile)->delete();
            $data= DB::table('like_table')->get();
            if(count($data) >0){
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
           if(DB::table('like_table')->insert(['uid'=>$hasilrandom,'id_post' => $idpost,'uid_profile' => $uidprofile,'tanggal_like'=>$current_date])){ //mengecek apakah data kosong atau tidak
          
                $res['message'] = "Success!";
                $res['values'] = '';
                return response($res);
            }
            else{
                $res['message'] = "Failed!";
                return response($res);
                }
        }

        
       
    }
    //BOOKMARK POST USER
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function bookmark(Request $request)
    {
        $idpost=$request->input('idpost');
        $uidprofile=$request->input('uidprofile'); 
        $bytes = random_bytes(10);
        $hasilrandom=bin2hex($bytes);
        $current_date = date('Y-m-d H:i:s');
        
        //cek ada atau tidak like double
        $data= DB::table('bookmark_table')
        ->where('id_post', '=', $idpost)
        ->where('uid_profile', '=', $uidprofile)
        ->get();

        if(count($data) > 0){ //mengecek apakah data kosong atau tidak

            DB::table('bookmark_table')->where('id_post', $idpost)->where('uid_profile', $uidprofile)->delete();
            $data= DB::table('bookmark_table')->get();
            if(count($data) >0){
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
           if(DB::table('bookmark_table')->insert(['uid'=>$hasilrandom,'id_post' => $idpost,'uid_profile' => $uidprofile,'tanggal_bookmark'=>$current_date])){ //mengecek apakah data kosong atau tidak
          
                $res['message'] = "Success!";
                $res['values'] = '';
                return response($res);
            }
            else{
                $res['message'] = "Failed!";
                return response($res);
                }
        }

        
       
    }
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //POST UNFOLLOW USER
    public function unfollowuser(Request $request)
    {
        $id1=$request->input('mengikuti');//ini user login sekarang
        $id2=$request->input('pengikut');
        DB::table('follow_table')->where('id_following', $id1)->where('id_follower', $id2)->delete();
        $data= DB::table('follow_table')->get();
        if(count($data) >0){
            $res['message'] = "Success!";
            $res['value'] = "$data";
            return response($res);
        }
        else{
            $res['message'] = "Failed!";
            return response($res);
        }
        
    }
 /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //POST UNFOLLOW FANBASE
    public function unfollowfanbase(Request $request)
    {
        $id1=$request->input('idfanbase');
        $id2=$request->input('idmember');
        DB::table('fanbase_detail')->where('id_fanbase', $id1)->where('uid_member', $id2)->delete();
        $data= DB::table('fanbase_detail')->get();
        if(count($data) >0){
            $res['message'] = "Success!";
            $res['value'] = "$data";
            return response($res);
        }
        else{
            $res['message'] = "Failed!";
            return response($res);
        }
        
    }
 /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //POST FOLLOW FANBASE
    public function followfanbase(Request $request)
    {
        $rules = array(
            'idpengikut' => 'required|min:4',
            'idfanbase' => 'required|min:4',
        );    
        $messages = array(
            'idpengikut.required'    => 'Kamu sepertinya sudah berada dalam fanbase ini :)',
            'idfanbase.required'      => 'Kamu sepertinya sudah berada dalam fanbase ini :)',
                    );
        $validator = Validator::make( $request->all(), $rules, $messages );

        if ( $validator->fails() ) 
        {
            return [
                'success' => 0, 
                'message' => $validator->errors()->first()
            ];
        }
        $data= DB::table('fanbase_detail')->get();
        $bytes = random_bytes(10);
        $hasilrandom=bin2hex($bytes);
         
        $idpengikut = $request->input('idpengikut');//yang mengikuti
        $idfanbase = $request->input('idfanbase');//fanbase yang diikuti
       
        if(DB::table('fanbase_detail')->insert(
            ['uid'=>$hasilrandom,'uid_member' => $idpengikut,'id_fanbase' => $idfanbase,'role' => 'member','date'=>date('Y-m-d H:i:s')]
        )){
            $res['message'] = "Success!";
            $res['value'] = "$data";
            return response($res);
        }
        else{
            $res['message'] = "gagal";
            return response($res);
        }
        
    }
/**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //POST FANBASE
    public function createfanbase(Request $request)
    {
     
        $rules = array(
            'group_name' => 'required|min:4|unique:fanbase',
            'category' => 'required|min:4',
            'subkategori1' => 'required|min:4',
            'subkategori2' => 'required|min:4',
            'description' => 'required|min:4',
            'chairman' => 'required|min:4',
        );    
        $messages = array(
            'group_name.unique'      => 'Maaf kawan, Nama Grup ini telah digunakan orang lain, silahkan menggunakan nama lainnya.',
            'group_name.required'    => 'Yuk cantumkan nama grupmu agar orang lain bisa mengenalimu.',
            'category.required'      => 'Yuk cantumkan kategori grupmu agar orang lain bisa mengenalimu..',
            'subkategori1.required'      => 'Yuk cantumkan tag 1 grupmu agar orang lain bisa mengenalimu.',
            'subkategori1.required'      => 'Yuk cantumkan tag 2 grupmu agar orang lain bisa mengenalimu.',
            'description.required'      => 'Yuk cantumkan deskripsi grupmu agar orang lain bisa mengenalimu.',
                    );
        $validator = Validator::make( $request->all(), $rules, $messages );

        if ( $validator->fails() ) 
        {
            return response()->json($validator->errors()->first(), 400);
          
        }
        $bytes = random_bytes(10);
        $hasilrandom=bin2hex($bytes);
         
        // $data = DB::table('fanbase')->get();

        //  
        $group_name = $request->input('group_name');
        $status = 'terbuka';
        $category = $request->input('category');
        $subkategori1 = $request->input('subkategori1');
        $subkategori2 = $request->input('subkategori2');
        $description = $request->input('description');
        $chairman = $request->input('chairman');
        
        $data= DB::table('fanbase')
        ->where('group_name', '=', $group_name)
        ->get();
        if(count($data) > 0){ //mengecek apakah data kosong atau tidak
            $res['message'] = "gagal";
            return response()->json($res, 400);
        }else{
            if(DB::table('fanbase')->insert(
                ['uid'=>$hasilrandom,'group_name' => $group_name,'status' => $status,'category' => $category,
                'subkategori1' => $subkategori1,'subkategori2' => $subkategori2,
                'description' => $description,'chairman' => $chairman
                ]
            )){
                $bytes2 = random_bytes(10);
                $hasilrandom2=bin2hex($bytes2);
                if(DB::table('fanbase_chat')->insert(
                    ['uid'=>$hasilrandom2,'id_room' => $hasilrandom,'id_fanbase' => $hasilrandom]
                )){
                            $bytes3 = random_bytes(10);
                        $hasilrandom3=bin2hex($bytes3);
                        $current_date = date('Y-m-d H:i:s');
                        if(DB::table('fanbase_detail')->insert(
                            ['uid'=>$hasilrandom3,'id_fanbase' => $hasilrandom,'uid_member' => $chairman,'role' => 'admin','date'=>$current_date]
                        )){
                            $data= DB::table('fanbase')
                            ->where('uid', '=', $hasilrandom)
                            ->get();
                            $res['message'] = "Success!";
                            $res['values'] = $data;
                            return response($res);
                        }
                        else{
                            $res['message'] = "gagal";
                            return response($res);
                        }
                }
                else{
                    $res['message'] = "gagal";
                    return response($res);
                }
                
            }
            else{
                $res['message'] = "gagal";
                return response($res);
            }    
        }
        
        
    }
/**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //update FANBASE
    public function updatefanbaseinfo(Request $request)
    {
     
        $group_name = $request->input('group_name');
        $category = $request->input('category');
        $subkategori1 = $request->input('subkategori1');
        $subkategori2 = $request->input('subkategori2');
        $description = $request->input('description');
        $uidfanbase = $request->input('uidfanbase');
       
        $data= DB::table('fanbase')
        ->where('uid', '=', $uidfanbase)
        ->get();
        
        if(DB::table('fanbase')->where('uid', $uidfanbase)->update( [
            'group_name' => $group_name,
            'category' => $category,
            'subkategori1' => $subkategori1,
            'subkategori2' => $subkategori2,
            'description' => $description,
        ])){
            $res['message'] = "Success!";
            $res['value'] = "$data";
            return response($res);
        }
        else{
            $res['message'] = "Gagal!";
            return response($res);
        }
        
        
    }
    public function updatestruktur(Request $request)
{
    //
    $uidmember = $request->input('uidmember');
    $uidmemberlama = $request->input('uidmemberlama');
    $uidfanbase = $request->input('uidfanbase');
    $data= DB::table('fanbase')
    ->where('uid', '=', $uidfanbase)
    ->get();
    
    if(DB::table('fanbase')->where('uid', $uidfanbase)->update( [
        'chairman' => $uidmember,
    ])){
        if(DB::table('fanbase_detail')->where('id_fanbase', $uidfanbase)->where('uid_member', $uidmember)->update( [
            'role' => 'admin',
        ])){
            if(DB::table('fanbase_detail')->where('id_fanbase', $uidfanbase)->where('uid_member', $uidmemberlama)->update( [
                'role' => 'member',
            ])){
                $res['message'] = "Success!";
                $res['value'] = "$data";
                return response($res);
            };
        }
        $res['message'] = "Success!";
                $res['value'] = "$data";
                return response($res);
    }
    else{
        $res['message'] = "Gagal!";
        return response($res);
    }
    
    
}

}
