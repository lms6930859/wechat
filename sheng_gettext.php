<?php
/*include 'token.php';

$token = cacheToken();


$url = 'https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token='. $token;


$curl = new MyCurl($url);
$data = '{
"type":"news",
"offset":0,
"count":20
    }';


$ret = $curl->post($data);*/

$ret='{"item":[{"media_id":"E7Nse5wraer6OWCNEYQQ5oXNmNKE1guHrciJomJY73U","content":{"news_item":[{"title":"标题2","author":"作者2","digest":"摘要2","content":"内容2","content_source_url":"http:\/\/blog.csdn.net\/wenzhao911224\/article\/details\/27226887","thumb_media_id":"E7Nse5wraer6OWCNEYQQ5gPfhj1QwRJfg2helh3caac","show_cover_pic":1,"url":"http:\/\/mp.weixin.qq.com\/s?__biz=MzU4ODQyNDY0NQ==&mid=100000003&idx=1&sn=f56b831fd43ab7fdb0ec320f8adf2efe&chksm=7dddb5a94aaa3cbff193efa3bfbeb52d1b18706146478e58dcc020aea66a9081a90e17e98cd9#rd","thumb_url":"http:\/\/mmbiz.qpic.cn\/mmbiz_jpg\/lkL5lAgQdWfrOZoqaSoySOADEWBPwbOqLM9ibibJic4ktfjSPKhY5aRz2FwA5Vm0PUYiaEcicf9cHCE1u15BhzVSgBg\/0?wx_fmt=jpeg","need_open_comment":1,"only_fans_can_comment":0}],"create_time":1516436319,"update_time":1516436319},"update_time":1516436319},{"media_id":"E7Nse5wraer6OWCNEYQQ5mkKRRLpfJq4MYaKGNbX1qs","content":{"news_item":[{"title":"标题","author":"作者","digest":"摘要","content":"内容","content_source_url":"http:\/\/blog.csdn.net\/wenzhao911224\/article\/details\/27226887","thumb_media_id":"E7Nse5wraer6OWCNEYQQ5gPfhj1QwRJfg2helh3caac","show_cover_pic":1,"url":"http:\/\/mp.weixin.qq.com\/s?__biz=MzU4ODQyNDY0NQ==&mid=100000002&idx=1&sn=eac04dc380dd8a90a9177101feddf4de&chksm=7dddb5a84aaa3cbe92e3f3f833d56a0b20a0fdf2cf83270aa9c2ae0339a81fa06289edbbe98e#rd","thumb_url":"http:\/\/mmbiz.qpic.cn\/mmbiz_jpg\/lkL5lAgQdWfrOZoqaSoySOADEWBPwbOqLM9ibibJic4ktfjSPKhY5aRz2FwA5Vm0PUYiaEcicf9cHCE1u15BhzVSgBg\/0?wx_fmt=jpeg","need_open_comment":1,"only_fans_can_comment":0},{"media_id":"E7Nse5wraer6OWCNEYQQ5mkKRRLpfJq4MYaKGNbX1qs","content":{"news_item":[{"title":"标题","author":"作者","digest":"摘要","content":"内容","content_source_url":"http:\/\/blog.csdn.net\/wenzhao911224\/article\/details\/27226887","thumb_media_id":"E7Nse5wraer6OWCNEYQQ5gPfhj1QwRJfg2helh3caac","show_cover_pic":1,"url":"http:\/\/mp.weixin.qq.com\/s?__biz=MzU4ODQyNDY0NQ==&mid=100000002&idx=1&sn=eac04dc380dd8a90a9177101feddf4de&chksm=7dddb5a84aaa3cbe92e3f3f833d56a0b20a0fdf2cf83270aa9c2ae0339a81fa06289edbbe98e#rd","thumb_url":"http:\/\/mmbiz.qpic.cn\/mmbiz_jpg\/lkL5lAgQdWfrOZoqaSoySOADEWBPwbOqLM9ibibJic4ktfjSPKhY5aRz2FwA5Vm0PUYiaEcicf9cHCE1u15BhzVSgBg\/0?wx_fmt=jpeg","need_open_comment":1,"only_fans_can_comment":0}],"create_time":1516435397,"update_time":1516435397},"update_time":1516435397},{"media_id":"E7Nse5wraer6OWCNEYQQ5mkKRRLpfJq4MYaKGNbX1qs","content":{"news_item":[{"title":"标题","author":"作者","digest":"摘要","content":"内容","content_source_url":"http:\/\/blog.csdn.net\/wenzhao911224\/article\/details\/27226887","thumb_media_id":"E7Nse5wraer6OWCNEYQQ5gPfhj1QwRJfg2helh3caac","show_cover_pic":1,"url":"http:\/\/mp.weixin.qq.com\/s?__biz=MzU4ODQyNDY0NQ==&mid=100000002&idx=1&sn=eac04dc380dd8a90a9177101feddf4de&chksm=7dddb5a84aaa3cbe92e3f3f833d56a0b20a0fdf2cf83270aa9c2ae0339a81fa06289edbbe98e#rd","thumb_url":"http:\/\/mmbiz.qpic.cn\/mmbiz_jpg\/lkL5lAgQdWfrOZoqaSoySOADEWBPwbOqLM9ibibJic4ktfjSPKhY5aRz2FwA5Vm0PUYiaEcicf9cHCE1u15BhzVSgBg\/0?wx_fmt=jpeg","need_open_comment":1,"only_fans_can_comment":0}],"create_time":1516435397,"update_time":1516435397},"update_time":1516435397}],"total_count":2,"item_count":2}';

$jsonarr = json_decode($ret,true);
 $i=0;
 $data=[];
foreach ($jsonarr['item'] as $value)
{
    $data[$i] = $value;
    $i++;
}




  

//计算数
$total=count($data);
//每页显示数
$num=3;
//总页数
$pageCount=ceil($total/$num);
//当前页数
$pageNow=$_GET['pageNow'];
// //当前页数显示的数据 $data[(pagenow-1)*num]->$data[pagenow*num-1]
 $data22=array_chunk($data,$num);
 $data33=$data22[$pageNow-1];
//var_dump($data33);

$DATA['result']=$data33;
$DATA['pageCount']=$pageCount;
$DATA['total']=$total;



$DATA = json_encode($DATA);
echo $DATA;