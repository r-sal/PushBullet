PushBullet
==========

PushBullet PHP API

https://www.pushbullet.com/api


### Usage

```php
// Create client
$pb = new PushBullet($apiKey);

// Get devices
$response = $pb->devices();
// Select first device
$device = $response['devices'][0];
$iden = $device['iden'];

// Send File
$response = $pb->file(array(
    'device_iden' => $iden,
    'file' => 'path/to/your/file.png'
));

// Send Note
$response = $pb->note(array(
    'device_iden' => $iden,
    'title' => 'Hello note',
    'body' => 'My name is rick',
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
```