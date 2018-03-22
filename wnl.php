<?php
 
require_once 'curl.func.php';
 
$appkey = '48e4f23a118fbf7b';//你的appkey 
$date = date('Y-m-d');;
$url = "http://api.jisuapi.com/calendar/query?appkey=$appkey&date=$date";
$result = curlOpen($url);
$jsonarr = json_decode($result, true);
//exit(var_dump($jsonarr));
 
if($jsonarr['status'] != 0)
{
    echo $jsonarr['msg'];
    exit();
}
 
$result = $jsonarr['result'];
$huangli = $result['huangli'];
echo $result['year'].'年 '.$result['month'].'月 '.$result['day'].'日 <br> 星期'.$result['week'].'<br>'.$huangli['nongli'].'<br >'.'宜'.join(',',$huangli['yi']) ;




