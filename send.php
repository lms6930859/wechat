<?php
include 'token.php';

function  sendAll($message)
{
	$token = cacheToken();
	// 获取所有用户
	$url = 'https://api.weixin.qq.com/cgi-bin/user/get?access_token='. $token;
	$curl = new MyCurl($url);
	// 得到json数据的所有用户
	$ret = $curl->get();
	$decStr = json_decode($ret);
	// 得到所有用户的ip
	$userArr = $decStr->data->openid;
	// 通过循环将所有用户保存到数组,以达到发送给所有用户消息
	$i = 0;
	foreach ($userArr as $key => $value) {
		$data['touser'][$i] = $value;
		$i++;
	}

//-------------------------------------------------------------------------------------------
	// 开始群发文本
	$urlTwo = 'https://api.weixin.qq.com/cgi-bin/message/mass/send?access_token='. $token;
	$curlTwo = new MyCurl($urlTwo);
	// $data['touser'][0] = "oZjC60ZYqQc29SJdpr9BdFehrkrY";
	// $data['touser'][1] = "oZjC60S2fX9TC7sot0mfqEPRxESo";
	$data['msgtype'] = "text";
	$data['text']['content'] = $message;



	$endata =  json_encode($data, JSON_UNESCAPED_UNICODE);
	$res = $curlTwo->post($endata);
	echo $res;

//-------------------------------------------------------------------------------------------
	//群发图文
/*	$urlTwo = 'https://api.weixin.qq.com/cgi-bin/message/mass/send?access_token='. $token;
	$curlTwo = new MyCurl($urlTwo);
	// $data['touser'][0] = "oZjC60ZYqQc29SJdpr9BdFehrkrY";
	// $data['touser'][1] = "oZjC60S2fX9TC7sot0mfqEPRxESo";
	$data['msgtype'] = "mpnews";
	$data['send_ignore_reprint'] = 1;
	$data['mpnews']['media_id'] = "hA-IwtKshw4B3gMPW9Zl14UBk0nYA2-Drs6rfHX-yV4";
	$data['text']['content'] = "每天5分针";



	$endata =  json_encode($data, JSON_UNESCAPED_UNICODE);
	$res = $curlTwo->post($endata);
	echo $res;*/

}


$value=$_GET['value'];
if(isset($value))
{
	sendAll($value);
}
