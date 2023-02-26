<?php
require_once 'vendor/autoload.php';

use Source\Search;

print_r(Search::getNearbyHotels(38.69092012072637, -9.357038524846422, 'proximity'));
?>