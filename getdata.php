<?php
include './config.php';
$tmp = $db->prepare("SELECT * FROM `{$table}` where `status` = 1 ORDER by `notify_time` DESC limit 5");
$tmp->execute();
$result = $tmp->fetchAll(PDO::FETCH_ASSOC);

$tmp = $db->prepare("SELECT sum(`mount`) as total FROM `{$table}` where `status` = 1 ORDER by `notify_time` DESC limit 5");
$tmp->execute();
$money = $tmp->fetchAll(PDO::FETCH_ASSOC);
$allmoney = $money[0]['total'];
$allmoney = 360 + $allmoney;

$html = '<h3 class="title">梦想记录(最新5条)</h3>';
for ($i = 0; $i < count($result); $i++) {
//$allmoney = @$allmoney + $result[$i]['mount'];
$html .= '<div class="item"><span class="price">￥'.$result[$i]['mount'].'</span><p class="item-name">'.$result[$i]['notify_time'].'</p><p class="item-description">来自于'.$result[$i]['buyer_logon_id'].'的梦想:&nbsp;&nbsp;'.$result[$i]['mark'].'</p></div>';
}
$html .= '<div class="total">全站助梦总计<span class="price">￥'.$allmoney.'</span></div>';
exit(json_encode(array('data'=>$html)));
