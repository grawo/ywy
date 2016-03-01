<?php

/*--------------------------------
功能:		duanxin.cm PHP HTTP接口 发送短信
修改日期:	2014-03-19
说明:		http://api.duanxin.cm/?action=send&username=用户账号&password=MD5位32密码&phone=号码&content=内容
状态:
	100 发送成功
	101 验证失败
	102 短信不足
	103 操作失败
	104 非法字符
	105 内容过多
	106 号码过多
	107 频率过快
	108 号码内容空
	109 账号冻结
	110 禁止频繁单条发送
	111 系统暂定发送
	112 号码不正确
	120 系统升级

$username = '70201503';		//用户账号
$password = '13621973524';		//密码
$phone	 = '15021901912';	//号码
$content = 'duanxin.cm PHP HTTP接口';		//内容
//即时发送
$res = sendSMS($username,$password,$phone,$content);
echo $res;

//定时发送
$time = '2010-05-27 12:11';
$res = sendSMS($username,$password,$phone,$content,$time);
echo $res;
--------------------------------*/

namespace Org\Util;

class SendSMS
{
    public function sendmessage($username,$password,$phone,$content,$time='',$mid='')
    {
    	$http = 'http://api.duanxin.cm/';
    	$data = array
    		(
    		'action'=>'send',
    		'username'=>$username,					//用户账号
    		'password'=>strtolower(md5($password)),	//MD5位32密码
    		'phone'=>$phone,				//号码
    		'content'=>iconv('utf-8','gbk',$content), //内容
    		'time'=>$time,		//定时发送          
    		);
    	$re= $this->postSMS($http,$data);			//POST方式提交
    	return trim($re);
    }
    
    public function postSMS($url,$data='')
    {
    	$row = parse_url($url);
    	$host = $row['host'];
    	$port = $row['port'] ? $row['port']:80;
    	$file = $row['path'];
    	while (list($k,$v) = each($data)) 
    	{
    		$post .= rawurlencode($k)."=".rawurlencode($v)."&";	//转URL标准码
    	}
    	$post = substr( $post , 0 , -1 );
    	$len = strlen($post);
    	$fp = @fsockopen( $host ,$port, $errno, $errstr, 10);
    	if (!$fp) {
    		return "$errstr ($errno)\n";
    	} else {
    		$receive = '';
    		$out = "POST $file HTTP/1.0\r\n";
    		$out .= "Host: $host\r\n";
    		$out .= "Content-type: application/x-www-form-urlencoded\r\n";
    		$out .= "Connection: Close\r\n";
    		$out .= "Content-Length: $len\r\n\r\n";
    		$out .= $post;		
    		fwrite($fp, $out);
    		while (!feof($fp)) {
    			$receive .= fgets($fp, 128);
    		}
    		fclose($fp);
    		$receive = explode("\r\n\r\n",$receive);
    		unset($receive[0]);
    		return implode("",$receive);
    	}
    }
}
?>