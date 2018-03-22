<?php

include 'token.php';

$token = cacheToken();
$url = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token='. $token;


$data['button'][0] = [
	'type'=>'click',
	'name' => '点我啊',
	'key' =>'btn'
];
$data['button'][1] = [
	'type'=>'view',
	'name' => '百度',
	'url' =>'http://www.baidu.com'
];
$data['button'][2] = [
	'type'=>'scancode_push',
	'name' => '扫一扫',
	'key' =>'sao'
];

$curl = new MyCurl($url);
$str = json_encode($data, JSON_UNESCAPED_UNICODE);
//echo $str;
$ret = $curl->post($str);
echo $ret;