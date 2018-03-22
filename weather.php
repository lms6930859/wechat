<?php
 
require_once 'curl.func.php';
 
$appkey = '3146d21ea82a8baa';//你的appkey
$city = '安顺';//utf8
$cityid='111';//任选
$citycode='101260301';//任选
$url = "http://api.jisuapi.com/weather/query?appkey=$appkey&city=$city";
$result = curlOpen($url);
$jsonarr = json_decode($result, true);
//exit(var_dump($jsonarr));
if($jsonarr['status'] != 0)
{
    echo $jsonarr['msg'];
    exit();
}
 
$result = $jsonarr['result'];
echo $result['city'].' '.$result['date'].' '.$result['week'];







foreach($result['daily'] as $daily)
{
    $data[]= $daily['date'].' '.$daily['week']."\n". $daily['night']['weather'].' '.$daily['night']['winddirect'].' '.$daily['night']['windpower'];
   
}
echo join('  ' , $data);