<?php

include 'token.php';


$token = cacheToken();


$url = 'https://api.weixin.qq.com/cgi-bin/material/add_news?access_token=' . $token;
$str = '{
		 "articles":[{
		 "title": "你想说什么呢",
		 "thumb_media_id": "E7Nse5wraer6OWCNEYQQ5jT-EBUxYEajJXhbGVK6Afk",
		 "author": "小明",
		 "digest" : "just say say",
		 "show_cover_pic": 1,
		 "content" : "没有什么内容就是纯粹测试一下图文发布的",
		 "content_source_url": "http://www.baidu.com",
		 "need_open_comment" : 1,
		 "only_fans_can_comment" : 0 }]
		}';


$curl = new MyCurl($url);


$ret = $curl->post($str);
echo $ret;
