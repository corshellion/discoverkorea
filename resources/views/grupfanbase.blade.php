<meta name="description" content="Kalian penggembar KPOP? Tapi juga suka dengan budaya Korea juga? Buat akun Discover Korea dan bagikan pengalamanmu tentang korea ke banyak orang dan gabung dengan fanbase yang sesuai dengan minatmu, gabung sekarang untuk memulai. ">
<meta name="author" content="Discover Korea">
<meta name="keywords" content="Fanbase, Korea, Korea Selatan, Komunitas, Kpop, blackpink, bts, lisa blackpink, nonton drama korea, download drama korea, drama korea, drama korea terbaru, film semi korea, film korea, drama korea terbaik, streaming drama korea, south korea, berita korea">
<meta name="og:title" property="og:title" content="Fanbase Korea Terbaik">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Disover Korea- Let's Discover</title>
@extends('base')
@section('content')
    <!-- Main Section -->
    <section class="main-section">
        <!-- Add Your Content Inside -->
        <div class="content">
            <!-- Remove This Before You Start -->
            <h1>Grup Fanbase</h1>
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
                    <th>Nama Grup</th>
                    <th>Deskripsi</th>
                    <th>Leader</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @php $no = 1; @endphp
                @foreach($data as $datas)
                    <tr>
                        
                                <td>{{ $no++ }}</td>
                                <td>{{ $datas->group_name }}</td>
                                {{-- <td><img src="{{ url('uploads/file/'.$datas->file) }}" style="width: 150px; height: 150px;"> </td> --}}
                                <td>{{ $datas->description }}</td>
                                <td>{{ $datas->chairman }}</td>
                                <td>
                                    {{ csrf_field() }}
                                    <a href="{{ url('/dropfanbase',$datas->id_fanbase) }}" class=" btn btn-sm btn-primary" style="background-color: #cc0634;" onclick="return confirm('Yakin ingin menghapus fanbase ini?')">Hapus Fanbase</a>
                                </td>
                        
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.content -->
    </section>
    <!-- /.main-section -->
@endsection