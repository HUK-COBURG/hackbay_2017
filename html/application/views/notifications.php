<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<i class="ti-bell dropdown-toggle" data-toggle="dropdown">
    <?php if (count($alerts)): ?>
    <span><?php echo count($alerts); ?></span>
    <?php endif; ?>
</i>
<div class="dropdown-menu bell-notify-box notify-box">
    <span class="notify-title">Benachrichtigungen</span>
    <div class="nofity-list">
        <?php foreach ($alerts as $alert): ?>
        <a href="#" data-href="/sensor/info/<?php echo $alert->getSensor()->getId(); ?>" class="ajax-get-content notify-item">
            <div class="notify-thumb"><i class="ti-bolt btn-<?php echo $alert->getType(); ?>"></i></div>
            <div class="notify-text">
                <p><?php echo $alert->getMessage(); ?></p>
                <span>jetzt</span>
            </div>
        </a>
        <?php endforeach; ?>
    </div>
</div>