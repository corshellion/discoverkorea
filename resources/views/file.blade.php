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
    <!-- Main Section -->
    <section class="main-section">
        <!-- Add Your Content Inside -->
        <div class="content">
            <!-- Remove This Before You Start -->
            <h1>Direktori Berita</h1>
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
                    <th>Username</th>
                    <th>Direktori File</th>
                    <th>Status Unggahan</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @php $no = 1; @endphp
               
                @foreach($data as $datas)
                    <tr>
                        
                        @if($datas->previlege==1)   
                                <td>{{ $no++ }}</td>
                                <td>{{ $datas->username }}</td>
                                @if($datas->type=='image') 
                                    <td>
                                        <a href="{{ url('uploads/file/'.$datas->file) }}" ><img id="myImg" src="{{ url('uploads/file/'.$datas->file) }}" alt="Detail Gambar" style="width:100%;max-width:320px"></a>
                                        
                                    </td>
                                @else
                                    <td>
                                        <video width="320" height="240" controls> <source src="{{ url('uploads/file/'.$datas->file) }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                        </video>
                                    </td>
                                @endif
                                
                                <td style="width: 50%;text-align:justify;"><b>Judul: </b>{{$datas->title}} <br><br>{{$datas->status }}</td>
                                <td>
                                        {{ csrf_field() }}
                                        <a href="{{ url('/editfile',$datas->uid) }}" class=" btn btn-sm btn-primary">Edit</a>
                                        <a href="{{ url('/hapusfile', $datas->uid) }}" class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Yakin ingin menghapus data?')" style="background-color:red;">Hapus</button>
                                    
                                </td>
                         @endif
                        
                        
                    </tr>
                    
                @endforeach
                </tbody>
            </table>
        </div>
         
        <!-- /.content -->
    </section>
    <!-- /.main-section -->
@endsection