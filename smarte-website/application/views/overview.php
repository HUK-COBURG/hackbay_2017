<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
 
 <!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<link rel="stylesheet" href="assets/css-percentage-circle-master/css/circle.css">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Smart Home Statistiken</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

</head>
<body>

<div class="wrapper">
    <?php include 'sidebar.php';?>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Smart Home Auswertungen</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-globe"></i>
                                    <b class="caret hidden-sm hidden-xs"></b>
                                    <span class="notification hidden-sm hidden-xs">2</span>
									<p class="hidden-lg hidden-md">
										2 Benachrichtigungen
										<b class="caret"></b>
									</p>
                              </a>
                              <ul class="dropdown-menu">
                                <li><a href="#">Möglicher Wasserschaden</a></li>
								<li><a href="#">Empfehlung: Fenster öffnen, hohe Luftfeuchtigkeit</a></li>
                              </ul>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li>
                           <a href="">
                               <p>Konto</p>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <p>Abmelden</p>
                            </a>
                        </li>
						<li class="separator hidden-lg hidden-md"></li>
                    </ul>
                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Warnungen</h4>
                                <p class="category">Des letzten Tages</p>
                            </div>
                            <div class="content">
                                <div>ES IST WAS SCHLIMMES PASSIERT</div>
                            </div>
							
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Empfehlungen</h4>
                                <p class="category">Des letzten Tages</p>
                            </div>
                            <div class="content">
                                <div>Fenster im Wohnzimmer schließen. Es wurde hohe Luftfeuchtigkeit im Wohnzimmer festgestellt.</div>
                            </div>
							
                        </div>
                    </div>
                </div>

				<div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Statistiken</h4>
                            </div>
                            <div class="content">
                                <ul>
								<?php foreach ($sensors as $sensor): ?>
									<li><a href="<?= base_url(); ?>sensor/show/<?= $sensor->get_SensorBezeichnung(); ?>"><?= $sensor->get_SensorBezeichnung(); ?></a></li>
								<?php endforeach; ?>
								</ul>
                            </div>
							
                        </div>
						
                    </div>
                </div>

				<div class="row">
                    <?php foreach ($sensors as $sensor): ?>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Sensor <?= $sensor->get_SensorBezeichnung() ?></h4>
                                </div>
                                <div class="content">
                                    <script>
                                        window.onload = function() {
                                            var chart1 = new CanvasJS.Chart("insgesamt", {
                                                title: {
                                                    text: "<?= $sensor->get_SensorBezeichnung(); ?> Ganzer Tag"
                                                },
                                                axisX: {
                                                    interval: 10
                                                },
                                                data: [{
                                                    type: "line",
                                                    dataPoints: [
                                                    
                                                    <?php foreach ($data as $item): ?>
                                                    { x: new Date("<?= date('c', $item->get_SensorZeit());?>"), y: <?= $item->get_SensorWert();?> },
                                                    <?php endforeach; ?>
                                                    ]
                                                }]
                                            });
                                            chart1.render();
                                            var chart2 = new CanvasJS.Chart("letzte5", {
                                                title: {
                                                    text: "<?= $sensor->get_SensorBezeichnung(); ?> Letzte Stunde"
                                                },
                                                axisX: {
                                                    interval: 10
                                                },
                                                data: [{
                                                    type: "line",
                                                    dataPoints: [
                                                    
                                                    <?php foreach ($data as $item): ?>
                                                    { x: new Date("<?= date('c', $item->get_SensorZeit());?>"), y: <?= $item->get_SensorWert();?> },
                                                    <?php endforeach; ?>
                                                    ]
                                                }]
                                            });
                                            chart2.render();
                                        }
                                    <script>
                                </div>
                                
                            </div>
                        </div>
					<?php endforeach; ?>
                </div>
            </div>
        </div>


    </div>
</div>


</body>

    <!--   Core JS Files   -->
    <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="assets/js/bootstrap-checkbox-radio-switch.js"></script>

	<!--  Charts Plugin -->
	<script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="assets/js/light-bootstrap-dashboard.js"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="assets/js/demo.js"></script>

</html>
