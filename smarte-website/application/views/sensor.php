<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="<?= base_url(); ?><?= base_url(); ?>assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	
	<script src="<?= base_url(); ?>assets/js/canvasjs.min.js"></script>
	<script type="text/javascript">
						window.onload = function() {
							var chart1 = new CanvasJS.Chart("insgesamt", {
								title: {
									text: "Letzter Tag"
								},
                                                                axisX:{
                                                                    title: "Uhrzeit",
                                                                    gridThickness: 1,
                                                                    valueFormatString: "HH:mm"
                                                                },
                                                                axisY: {
                                                                    title: "<?= $sensor->get_SensorBezeichnung(); ?>"
                                                                },
								data: [{
									type: "line",
									dataPoints: [
									
									<?php foreach ($data['day'] as $item): ?>
									  { x: new Date("<?= date('c', $item->get_SensorZeit());?>"), y: <?= $item->get_SensorWert();?>, label: "<?= date('H:i:s', $item->get_SensorZeit()+7200);?>" },
									<?php endforeach; ?>
									]
								}]
							});
							chart1.render();
							var chart2 = new CanvasJS.Chart("letzte5", {
								title: {
									text: "Letzte Stunde"
								},
								axisX:{
                                                                    title: "Uhrzeit",
                                                                    gridThickness: 1,
                                                                    valueFormatString: "HH:mm"
                                                                },
                                                                axisY: {
                                                                    title: "<?= $sensor->get_SensorBezeichnung(); ?>"
                                                                },
								data: [{
									type: "line",
									dataPoints: [
									
									<?php foreach ($data['hour'] as $item): ?>
									  { x: new Date("<?= date('c', $item->get_SensorZeit());?>"), y: <?= $item->get_SensorWert();?>, label: "<?= date('H:i:s', $item->get_SensorZeit()+7200);?>" },
									<?php endforeach; ?>
									]
								}]
							});
							chart2.render();
						}
					</script>
					
	<title>Light Bootstrap Dashboard by Creative Tim</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="<?= base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="<?= base_url(); ?>assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="<?= base_url(); ?>assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="<?= base_url(); ?>assets/css/demo.css" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="<?= base_url(); ?>assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
	
	    <!--   Core JS Files   -->
    <script src="<?= base_url(); ?>assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="<?= base_url(); ?>assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="<?= base_url(); ?>assets/js/bootstrap-checkbox-radio-switch.js"></script>

	<!--  Charts Plugin -->
	<script src="<?= base_url(); ?>assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="<?= base_url(); ?>assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="<?= base_url(); ?>assets/js/light-bootstrap-dashboard.js"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="<?= base_url(); ?>assets/js/demo.js"></script>
</head>
<body>

<div class="wrapper">
    <?php include 'sidebar.php';?>

    <div class="main-panel">
		<?php include 'navbar.php';?>
		<script>
		$(document).ready(function(){ 
                    refresh();
                    window.setInterval(refresh, 5000);
                } );
		</script>
        <div class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="content">
					<div id="letzte5" style="height: 400px; width: 100%;"></div>
                    </div>
                </div>
                <div class="card">
                    <div class="content">
                        <div id="insgesamt" style="height: 400px; width: 100%;"></div>
                    </div>
                </div>
            </div>
        </div>


        

    </div>
</div>


</body>

</html>
