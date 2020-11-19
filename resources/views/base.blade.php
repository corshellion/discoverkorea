<!DOCTYPE html>
<html lang="en">

<head>
  <title>Disover Korea- Let's Discover</title>
    <!-- Main Styles CSS -->
    <link href="/assets/css/main.css" rel="stylesheet"> {{-- ini cara memanggil css dari folder assets -> css --}}

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- CSS untuk sub menu-->
    <link rel="stylesheet" type="text/css" href="{{{URL::asset('/assets/submenu/submenu.css') }}}">
    <!-- CSS Untuk Mavbar-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    {{-- untuk multi dropdown --}}
        <style>
            .dropdown-submenu {
              position: relative;
            }

            .dropdown-submenu .dropdown-menu {
              top: 0;
              left: 100%;
              margin-top: -1px;
            }
            
        </style>
</head>

<body>
   
    <nav class="navbar navbar-inverse" style="margin: 0px;position: relative;z-index:1000; " >
        <div class="container-fluid">
          <div class="navbar-header">
         <a  class="navbar-brand"href="/home_user">Discover Korea Admin</a>
          </div>
          <ul class="nav navbar-nav">
            <li class="active"><a href="{{url('/home_user')}}">Beranda</a></li>
            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Halaman Pengguna (Customer) <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="{{url('/buatkontak')}}"><span class="glyphicon glyphicon-plus"> </span> Tambah Pengguna</a></li>
                <li><a href="{{url('/user')}}"><span class="glyphicon glyphicon-user"> </span> Direktori Pengguna</a></li>
                <li><a href="{{url('/file_pengguna')}}"><span class="glyphicon glyphicon-picture"> </span> Direktori Unggahan Pengguna</a></li>
                <li class="dropdown-submenu">
                  <a class="test" tabindex="2" href="#"><span class="glyphicon glyphicon-info-sign"> </span> Laporan<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="{{url('/laporan_berita')}}"><span class="glyphicon glyphicon-info-sign"> </span> Laporan Berita Bermasalah</a></li>
                    <li><a href="{{url('/laporan_pengguna')}}"><span class="glyphicon glyphicon-info-sign"> </span> Laporan Pengguna Bermasalah</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Halaman Admin (Administrator) <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li class="dropdown-submenu">
                  <a class="test" tabindex="1" href="#"><span class="glyphicon glyphicon-briefcase"></span> Direktori Berita<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="{{url('/unggah_file')}}"><span class="glyphicon glyphicon-bullhorn"> </span> Buat berita baru</a></li>
                    <li><a href="{{url('/file')}}"><span class="glyphicon glyphicon-folder-open"> </span> Direktori Berita</a></li>
                    
                    <li class="dropdown-submenu">
                      <a class="test" href="#">Another dropdown <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a href="#">3rd level dropdown</a></li>
                        <li><a href="#">3rd level dropdown</a></li>
                      </ul>
                    </li>
                  </ul>
                </li>
                <li class="dropdown-submenu">
                  <a class="test" tabindex="2" href="#"><span class="glyphicon glyphicon-usd"> </span>Direktori Iklan<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="{{url('/iklan')}}"><span class="glyphicon glyphicon-book"> </span> Direktori Iklan</a></li>
                    <li><a href="{{url('/buat_iklan')}}"><span class="glyphicon glyphicon-tag"> </span> Buat Iklan Baru</a></li>
                    <li><a href="{{url('/permintaan_iklan')}}"><span class="glyphicon glyphicon-transfer"> </span> Permintaan Iklan</a></li>
                  </ul>
                </li>
                <li class="dropdown-submenu">
                  <a class="test" tabindex="2" href="#"><span class="glyphicon glyphicon-globe"> </span> Grup Fanbase<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="{{url('/fanbase')}}"><span class="glyphicon glyphicon-envelope"> </span> Direktori Grup Obrolan</a></li>
                  </ul>
                </li>
               
              </ul>
            </li>
            <li><a href="{{url('/social')}}">Halaman Media Sosial</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"> <span class="glyphicon glyphicon-bell"></span></a>
              <ul class="dropdown-menu" >
                
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
                    <li style="overflow-y: scroll;">
                     {{-- untuk style scroll --}}
                <?php
                if ($result->num_rows > 0) {
                    // output data of each row
                      while($row = $result->fetch_assoc()) {
                        if($row["to"]=='discoverkorea'){
                        ?>
                          <a href="/" style="width:600px;max-height:200px ">
                            <span class="glyphicon glyphicon-info-sign"></span>
                            <span style=""><b><?php echo nl2br($row["from"]); ?></b></span><br>
                            <?php   echo nl2br($row["message"]);?> <br>
                          </a>
                      <?php }else{?>
                        <a  style="width:600px;max-height:200px ">
                          <span class="glyphicon glyphicon-info-sign"></span>
                          <span style=""><b>Info</b></span><br>
                          <?php   echo 'Tidak ada informasi yang masuk ke kontak anda.'?> <br>
                        </a>
                     <?php }} ?>
                     
                    </li>
                <?php
                  
                      } else {
                          echo "0 results";
                      }
                      $conn->close();
                ?>
               
              </ul>
            </li>
            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Pengaturan <span class="glyphicon glyphicon-user"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="/register"><span class="glyphicon glyphicon-user"></span> Daftarkan Admin Baru</a></li>
                    <li><a href="/logout"><span class="glyphicon glyphicon-log-in"></span> Keluar</a></li>
                </ul>
              </li>
            
            
          </ul>
        </div>
      </nav>
      
      <div style="margin-left: 100px; margin-right:100px;">
        @yield('content') {{-- Semua file konten kita akan ada di bagian ini --}}
    </div>
      {{-- js untuk drop down --}}
    <script>
      $(document).ready(function(){
        $('.dropdown-submenu a.test').on("click", function(e){
          $(this).next('ul').toggle();
          e.stopPropagation();
          e.preventDefault();
        });
      });
      </script>
<!-- /#wrapper -->


</body>

</html>