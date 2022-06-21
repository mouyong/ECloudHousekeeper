# E 云管家

[![Sponsor me](https://github.com/mouyong/mouyong/blob/master/sponsor-me-button-s.svg?raw=true)](https://github.com/sponsors/mouyong)


## 安装

```shell
$ composer require mouyong/ecloudhousekeeper -vvv
```

## 配置

在 laravel 项目 .env 种增加如下配置，配置获取地址：[管理后台](http://122.237.103.224:6327/#/dashboard) -> API 开通信息
**联系<a href="mailto:1254075921@qq.com?subject=了解 E 云管家优惠信息&body=请问最新的优惠信息是啥？" title="qq: 1254075921">作者</a>了解优惠信息**
```
E_CLOUD_HOUSEKEEPER_API=
E_CLOUD_HOUSEKEEPER_ACCOUNT=
E_CLOUD_HOUSEKEEPER_PASSWORD=
```

## 使用

```php
$wcid = "";
$wid = "";
$api = 'http://your-wkcloud-api-address';

$client = \MouYong\ECloudHousekeeper\ECloudHousekeeperClient::make();
// $client->setBaseUri($api);

// 设置消息回调地址
// $data = $client->json('/setHttpCallbackUrl', [
//     'httpUrl' => route('wechat.callback'),
//     'type' => 2,
// ]);

// 取消设置消息回调地址
// $data = $client->json('/cancelHttpCallbackUrl');

// 1. e cloud 平台登录
// $loginData = $client->json('/member/login', [
//     'account' => $client->getAccount(),
//     'password' => $client->getPassword(),
// ]);
// or
// $loginData = $client->eCloudLogin();

// 二次登录
// $data = $client->json('/secondLogin', [
//     'wcId' => $wcid,
//     'type' => 2,
// ]);

// 2. 微信登录，扫码后需要调用 simpleIPadLoginInfo 接口完成首次登录。首次登录成功后，建议后续通过 wcId 调用二次登录。避免登录时使用新的设备，产生风控风险
// $data = $client->json('/iPadLogin', [
//     'wcId' => $wcid ?? '', // 首次为 "", 掉线登录为 3 接口返回的信息
// ]);
// return \response(file_get_contents($data['data']['qrCodeUrl']))->header('Content-Type', 'image/jpeg');

// $data = $client->json('/simpleIPadLoginInfo', [
//     'wId' => $wid,
//     // 'wId' => $data['data'][0]['wId'],
// ]);

// 3. 查询已登录账号
// $data = $client->json('/queryLoginWx');

// 获取登录实例的在线状态
// $data = $client->json('/isOnline', [
//     'wId' => $data['data'][0]['wId'],
// ]);
// 初始化通讯录
// $data = $client->json('/initAddressList', [
//     'wId' => $wid,
// ]);

// 获取通讯录，在调用之前需要先完成初始化通讯录
// $data = $client->json('/getAddressList', [
//     'wId' => $wid,
// ]);

// 获取联系人详细信息
// $data = $client->json('/getContact', [
//     'wId' => $wid,
//     'wcId' => 'wxid_u4f7tsn8hgbj22,wxid_lejlzeigj4kt22',
// ]);

// 退出微信
// $data = $client->json('/member/offline', [
//     'account' => $client->getAccount(),
//     'wcIds' => [$wcid],
// ]);

// 搜索微信号或手机号
// $data = $client->json('/searchUser', [
//     'wId' => $wid,
//     'wcId' => '133xxxx3333',
// ]);

// 在线 3 天后才可以获取群二维码
// $data= $client->json('/getGroupQrCode', [
//     'wId' => $wid,
//     'chatRoomId' => '1290229915@chatroom',
// ]);
// header('Content-Type', 'image/jpg');
// return file_get_contents('http://xdkj-enterprise.oss-cn-beijing.aliyuncs.com/20220622/2c3437ac-cc43-48de-b123-2ec76681505b.jpg?Expires=1656432859&OSSAccessKeyId=LTAI4G5VB9BMxMDV14c6USjt&Signature=9i7SXjnQYAfVEqMNHuN6lh%2BVQBs%3D');

// 获取朋友圈列表
// $data = $client->json('/getCircle', [
//     'wId' => $wid,
//     'firstPageMd5' => '', // 首次传 ''
//     'maxId' => 0, '', // 首次传 0
// ]);

// 获取朋友圈详情
// $data = $client->json('/getSnsObject', [
//     'wId' => $wid,
//     'wcId' => $wcid,
//     'id' => '13890042351255695627',
// ]);

dump($data->toArray() ?? []);
dd($data['data'] ?? []);
```

## :heart: 支持我

[![Sponsor me](https://github.com/mouyong/mouyong/blob/master/sponsor-me.svg?raw=true)](https://github.com/sponsors/mouyong)

如果你喜欢我的项目并想支持它，[点击这里 :heart:](https://github.com/sponsors/mouyong)

## 贡献

You can contribute in one of three ways:

1. File bug reports using the [issue tracker](https://github.com/mouyong/ecloudhousekeeper/issues).
2. Answer questions or fix bugs on the [issue tracker](https://github.com/mouyong/ecloudhousekeeper/issues).
3. Contribute new features or update the wiki.

_The code contribution process is not very formal. You just need to make sure that you follow the PSR-0, PSR-1, and PSR-2 coding guidelines. Any new code contributions must be accompanied by unit tests where applicable._

## 授权

[Apache-2.0](LICENSE)
