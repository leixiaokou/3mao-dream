# 3mao-dream
This beg to reward  project based  alipay  face to face pay way using  original  PHP 使用支付宝当面付个人接口，原生PHP开发的变现乞讨项目 
#### 前言
* 项目是基于jquery + PHP原生代码。主要功能是一个订单表记录支付宝当面付用户情况。基于该项目改造后请保留链接到 https://pay.taokeduo.cn
* 使用前请了解支付宝当面付。在支付宝后台创建应用后开通签约当面付功能。只需要门牌照审核即可，签约费率一般为0.6
* 使用请自行阅读源码，解决问题，也是自己对项目的熟悉过程，更加灵活的改造
* 如果帮助到您，请给项目一个star， 后续会把该项目的支付宝当面付部分整理成一个简单面对对象的PHP开源composer包供大家使用，感谢！
#### 项目流程
index.html是主页面请求 query.php, getdata.php， pay.php接口
getdata.php 获取已支付订单列表。
1. 首先ajax调用pay.php使用支付宝当面付发起支付获取到支付链接，调用第三方二维码生成工具生成二维码到前端页面，同时产生未支付订单记录
2. 支付宝异步回调通知notify.php.加密签名收到请求数据改变订单状态，更新订单记录支付状态位
3. 页面定时请求query接口查询当前订单的支付状态直到发现订单状态为已支付。

#### 项目安装

* 原生PHP项目直接根目录指向 3mao-dream即可
* 创建一个数据库导入f2f_order.sql 创建表f2f_order。 表结构有注释
* 配置文件config.php 配置项文件注释有 数据库相关 和 支付宝相关
相关链接：
 <br>支付宝应用管理后台 https://developers.alipay.com/platform/developerIndex.htm
<br> 当面付产品说明及接口文档 https://opendocs.alipay.com/open/repo-0038t7

#### 结实快乐开发者
技术本身没什么考量，做出来一款能上线的作品是一件有意义的事儿，如果还能通过技术转化为生产力那就更好不过。
落魄PHP开发LaJun 微信1361683946
#### 感谢
本项目基于PHP支付宝当面付项目 https://github.com/yumusb/alipay-f2fpay    感谢！
#### 推广UCloud廉价服务器
  <div class="" style="max-width: 600px;margin:20px auto;">
            <a href="https://www.ucloud.cn/site/global.html?ytag=re598A"><img style="width: 100%; height: auto" src="https://leijun-common.oss-cn-shenzhen.aliyuncs.com/E0CA8A10-A010-4B85-800D-7CF58A18DFDC.png"></a>
          </div>
          <div class="" style="max-width: 600px;margin:20px auto;">
            <a href="https://www.ucloud.cn/site/active/1111.html?ytag=re598A"><img style="width: 100%; height: auto" src="https://leijun-common.oss-cn-shenzhen.aliyuncs.com/52FAF13E-C9CC-4444-901A-0F85F74E9D63.png"></a>
          </div>
