<meta name="description" content="Kalian penggembar KPOP? Tapi juga suka dengan budaya Korea juga? Buat akun Discover Korea dan bagikan pengalamanmu tentang korea ke banyak orang dan gabung dengan fanbase yang sesuai dengan minatmu, gabung sekarang untuk memulai. ">
<meta name="author" content="Discover Korea">
<meta name="keywords" content="Fanbase, Korea, Korea Selatan, Komunitas, Kpop, blackpink, bts, lisa blackpink, nonton drama korea, download drama korea, drama korea, drama korea terbaru, film semi korea, film korea, drama korea terbaik, streaming drama korea, south korea, berita korea">
<meta name="og:title" property="og:title" content="Fanbase Korea Terbaik">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Disover Korea- Let's Discover</title>
@extends('base')
@section('content')
 <!-- JQUERY untuk bold text-->
 <link rel="stylesheet" type="text/css" href="{{{URL::asset('/assets/jquery_text/jquery.js') }}}">
 <!-- Include stylesheet -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script type="text/javascript" src="{{{URL::asset('/assets/ckeditor/ckeditor.js') }}}"></script>
	<link rel="stylesheet" type="text/css" href="{{{URL::asset('/assets/ckeditor/style.css') }}}">
 <style>
    div.editable {
        width: 300px;
        height: 200px;
        border: 1px solid #ccc;
        padding: 5px;
    }
 </style>
    <!-- Main Section -->
    <section class="main-section">
        <!-- Add Your Content Inside -->
        <div class="content">
            <!-- Remove This Before You Start -->
            <h1 style="color: black;">Buat Unggahan Pengguna</h1>
            <hr>
            <form enctype="multipart/form-data" action="{{ url('/unggahpost_pengguna') }}" method="post">
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
                    <label for="file">File Url:</label>
                    <input type="file" class="form-control"  name="file">
                </div>
                <div class="form-group">
                    <label for="judul">Judul:</label>
                    <input type="text" class="form-control" id="usr" name="title" placeholder="Maksimal 50 karakter">
                </div>
                <div class="form-group">
                    <label for="desc">Description:</label>
                    <textarea class="ckeditor" id="ckedtor" name="status"></textarea>
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
