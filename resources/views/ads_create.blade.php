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
            <h1>Buat Iklan Baru</h1>
            <hr>
            <?php $id=Session::get('email');
            
            ?>
            <form enctype="multipart/form-data" action="{{ url('/buat_permintaan_iklan') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">Username:</label>
                        <select name="name" id="name"  class="form-control">
                            @foreach($data as $datas)
                            <option value="{{$datas->username}}" >{{$datas->username}}</option>
                            @endforeach
                        </select>
                </div>
                <div class="form-group">
                    <label for="email">Upload Gambar Berita:</label>
                    <input type="file" class="form-control" id="email" name="file">
                </div>
                <div class="form-group">
                    <label for="isi">Isi Unggahan:</label>
                    <textarea class="form-control" id="status" name="status" style="height: 200px;" placeholder="Silahkan mengisi isi dari status"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-md btn-primary">Submit</button>
                    <button type="reset" class="btn btn-md btn-danger">Cancel</button>
                </div>
            </form>
        </div>
        <!-- /.content -->
    </section>
    <!-- /.main-section -->
@endsection