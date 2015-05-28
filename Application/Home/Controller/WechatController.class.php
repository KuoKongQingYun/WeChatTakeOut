<?php
namespace Home\Controller;
use Think\Controller;
use \Org\Util\TPWechat;
class WechatController extends Controller {
    public function index(){
    	$options = array(
    	'token'=>'takeaway', //填写你设定的key
 		'encodingaeskey'=>'NNTbbVUyNyZA5t3dzoWhteu18NfQCNKkIS3BdqWJmj4', //填写加密用的EncodingAESKey
 		'appid'=>'wx618101eccc20ca8c', //填写高级调用功能的app id
 		'appsecret'=>'129b4352fa10ccea9a0afb1f9eb3ab0b'
 		);
    	$weObj = new TPWechat($options);
    	$weObj->valid();
      $weObj->createMenu(array(
        'button' => array(
          0=>array(
          'type'=>'click',
          'name'=>"点外卖",
          'key'=>"buy")
        )
      ));
    	$type = $weObj->getRev()->getRevType();
    	switch($type) {
   		case TPWechat::MSGTYPE_TEXT:
   			$openid=$weObj->getRevFrom();
        $weObj->text("<a href=\"http://wechat.linzhihao.cn/?wxid=$openid\" >请点击此链接进入购物菜单</a>")->reply();
  			exit;
  			break;
  		case TPWechat::MSGTYPE_EVENT:
        $openid=$weObj->getRevFrom();
        $weObj->text("<a href=\"http://wechat.linzhihao.cn/?wxid=$openid\" >请点击此链接进入购物菜单</a>")->reply();
  			break;
  		case TPWechat::MSGTYPE_IMAGE:
  			break;
  		default:
  			$weObj->text("help info")->reply();
  		}
    }
}