<?php
require 'vendor/autoload.php';
require __DIR__ . '/src/PushBullet/PushBullet.php';


$apiKey = "";
$pb = new PushBullet($apiKey);

// Get devices
$response = $pb->devices();
// Select first device
$device = $response['devices'][0];
$iden = $device['iden'];


// Send File
$response = $pb->file(array(
    'device_iden' => $iden,
    'file' => 'header-logo.png'
));

// Send Note
$response = $pb->note(array(
    'device_iden' => $iden,
    'title' => 'hello world',
    'body' => 'my name is rick',
));

// Send Link
$response = $pb->link(array(
    'device_iden' => $iden,
    'title' => 'pushbullet api',
    'url' => 'https://www.pushbullet.com/api',
));

// Send Address
$response = $pb->address(array(
    'device_iden' => $iden,
    'name' => 'Googleplex',
    'address' => '1600 Amphitheatre Pkwy Mountain View, CA 94043',
));
