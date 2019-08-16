<?php

include  __DIR__.'/Aws/functions.php';
include  __DIR__.'/GuzzleHttp/Promise/functions.php';
include  __DIR__.'/GuzzleHttp/Psr7/functions.php';
include  __DIR__.'/GuzzleHttp/functions.php';



function myAutoLoad($className){
    include __DIR__.'/'.str_replace('\\','/', $className).'.php';
}

spl_autoload_register('myAutoLoad', true, true);



use Aws\Sns\SnsClient;


$aws_cred = array(
    'credentials' => array(
        'key' => '',
        'secret' => '',
    ),
    'region' => 'ap-southeast-1', // < your aws from SNS Topic region
    'version' => 'latest'
);
$sns = new SnsClient($aws_cred);

//$args = array(
//    "SenderID" => "MySendID",
//    "SMSType" => "Promotional",
//    "Message" => "Amazon y u do dis??",
//    "PhoneNumber" => "+00000"
//);

$args = array(
    'MessageAttributes' => [
        'AWS.SNS.SMS.SenderID' => [
            'DataType' => 'String',
            'StringValue' => 'tyson'
        ]
    ],
    "SMSType" => "Transactional",
    "PhoneNumber" => "+00000",
    "Message" => "Hello World!"
);

$result = $sns->publish($args);

var_dump($result);


