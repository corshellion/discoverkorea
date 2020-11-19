<meta name="description" content="Kalian penggembar KPOP? Tapi juga suka dengan budaya Korea juga? Buat akun Discover Korea dan bagikan pengalamanmu tentang korea ke banyak orang dan gabung dengan fanbase yang sesuai dengan minatmu, gabung sekarang untuk memulai. ">
<meta name="author" content="Discover Korea">
<meta name="keywords" content="Fanbase, Korea, Korea Selatan, Komunitas, Kpop, blackpink, bts, lisa blackpink, nonton drama korea, download drama korea, drama korea, drama korea terbaru, film semi korea, film korea, drama korea terbaik, streaming drama korea, south korea, berita korea">
<meta name="og:title" property="og:title" content="Fanbase Korea Terbaik">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Disover Korea- Let's Discover</title>
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
            <h1 style="color:black;">Laporan Pengguna Bermasalah</h1>
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
                    <th>User Terlapor</th>
                    <th>Jumlah Kasus</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @php $no = 1; @endphp
                @foreach($data as $datas)

                        
                        <td>{{ $no++ }}</td>
                        <td>
                            <b>{{$datas->user_reported}}</b>
                            @php 
                                $users_verified="";
                                $users_verified = DB::table('kontak')->where('username', $datas->user_reported)->pluck('verified');

                            
                            @endphp
                            @if($datas->previlege==1||$users_verified=='[1]')
                                    <span>
                                        <a href="#" data-toggle="tooltip" title="Terverifikasi"><img src="{{{URL::asset('/assets/verified/verified.png') }}}" style="width:1%; margin-top:-20px; "></a>
                                        
                                    </span>
                            @endif

                        </td>
                        <td>{{ $datas->total }}</td>
                        
                        <td>
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <a href="#comment{{$datas->user_reported}}" class=" btn btn-sm btn-primary" style="color:white">Detail Laporan</a>  
                                <a href="{{ url('/penangguhan',$datas->user_reported) }}" class=" btn btn-sm btn-primary" style="background-color: green;color:white;" onclick="return confirm('Yakin ingin menangguhkan pelanggan ini?')">Tangguhkan</a>
                                <a href="{{ url('/decline_user_report',$datas->user_reported) }}" class=" btn btn-sm btn-primary" style="background-color: red;color:white;" onclick="return confirm('Yakin ingin hapus pelanggan ini?')">Hapus</a>
                        </td>
                    </tr>
                     {{-- Komentar Laporan --}}
                        <div id="comment{{$datas->user_reported}}" class="overlay" >
                            <div class="popup" style="width:922px;height:300px;margin-top:100px;z-index:999;position: relative" >
                                <h4 style="color:black;">Detail Laporan Pengguna</h4>
                                <a class="close" href="#post">&times;</a>
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

                                            $sql = "SELECT * FROM kontak where username='".$datas->user_reported."'";
                                            $result = $conn->query($sql);
                                            ?>
                                                
                                            <?php
                                            if ($result->num_rows > 0) {
                                                // output data of each row
                                                while($row = $result->fetch_assoc()) {
                                                    ?>
                                                       
                                                       <b>User Pengguna:</b> <div style="font-size: 15px; color:grey;">  <?php   echo nl2br($row["username"]);?> <br></div>
                                                       <b>Nama Pengguna:</b> <div style="font-size: 15px;color:grey;">  <?php   echo nl2br($row["nama"]);?> <br></div>
                                                       <b>E-mail Pengguna:</b><div style="font-size: 15px;color:grey;">  <?php   echo nl2br($row["email"]);?> <br></div>
                                                       <b> Status Pengguna:</b><div style="font-size: 15px;color:grey;">  <?php   echo nl2br($row["status"]);?> <br></div>
                                                <?php } ?>
                                                
                                               
                                            <?php
                                                } else {
                                                    echo "0 results";
                                                }
                                                $conn->close();
                                        ?>
                            </div>
                        </div>
           
                     {{-- Komentar Laporan --}}
                @endforeach
                </tbody>
            </table>
            
        </div>
        <!-- /.content -->
    </section>
    <script>
        $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
    <!-- /.main-section -->
@endsection