<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6" style="margin:10px 0;">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Räume</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="/">Home</a></li>
                    <li><span>Räume</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- page title area end -->
<div class="main-content-inner">
    <div class="row">
        <?php foreach ($rooms as $room): ?>
        <div class="col-lg-6 mt-5">
            <div class="card card-bordered">
                <?php echo assets_img('rooms/'.$room->getPicture(), array('class' => 'card-img-top img-fluid', 'alt' => 'image')); ?>
                <div class="card-body">
                    <h5 class="title"><?php echo $room->getName(); ?></h5>
                    <div class="card-text mb-4">
                        <ul class="list-group">
                            <?php foreach ($room->getSensors() as $sensor): ?>
                            <li class="list-group-item">
                                <a href="#" data-href="/sensor/info/<?php echo $sensor->getId(); ?>" class="ajax-get-content d-flex justify-content-between align-items-center">
                                    <?php echo $sensor->getName(); ?>
                                    <?php if (count($sensor->getMeasurements()) > 0): ?>
                                        <span class=""><?php echo $sensor->getMeasurements()[0]->getValue() . ' ' . $sensor->getUnit(); ?></span>
                                    <?php endif; ?>
                                </a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <a href="#" data-href="/room/info/<?php echo $room->getId(); ?>" class="ajax-get-content btn btn-primary">Mehr</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>