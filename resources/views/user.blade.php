<meta name="description" content="Kalian penggembar KPOP? Tapi juga suka dengan budaya Korea juga? Buat akun Discover Korea dan bagikan pengalamanmu tentang korea ke banyak orang dan gabung dengan fanbase yang sesuai dengan minatmu, gabung sekarang untuk memulai. ">
<meta name="author" content="Discover Korea">
<meta name="keywords" content="Fanbase, Korea, Korea Selatan, Komunitas, Kpop, blackpink, bts, lisa blackpink, nonton drama korea, download drama korea, drama korea, drama korea terbaru, film semi korea, film korea, drama korea terbaik, streaming drama korea, south korea, berita korea">
<meta name="og:title" property="og:title" content="Fanbase Korea Terbaik">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Disover Korea- Let's Discover</title>
@extends('base')
@section('content')
<head>
    <script src="../dist/Chart.min.js"></script>
    <script src="../dist/utils.js"></script>
    
</head>
    <!-- Main Section -->
    <section class="main-section">
        <!-- Add Your Content Inside -->
        <div class="content">
            <!-- Remove This Before You Start -->
            <h1>Selamat Datang Administrator</h1>
            <p>Hallo, {{Session::get('name')}}. Apakabar?</p>

            <h2>* Email kamu : {{Session::get('email')}}</h2>
            <h2>* Status Login : {{Session::get('login')}}</h2>
            <h2>* Username Login : {{Session::get('username')}}</h2>

        </div>
        <body>
            <div id="piechart" style="margin-left:50%;margin-right:30%;margin-top:-15%;padding:0%;background-color: transparent;"></div>
            <form action="/action_page.php" style="margin-left:60%;margin-top:-13%; position: relative;z-index:999; ">
                <label for="birthdaytime">Bulan:</label>
                <input type="month" id="birthdaytime" name="birthdaytime">
                <input type="submit">
              </form>
            
            {{-- <button id="randomizeData">Randomize Data</button>
            <button id="addDataset">Add Dataset</button>
            <button id="removeDataset">Remove Dataset</button> --}}

            @php $count = DB::table('kontak')->count(); @endphp
            
          
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    //  $jsvar = <?php echo json_encode($count); ?>;
		$(document).ready(function() {
			setInterval(function () {
               // var con=$('#show').load('/reload').val();
           ///menghitung sebuah value chart
               $.ajax({
               type:'GET',
               url:'/reload',
               data:'_token = <?php echo csrf_token() ?>',
               success:function(data) {
                  $("#show").html(data.values);
                  $jsvar=data.values;
                  
               }
               
            });
            //akhir dari perhitungan value chart
            
                    // Load google charts
                    google.charts.load('current', {'packages':['corechart']});
                    google.charts.setOnLoadCallback(drawChart);
                
                    // Draw the chart and set the chart values
                    function drawChart() {
                    
                    var data = google.visualization.arrayToDataTable([
                    ['Task', 'Hours per Day'],
                    ['Budaya',  $jsvar],
                    ['Sosial', 2],
                    ['Ekonomi', 4],
                    ['Politik', 2],
                    ['Kesehatan', 8]
                    ]);
                    
                    // Optional; add a title and set the width and height of the chart
                    var options = {'title':'Trend Pengguna', 'width':800, 'height':800};
                    
                    // Display the chart inside the <div> element with id="piechart"
                    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                    chart.draw(data, options);
                    }


			}, 1000);
		});
            </script>
        
        </body>
        <!-- /.content -->
    </section>
    <!-- /.main-section -->
@endsection


