<!doctype html>
<html>

<head>
	<meta name="description" content="Kalian penggembar KPOP? Tapi juga suka dengan budaya Korea juga? Buat akun Discover Korea dan bagikan pengalamanmu tentang korea ke banyak orang dan gabung dengan fanbase yang sesuai dengan minatmu, gabung sekarang untuk memulai. ">
<meta name="author" content="Discover Korea">
<meta name="keywords" content="Fanbase, Korea, Korea Selatan, Komunitas, Kpop, blackpink, bts, lisa blackpink, nonton drama korea, download drama korea, drama korea, drama korea terbaru, film semi korea, film korea, drama korea terbaik, streaming drama korea, south korea, berita korea">
<meta name="og:title" property="og:title" content="Fanbase Korea Terbaik">
@include('meta::manager')
<title>Disover Korea- Let's Discover</title>
	<script src="../dist/Chart.min.js"></script>
	<script src="utils.js"></script>
</head>

<body>
	<div id="canvas-holder" style="width:40%">
		<canvas id="chart-area"></canvas>
	</div>
	<button id="randomizeData">Randomize Data</button>
	<button id="addDataset">Add Dataset</button>
	<button id="removeDataset">Remove Dataset</button>
	<script>
		var randomScalingFactor = function() {
			return Math.round(Math.random() * 100);
		};

		var config = {
			type: 'pie',
			data: {
				datasets: [{
					data: [
						50,
						60,
						70,
						80,
						90,
					],
					backgroundColor: [
						window.chartColors.red,
						window.chartColors.orange,
						window.chartColors.yellow,
						window.chartColors.green,
						window.chartColors.blue,
					],
					label: 'Dataset 1'
				}],
				labels: [
					'Red',
					'Orange',
					'Yellow',
					'Green',
					'Blue'
				]
			},
			options: {
				responsive: true
			}
		};

		window.onload = function() {
			var ctx = document.getElementById('chart-area').getContext('2d');
			window.myPie = new Chart(ctx, config);
		};

		document.getElementById('randomizeData').addEventListener('click', function() {
			config.data.datasets.forEach(function(dataset) {
				dataset.data = dataset.data.map(function() {
					return randomScalingFactor();
				});
			});

			window.myPie.update();
		});

		var colorNames = Object.keys(window.chartColors);
		document.getElementById('addDataset').addEventListener('click', function() {
			var newDataset = {
				backgroundColor: [],
				data: [],
				label: 'New dataset ' + config.data.datasets.length,
			};

			for (var index = 0; index < config.data.labels.length; ++index) {
				newDataset.data.push(randomScalingFactor());

				var colorName = colorNames[index % colorNames.length];
				var newColor = window.chartColors[colorName];
				newDataset.backgroundColor.push(newColor);
			}

			config.data.datasets.push(newDataset);
			window.myPie.update();
		});

		document.getElementById('removeDataset').addEventListener('click', function() {
			config.data.datasets.splice(0, 1);
			window.myPie.update();
		});
	</script>
</body>

</html>
