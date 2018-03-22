<?php
include 'token.php';

/*$token = cacheToken();
		$url = 'https://api.weixin.qq.com/cgi-bin/tags/members/getblacklist?access_token=' . $token;
		$curl = new MyCurl($url);
		$data = '{
			"begin_openid":""
		}';
		$ret = $curl->post($data);
		$decStr = json_decode($ret);
		// 得到所有黑名单用户的ip
		$userArr = $decStr->data->openid;
		// echo $ret;
		// var_dump($userArr);
		var_dump($userArr);*/


$token = cacheToken();
		$url = 'https://api.weixin.qq.com/cgi-bin/tags/members/batchunblacklist?access_token=' . $token;
		$user='o2ZQc1RZVY0YPNDn3kRFpmvdJhH4';
		$str = '{
			 "openid_list":["'.$user.'"]
			}';
		$curl = new MyCurl($url);
		
		//echo $str;
		//$str = json_encode($data, JSON_UNESCAPED_UNICODE);
		$ret = $curl->post($str);
		echo $ret;