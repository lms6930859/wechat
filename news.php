<?php
 
require_once 'curl.func.php';
 
$appkey = '2a7393232e995255';//你的appkey
$channel='头条';//utf8 新闻频道(头条,财经,体育,娱乐,军事,教育,科技,NBA,股票,星座,女性,健康,育儿)
$url = "http://api.jisuapi.com/news/get?channel=$channel&appkey=$appkey";
$result = curlOpen($url);
$jsonarr = json_decode($result, true);
if($jsonarr['status'] != 0)
{
    echo $jsonarr['msg'];
    exit();
}
$result = $jsonarr['result'];


  $title1=$result['list'][0]['title'];
  $time=$result['list'][0]['time'];
  $pic=$result['list'][0]['pic'];
  $content=$result['list'][0]['content'];
  $url=$result['list'][0]['url'];
