<html>
<head>
<title>Tina's Wifi-Weather Station</title>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/moment.min.js"></script>
<script type="text/javascript" src="js/Chart.min.js"></script>
<link rel="stylesheet" href="css/styles.css">
<link rel="stylesheet" href="css/weather-icons.min.css" />
</head>
<body>
<div id="chart-container">
  <canvas id="weather"></canvas>
  <button id="0" class="btn" type="button"><i class="wi wi-thermometer"></i> Temperatur</button>
  <button id="1" class="btn" type="button"><i class="wi wi-humidity"></i> Luftfeuchtigkeit</button>
  <button id="2" class="btn" type="button"><i class="wi wi-barometer"></i> Luftdruck</button>
</div>

<script>
$.post("data.php",
  function (data) {
    console.log(data);
    
    var in_time = [];
    var in_temp = [];
    var in_humi = [];
    var in_pres = [];
    
    var out_time = [];
    var out_temp = [];
    var out_humi = [];
    var out_pres = [];

    for (var i in data['indoor']) {
      in_time.push(data['indoor'][i].time);
      in_temp.push(data['indoor'][i].temp);
      in_humi.push(data['indoor'][i].humi);
      in_pres.push(data['indoor'][i].pres);
    }
    
    for (var i in data['outdoor']) {
      out_time.push(data['outdoor'][i].time);
      out_temp.push(data['outdoor'][i].temp);
      out_humi.push(data['outdoor'][i].humi);
      out_pres.push(data['outdoor'][i].pres);
    }

var ctx = document.getElementById("weather").getContext('2d');

var config = {
  data: {
    labels: in_time,
    datasets: [{
      label: 'Tina\'s Zimmer',
      type: 'line',
      borderColor: '#fea837',
      yAxisID: "y-axis-0",
      fill: false,
      data: in_temp
    },
    { 
      label: 'Bird Nest',
      type: 'line',
      borderColor: '#3ab7f6',
      yAxisID: "y-axis-0",
      fill: false,
      data: out_temp
    }]
  },
  options: {
    title: {
      display: true,
      text: 'Temperatur (letzte 24 Stunden)',
      fontColor: 'black',
      fontSize: 20
    },
    legend: {
      position: 'bottom'
    },
    scales: {
      yAxes: [{
	scaleLabel: {
	  display: true,
	  labelString: 'Celcius',
	  fontColor: 'black',
	  fontSize:14
	},
	ticks: {
	  fontColor: "black",
	  fontSize: 14,  
	}
      }],
      xAxes: [{
        type: "time",
	distribution: "series",
	time: {
	  unit: "minute",
	  displayFormats: {
	    minute: 'HH:mm' 
          }
	},
	ticks: {
	  fontColor: "grey",
	  fontSize: 13
	},
	gridLines : {
	  display : false
	}
      }]
    }
  }
};

var weather_chart = new Chart(ctx, config);

// add event listeners for the buttons
$("#0").click(function() {
    var data = weather_chart.config.data;
    var options = weather_chart.config.options;
    data.datasets[0].data = in_temp;
    data.datasets[1].data = out_temp;
    options.scales.yAxes[0].scaleLabel.labelString = "Celcius";
    data.labels = in_time;
    weather_chart.update();
});

$("#1").click(function() {
    var data = weather_chart.config.data;
    var options = weather_chart.config.options;
    data.datasets[0].data = in_humi;
    data.datasets[1].data = out_humi;
    options.title.text = "Luftfeuchtigkeit (letzte 24 Stunden)";
    options.scales.yAxes[0].scaleLabel.labelString = "Prozent";
    data.labels = in_time;
    weather_chart.update();
});

$("#2").click(function() {
    var data = weather_chart.config.data;
    var options = weather_chart.config.options;
    data.datasets[0].data = in_pres;
    data.datasets[1].data = out_pres;
    options.title.text = "Luftdruck (letzte 24 Stunden)";
    options.scales.yAxes[0].scaleLabel.labelString = "Hektopascal";
    data.labels = in_time;
    weather_chart.update();
});

});
</script>
</body>
</html>
