<?php

include 'token.php';
include 'WeChat.php';
include 'sendall.php';
require_once 'curl.func.php';


$token1 = cacheToken();
$url = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token='. $token1;
define('TOKEN', 'hello');
define('ACCESS_TOKEN',$token1);
//第一步  实现微信服务器和自己的服务器结合
//
$weixin = new WeixinCheck();
 //$weixin->check();
$weixin->responseMessage();


##生成自定义菜单
// $wechat = new WeChat(); 
// $wechat->easyMenu();

##群发消息
// sendAll();




class WeixinCheck
{

	
	public function responseMessage()
	{
		
		
		$postr = file_get_contents('php://input');
		$obj = simplexml_load_string($postr);
		$type=$obj->MsgType;
		// file_put_contents('msg.txt', $type);
		//发送给用户的id可以获取到 
		$fromUser = $obj->ToUserName;
		$toUser = $obj->FromUserName;
		

		// 用户发给我的内容
		$content = $obj->Content;
		$time = time();
		if (strstr($type, 'text'))
		{

			//进行上传
			//数据库链接
		  	$link=mysqli_connect('localhost','root','123456');
			if(!$link)
			{
				exit('数据库链接失败');
			}

			mysqli_set_charset($link,'utf8');
			mysqli_select_db($link,'message');
			$msgid = $obj->MsgId;

			$sql="insert into message(openid,time,type,content,msgid) values('$obj->FromUserName',$time,'$type','$content',$msgid) ";
			$res=mysqli_query($link,$sql);

			


			 if (strstr($content, '爱'))
			  {

			

		 		$value = '再丑也要谈恋爱，谈到世界充满爱';

		 		$str = "<xml><ToUserName><![CDATA[%s]]></ToUserName>
		 		<FromUserName><![CDATA[%s]]></FromUserName>
		 		<CreateTime>%s</CreateTime>
		 		<MsgType><![CDATA[%s]]></MsgType>
				<Content><![CDATA[%s]]></Content>
		 		</xml>";

		 	 	
			

		 		echo sprintf($str,$toUser,$fromUser,$time,$type,$value);



			  }
			  else if(strstr($content, '音乐'))
			  {
			  	$type='music';
			  	$title='音乐';
			  	$description='这是一段音乐';
			  	$music='http://weixin.xiaomingzaiqianfeng.xin/1.wav';
			  	$hqmusic='http://weixin.xiaomingzaiqianfeng.xin/1.wav';
			  	// $value=$obj->ThumbMediaId;
			  	$value='8icuvbtvJYA2P9aM1e-1R8VQtKbcKT82nJ-ELDgTMmArlhgjqAB3LyBsEoEN_2Ci';

			  	$str='<xml>
				<ToUserName><![CDATA[%s]]></ToUserName>
			  	<FromUserName><![CDATA[%s]]></FromUserName>
			  	<CreateTime>%s</CreateTime>
			  	<MsgType><![CDATA[%s]]></MsgType>
			  	<Music>
			  	<Title><![CDATA[%s]]></Title>
			  	<Description><![CDATA[%s]]></Description>
			  	<MusicUrl><![CDATA[%s]]></MusicUrl>
			  	<HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
			  	<ThumbMediaId><![CDATA[%s]]></ThumbMediaId>
			  	</Music>
			  	</xml>';

			  	echo sprintf($str,$toUser,$fromUser,$time,$type,$title,$description,$music,$hqmusic,$value);
			  }
			  else if(strstr($content, '视频'))
			  {
			  	$type='video';
			  	$title='视频';
			  	$description='这是一个视频';
			  	// $value=$obj->MediaId;
			  	$value='jSTxR4beY2FR59g-IuxJAtS9YpDnk2HSchht9PMT84NcExmwBg_BYEB6EAI_D9At';

			  	$str='<xml>
			  	<ToUserName><![CDATA[%s]]></ToUserName>
			  	<FromUserName><![CDATA[%s]]></FromUserName>
			  	<CreateTime>%s</CreateTime>
			  	<MsgType><![CDATA[%s]]></MsgType>
			  	<Video><MediaId><![CDATA[%s]]></MediaId>
			  	 </xml>';


			  	echo sprintf($str,$toUser,$fromUser,$time,$type,$value);
			  }
			  else if (strstr($content, '历')) 
			  {
			  	 
				 
				$appkey = '48e4f23a118fbf7b';//你的appkey 
				$date = date('Y-m-d');;
				$url = "http://api.jisuapi.com/calendar/query?appkey=$appkey&date=$date";
				$result = curlOpen($url);
				$jsonarr = json_decode($result, true);
				//exit(var_dump($jsonarr));
				 
				if($jsonarr['status'] != 0)
				{
				    echo $jsonarr['msg'];
				    exit();
				}
				 
				$result = $jsonarr['result'];
				$huangli = $result['huangli'];
				$value = $result['year'].'年 '.$result['month'].'月 '.$result['day'].'日
星期'.$result['week'].'
'.$huangli['nongli'].'
'.'宜'.join(',',$huangli['yi']) ;

		 		$str = "<xml><ToUserName><![CDATA[%s]]></ToUserName>
		 		<FromUserName><![CDATA[%s]]></FromUserName>
		 		<CreateTime>%s</CreateTime>
		 		<MsgType><![CDATA[%s]]></MsgType>
				<Content><![CDATA[%s]]></Content>
		 		</xml>";

		 		echo sprintf($str,$toUser,$fromUser,$time,$type,$value);

			  }
			  else if(strstr($content, '天气'))
			  {
			  	$appkey = '3146d21ea82a8baa';//你的appkey
			  	$city=mb_substr($content,0,-2);
				// $city = '安顺';

				$url = "http://api.jisuapi.com/weather/query?appkey=$appkey&city=$city";
				$result = curlOpen($url);
				$jsonarr = json_decode($result, true);
				//exit(var_dump($jsonarr));
				if($jsonarr['status'] != 0)
				{
				    echo $jsonarr['msg'];
				    exit();
				}
				 
				$result = $jsonarr['result'];
			
				$title1=$result['city'].' '.$result['date'].' '.$result['week'];



				foreach($result['daily'] as $daily)
				{
				    $data[]= $daily['date'].' '.$daily['week']."\n ". $daily['night']['weather'].' '.$daily['night']['winddirect'].' '.$daily['night']['windpower']."\n";
				   
						}
				$DA[0]=' '.$data[0];
				$DA[1]=$data[1];
				$DA[2]=$data[2];

				$description1 = join(' ' , $DA);


		 		$str='<xml>
		 		<ToUserName><![CDATA[%s]]></ToUserName>
		 		<FromUserName><![CDATA[%s]]></FromUserName>
		 		<CreateTime>%s</CreateTime>
		 		<MsgType><![CDATA[news]]></MsgType>
		 		<ArticleCount>1</ArticleCount>
		 		<Articles>
		 		<item>
		 		<Title><![CDATA[%s]]></Title>
		 		<Description><![CDATA[%s]]></Description>
		 		<PicUrl><![CDATA[https://mmbiz.qpic.cn/mmbiz_png/mabMGGmLlYLoHDJdAWQNPR1Q7xMtnMBeJYSQciaLxibNQIZqlSYTrLupMlIBkFY51g5tPGZLX6a9SN66K9ACsm6w/0?wx_fmt=gif]]></PicUrl>
		 		<Url><![CDATA[http://m.weather.com.cn/d/town/index?lat=39.95933&lon=116.29845]]></Url>
		 		</item>
		 		</Articles>
		 		</xml>';

		 		echo sprintf($str,$toUser,$fromUser,$time,$title1,$description1);
			
			  }
			  elseif (strstr($content, '头条')||strstr($content, '新闻'))
			  {
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

				$num=intval(rand(2,9));
				  $title1=$result['list'][$num]['title'];
				  $time=$result['list'][$num]['time'];
				  $pic=$result['list'][$num]['pic'];
				  $content=$result['list'][$num]['content'];
				  $url=$result['list'][$num]['url'];

				$str='<xml>
		 		<ToUserName><![CDATA[%s]]></ToUserName>
		 		<FromUserName><![CDATA[%s]]></FromUserName>
		 		<CreateTime>%s</CreateTime>
		 		<MsgType><![CDATA[news]]></MsgType>
		 		<ArticleCount>1</ArticleCount>
		 		<Articles>
		 		<item>
		 		<Title><![CDATA[%s]]></Title>
		 		<Description><![CDATA[%s]]></Description>
		 		<PicUrl><![CDATA[%s]]></PicUrl>
		 		<Url><![CDATA[%s]]></Url>
		 		</item>
		 		</Articles>
		 		</xml>';

		 		echo sprintf($str,$toUser,$fromUser,$time,$title1,$description1,$pic,$url);
				 
			  }


		}
		else if(strstr($type, 'image'))
		{
			 // $value = 'FQb-4iSIRFu3nrWo7KaeQ398Vg2Stia7QHG5uQh5oZSQ1NJvL_9k-ReM4U47-Dx2';
			 $value = 'hA-IwtKshw4B3gMPW9Zl1_UD3EjzvBJOnsI9NrZqtm4';
			 // $value = 'NhBPicprW4mM9pYAgmuNb5D0uFGfrNQHWvzutHaWL21CgebO5UmWp9GRYY2un3-j';
			 // $value = '5VbUhDOh2FPgw8b9zuP59LtPSD8OssOLO_WeN8PUdRpoz7bLs-lvdR_5vVnIVcVQ';

			 $str = "<xml><ToUserName><![CDATA[%s]]></ToUserName>
				<FromUserName><![CDATA[%s]]></FromUserName>
		 		<CreateTime>%s</CreateTime>
				<MsgType><![CDATA[%s]]></MsgType>
				<Image><MediaId><![CDATA[%s]]></MediaId></Image>
				</xml>";


			$test=sprintf($str,$toUser,$fromUser,$time,$type,$value);
			
			echo $test;
		}
		else if(strstr($type, 'oice'))
		{
			 $value =$obj->MediaId;

				$str = "<xml><ToUserName><![CDATA[%s]]></ToUserName>
				<FromUserName><![CDATA[%s]]></FromUserName>
		 		<CreateTime>%s</CreateTime>
				<MsgType><![CDATA[%s]]></MsgType>
				<Voice><MediaId><![CDATA[%s]]></MediaId></Voice>
				</xml>";

			echo sprintf($str,$toUser,$fromUser,$time,$type,$value);
		}
		else if(strstr($type, 'event'))
		{
			if($obj->Event == 'subscribe')
			{

				$value = ' 感谢您的关注
1.输入地名+天气可获取当地天气状况
2.输入日历获取万年历信息
3.输入新闻获取每日新闻
4.输入音乐获取推荐音乐
5.输入视频获取推荐视频';
				
				$type = 'text';
				//固定格式
				$str = "<xml><ToUserName><![CDATA[%s]]></ToUserName>
						<FromUserName><![CDATA[%s]]></FromUserName>
						<CreateTime>%s</CreateTime>
						<MsgType><![CDATA[%s]]></MsgType>
						<Content><![CDATA[%s]]></Content>
					
					</xml>";
				echo sprintf($str,$toUser,$fromUser, $time, $type, $value);
			}
			elseif ($obj->EventKey == 'click')
			{
				
				
				$title1='离骚';
				$description1='帝高阳之苗裔兮，朕皇考曰伯庸';
				//固定格式
				$str='<xml>
		 		<ToUserName><![CDATA[%s]]></ToUserName>
		 		<FromUserName><![CDATA[%s]]></FromUserName>
		 		<CreateTime>%s</CreateTime>
		 		<MsgType><![CDATA[news]]></MsgType>
		 		<ArticleCount>1</ArticleCount>
		 		<Articles>
		 		<item>
		 		<Title><![CDATA[%s]]></Title>
		 		<Description><![CDATA[%s]]></Description>
		 		<PicUrl><![CDATA[https://mmbiz.qpic.cn/mmbiz_png/mabMGGmLlYLoHDJdAWQNPR1Q7xMtnMBeJYSQciaLxibNQIZqlSYTrLupMlIBkFY51g5tPGZLX6a9SN66K9ACsm6w/0?wx_fmt=gif]]></PicUrl>
		 		<Url><![CDATA[https://0x9.me/LScth]]></Url>
		 		</item>
		 		</Articles>
		 		</xml>';

				echo sprintf($str,$toUser,$fromUser,$time,$title1,$description1);
			}
		}



		


		
	}
	public function check()
	{
		$echoStr = $_GET['echostr'];
		if ($this->checkSignature()) {
			//赞正成功
			echo $echoStr;
		} else {

		}
	}
	private function checkSignature()
	{
    $signature =  $_GET["signature"];
    $timestamp = $_GET["timestamp"];
    $nonce =  $_GET["nonce"];
	$token = TOKEN;
	$tmpArr = array($token, $timestamp, $nonce);
	sort($tmpArr, SORT_STRING);
	$tmpStr = implode( $tmpArr );
	$tmpStr = sha1( $tmpStr );

	if( $signature == $tmpStr ){
			return true;
	}else{
			return false;
		}
	}
}
