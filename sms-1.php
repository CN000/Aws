<?php


putenv('HOME=/var/www/html/aws');


include  __DIR__.'/Aws/functions.php';
include  __DIR__.'/GuzzleHttp/Promise/functions.php';
include  __DIR__.'/GuzzleHttp/Psr7/functions.php';
include  __DIR__.'/GuzzleHttp/functions.php';



function myAutoLoad($className){
    include __DIR__.'/'.str_replace('\\','/', $className).'.php';
}

spl_autoload_register('myAutoLoad', true, true);



use Aws\Sns\SnsClient;
use Aws\Exception\AwsException;


$SnSclient = new SnsClient([
    'profile' =>  __DIR__.'/credentials.csv',
    'filename' => __DIR__.'/credentials.csv',
    'region'  => 'ap-southeast-1',
    'version' => '2010-03-31'
]);

$message = 'This message is sent from a Amazon SNS code sample.';
$phone = '+1XXX5550100';

try {
    $result = $SnSclient->publish([
        'Message'     => $message,
        'PhoneNumber' => $phone,
    ]);
    var_dump($result);
} catch (AwsException $e) {
    // output error message if fails
    error_log($e->getMessage());
}