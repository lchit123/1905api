<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redis;
class TestController extends Controller
{ 

    //注册
    public function reg()
    {
        //请求passport
        $url = 'http://www.1905passport.com/admin/user/reg';
        $response = UserModel::curlPost($url,$_POST);
        return $response;
    }

    //登陆
    public function login()
    {
        //请求passport
        $url = 'http://www.1905passport.com/admin/user/login';
        $response = UserModel::curlPost($url,$_POST);
        return $response;
    }

    public function showData()
    {

        // 收到 token
        $uid = $_SERVER['HTTP_UID'];
        $token = $_SERVER['HTTP_TOKEN'];

        // 请求passport鉴权
        $url = 'http://passport.1905.com/api/auth';         //鉴权接口
        $response = UserModel::curlPost($url,['uid'=>$uid,'token'=>$token]);

        $status = json_decode($response,true);

        //处理鉴权结果
        if($status['errno']==0)     //鉴权通过
        {
            $data = "sdlfkjsldfkjsdlf";
            $response = [
                'errno' => 0,
                'msg'   => 'ok',
                'data'  => $data
            ];
        }else{          //鉴权失败
            $response = [
                'errno' => 40003,
                'msg'   => '授权失败'
            ];
        }

        return $response;

    }


    public function postman()
    {
        echo __METHOD__;
    }


    /**
     * 测试接口
     */
    public function postman1()
    {

        $data = [
            'user_name' => 'zhangsan',
            'email'     => 'zhangsan@qq.com',
            'amount'    => 10000
        ];

        echo json_encode($data);

    }

     public function md5test()
     {
        $data = "Hello world";      //要发送的数据
        $key = "1905";              //计算签名的key  发送端与接收端拥有相同的key

        //计算签名  MD5($data . $key)
        //$signature = md5($data . $key);
        $signature = 'sdlfkjsldfkjsfd';

        echo "待发送的数据：". $data;echo '</br>';
        echo "签名：". $signature;echo '</br>';

        //发送数据
        $url = "http://1905passport.com/test/check?data=".$data . '&signature='.$signature;
        echo $url;echo '<hr>';

        $response = file_get_contents($url);
        echo $response;
    }

       public function sign2()
    {
        $key = "1905";          // 签名使用key  发送端与接收端 使用同一个key 计算签名

        //待签名的数据
        $order_info = [
            "order_id"          => 'LN_' . mt_rand(111111,999999),
            "order_amount"      => mt_rand(111,999),
            "uid"               => 12345,
            "add_time"          => time(),
        ];

        $data_json = json_encode($order_info);

        //计算签名
        $sign = md5($data_json.$key);

        // post 表单（form-data）发送数据
        $client = new Client();
        $url = 'http://passport.1905.com/test/check2';
        $response = $client->request("POST",$url,[
            "form_params"   => [
                "data"  => $data_json,
                "sign"  => $sign
            ]
        ]);

        //接收服务器端响应的数据
        $response_data = $response->getBody();
        echo $response_data;

    }

    public function sign3()
    { 
        $data="Hello world";//待签名的数据
        //计算签名
        $path=storage_path('keys/privkey3')
        $pkeyid=openssl_pkey_get_private("file://".$path);
        //计算签名都得到$signature
        openssl_sign($data,$signature,$pkeyid);
        openssl_free_key($pkeyid);

        //base64编码方便传输
        $sign_str=base64_encode($signature);
        echo "base64encode后的签名：". $sign_str;

    }

    //非对称加密
    public function encrypt2()
    { 
        $data="这是一个秘密";

        //使用非对称加密
        //获取私钥
        //$prive_key=openssl_get_privatekey();
        $path=storage_path('keys/privkey3');
        $prive_key=openssl_get_private("file://".$path);
        openssl_plivate_encrypt($data,$encrypt_data,$prive_key,OPENSSL_PKCS1_PADDING);

        var_dump($encrypt_data);echo '<hr>';

        $base64_str=base64_encode($encyrypt_data);
        echo '</br>';
        echo $base64_str;

    }














}
