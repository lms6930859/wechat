
<?php

include 'token.php';

$token = cacheToken();
//上传永久图片素材 获得thumb_media_id
$url = "https://api.weixin.qq.com/cgi-bin/material/add_material?access_token=$token&type=$type";
if (class_exists('\CURLFile')) {  
    $data = array('media' => new \CURLFile(realpath("1.jpg")));  
} else {  
    $data = array('media' => '@' . realpath("1.jpg"));  
}  




$curl = new MyCurl($url);  
$ret = $curl->post($data);
$row = json_decode($ret);//对JSON格式的字符串进行编码  
echo $ret;
echo $row->media_id;