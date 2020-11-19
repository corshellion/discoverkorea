<meta name="description" content="Kalian penggembar KPOP? Tapi juga suka dengan budaya Korea juga? Buat akun Discover Korea dan bagikan pengalamanmu tentang korea ke banyak orang dan gabung dengan fanbase yang sesuai dengan minatmu, gabung sekarang untuk memulai. ">
  <meta name="author" content="Discover Korea">
  <meta name="keywords" content="Fanbase, Korea, Korea Selatan, Komunitas, Kpop, blackpink, bts, lisa blackpink, nonton drama korea, download drama korea, drama korea, drama korea terbaru, film semi korea, film korea, drama korea terbaik, streaming drama korea, south korea, berita korea">
  <meta name="og:title" property="og:title" content="Fanbase Korea Terbaik">
      <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Disover Korea- Let's Discover</title>
@include('meta::manager')
@extends('base')
@section('content')
 <!-- CSS untuk read more-->
 <link rel="stylesheet" type="text/css" href="{{{URL::asset('/assets/read_more/readmore.css') }}}">
 <!-- CSS untuk pop up-->
 <link rel="stylesheet" type="text/css" href="{{{URL::asset('/assets/pop_up/popup.css') }}}">
    <!-- Main Section -->
    <section class="main-section">
        <!-- Add Your Content Inside -->
        <div class="content">
            <!-- Remove This Before You Start -->
            <h1 style="color: black;">Direktori Permintaan Iklan</h1>
            @if(Session::has('alert-success'))
                <div class="alert alert-success">
                    <strong>{{ \Illuminate\Support\Facades\Session::get('alert-success') }}</strong>
                </div>
            @endif
            <hr>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Status </th>
                    <th>Berkas Terlampir</th>
                    <th>Berlaku Mulai</th>
                    <th>Berlaku Hingga</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @php $no = 1; @endphp
                @foreach($data as $datas)

                        
                        <td>{{ $no++ }}</td>
                        <td>
                            <div class="comment more" style="width: 400px;background-color:white;text-align:justify">
                                {{ $datas->status }}
                            </div>
                           
                        </td>
                            @if($datas->type=='image') 
                            <td> <img src="{{ url('uploads/file/'.$datas->file) }}" style="width: 320px; height: 320px;"></td>
                            @else
                                <td>
                                    <video width="320" height="240" controls> <source src="{{ url('uploads/file/'.$datas->file) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                    </video>
                                </td>
                            @endif
                        <td>{{ $datas->created_at }}</td>
                        <td>{{ $datas->ended_at }}</td>
                      
                        <td>
                                {{ csrf_field() }}
                                <a href="#comment{{$datas->id_request}}" class=" btn btn-sm btn-primary" style="background-color: green;color:white">Detail Iklan</a>
                                <a href="{{ url('/aktifkan_iklan',$datas->id_request) }}" class=" btn btn-sm btn-primary" style="background-color:chocolate;color:white;" onclick="return confirm('Yakin ingin Mengaktfikan iklan pelanggan ini?')">Aktifkan</a>
                                <a href="{{ url('/batalkan_iklan',$datas->id_request) }}" class=" btn btn-sm btn-primary" style="background-color:rgb(216, 57, 57);color:white;" onclick="return confirm('Yakin ingin Menghapus permintaan iklan pelanggan ini?')">Batalkan Iklan</a>
                            
                        </td>
                    </tr>
                    {{-- Komentar foto --}}
                    <div id="comment{{$datas->id_request}}" class="overlay" >
                        <div class="popup" style="width:922px;height:656px;margin-top:100px;z-index:999;position: relative" >
                            <h4>Detail Permintaan Iklan</h4>
                            <a class="close" href="#post">&times;</a>
                                <img src="{{ url('uploads/file/'.$datas->file) }}" alt="Avatar" style="width:598px;height:598px;margin-left:-20px;">
                                <div style="background-color:transparent; width:324px; height:100px;margin-left:580px;margin-top:-598px">
                                    <span>
                                        <b style="font-size: 18px;margin-left:20px;">{{$datas->username}}</b>
                                        @php 
                                            $users_verified="";
                                            $users_verified = DB::table('kontak')->where('username', $datas->username)->pluck('verified');

                                        
                                        @endphp
                                        @if($datas->previlege==1||$users_verified=='[1]')
                                                <span>
                                                    <a href="#" data-toggle="tooltip" title="Terverifikasi"><img src="{{{URL::asset('/assets/verified/verified.png') }}}" style="width:3%; margin-top:-20px; "></a>
                                                    
                                                </span>
                                        @endif
                                        <br >
                                        <span style="font-size: 14px; color:grey;margin-left: 20px;">
                                            @if($datas->category=='ads')
                                                Bersponsor
                                            @endif
                                            @if($datas->category=='post')
                                                Unggahan
                                            @endif
                                            @if($datas->category=='news')
                                                Berita
                                            @endif
                                        </span>
                                    </span>
                                </div>
                                <div style="background-color:transparent;margin-top:-20px ;width:322px; height:498px;margin-left:577px;text-decoration:none">
                                   
                                   
                                </div>
                        </div>
                    </div>
                   
                    {{-- Komentar Foto --}}
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.content -->
        <script>
            $(document).ready(function(){
              $('[data-toggle="tooltip"]').tooltip();   
            });
        </script>
        <script type="text/javascript" src="{{{URL::asset('/assets/read_more/readmorejs.js') }}}"></script>
    </section>
    <!-- /.main-section -->
@endsection