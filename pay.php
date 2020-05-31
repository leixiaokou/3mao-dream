<?php
/*
 * @Author: yumusb
 * @Date: 2019-08-19 17:14:30
 * @LastEditors: yumusb
 * @LastEditTime: 2019-08-19 17:50:24
 * @Description: 
 */

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    exit(json_encode(array('code'=>-1,'msg'=>'请使用post方式!')));
}

if(empty($_POST['money']) || empty($_POST['info'])){
    exit(json_encode(array('code'=>-1,'msg'=>'请填写完整!')));
}

//exit(json_encode(array('code'=>1,'msg'=>'成功啦')));

require_once './f2fpay/model/builder/AlipayTradePrecreateContentBuilder.php';
require_once './f2fpay/service/AlipayTradeService.php';

$outTradeNo = md5(time() . "91445646fsd6fsdfs4564544"); //生成订单账号。要保证唯一性。可以改用其他更符合自己的算法。
//$totalAmount = round(trim($_POST['amount']), 2); //错误写法 这样并不会对整数以及一位小数后面补0
$totalAmount=sprintf('%.2f',trim($_POST['money']));//支付宝金额只支持两位小数

if (!is_numeric($totalAmount) || $totalAmount == 0) {
    exit(json_encode(array('code'=>-1,'msg'=>'订单金额不合法!')));
}
$body = htmlentities(trim($_POST['info']));
if (strlen($body) > 255) {
    exit(json_encode(array('code'=>-1,'msg'=>'备注太长了!')));
}


/*记录订单信息*/
if (NeedTakeNote == "yes") {
    $tmp = $db->prepare("INSERT INTO `{$table}`(`order_no`, `mark`, `mount`,`status`, `created_at`) VALUES (?,?,?,?,?)");
    $tmp->execute(array($outTradeNo, $body, $totalAmount, 2, date('Y-m-d H:i:s')));
    //file_put_contents('pay.txt', 'yes' . json_encode($temp));javascript:;
}


// 创建请求builder，设置请求参数
$qrPayRequestBuilder = new AlipayTradePrecreateContentBuilder();
$qrPayRequestBuilder->setOutTradeNo($outTradeNo);
$qrPayRequestBuilder->setTotalAmount($totalAmount);
$qrPayRequestBuilder->setSubject("LaJun_3毛钱助梦_".$totalAmount."元");
#print_r(get_class_methods($qrPayRequestBuilder));
// 调用qrPay方法获取当面付应答
$qrPay = new AlipayTradeService($alipay_config);
$qrPayResult = $qrPay->qrPay($qrPayRequestBuilder);

if ($qrPayResult->getTradeStatus() === "SUCCESS") {
    $qr = $qrPayResult->getResponse()->qr_code; //SUCCESS 是官方SDK给的结果。如果想看详细的介绍，去找SDK
} else {
    exit(json_encode(array('code'=>-1,'msg'=>'生成订单失败,错误原因：'.$qrPayResult->getTradeStatus())));
}

/*$form['body'] = $body;
$form['no'] = $outTradeNo;
$form['money'] = $totalAmount;
$form['qr'] = $qr;*/
exit(json_encode(array('code'=>1,'qrcode'=>$qr,'order'=>$outTradeNo)));
?>
