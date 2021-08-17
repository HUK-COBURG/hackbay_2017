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
	
	    <!--   Core JS Files   -->
    <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="assets/js/bootstrap-checkbox-radio-switch.js"></script>

	<!--  Charts Plugin -->
	<script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="assets/js/light-bootstrap-dashboard.js"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="assets/js/demo.js"></script>

    <!-- Toggle button -->
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    <script src="<?= base_url(); ?>assets/js/canvasjs.min.js"></script>

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
                                <h4 class="title">Benachrichtigungen</h4>
                                <p class="category">Aktuell</p>
                            </div>
                            <div class="content">
                                <ul style="list-style:none; padding:0; text-decoration:none;" id="warningsOverview"></ul>
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
                                <div>Schalten Sie den Fernseher aus, wenn Sie den Raum verlassen, um Strom zu sparen!</div>
                            </div>
							
                        </div>
                    </div>
                </div>

				<div class="row">
                    <?php foreach ($sensors as $sensor): ?>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title"><a href="<?= site_url('sensor/show/'.$sensor->get_SensorBezeichnung()); ?>"><?= $sensor->get_SensorBezeichnung() ?></a></h4>
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
                                <h4 class="title">Fernseher</h4>
                            </div>
                            <div class="content">
                                <input type="checkbox" id="checkbox-steckdose" checked data-toggle="toggle">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


</body>

    <?php foreach ($sensors as $sensor): ?>
        <script>
            <?php
                $sensorData = $data[$sensor->get_SensorID()];
            ?>
            $(function() {
                var chart1 = new CanvasJS.Chart("sensor-<?= $sensor->get_SensorID() ?>", {
                    
                    axisX:{
                        gridThickness: 1,
                        valueFormatString: "HH:mm"
                    },
                    data: [{
                        type: "line",
                        dataPoints: [
                            <?php foreach ($sensorData as $item): ?>
                            { x: new Date("<?= date('c', $item->get_SensorZeit());?>"), y: <?= $item->get_SensorWert();?>, label: "<?= date('H:i:s', $item->get_SensorZeit()+7200);?>" },
                            <?php endforeach; ?>
                        ]
                    }]
                });
                chart1.render();
            });
			
			
			$(document).ready(function(){
                            refresh();
							refreshWarnings();
                            window.setInterval(refresh, 5000);
							window.setInterval(refreshWarnings, 5000);
                        } );
			function refreshWarnings(){
				refreshVar("#warningsOverview");
			}
        </script>
    <?php endforeach; ?>

    <script>
        $('#checkbox-steckdose').on('change', function () {
            var arg = $('#checkbox-steckdose').prop('checked') ? 'on' : 'off';
            $.post('https://api.particle.io/v1/devices/3e004d000f51353532343635/relais?access_token=160e0dfae04bcd876bc3c21cad6470f42bfa2964', { arg: arg });
        });
    </script>

</html>
