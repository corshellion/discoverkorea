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
        <!-- CSS Verified Badges -->
        <link rel="stylesheet" type="text/css" href="{{{URL::asset('/assets/icofont/icofont.min.css') }}}">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSS Verified Badges -->
    <!-- Main Section -->
    <section class="main-section">
        <!-- Add Your Content Inside -->
        <div class="content">
            <!-- Remove This Before You Start -->
            <h1>Pengguna</h1>
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
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No. HP</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @php $no = 1; @endphp
                @foreach($data as $datas)

                        @if($datas->status=='ditangguhkan')         
                                <tr style="background-color: pink">           
                        @else
                                <tr>       
                        @endif
                        <td>{{ $no++ }}</td>
                        <td style="width: 300px">{{ $datas->username }}
                                @if($datas->verified==1)
                                    <span>
                                        <a href="#" data-toggle="tooltip" title="Terverifikasi"><img src="{{{URL::asset('/assets/verified/verified.png') }}}" style="width:5%; margin-top:-20px; "></a>
                                        
                                    </span>
                                @endif
                        </td>
                        <td>{{ $datas->email }}</td>
                        <td>{{ $datas->nohp }}</td>
                        <td>{{ $datas->alamat }}</td>
                        
                        <td>
                           
                                {{ csrf_field() }}
                                {{-- {{ method_field('DELETE') }} --}}
                                {{-- <a href="{{ route('ckontak.edit',$datas->id) }}" class=" btn btn-sm btn-primary">Edit</a> --}}
                            
                                @if($datas->status=='aktif')         
                                    <a href="{{ url('/tangguhkan',$datas->uid) }}" class=" btn btn-sm btn-primary" style="background-color: green" onclick="return confirm('Yakin ingin menangguhkan pelanggan ini?')">Tangguhkan</a>
                                @else
                                    <a href="{{ url('/aktifkan',$datas->uid) }}" class=" btn btn-sm btn-primary" style="background-color:chocolate" onclick="return confirm('Yakin ingin menghapus penangguhan pelanggan ini?')">Pengaktifan</a>
                                @endif
                                @if($datas->verified=='0')   
                                <a href="{{ url('/verified',$datas->uid) }}" class="btn btn-sm btn-primary" type="submit" onclick="return confirm('Yakin ingin memberikan lencana verifikasi kepada user ini?')"  style="background-color:#42c2f5;">Berikan Lencana Verifikasi</a>
                                @else
                                <a href="{{ url('/unverified',$datas->uid) }}" class="btn btn-sm btn-primary" type="submit" onclick="return confirm('Yakin ingin mencopot lencana verifikasi kepada user ini?')"  style="background-color:#f59e3b;">Copot Lencana Verifikasi</a>
                                @endif
                                <a href="{{ url('/hapususer', $datas->uid) }}" class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Yakin ingin menghapus data?')" style="background-color:red;">Hapus</a>
                            
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.content -->
    </section>
    <!-- /.main-section -->
    <script>
        $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip();   
        });
        </script>
@endsection
