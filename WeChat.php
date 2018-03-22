<?php
class WeChat
{
	function lahei()
	{
		$token = cacheToken();
		$url = 'https://api.weixin.qq.com/cgi-bin/tags/members/batchblacklist?access_token=' . $token;
		$str = '{
			 "openid_list":["ozndl1GVTtcyAX_wqH2RG0uiVPbs"]
			}';
		$curl = new MyCurl($url);
		
		//echo $str;
		//$str = json_encode($data, JSON_UNESCAPED_UNICODE);
		$ret = $curl->post($str);
		echo $ret;

	}
	//二级菜单
	function subMenu () 
	{
		$token = cacheToken();
		$url = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token='. $token;
			$data['button'][0] = [
				'type' => 'pic_weixin',
				'name' => '相册',
				'key' => 'btn'
			];
			$data['button'][1] = ['name' => '大片'];
			$data['button'][1]['sub_button'][0] = [
				'type' => 'click',
				'name' => '欧美',
				'key' => 'oumei'
			];
			$data['button'][1]['sub_button'][1] = [
				'type' => 'click',
				'name' => '韩日',
				'key' => 'hanri'
			];
			$data['button'][1]['sub_button'][2] = [
				'type' => 'click',
				'name' => '香港',
				'key' => 'hongkong'
			];
			$data['button'][1]['sub_button'][3] = [
				'type' => 'click',
				'name' => '你的最爱',
				'key' => 'avi'
			];

 		$curl = new MyCurl($url);
		
		//echo $str;
		$str = json_encode($data, JSON_UNESCAPED_UNICODE);
		$ret = $curl->post($str);
		echo $ret;


	}
	//一级菜单
	function easyMenu () 
	{
		$token = cacheToken();
		$url = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token='. $token;
		$data['button'][0] = ['name' => '点我啊'];

			
		$data['button'][0]['sub_button'][0] = [
				'type' => 'click',
				'name' => '图文',
				'key' => 'click'
			];
		$data['button'][0]['sub_button'][1] = [
				'type' => 'location_select',
				'name' => '位置',
				'key' => 'location_select'
			];
		$data['button'][0]['sub_button'][2] = [
				'type' => 'pic_weixin',
				'name' => '相册',
				'key' => 'pic_weixin'
			];
		$data['button'][0]['sub_button'][3] = [
				'type' => 'pic_sysphoto',
				'name' => '相机',
				'key' => 'pic_sysphoto'
			];




		$data['button'][1] = [
			'type'=>'view',
			'name' => '百度',
			'url' =>'http://www.baidu.com'
		];
		$data['button'][2] = [
			'type'=>'scancode_push',
			'name' => '扫一扫',
			'key' =>'sao'
		];

		$curl = new MyCurl($url);
		$str = json_encode($data, JSON_UNESCAPED_UNICODE);
		//echo $str;
		$ret = $curl->post($str);
		echo $ret;

	}
	
}