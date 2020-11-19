<meta name="description" content="Kalian penggembar KPOP? Tapi juga suka dengan budaya Korea juga? Buat akun Discover Korea dan bagikan pengalamanmu tentang korea ke banyak orang dan gabung dengan fanbase yang sesuai dengan minatmu, gabung sekarang untuk memulai. ">
<meta name="author" content="Discover Korea">
<meta name="keywords" content="Fanbase, Korea, Korea Selatan, Komunitas, Kpop, blackpink, bts, lisa blackpink, nonton drama korea, download drama korea, drama korea, drama korea terbaru, film semi korea, film korea, drama korea terbaik, streaming drama korea, south korea, berita korea">
<meta name="og:title" property="og:title" content="Fanbase Korea Terbaik">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Sosial Media- Let's Discover</title>
@extends('base')
@section('content')
<head>
    {{-- <script src="../dist/Chart.min.js"></script>
    <script src="../dist/utils.js"></script> --}}
    <!-- CSS untuk social card-->
    <link rel="stylesheet" type="text/css" href="{{{URL::asset('/assets/imagecard/card.css') }}}">
    <!-- CSS untuk pop up-->
    <link rel="stylesheet" type="text/css" href="{{{URL::asset('/assets/pop_up/popup.css') }}}">
</head>
    <!-- Main Section -->
    <section class="main-section">
        <!-- Add Your Content Inside -->
        <div class="content">
            @foreach($data as $datas)
                    @php
                      $status_user = DB::table('kontak')->where('username', $datas->username)->pluck('status');
                    @endphp
                    @if(($datas->status_post=='aktif' && $status_user=='["aktif"]')||$status_user=='[]')
                        <div style="margin-top: 100px;"></div>
                        <div class="card" style="margin: auto; width:720px">
                            @if($datas->type=='image') 
                                 <a style="z-index:1" href='#comment{{$datas->uid}}'><img src="{{ url('uploads/file/'.$datas->file) }}" alt="Avatar" style="width:720px;"></a>
                            @else
                                    <video style="z-index:1" width="720px" height="480px" controls> <source src="{{ url('uploads/file/'.$datas->file) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                    </video>
                                 
                            @endif
                            {{-- Komentar foto --}}
                            <div id="comment{{$datas->uid}}" class="overlay" >
                                <div class="popup" style="width:922px;height:656px;margin-top:100px;z-index:999;position: relative" >
                                    <h4>Komentar</h4>
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
                                            
                                            {{-- Komentar --}}
                                            <?php
                                                $servername = "localhost";
                                                $username = "root";
                                                $password = "";
                                                $dbname = "discoverkorea_db";

                                                // Create connection
                                                $conn = new mysqli($servername, $username, $password, $dbname);
                                                // Check connection
                                                if ($conn->connect_error) {
                                                    die("Connection failed: " . $conn->connect_error);
                                                }

                                                $sql = "SELECT * FROM notifikasi";
                                                $result = $conn->query($sql);
                                                ?>
                                                    <li style="overflow-y: scroll;;height:484px; margin-left:20px;text-decoration:none;list-style: none">
                                                    <a href="/" style="width:600px;text-decoration:none;color:black;">
                                                <?php
                                                if ($result->num_rows > 0) {
                                                    // output data of each row
                                                    while($row = $result->fetch_assoc()) {
                                                        ?>
                                                            <span class="glyphicon glyphicon-info-sign"></span>
                                                            <span style=""><b><?php echo nl2br($row["from"]); ?></b></span><br>
                                                            <?php   echo nl2br($row["message"]);?> <br>
                                                    <?php } ?>
                                                    </a>
                                                    </li>
                                                <?php
                                                
                                                    } else {
                                                        echo "0 results";
                                                    }
                                                    $conn->close();
                                                ?>
                                            {{-- Komentar --}}
                                            <span>
                                                <input type="text" style="width: 325px;height:50px;margin-top:-20px;" placeholder="Beri komentar sesuatu...">
                                            </span>
                                        </div>
                                </div>
                            </div>
                           
                            {{-- Komentar Foto --}}

                            <div class="container">
                            <h4 style="margin-top: 20px;">
                                <b>{{$datas->username}}</b>
                                @php 
                                    $users_verified="";
                                    $users_verified = DB::table('kontak')->where('username', $datas->username)->pluck('verified');

                                
                                @endphp
                                @if($datas->previlege==1||$users_verified=='[1]')
                                        <span>
                                            <a href="#" data-toggle="tooltip" title="Terverifikasi"><img src="{{{URL::asset('/assets/verified/verified.png') }}}" style="width:1%; margin-top:-20px; "></a>
                                            
                                        </span>
                                @endif
                                <br>
                                <span style="font-size: 14px; color:grey">
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
                            </h4>
                            <span>
                            <span style="margin-left:670px; "><a href='#notify{{$datas->uid}}'><img src="{{{URL::asset('/assets/more/more.png') }}}" style="width:1.1%; margin-top:-20px;"></a></span>
                            <div id="notify{{$datas->uid}}" class="overlay">
                                    <div class="popup">
                                        <h4>Pemberitahuan</h4>
                                        <a class="close" href="#post">&times;</a>
                                        <div class="content" >
                                            <hr>
                                            <a href="{{ url('/laporkan', $datas->uid) }}" style="text-decoration:none"><span style="color:red;text-align:center;margin-left:17%;font-size:14px;margin-top:20px;">Laporkan kiriman sebagai Tidak sesuai</span></a>
                                            <hr>
                                            <a href="{{ url('/laporkan_pengguna', $datas->username) }}" style="text-decoration:none"><span style="color:red;text-align:center;margin-left:17%;font-size:14px;margin-top:20px;">Laporkan Pengguna sebagai Tidak sesuai</span></a>
                                        </div>
                                    </div>
                                </div>
                            </span>
                            
                            <span style="font-size: 14px; color:grey;text-align:right;margin-left:560px;">{{$datas->created_at}}</span>
                             <br><b>{{$datas->title}} </b>
                            <div style="width: 690px; text-align: justify; text-justify: inter-word;margin-top:10px">
                                <div class="comment more" style="width: 672px;">
                                   <?php   echo nl2br($datas->status); ?>
                                </div>
                                
                            </div> 
                            
                            </div>
                        </div>
                    @endif
                @endforeach
            
        </div>
        <footer style="margin-top: 200px;"></footer>
        <!-- /.content -->
        
    </section>
    <!-- /.main-section -->
    <script>
        $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
   
@endsection


