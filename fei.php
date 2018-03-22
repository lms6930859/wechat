<?php


//图文素材


include 'token.php';
$token = cacheToken();
$type = 'image';
// $title = 'php是世界上最好的语言';
// $author = '飞';
// $mediaid = 'CAKK9UKmfHbOyxoT2iY29YTag3iZl2HBUwnz6zrv7Mw';
// $contentsourceurl = 'https://www.zhihu.com/question/26498147';
// $content = 'php天下第一';
$url = "https://api.weixin.qq.com/cgi-bin/material/add_news?access_token=$token";
$data='{
 "articles":[{
 "title": "TITLE",
 "thumb_media_id":"h-R8YLHrrBW5bWTjIN8pdgsuf0606hd7Qnu4Pb9nM3rd5UdDaCkf3_1xKj9Wz7na",
 "author": "AUTHOR", "digest" : "DIGEST",
 "show_cover_pic": "1",
 "content" : "CONTENT",
 "content_source_url": "www.baidu.com",
 "need_open_comment" : 1,
 "only_fans_can_comment" : 0}]
 
}';
$curl = new MyCurl($url);  
$ret = $curl->post($data);
$row = json_decode($ret);//对JSON格式的字符串进行编码  


echo $ret;