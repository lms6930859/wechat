<?php
//永久图片
include 'token.php';
$token = cacheToken();
$type = 'image';


//$url = "https://api.weixin.qq.com/cgi-bin/material/add_material?access_token=$token&type=$type";
$url = "http://file.api.weixin.qq.com/cgi-bin/media/upload?access_token=$token&type=$type";
if (class_exists('\CURLFile')) {  
    $data = array('media' => new \CURLFile(realpath("upload.jpg")));  
} else {  
    $data = array('media' => '@' . realpath("upload.jpg"));  
}  


$curl = new MyCurl($url);  
$ret = $curl->post($data);
$row = json_decode($ret);//对JSON格式的字符串进行编码  
echo $ret;
echo $row->media_id;