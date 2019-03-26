<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6" style="margin:10px 0;">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left"><?php echo $sensor->getName(); ?></h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="/">Home</a></li>
                    <li><a href="#" data-href="/room" class="ajax-get-content">Räume</a></li>
                    <li><a href="#" data-href="/room/info/<?php echo $room->getId(); ?>" class="ajax-get-content"><?php echo $room->getName(); ?></a></li>
                    <li><span><?php echo $sensor->getName(); ?></span></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- page title area end -->
<div class="main-content-inner">
    <div class="row">
        <div class="col-lg-12 mt-5">
            <div class="card card-bordered">
                <div class="card-body">
                    <h5 class="title">Letzte Stunde</h5>
                    <div id="sensor-chart-hour-<?php echo $sensor->getId(); ?>"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 mt-5">
            <div class="card card-bordered">
                <div class="card-body">
                    <h5 class="title">Letzter Tag</h5>
                    <div id="sensor-chart-day-<?php echo $sensor->getId(); ?>"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    refreshCharts();
    setInterval(refreshCharts, 30000);
    
    function refreshCharts() {
        loadChart(<?php echo $sensor->getId(); ?>, 3600, 'sensor-chart-hour-<?php echo $sensor->getId(); ?>');
        loadChart(<?php echo $sensor->getId(); ?>, 86400, 'sensor-chart-day-<?php echo $sensor->getId(); ?>');
    }
</script>