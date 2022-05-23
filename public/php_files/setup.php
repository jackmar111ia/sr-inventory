<?php 
require __DIR__ . '/vendor/autoload.php';

use Automattic\WooCommerce\Client;

$woocommerce = new Client(
    'https://www.simplyretrofits.com', 
    'ck_ece4db69e557c46cce993459c40759edfd5d890a', 
    'cs_069b2e7f2bc37aa3a2ff0df5c3838e1704661817',
    [
        'version' => 'wc/v3',
    ]
);


?>