<?php
namespace app\index\controller;

use Aws\Sns\SnsClient;

class Index
{
    public function index()
    {
        $client = new SnsClient([
            'region'      => 'ap-southeast-1',//这是亚马逊在新加坡的服务器，具体要根据情况决定
            'credentials' => [
                'key'         => '需要登陆aws的控制台查看',
                'secret'      => '需要登陆aws的控制台查看',
            ],
            'version'     => '2010-03-31',    //一般在aws的官方api中会有关于这个插件的版本信息
            'debug'       => false,
        ]);
        $args = [
            'Message' => 'Hello, world!',           // REQUIRED
            'PhoneNumber' => '+86....',
        ];
        $client->Publish($args);
    }
}
