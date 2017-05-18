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
        <?php include 'navbar.php';?>

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
                    <?php foreach ($sensors as $sensor): ?>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Sensor <?= $sensor->get_SensorBezeichnung() ?></h4>
                                </div>
                                <div class="content">
                                    <div id="sensor-<?= $sensor->get_SensorID() ?>" style="height: 400px; width: 100%;"></div>
                                </div> 
                            </div>
                        </div>
					<?php endforeach; ?>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Steckdose</h4>
                            </div>
                            <div class="content">
                                <form action="https://api.particle.io/v1/devices/3e004d000f51353532343635/relais?access_token=160e0dfae04bcd876bc3c21cad6470f42bfa2964" method="POST">
                                    Schalte das <br>
                                    <br>
                                    <input type="radio" name="arg" value="on">Relais ein.
                                    <br>
                                    <input type="radio" name="arg" value="off">Relais aus.
                                    <br>
                                    <br>
                                    <input type="submit" value="Ausf&uuml;hren">
                                </form>
                            </div> 
                        </div>
                    </div>
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

    <script src="<?= base_url(); ?>assets/js/canvasjs.min.js"></script>

    <?php foreach ($sensors as $sensor): ?>
        <script>
            <?php
                $sensorData = $data[$sensor->get_SensorID()];
            ?>
            $(function() {
                var chart1 = new CanvasJS.Chart("sensor-<?= $sensor->get_SensorID() ?>", {
                    title: {
                        text: "<?= $sensor->get_SensorBezeichnung(); ?> Ganzer Tag"
                    },
                    axisX: {
                        interval: 10
                    },
                    data: [{
                        type: "line",
                        dataPoints: [
                            <?php foreach ($sensorData as $item): ?>
                            { x: new Date("<?= date('c', $item->get_SensorZeit());?>"), y: <?= $item->get_SensorWert();?> },
                            <?php endforeach; ?>
                        ]
                    }]
                });
                chart1.render();
            });
        </script>
    <?php endforeach; ?>

</html>
