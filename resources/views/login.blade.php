<head>
	<title>Masuk Halaman Pengaturan</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{{URL::asset('/assets/login_asset/vendor/bootstrap/css/bootstrap.min.css') }}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{URL::asset('/assets/login_asset/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{URL::asset('/assets/login_asset/fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{URL::asset('/assets/login_asset/vendor/animate/animate.css') }}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{URL::asset('/assets/login_asset/vendor/css-hamburgers/hamburgers.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{URL::asset('/assets/login_asset/vendor/animsition/css/animsition.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{URL::asset('/assets/login_asset/vendor/select2/select2.min.css') }}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{URL::asset('/assets/login_asset/vendor/daterangepicker/daterangepicker.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{URL::asset('/assets/login_asset/css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{URL::asset('/assets/login_asset/css/main.css') }}">
<!--===============================================================================================-->
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Kalian penggembar KPOP? Tapi juga suka dengan budaya Korea juga? Buat akun Discover Korea dan bagikan pengalamanmu tentang korea ke banyak orang dan gabung dengan fanbase yang sesuai dengan minatmu, gabung sekarang untuk memulai. ">
<meta name="author" content="Discover Korea">
<meta name="keywords" content="Fanbase, Korea, Korea Selatan, Komunitas, Kpop, blackpink, bts, lisa blackpink, nonton drama korea, download drama korea, drama korea, drama korea terbaru, film semi korea, film korea, drama korea terbaik, streaming drama korea, south korea, berita korea">
<meta name="og:title" property="og:title" content="Fanbase Korea Terbaik">
@include('meta::manager')
<title>Disover Korea- Let's Discover</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#dialog" ).dialog();
  } );
  </script>

</head>
<div class="limiter">
  <div class="container-login100">
    <div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
      <form class="login100-form validate-form flex-sb flex-w"  action="{{ url('/loginPost') }}" method="post">
        {{ csrf_field() }}
        @if(\Session::has('alert'))
        <div id="dialog" title="Pemberitahuan!">
          <p>{{Session::get('alert')}}</p>
        </div>
    @endif
    @if(\Session::has('alert-success'))
        <div id="dialog" title="Selamat Datang!">
          <p>{{Session::get('alert-success')}}</p>
        </div>
    @endif
        <span class="login100-form-title p-b-32">
          Account Login
        </span>

        <span class="txt1 p-b-11">
          Username
        </span>
        <div class="wrap-input100 validate-input m-b-36" data-validate = "Username is required">
          <input class="input100" type="text"   id="email" name="email" >
          <span class="focus-input100"></span>
        </div>
        
        <span class="txt1 p-b-11">
          Password
        </span>
        <div class="wrap-input100 validate-input m-b-12" data-validate = "Password is required">
          <span class="btn-show-pass">
            <i class="fa fa-eye"></i>
          </span>
          <input class="input100" type="password"   id="password" name="password" >
          <span class="focus-input100"></span>
        </div>
        
        <div class="flex-sb-m w-full p-b-48">
          <div class="contact100-form-checkbox">
            <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
            <label class="label-checkbox100" for="ckb1">
              Remember me
            </label>
           
          </div>

          <div>
          
            <a href="#" class="txt3">
              Forgot Password?
            </a>
           
          </div>
        </div>

        <div class="container-login100-form-btn">
          <button class="login100-form-btn">
            Login
          </button>
        </div>

      </form>
    </div>
  </div>
</div>
   
