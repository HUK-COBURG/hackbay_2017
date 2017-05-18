<div class="sidebar" data-color="purple" data-image="assets/img/sidebar-5.jpg">

    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="<?= base_url(); ?>" class="simple-text">
                    Smart Home Auswertungen
                </a>
            </div>

            <ul class="nav">
                <li class="<?= (!isset($sensor) ? 'active' : ''); ?>">
                    <a href="<?= base_url(); ?>">
                        <p>Überblick</p>
                    </a>
                </li>				
			<?php foreach ($sensors as $item): ?>
				<li class="<?= ((isset($sensor) && $sensor->get_SensorID() == $item->get_SensorID()) ? 'active' : ''); ?>"><a href="<?= base_url(); ?>sensor/show/<?= $item->get_SensorBezeichnung(); ?>"><p><?= $item->get_SensorBezeichnung(); ?></p></a></li>
			<?php endforeach; ?>
                <li>
                    <a href="<?= base_url(); ?>schaden">
                        <p>Schaden melden</p>
                    </a>
                </li>
                <li>
                    <a href="typography.html">
                        <p>Tarif anzeigen</p>
                    </a>
                </li>
            </ul>
    	</div>
    </div>