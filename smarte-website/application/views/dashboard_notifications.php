<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php foreach ($alerts as $alert): ?>
    <a href="#" data-href="/sensor/info/<?php echo $alert->getSensor()->getId(); ?>" class="ajax-get-content list-group-item list-group-item-<?php echo $alert->getType(); ?>"><?php echo $alert->getMessage(); ?></a>
<?php endforeach; ?>