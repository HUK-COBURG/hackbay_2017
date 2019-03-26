<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<h1><?= $sensor->get_SensorBezeichnung(); ?> (<?= $sensor->get_SensorID(); ?>)</h1>

<ul>
<?php foreach ($data as $item): ?>
    <li><?= date('c', $item->get_SensorZeit()); ?> : <?= $item->get_SensorWert(); ?></li>
<?php endforeach; ?>
</ul>
