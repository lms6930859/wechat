<?php 

include 'token.php';


$token = cacheToken();
/* 新增一个临时素材 */  
//url 里面的需要2个参数一个 access_token 一个是 type（值可为image、voice、video和缩略图thumb）  
$url = "https://api.weixin.qq.com/cgi-bin/media/upload?access_token=".$token."&type=image";  

if (class_exists('\CURLFile')) {  
    $data = array('media' => new \CURLFile(realpath("upload.jpg")));  
} else {  
    $data = array('media' => '@' . realpath("upload.jpg"));  
}  

$curl = new MyCurl($url);
  
$ret = $curl->post($data);
$row = json_decode($ret);//对JSON格式的字符串进行编码  

echo $row->media_id;


$fromUser = 'gh_f08371b0e61f';
$toUser = 'o2ZQc1RZVY0YPNDn3kRFpmvdJhH4';

$time=time();
$type='image';
// $value = $row->media_id;
$value = 'B3HynQA0EI6USKvnXY8NMYwT487uvpm__TNNlwbSPFRT5CDtFlV0hcETDwsxBm1Y';



// $str = "<xml><ToUserName><![CDATA[%s]]></ToUserName><FromUserName><![CDATA[%s]]></FromUserName><CreateTime>%s</CreateTime><MsgType><![CDATA[%s]]></MsgType><Image><MediaId><![CDATA[%s]]></MediaId></Image></xml>";

          


// $value = '再丑也要谈恋爱，谈到世界充满爱';

		 		$str = "<xml><ToUserName><![CDATA[%s]]></ToUserName>
		 		<FromUserName><![CDATA[%s]]></FromUserName>
		 		<CreateTime>%s</CreateTime>
		 		<MsgType><![CDATA[%s]]></MsgType>
				<Content><![CDATA[%s]]></Content>
		 		</xml>";
 echo sprintf($str,$toUser,$fromUser,$time,$type,$value);