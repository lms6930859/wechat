<?php


/*include 'token.php';


$del = $_GET['del'];
$token = cacheToken();
$url = 'https://api.weixin.qq.com/cgi-bin/material/del_material?access_token='.$token;
		
$str = "{'media_id': ".$del." }";


// $str = '{"media_id":"'.$del.'"}';


// echo $str;

$curl = new MyCurl($url);


$ret = $curl->post($str);
// echo $ret;



$url = 'https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token='. $token;


$curl = new MyCurl($url);
$data = '{
"type":"news",
"offset":0,
"count":20
    }';


$ret = $curl->post($data);
*/
$ret='{"item":[{"media_id":"E7Nse5wraer6OWCNEYQQ5mkKRRLpfJq4MYaKGNbX1qs","content":{"news_item":[{"title":"标题","author":"作者","digest":"摘要","content":"内容","content_source_url":"http:\/\/blog.csdn.net\/wenzhao911224\/article\/details\/27226887","thumb_media_id":"E7Nse5wraer6OWCNEYQQ5gPfhj1QwRJfg2helh3caac","show_cover_pic":1,"url":"http:\/\/mp.weixin.qq.com\/s?__biz=MzU4ODQyNDY0NQ==&mid=100000002&idx=1&sn=eac04dc380dd8a90a9177101feddf4de&chksm=7dddb5a84aaa3cbe92e3f3f833d56a0b20a0fdf2cf83270aa9c2ae0339a81fa06289edbbe98e#rd","thumb_url":"http:\/\/mmbiz.qpic.cn\/mmbiz_jpg\/lkL5lAgQdWfrOZoqaSoySOADEWBPwbOqLM9ibibJic4ktfjSPKhY5aRz2FwA5Vm0PUYiaEcicf9cHCE1u15BhzVSgBg\/0?wx_fmt=jpeg","need_open_comment":1,"only_fans_can_comment":0}],"create_time":1516435397,"update_time":1516435397},"update_time":1516435397}],"total_count":2,"item_count":2}';

$jsonarr = json_decode($ret,true);
 $i=0;
 $data=[];
foreach ($jsonarr['item'] as $value)
{
    $data[$i] = $value;
    $i++;
}
$data['result'] = $data;
$data = json_encode($data);
echo $data;

