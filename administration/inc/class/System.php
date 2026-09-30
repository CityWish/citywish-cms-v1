<?php
require_once '/var/www/citywish/administration/inc/class/Statistics.php';

class System {
    public function getStatistics(): Statistics
    {
        return new Statistics();
    }
}