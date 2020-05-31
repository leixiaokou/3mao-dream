<?php
/*
 * @Author: yumusb
 * @Date: 2019-08-19 17:35:15
 * @LastEditors: yumusb
 * @LastEditTime: 2019-08-19 17:50:00
 * @Description: 
 */
header("Content-type: text/html; charset=utf-8");
function exitt($a = "错误", $b = "../")
{

	echo "<script>alert('{$a}');window.location.href='{$b}'</script>";
	exit();
}
const NeedTakeNote = 'yes';
//需要记录,则改为 yes
//不需要 值为 no
//如果需要记录 需要正确的数据库配置


$http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
$url = dirname($http_type . $_SERVER['SERVER_NAME'] . $_SERVER["REQUEST_URI"]) . "/notify.php";
$url = ''; //支付宝后台的回调通知地址
//echo "{$url}?check"; //访问这个输出的url检测回调可用性
$alipay_config = array(
	//签名方式,默认为RSA2(RSA2048)
	'sign_type' => "RSA2",
	//支付宝公钥
    'alipay_public_key' => "",
    //商户私钥
    'merchant_private_key' => "",
	//编码格式
	'charset' => "UTF-8",

	//支付宝网关
	'gatewayUrl' => "https://openapi.alipay.com/gateway.do",

	//应用ID
	'app_id' => "", //

	//最大查询重试次数
	'MaxQueryRetry' => "10",
	
	'notify_url' => $url,

	//查询间隔
	'QueryDuration' => "3"
);

if ($alipay_config['alipay_public_key'] == '' || $alipay_config['merchant_private_key'] == '' || $alipay_config['app_id'] == '') {
	exit("alipay_public_key/merchant_private_key/app_id must not be null");
}

//数据库配置信息。
if (NeedTakeNote == "yes") {
	$database = array(
		'dbname' => '', //修改这个，数据库名
		'host' => '',
		'port' => 3306,
		'user' => '', //修改这个，数据库用户名
		'pass' => '', //修改这个，数据库密码
	);

	try {
		$db = new PDO("mysql:dbname=" . $database['dbname'] . ";host=" . $database['host'] . ";" . "port=" . $database['port'] . ";", $database['user'], $database['pass'], array(PDO::MYSQL_ATTR_INIT_COMMAND => "set names utf8"));
	} catch (PDOException $e) {
		die("数据库出错，请检查 config.php中的database配置项.<br> " . $e->getMessage() . "<br/>");
	}

	$table = 'f2f_order'; //表名字
}
