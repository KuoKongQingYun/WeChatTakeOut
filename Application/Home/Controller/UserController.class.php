<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {
	private function userInit(){
		$wxid = I('get.wxid');
		$wxid = $wxid==""?I('cookie.wxid'):$wxid;
		if($wxid=="")
		{
			exit("请从微信访问！");
		}
		else
		{
			cookie('wxid',$wxid);
			$user=M('user');
			$selectUser=$user->where(array("wxid"=>$wxid))->select();
			if(count($selectUser)==0)
			{
				$this->redirect('User/index');
			}
			return $selectUser[0];
		}
	}
	private function categoryInit(){
		
		$category=M('category');
		$selectCategory=$category->select();
		$this->assign('categoryList',$selectCategory);
		return $selectCategory;
	}
	public function index(){
		$this->categoryInit();
		$wxid = I('get.wxid');
		$wxid = $wxid==""?I('cookie.wxid'):$wxid;
		if($wxid=="")
		{
			exit("请从微信访问！");
		}
		else
		{
			cookie('wxid',$wxid);
			$user=M('user');
			$selectUser=$user->where(array("wxid"=>$wxid))->select();
			if(count($selectUser)==0)
			{
				$user->create(array('name' =>I('name'),'phone' =>I('phone') ,'address' =>I('address'),'wxid' =>$wxid));
				$user->add();
			}
			else
			{
				$currentUser=$selectUser[0];
				if(IS_POST)
				{
					$user->create(array('id'=>$currentUser['id'],'name' =>I('name'),'phone' =>I('phone') ,'address' =>I('address'),'wxid' =>$wxid));
					$user->save();
					$this->assign('name',I('name'));
					$this->assign('phone',I('phone'));
					$this->assign('address',I('address'));
					$this->assign('info','保存成功');
				}
				else 
				{
					$this->assign('name',$currentUser['name']);
					$this->assign('phone',$currentUser['phone']);
					$this->assign('address',$currentUser['address']);
				}
			}
			$this->display();
		}
	}
}