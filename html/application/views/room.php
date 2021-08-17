<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6" style="margin:10px 0;">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left"><?php echo $room->getName(); ?></h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="/">Home</a></li>
                    <li><a href="#" data-href="/room" class="ajax-get-content">Räume</a></li>
                    <li><span><?php echo $room->getName(); ?></span></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- page title area end -->
<div class="main-content-inner">
    <div class="row">
        
        <?php foreach ($sensors as $sensor): ?>
        <div class="col-lg-6 mt-5">
            <div class="card card-bordered">
                <div class="card-body">
                    <h5 class="title"><?php echo $sensor->getName(); ?></h5>
                    <div id="sensor-chart-<?php echo $sensor->getId(); ?>"></div>
                    <a href="#" data-href="/sensor/info/<?php echo $sensor->getId(); ?>" class="ajax-get-content btn btn-primary">Mehr</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
    refreshCharts();
    setInterval(refreshCharts, 30000);
    
    function refreshCharts() {
        <?php foreach ($sensors as $sensor): ?>
        loadChart(<?php echo $sensor->getId(); ?>, 600, 'sensor-chart-<?php echo $sensor->getId(); ?>');
        <?php endforeach; ?>  
    }
</script>