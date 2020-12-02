<!--PHP Code For ISL201 Section Temperature -->

<?php
$connect = mysqli_connect("192.168.1.160", "iotdata", "csir.ceeri", "SHMDB");
$query = '
SELECT Temperature,
UNIX_TIMESTAMP(CONCAT_WS(" ", TimeStamp)) AS datetime
FROM ISL201 WHERE TimeStamp > "2020-02-17 10:00:00"
';
$result = mysqli_query($connect, $query);
$rows = array();
$table = array();

$table['cols'] = array(
 array(
  'label' => 'TimeStamp',
  'type' => 'datetime'
 ),
 array(
  'label' => 'Temperature (°C)',
  'type' => 'number'
 )
);

while($row = mysqli_fetch_array($result))
{
 $sub_array = array();
 $datetime = explode(".", $row["datetime"]);
 $sub_array[] =  array(
      "v" => 'Date(' . $datetime[0] . '000)'
     );
 $sub_array[] =  array(
      "v" => $row["Temperature"]
     );
 $rows[] =  array(
     "c" => $sub_array
    );
}
$table['rows'] = $rows;
$jsonTable = json_encode($table);

?>

<!--PHP Code For ISL201 Section Humidity -->

<?php
$connect = mysqli_connect("192.168.1.160", "iotdata", "csir.ceeri", "SHMDB");
$query = '
SELECT Humidity,
UNIX_TIMESTAMP(CONCAT_WS(" ", TimeStamp)) AS datetime
FROM ISL201 WHERE TimeStamp > "2020-02-17 10:00:00"
';
$result = mysqli_query($connect, $query);
$rows = array();
$table = array();

$table['cols'] = array(
 array(
  'label' => 'TimeStamp',
  'type' => 'datetime'
 ),
 array(
  'label' => 'Humidity (%)',
  'type' => 'number'
 )
);

while($row = mysqli_fetch_array($result))
{
 $sub_array = array();
 $datetime = explode(".", $row["datetime"]);
 $sub_array[] =  array(
      "v" => 'Date(' . $datetime[0] . '000)'
     );
 $sub_array[] =  array(
      "v" => $row["Humidity"]
     );
 $rows[] =  array(
     "c" => $sub_array
    );
}
$table['rows'] = $rows;
$jsonTable_Humidity = json_encode($table);

?>

<!--PHP Code For ISL201 Section Vibration -->

<?php
$connect = mysqli_connect("192.168.1.160", "iotdata", "csir.ceeri", "SHMDB");
$query = '
SELECT Vibration,
UNIX_TIMESTAMP(CONCAT_WS(" ", TimeStamp)) AS datetime
FROM ISL201 WHERE TimeStamp > "2020-02-17 10:00:00"
';
$result = mysqli_query($connect, $query);
$rows = array();
$table = array();

$table['cols'] = array(
 array(
  'label' => 'TimeStamp',
  'type' => 'datetime'
 ),
 array(
  'label' => 'Vibration (%)',
  'type' => 'number'
 )
);

while($row = mysqli_fetch_array($result))
{
 $sub_array = array();
 $datetime = explode(".", $row["datetime"]);
 $sub_array[] =  array(
      "v" => 'Date(' . $datetime[0] . '000)'
     );
 $sub_array[] =  array(
      "v" => $row["Vibration"]
     );
 $rows[] =  array(
     "c" => $sub_array
    );
}
$table['rows'] = $rows;
$jsonTable_Vibration = json_encode($table);

?>

<!--PHP Code For ISL201 Section Force -->

<?php
$connect = mysqli_connect("192.168.1.160", "iotdata", "csir.ceeri", "SHMDB");
$query = '
SELECT BeamForce,
UNIX_TIMESTAMP(CONCAT_WS(" ", TimeStamp)) AS datetime
FROM ISL201 WHERE TimeStamp > "2020-02-17 10:00:00"
';
$result = mysqli_query($connect, $query);
$rows = array();
$table = array();

$table['cols'] = array(
 array(
  'label' => 'TimeStamp',
  'type' => 'datetime'
 ),
 array(
  'label' => 'BeamForce (lb)',
  'type' => 'number'
 )
);

while($row = mysqli_fetch_array($result))
{
 $sub_array = array();
 $datetime = explode(".", $row["datetime"]);
 $sub_array[] =  array(
      "v" => 'Date(' . $datetime[0] . '000)'
     );
 $sub_array[] =  array(
      "v" => $row["BeamForce"]
     );
 $rows[] =  array(
     "c" => $sub_array
    );
}
$table['rows'] = $rows;
$jsonTable_BeamForce = json_encode($table);

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Dashboard</title>

      <!-- Google Charts Library-->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <!-- FOR TEMPERATURE -->
  <script type="text/javascript">
   google.charts.load('current', {'packages':['corechart']});
   google.charts.setOnLoadCallback(drawChart);
   function drawChart()
   {
    var data = new google.visualization.DataTable(<?php echo $jsonTable; ?>);

    var options = {
     title:'Temperature vs Date Graph',
     titleTextStyle:{   //For Changing the color of title text
       color: '#871b47',
     },
     legend: 'none'  /*{position:'right'}*/,
     chartArea:{width:'90%', height:'65%'},
     hAxis: {
          title: 'Date'
        },
    vAxis: {
          title: 'Temperature (°C)'
        }
    };

    var chart = new google.visualization.LineChart(document.getElementById('line_chart'));

    chart.draw(data, options);
   }
  </script>

  <!-- FOR HUMIDITY -->
  <script type="text/javascript">
   google.charts.load('current', {'packages':['corechart']});
   google.charts.setOnLoadCallback(drawChart);
   function drawChart()
   {
    var data = new google.visualization.DataTable(<?php echo $jsonTable_Humidity; ?>);

    var options = {
     title:'Humidity vs Date Graph',
     titleTextStyle:{   //For Changing the color of title text
       color: '#871b47',
     },
     legend: 'none'  /*{position:'right'}*/,
     chartArea:{width:'90%', height:'65%'},
     hAxis: {
          title: 'Date'
        },
    vAxis: {
          title: 'Humidity (%)'
        }
    };

    var chart = new google.visualization.LineChart(document.getElementById('line_chart_1'));

    chart.draw(data, options);
   }
  </script>

  <!-- FOR VIBRATION -->
  <script type="text/javascript">
   google.charts.load('current', {'packages':['corechart']});
   google.charts.setOnLoadCallback(drawChart);
   function drawChart()
   {
    var data = new google.visualization.DataTable(<?php echo $jsonTable_Vibration; ?>);

    var options = {
     title:'Vibration vs Date Graph',
     titleTextStyle:{   //For Changing the color of title text
       color: '#871b47',
     },
     legend: 'none'  /*{position:'right'}*/,
     chartArea:{width:'90%', height:'65%'},
     hAxis: {
          title: 'Date'
        },
    vAxis: {
          title: 'Vibration (volt)'
        }
    };

    var chart = new google.visualization.LineChart(document.getElementById('line_chart_2'));

    chart.draw(data, options);
   }
  </script>

  <!-- FOR BEAMFORCE -->
  <script type="text/javascript">
   google.charts.load('current', {'packages':['corechart']});
   google.charts.setOnLoadCallback(drawChart);
   function drawChart()
   {
    var data = new google.visualization.DataTable(<?php echo $jsonTable_BeamForce; ?>);

    var options = {
     title:'BeamForce vs Date Graph',
     titleTextStyle:{   //For Changing the color of title text
       color: '#871b47',
       fontSize: '1.2rem',
     },
     legend: 'none'  /*{position:'right'}*/,
     chartArea:{width:'88%', height:'65%'},
     hAxis: {
          title: 'Date'
        },
    vAxis: {
          title: 'BeamForce (lbs)'
        }
    };

    var chart = new google.visualization.LineChart(document.getElementById('line_chart_3'));

    chart.draw(data, options);
   }
  </script>

  <!-- Styles -->
  <link href="assets/css/lib/font-awesome.min.css" rel="stylesheet">
  <link href="assets/css/lib/themify-icons.css" rel="stylesheet">
  <link href="assets/css/lib/menubar/sidebar.css" rel="stylesheet">
  <link href="assets/css/lib/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/lib/helper.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
</head>

    <body>

        <div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
            <div class="nano">
                <div class="nano-content">
                    <div class="logo"><a><img src="assets/images/ceeri_logo.png" alt=""/><span></span></a></div>
                    <ul>
                        <li class="active" ><a><i class="ti-home"></i> Online Dashboard</a></li>

                        <li class="label">Room Sections</li>
                        <li><a href="isl201.php"><i class="ti-bar-chart-alt"></i>  ISL201  </a>
                        <li><a href="isl202.php"><i class="ti-bar-chart-alt"></i>  ISL202  </a>
                        <li><a href="isl203.php"><i class="ti-bar-chart-alt"></i>  ISL203  </a>
                        <li><a href="isl204.php"><i class="ti-bar-chart-alt"></i>  ISL204  </a>
                        <!--<li><a><i class="ti-bar-chart-alt"></i>  About </a> -->
                            <!--<ul>
                                <li><a href="chart-flot.html">Untitled</a></li>
                                <li><a href="chart-morris.html">Untitled</a></li>
                                <li><a href="chartjs.html">Untitled</a></li>
                                <li><a href="chartist.html">Untitled</a></li>
                                <li><a href="chart-peity.html">Untitled</a></li>
                            </ul> -->
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /# sidebar -->

        <div class="content-wrap">
            <div class="main">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-8 p-r-0 title-margin-right">
                            <div class="page-header">
                                <div class="page-title">
                                    <h1>Real Time Dashboard</h1>
                                </div>
                            </div>
                        </div>

                        <!-- JavaScript For Time Clock -->
                        <div class="col-lg-4 p-l-0 title-margin-left">
                            <div class="page-header">
                                <div id="clockbox" style="font-size:1.08rem; font-weight:430; color: black;"></div>
                                <script type="text/javascript">
                               function GetClock(){
                             var d=new Date();
                            var nhour=d.getHours(),nmin=d.getMinutes(),nsec=d.getSeconds(),ap;

                            if(nhour==0){ap=" AM";nhour=12;}
                            else if(nhour<12){ap=" AM";}
                            else if(nhour==12){ap=" PM";}
                            else if(nhour>12){ap=" PM";nhour-=12;}

                            if(nmin<=9) nmin="0"+nmin;
                            if(nsec<=9) nsec="0"+nsec;

                            var clocktext=""+nhour+":"+nmin+":"+nsec+ap+"";
                            document.getElementById('clockbox').innerHTML=clocktext;
                             }

                             GetClock();
                             setInterval(GetClock,1000);
                         </script>
                            </div>
                        </div>
                        <!-- /# column -->
                    </div>
                    <!-- /# row -->

                    <section id="main-content">

                        <div class="row">
                            <!-- column -->
                            <div class="col-lg-12">
                              <h5 class="style-h5">Online Structural Health Monitoring For ISL201 Room at CSIR-CEERI, Pilani</h5>
                                <!--<div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Online SHM at CSIR-CEERI</h4>
                                    </div>
                                </div>-->
                            </div>

                            <!-- <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">ISL 201</h4>
                                    </div>
                                </div>
                            </div> -->
                            <!-- column -->

                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Temperature Graph</h4>
                                        <div id="line_chart" style="width: 100%; height: 350px"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Humidity Graph</h4>
                                        <div id="line_chart_1" style="width: 100%; height: 350px"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Vibration Graph</h4>
                                        <div id="line_chart_2" style="width: 100%; height: 350px"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">BeamForce Graph</h4>
                                        <div id="line_chart_3" style="width: 100%; height: 350px"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                     <!-- Footer Section -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="footer">
                                    <p class="footer-p">2020 © CSIR-CEERI, Pilani</p>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>

        <!-- jquery vendor -->
        <script src="assets/js/lib/jquery.min.js"></script>
        <script src="assets/js/lib/jquery.nanoscroller.min.js"></script>
        <!-- nano scroller -->
        <script src="assets/js/lib/menubar/sidebar.js"></script>
        <script src="assets/js/lib/preloader/pace.min.js"></script>
        <!-- sidebar -->
        <script src="assets/js/lib/bootstrap.min.js"></script>
        <!-- bootstrap -->
        <script src="assets/js/lib/circle-progress/circle-progress.min.js"></script>
        <script src="assets/js/lib/circle-progress/circle-progress-init.js"></script>
        <script src="assets/js/scripts.js"></script>
        <!-- scripit init-->

    </body>
</html>
