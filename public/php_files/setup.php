<?php 
require __DIR__ . '/vendor/autoload.php';

use Automattic\WooCommerce\Client;

$woocommerce = new Client(
    'http://clone.simplyretrofits.com/', 
    'ck_26295ce796419377c91831f2052016d15b0ecce2', 
    'cs_3101fb0b889cff1a2d20ce7ae49ab3b39b7424db',
    [
        'version' => 'wc/v3',
    ]
);


?>