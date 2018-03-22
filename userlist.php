<?php
include 'token.php';

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
	$data11=[];
	foreach ($userArr as $key => $value) {
		$data11[$i] = $value;
		$i++;
	}

// var_dump($data);




//获取拉黑的名单openid
$url = 'https://api.weixin.qq.com/cgi-bin/tags/members/getblacklist?access_token='. $token;
	$curl = new MyCurl($url);
	$data = '{
		"begin_openid":""
	}';
	$ret = $curl->post($data);
	$decStr = json_decode($ret);
	// 得到所有黑名单用户的ip
	$userArrblack = $decStr->data->openid;



	

//去掉拉黑的部分
foreach ($userArr as $ke => $valu) 
{
	if(in_array($valu,$userArrblack))
	{
		// var_dump($value);
		// $data[$key]='';
		unset($userArr[$ke]);	

	}
}


$i = 0;
$decStr=[];
foreach ($userArr as $ky => $vlue) 
{
	// $value = "oZjC60ZYqQc29SJdpr9BdFehrkrY";
	$i++;
	$url2 = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$token.'&openid='.$vlue.'&lang=zh_CN';
 	$curl2 = new MyCurl($url2);
 	$ret = $curl2->get();
 	$decStr[] = json_decode($ret);
 	

}
$data11=[];
foreach($decStr as $vl)
{
	$data11[]=$vl;

}

//var_dump($decStr);

//计算数
$total=count($data11);
//每页显示数
$num=3;
//总页数
$pageCount=ceil($total/$num);
//当前页数
$pageNow=$_GET['pageNow'];
// //当前页数显示的数据 $data[(pagenow-1)*num]->$data[pagenow*num-1]
 $data22=array_chunk($data11,$num);
 $data33=$data22[$pageNow-1];
//var_dump($data33);

$DATA['data']=$data33;
$DATA['pageCount']=$pageCount;
$DATA['total']=$total;


echo  json_encode($DATA);




// subscribe	用户是否订阅该公众号标识，值为0时，代表此用户没有关注该公众号，拉取不到其余信息。
// openid	用户的标识，对当前公众号唯一
// nickname	用户的昵称
// sex	用户的性别，值为1时是男性，值为2时是女性，值为0时是未知
// city	用户所在城市
// country	用户所在国家
// province	用户所在省份
// language	用户的语言，简体中文为zh_CN
// headimgurl	用户头像，最后一个数值代表正方形头像大小（有0、46、64、96、132数值可选，0代表640*640正方形头像），用户没有头像时该项为空。若用户更换头像，原有头像URL将失效。
// subscribe_time	用户关注时间，为时间戳。如果用户曾多次关注，则取最后关注时间
// unionid	只有在用户将公众号绑定到微信开放平台帐号后，才会出现该字段。
// remark	公众号运营者对粉丝的备注，公众号运营者可在微信公众平台用户管理界面对粉丝添加备注
// groupid	用户所在的分组ID（兼容旧的用户分组接口）
// tagid_list	用户被打上的标签ID列表