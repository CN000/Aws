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


//
//$snsClient = new \Aws\Sns\SnsClient([
//    'region'       => 'ap-southeast-1',                          //这是亚马逊在新加坡的服务器，具体要根据情况决定
//    'credentials'  => [
//        'key'      => 'AKIAU4WLISQUX6WX5WKQ',                     // AKIAU4WLISQUX6WX5WKQ
//        'secret'   => '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', // HLSSq6UD+D3KBif3p6LHKvqMv3KBsMrmaRVTpVDU
//    ],
//    'version'     => '2010-03-31',    //一般在aws的官方api中会有关于这个插件的版本信息
//    'debug'       => false,
//]);
//
//$args = [
//    'Message' => 'Hello, HTCC!',           // REQUIRED
//    'PhoneNumber' => '+8618588432006',
//];
//$snsClient->publish($args);